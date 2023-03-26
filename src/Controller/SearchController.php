<?PHP

namespace App\Controller;

use App\Entity\Party;
use App\Entity\User;
use App\Entity\UserComment;
use App\Entity\PartyUser;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Doctrine\ORM\EntityManagerInterface;

class SearchController extends AbstractController
{
    #[Route('/search', name: 'search')]
    public function search(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Allow acces only to connected user
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // Variables declaration
        $result=[];
        $result_party=[];
        $result_user=[];
        $error = "";
        $data = [];
        define("SEARCH_PARTY", "1");
        define("SEARCH_PLAYER", "0");

        // Get ID of user
        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        $user_ID = $user->getId();
        $user_ID_city = $user->getCity();
        $user_ID_lat = $user->getCityGPSLat();
        $user_ID_long = $user->getCityGPSLong();

        // Default value for form
        $defaults = [
            'city_name' => $user_ID_city,
            'city_GPS_lat' => $user_ID_lat,
            'city_GPS_long' => $user_ID_long,
            'search_type' => 0
        ];

        // Create form
        $form = $this->createFormBuilder($defaults)
            ->add('search_type', ChoiceType::class, [
                'choices'  => [
                    'Joueur' => 0,
                    'Partie' => 1,
                ],
                'expanded' => true,
                'label' => false, 
            ])
            ->add('city_name')
            ->add('city_GPS_lat', TextareaType::class,[
                'label' => false,
                ])
            ->add('city_GPS_long', TextareaType::class,[
                'label' => false]
                )
            ->add('distance', RangeType::class, [
                'attr' => [
                    'value' => 5,
                    'min' => 5,
                    'max' => 25,
                    'step' => 5
                ],
            ])
            ->add('send', SubmitType::class)
            ->getForm();

        // Process form
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Recover data from form
            $data = $form->getData();
            $user_ID_lat = $data['city_GPS_lat'];
            $user_ID_long = $data['city_GPS_long'];
            
            // Variables declaration
            $temp_result = [];

            // Check if user search player or party
            if($data['search_type'] == SEARCH_PARTY){
                // Search in database
                $result = $entityManager->getRepository(Party::class)->findAllAvailableParty();
                
                for ($i=0; $i < sizeof($result); $i++) { 
                    $player_lat = $result[$i]['address_gps_lat'];
                    $player_long = $result[$i]['address_gps_long'];
                    $distance_between = SearchController::calculateDistance($user_ID_lat,$user_ID_long,$player_lat,$player_long);              
                    if($distance_between <= $data['distance']){
                        $result[$i]['distance'] = round($distance_between,1);
                        array_push($temp_result,$result[$i]);
                    }
                }
                
                // Edit data before export to TWIG
                $result_party_host = SearchController::checkHostInformation($temp_result, $entityManager);
                $result_party_date = SearchController::editDate($result_party_host, $entityManager);
                $result_party_player = SearchController::checkUserInformation($result_party_date, $entityManager);
                $result_party_player_register = SearchController::checkIfUserRegistered($result_party_player, $user_ID, $entityManager);
                $result_party =$result_party_player_register;

            }else if($data['search_type'] == SEARCH_PLAYER){
                // Search in database
                $result = $entityManager->getRepository(User::class)->findAllAvailableUser($user_ID);

                for ($i=0; $i < sizeof($result); $i++) { 
                    $player_lat = $result[$i]['city_gps_lat'];
                    $player_long = $result[$i]['city_gps_long'];
                    $distance_between = SearchController::calculateDistance($user_ID_lat,$user_ID_long,$player_lat,$player_long);              
                    if($distance_between <= $data['distance']){
                        $result[$i]['distance'] = round($distance_between,1);
                        array_push($temp_result,$result[$i]);
                    }
                }

                // Edit data before export to TWIG
                $temp_result_date_created = SearchController::editDateCreatedAt($temp_result);
                $temp_result_last_connexion = SearchController::editLastConnexion($temp_result_date_created);
                $temp_result_age = SearchController::calculateAge($temp_result_last_connexion);
                $temp_result_comment = SearchController::numberOfComment($temp_result_age, $entityManager);
                $result_user = $temp_result_comment;
            }

            // Send a message if zero results are found
            if($result == []){
                $error = "Aucun résultats pour votre recherche";
            }
        }

        return $this->render('search.html.twig', [
            'searchForm' => $form->createView(),
            'current_user' => $user_ID,
            'partyResult' => $result_party,
            'userResult' => $result_user,
            'error' => $error,
            'data' => $data,
        ]);
    }

    public static function calculateDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo)
    {
        // Define constants
        $earth_radius = 6371;

        // convert from degrees to radians
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);
      
        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;
      
        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
          cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return $angle * $earth_radius;
    }

    public static function calculateAge($result)
    {
        // Get current year
        $current_year = date("Y");
        for ($i=0; $i < sizeof($result); $i++) { 
            #// Get year of birthdate
            $spliter_string =  str_split($result[$i]['birthdate'], 4);
            $birthdate_year = $spliter_string[0];

            // Calculate age
            $age = $current_year - $birthdate_year;

            // Edit age in array
            $result[$i]['birthdate'] = strval($age);
        }
        return $result;
    }

    public static function editDate($result)
    {
        for ($i=0; $i < sizeof($result); $i++) { 
            $spliter_string =  str_split($result[$i]['created_at'], 10);
            $result[$i]['date'] = $spliter_string[0];
        }
        return $result;
    }

    public static function editDateCreatedAt($result)
    {
        for ($i=0; $i < sizeof($result); $i++) { 
            $spliter_string =  str_split($result[$i]['created_at'], 10);
            $result[$i]['created_at'] = $spliter_string[0];
        }
        return $result;
    }

    public static function editLastConnexion($result)
    {
        // Get current date
        date_default_timezone_set('Europe/Paris');
        $current_date_string = date('Y/m/d', time());
        $current_date = strtotime($current_date_string);
        for ($i=0; $i < sizeof($result); $i++) { 
            $spliter_string =  str_split($result[$i]['created_at'], 10);
            $last_connexion_date  = strtotime($spliter_string[0]);
            $last_connexion_date = strtotime($spliter_string[0]);
            $timeDiff = abs($current_date - $last_connexion_date);
            $numberDays = $timeDiff/86400;
            $result[$i]['last_connexion'] = $numberDays;
        }
        return $result;
    }

    public static function numberOfComment($result, EntityManagerInterface $entityManager)
    {
        for ($i=0; $i < sizeof($result); $i++) { 
            // Get ID of user
            $userID = $result[$i]['id'];

            // Get number of comments
            $number = $entityManager->getRepository(UserComment::class)->numberOfComment($userID);

            // Store in array
            $result[$i]['number_comment'] = $number[0] ["COUNT(id)"];
        }
        return $result;
    }

    public static function checkIfUserRegistered($result, $user_ID,  EntityManagerInterface $entityManager)
    {
        for ($i=0; $i < sizeof($result); $i++) { 
            // Get ID of party
            $partyID = $result[$i]['id'];

            // Chek if already registered
            $checkIfAlreadyRegister = $entityManager->getRepository(PartyUser::class)->checkIfAlreadyRegister($partyID, $user_ID);

            // Store in array
            if($checkIfAlreadyRegister[0]["COUNT(id)"] == 1 ){
                $result[$i]['current_user_registered'] = true;
            }else{
                $result[$i]['current_user_registered'] = false;
            }
        }
        return $result;
    }

    public static function checkHostInformation($result, EntityManagerInterface $entityManager)
    {
        for ($i=0; $i < sizeof($result); $i++) { 
            // Get ID of party
            $host_user_ID = $result[$i]['user_host_id'];

            // Chek if already registered
            $party_host_name = $entityManager->getRepository(User::class)->find($host_user_ID);

            // Store in array
            $result[$i]['party_host_name'] = $party_host_name->getFirstName() . ' ' . $party_host_name->getLastName() ;
            $result[$i]['party_host_picture'] = $party_host_name->getPictureProfil();
        }
        return $result;
    }

    public static function checkUserInformation($result, EntityManagerInterface $entityManager)
    {
        for ($i=0; $i < sizeof($result); $i++) { 
            // Get ID of party
            $partyID = $result[$i]['id'];

            // Chek if already registered
            $party_user_list = $entityManager->getRepository(PartyUser::class)->findPartyWithID($partyID);

            $result[$i]['user_registered'] = null;
            for ($y=0; $y < sizeof($party_user_list); $y++) { 
                $party_user_information = $entityManager->getRepository(User::class)->find($party_user_list[$y]["user_id"]);

                // Store in array
                $result[$i]['user_registered'][$y]["user_id"] = $party_user_information->getId();
                $result[$i]['user_registered'][$y]["user_name"] = $party_user_information->getFirstName();
                $result[$i]['user_registered'][$y]["user_profil_picture"] = $party_user_information->getPictureProfil();
            }
        }
        return $result;
    }
}
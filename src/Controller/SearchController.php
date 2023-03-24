<?PHP

namespace App\Controller;

use App\Entity\Party;
use App\Entity\User;
use App\Entity\UserComment;
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
        define("EARTH_RADIUS",6371);

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
            
            $temp_result = [];

            // Check if user search player or party
            if($data['search_type'] == SEARCH_PARTY){
                // Search in database
                $result = $entityManager->getRepository(Party::class)->findAllAvailableParty();
                
                foreach ($result as $party) {
                    $party_lat = $party['address_gps_lat'];
                    $party_long = $party['address_gps_long'];
                    $distance_between = SearchController::calculateDistance($user_ID_lat,$user_ID_long,$party_lat,$party_long);
                    if($distance_between <= $data['distance']){
                        array_push($temp_result,$party);
                    }
                }
                $result_party = $temp_result;

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
            'partyResult' => $result_party,
            'userResult' => $result_user,
            'error' => $error,
            'data' => $data,
        ]);
    }

    public function calculateDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo){
        // convert from degrees to radians
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);
      
        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;
      
        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
          cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return $angle * EARTH_RADIUS;
    }

    public function calculateAge($result){
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

    public function editDateCreatedAt($result){
        for ($i=0; $i < sizeof($result); $i++) { 
            $spliter_string =  str_split($result[$i]['created_at'], 10);
            $result[$i]['created_at'] = $spliter_string[0];
        }
        return $result;
    }

    public function editLastConnexion($result){
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

    public function numberOfComment($result, EntityManagerInterface $entityManager){
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
}

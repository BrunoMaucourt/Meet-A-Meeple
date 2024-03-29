<?PHP

namespace App\Controller;

use App\Entity\Party;
use App\Entity\User;
use App\Entity\UserComment;
use App\Entity\PartyUser;
use App\Entity\Trait1;
use App\Entity\Trait2;
use App\Entity\Trait3;
use App\Entity\Trait4;
use App\Entity\UserBlackList;
use App\Entity\UserChat;
use App\Entity\UserFriend;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Doctrine\ORM\EntityManagerInterface;

class SearchController extends AbstractController
{
    #[Route('/search', name: 'search')]
    public function search(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Allow acces only to connected user
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // Variables declaration
        $result = [];
        $result_party = [];
        $result_user = [];
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

        // DEFAUT VALUE DATE INPUTS
        $tomorrow = date("Y-m-d", strtotime('tomorrow'));

        // setting non read message count
        $non_read_message_count = $entityManager->getRepository(UserChat::class)->findNonReadMessageCount($user_ID);

        // Display name of trait from database
        $trait1_name = $entityManager->getRepository(Trait1::class)->findAllTrait1($user_ID);
        $trait2_name = $entityManager->getRepository(Trait2::class)->findAllTrait2($user_ID);
        $trait3_name = $entityManager->getRepository(Trait3::class)->findAllTrait3($user_ID);
        $trait4_name = $entityManager->getRepository(Trait4::class)->findAllTrait4($user_ID);

        // Default value for form
        $defaults = [
            'city_name' => $user_ID_city,
            'city_GPS_lat' => $user_ID_lat,
            'city_GPS_long' => $user_ID_long,
            'search_type' => 0,
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
            ->add('city_name', TextType::class, [
                'label' => 'Nom de la ville',
            ])
            ->add('city_GPS_lat', TextareaType::class, [
                'label' => false,
            ])
            ->add(
                'city_GPS_long',
                TextareaType::class,
                [
                    'label' => false
                ]
            )
            ->add('distance', RangeType::class, [
                'attr' => [
                    'value' => 5,
                    'min' => 5,
                    'max' => 25,
                    'step' => 5
                ],
            ])
            // Option for party search
            ->add('party_game_name', TextType::class, [
                'required' => false,
                'label' => 'Nom du jeu',
            ])
            ->add('party_player_number', IntegerType::class, [
                'required' => false,
                'label' => 'Nombre de joueurs',
                'attr' => [
                    'min' => 1,
                    'max' => 99,
                    'step' => 1
                ]
            ])
            ->add('party_date', DateType::class, [
                'required' => false,
                'label' => 'Date de la partie',
                'widget' => 'single_text',
                'html5' => true,
            ])
            ->add('party_trait1', ChoiceType::class, [
                'label'    => 'Niveau de jeu',
                'choices'  => [
                    $trait1_name["0"]["name"] => null,
                    $trait1_name["1"]["name"] => 1,
                    $trait1_name["2"]["name"] => 2,
                    $trait1_name["3"]["name"] => 3,
                ]
            ])
            ->add('party_trait2', ChoiceType::class, [
                'label'    => 'Ambiance de jeu',
                'choices'  => [
                    $trait2_name["0"]["name"] => null,
                    $trait2_name["1"]["name"] => 1,
                    $trait2_name["2"]["name"] => 2,
                    $trait2_name["3"]["name"] => 3,
                ]
            ])
            ->add('party_trait3', ChoiceType::class, [
                'label'    => 'Alcool et cigarettes',
                'choices'  => [
                    $trait3_name["0"]["name"] => null,
                    $trait3_name["1"]["name"] => 1,
                    $trait3_name["2"]["name"] => 2,
                    $trait3_name["3"]["name"] => 3,
                ]
            ])
            ->add('party_trait4', ChoiceType::class, [
                'label'    => 'Animaux de compagnie',
                'choices'  => [
                    $trait4_name["0"]["name_party"] => null,
                    $trait4_name["1"]["name_party"] => 1,
                    $trait4_name["2"]["name_party"] => 2,
                    $trait4_name["3"]["name_party"] => 3,
                ]
            ])
            // Option for user search 
            ->add('player_rate', IntegerType::class, [
                'required' => false,
                'label' => 'Note du joueur',
                'attr' => [
                    'min' => 0,
                    'max' => 5,
                    'step' => 1
                ]
            ])
            ->add('player_friend', CheckboxType::class, [
                'label'    => 'seulement mes joueurs favoris',
                'required' => false,
            ])
            ->add('user_trait1', ChoiceType::class, [
                'label'    => 'Niveau de jeu',
                'choices'  => [
                    $trait1_name["0"]["name"] => null,
                    $trait1_name["1"]["name"] => 1,
                    $trait1_name["2"]["name"] => 2,
                    $trait1_name["3"]["name"] => 3,
                ]
            ])
            ->add('user_trait2', ChoiceType::class, [
                'label'    => 'Ambiance de jeu',
                'choices'  => [
                    $trait2_name["0"]["name"] => null,
                    $trait2_name["1"]["name"] => 1,
                    $trait2_name["2"]["name"] => 2,
                    $trait2_name["3"]["name"] => 3,
                ]
            ])
            ->add('user_trait3', ChoiceType::class, [
                'label'    => 'Alcool et cigarettes',
                'choices'  => [
                    $trait3_name["0"]["name"] => null,
                    $trait3_name["1"]["name"] => 1,
                    $trait3_name["2"]["name"] => 2,
                    $trait3_name["3"]["name"] => 3,
                ]
            ])
            ->add('user_trait4', ChoiceType::class, [
                'label'    => 'Animaux de compagnie',
                'choices'  => [
                    $trait4_name["0"]["name_player"] => null,
                    $trait4_name["1"]["name_player"] => 1,
                    $trait4_name["2"]["name_player"] => 2,
                    $trait4_name["3"]["name_player"] => 3,
                ]
            ])
            //
            ->add('send', SubmitType::class, [
                'label'    => 'Rechercher',
            ])
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

            //
            $raw_data_form = $form->getData();
            // Check if user search player or party
            if ($data['search_type'] == SEARCH_PARTY) {
                // Add optional field if they are not null
                $party_optional_request = "";
                if ($raw_data_form['party_game_name'] != null) {
                    $party_optional_request = $party_optional_request . " AND p.game LIKE '%" .  $raw_data_form['party_game_name'] . "%'";
                }
                if ($raw_data_form['party_player_number'] != null) {
                    $party_optional_request = $party_optional_request . " AND p.player_number_total = " .  $raw_data_form['party_player_number'];
                }
                if ($raw_data_form['party_date'] != null) {
                    $date = $raw_data_form['party_date']->format('Y-m-d h:i:s');
                    $party_optional_request = $party_optional_request . " AND p.date > '" . $date . "'";
                }
                if($raw_data_form['party_trait1'] != null){
                    $party_optional_request = $party_optional_request . " AND p.trait1_id = " .  $raw_data_form['party_trait1'];
                }
                if($raw_data_form['party_trait2'] != null){
                    $party_optional_request = $party_optional_request . " AND p.trait2_id = " .  $raw_data_form['party_trait2'];
                }
                if($raw_data_form['party_trait3'] != null){
                    $party_optional_request = $party_optional_request . " AND p.trait3_id = " .  $raw_data_form['party_trait3'];
                }
                if($raw_data_form['party_trait4'] != null){
                    $party_optional_request = $party_optional_request . " AND p.trait4_id = " .  $raw_data_form['party_trait4'];
                }

                // Search in database
                $result = $entityManager->getRepository(Party::class)->findAllAvailableParty($party_optional_request);

                for ($i = 0; $i < sizeof($result); $i++) {
                    $player_lat = $result[$i]['address_gps_lat'];
                    $player_long = $result[$i]['address_gps_long'];
                    $distance_between = SearchController::calculateDistance($user_ID_lat, $user_ID_long, $player_lat, $player_long);
                    if ($distance_between <= $data['distance']) {
                        $result[$i]['distance'] = round($distance_between, 1);
                        array_push($temp_result, $result[$i]);
                    }
                }

                // Edit data before export to TWIG
                $result_party_host = SearchController::checkHostInformation($temp_result, $entityManager);
                $result_party_date = SearchController::editDate($result_party_host, $entityManager);
                $result_party_player = SearchController::checkUserInformation($result_party_date, $entityManager);
                $result_party_player_register = SearchController::checkIfUserRegistered($result_party_player, $user_ID, $entityManager);
                $result_party = $result_party_player_register;
            } else if ($data['search_type'] == SEARCH_PLAYER) {
                // Add optional field if they are not null
                $party_optional_request = "";
                if ($raw_data_form['player_rate'] != null) {
                    $party_optional_request = $party_optional_request . " AND rate >= " . $raw_data_form['player_rate'];
                }
                if ($raw_data_form['player_friend'] != null) {
                    $party_optional_request = $party_optional_request . " AND U.id IN (select UF.user_friend_id from user_friend UF where user_id = " .  $user_ID . ") ";
                }
                if ($raw_data_form['user_trait1'] != null) {
                    $party_optional_request = $party_optional_request . " AND U.trait1_id = " .  $raw_data_form['user_trait1'];
                }
                if ($raw_data_form['user_trait2'] != null) {
                    $party_optional_request = $party_optional_request . " AND U.trait1_id = " .  $raw_data_form['user_trait2'];
                }
                if ($raw_data_form['user_trait3'] != null) {
                    $party_optional_request = $party_optional_request . " AND U.trait1_id = " .  $raw_data_form['user_trait3'];
                }
                if ($raw_data_form['user_trait4'] != null) {
                    $party_optional_request = $party_optional_request . " AND U.trait1_id = " .  $raw_data_form['user_trait4'];
                }
                // Search in database
                $result = $entityManager->getRepository(User::class)->findAllAvailableUser($user_ID, $party_optional_request);

                for ($i = 0; $i < sizeof($result); $i++) {
                    $player_lat = $result[$i]['city_gps_lat'];
                    $player_long = $result[$i]['city_gps_long'];
                    $distance_between = SearchController::calculateDistance($user_ID_lat, $user_ID_long, $player_lat, $player_long);
                    if ($distance_between <= $data['distance']) {
                        $result[$i]['distance'] = round($distance_between, 1);
                        array_push($temp_result, $result[$i]);
                    }
                }

                // Edit data before export to TWIG
                $temp_result_date_created = SearchController::editDateCreatedAt($temp_result);
                $temp_result_last_connexion = SearchController::editLastConnexion($temp_result_date_created);
                $temp_result_age = SearchController::calculateAge($temp_result_last_connexion);
                $temp_result_comment = SearchController::numberOfComment($temp_result_age, $entityManager);
                $temp_result_contact = SearchController::checkContact($temp_result_comment, $user_ID, $entityManager);
                $result_user = $temp_result_contact;
            }

            // Send a message if zero results are found
            if ($result_user == [] && $result_party == []) {
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
            'tomorrow' => $tomorrow,
            'nonReadMessageCount' => $non_read_message_count,
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
        for ($i = 0; $i < sizeof($result); $i++) {
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
        for ($i = 0; $i < sizeof($result); $i++) {
            $spliter_string =  str_split($result[$i]['date'], 10);
            $result[$i]['date'] = $spliter_string[0];
        }
        return $result;
    }

    public static function editDateCreatedAt($result)
    {
        for ($i = 0; $i < sizeof($result); $i++) {
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
        for ($i = 0; $i < sizeof($result); $i++) {
            $spliter_string =  str_split($result[$i]['last_connexion'], 10);
            $last_connexion_date  = strtotime($spliter_string[0]);
            $last_connexion_date = strtotime($spliter_string[0]);
            $timeDiff = abs($current_date - $last_connexion_date);
            $numberDays = $timeDiff / 86400;
            $result[$i]['last_connexion'] = round($numberDays, 0);
        }
        return $result;
    }

    public static function numberOfComment($result, EntityManagerInterface $entityManager)
    {
        for ($i = 0; $i < sizeof($result); $i++) {
            // Get ID of user
            $userID = $result[$i]['id'];

            // Get number of comments
            $number = $entityManager->getRepository(UserComment::class)->numberOfComment($userID);

            // Store in array
            $result[$i]['number_comment'] = $number[0]["COUNT(id)"];
        }
        return $result;
    }

    public static function checkIfUserRegistered($result, $user_ID,  EntityManagerInterface $entityManager)
    {
        for ($i = 0; $i < sizeof($result); $i++) {
            // Get ID of party
            $partyID = $result[$i]['id'];

            // Chek if already registered
            $checkIfAlreadyRegister = $entityManager->getRepository(PartyUser::class)->checkIfAlreadyRegister($partyID, $user_ID);

            // Store in array
            if ($checkIfAlreadyRegister[0]["COUNT(id)"] == 1) {
                $result[$i]['current_user_registered'] = true;
            } else {
                $result[$i]['current_user_registered'] = false;
            }
        }
        return $result;
    }

    public static function checkHostInformation($result, EntityManagerInterface $entityManager)
    {
        for ($i = 0; $i < sizeof($result); $i++) {
            // Get ID of party
            $host_user_ID = $result[$i]['user_host_id'];

            // Chek if already registered
            $party_host_name = $entityManager->getRepository(User::class)->find($host_user_ID);

            // Store in array
            $result[$i]['party_host_name'] = $party_host_name->getFirstName() . ' ' . $party_host_name->getLastName();
            $result[$i]['party_host_picture'] = $party_host_name->getPictureProfil();
        }
        return $result;
    }

    public static function checkUserInformation($result, EntityManagerInterface $entityManager)
    {
        for ($i = 0; $i < sizeof($result); $i++) {
            // Get ID of party
            $partyID = $result[$i]['id'];

            // Chek if already registered
            $party_user_list = $entityManager->getRepository(PartyUser::class)->findPartyWithID($partyID);

            $result[$i]['user_registered'] = null;
            for ($y = 0; $y < sizeof($party_user_list); $y++) {
                $party_user_information = $entityManager->getRepository(User::class)->find($party_user_list[$y]["user_id"]);

                // Store in array
                $result[$i]['user_registered'][$y]["user_id"] = $party_user_information->getId();
                $result[$i]['user_registered'][$y]["user_name"] = $party_user_information->getFirstName();
                $result[$i]['user_registered'][$y]["user_profil_picture"] = $party_user_information->getPictureProfil();
            }
        }
        return $result;
    }

    public static function checkContact($result, $user_ID, EntityManagerInterface $entityManager)
    {
        for ($i = 0; $i < sizeof($result); $i++) {
            // Get ID of user
            $target_ID = $result[$i]['id'];

            // Chek if user is a friend
            $check_friend_target = $entityManager->getRepository(UserFriend::class)->checkIfAlreadyFriend($user_ID, $target_ID);
            $check_black_list_target = $entityManager->getRepository(UserBlackList::class)->checkIfAlreadyBlackList($user_ID, $target_ID);

            if ($check_friend_target != []) {
                $result[$i]['friend'] = true;
                $result[$i]['black_list'] = false;
            } else if ($check_black_list_target != []) {
                $result[$i]['friend'] = false;
                $result[$i]['black_list'] = true;
            } else {
                $result[$i]['friend'] = false;
                $result[$i]['black_list'] = false;
            }
        }
        return $result;
    }
}

<?PHP

namespace App\Controller;
use App\Entity\User;
use App\Entity\UserChat;
use App\Entity\PartyUser;
use App\Entity\Trait1;
use App\Entity\Trait2;
use App\Entity\Trait3;
use App\Entity\Trait4;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

class PlayerController extends AbstractController
{
    #[Route('/playerprofil/{playerID}', name: 'player profil')]
    public function player(EntityManagerInterface $entityManager, int $playerID): Response
    {
        // Allow acces only to connected user
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // Get ID of user
        $user = $this->getUser();
        $user_ID = $user->getId();
        $user_ID_lat = $user->getCityGPSLat();
        $user_ID_long = $user->getCityGPSLong();

        //seting non read message count
        $non_read_message_count = $entityManager->getRepository(UserChat::class)->findNonReadMessageCount($user_ID);

        // Get data of player
        $user = $entityManager->getRepository(User::class)->find($playerID);
        $user_array['id'] = $user->getId();
        $user_array['lastName'] = $user->getLastName();
        $user_array['firstName'] = $user->getFirstName();
        $user_array['gender_ID'] = $user->getGenderID();
        $user_array['pseudo'] = $user->getPseudo();
        $user_array['city'] = $user->getCity();
        $user_array['description'] = $user->getDescription();
        $user_array['trait1_ID'] = $user->getTrait1ID();
        $user_array['trait2_ID'] = $user->getTrait2ID();
        $user_array['trait3_ID'] = $user->getTrait3ID();
        $user_array['trait4_ID'] = $user->getTrait4ID();
        $user_array['pictureProfil'] = $user->getPictureProfil();
        $user_array['rate'] = $user->getRate();
        
        // Calculate age
        $user_array['birthdate'] = $user->getBirthdate();
        $user_array['birthdate'] = $user_array['birthdate']->format('Y-m-d H:i:s');
        $current_year = date("Y");
        $spliter_string =  str_split($user_array['birthdate'], 4);
        $birthdate_year = $spliter_string[0];
        $age = $current_year - $birthdate_year;
        $user_array['birthdate'] = strval($age);


         


        $user_array['created_at'] = $user->getCreatedAt();
        $user_array['created_at'] = $user_array['created_at']->format('Y-m-d H:i:s');
        $spliter_string =  str_split($user_array['created_at'], 10);
        $user_array['created_at'] = $spliter_string[0];


        date_default_timezone_set('Europe/Paris');
        $current_date_string = date('Y/m/d', time());
        $current_date = strtotime($current_date_string);



        $user_array['last_connexion'] = $user->getLastConnexion();
        $user_array['last_connexion'] = $user_array['last_connexion']->format('Y-m-d H:i:s');
        $spliter_string =  str_split($user_array['last_connexion'], 10);
        $last_connexion_date  = strtotime($spliter_string[0]);
        $last_connexion_date = strtotime($spliter_string[0]);
        $timeDiff = abs($current_date - $last_connexion_date);
        $numberDays = $timeDiff / 86400;
        $user_array['last_connexion'] = round($numberDays, 0);

            
        $user_array['favorite_game'] = $user->getFavoriteGame();

        
        //$temp_result_contact = SearchController::checkContact($temp_result_comment, $user_ID, 




        // Display name of trait from database
        $trait1_name = $entityManager->getRepository(Trait1::class)->findAllTrait1();
        $trait2_name = $entityManager->getRepository(Trait2::class)->findAllTrait2();
        $trait3_name = $entityManager->getRepository(Trait3::class)->findAllTrait3();
        $trait4_name = $entityManager->getRepository(Trait4::class)->findAllTrait4();

        for ($i=0; $i < sizeof($trait1_name); $i++) { 
            if($user_array['trait1_ID'] == $i){
                $user_array['trait1_ID'] = $trait1_name[$i]["name"];
            }    
        }
        for ($i=0; $i < sizeof($trait2_name); $i++) { 
            if($user_array['trait2_ID'] == $i){
                $user_array['trait2_ID'] = $trait2_name[$i]["name"];
            }    
        }
        for ($i=0; $i < sizeof($trait3_name); $i++) { 
            if($user_array['trait3_ID'] == $i){
                $user_array['trait3_ID'] = $trait3_name[$i]["name"];
            }    
        }
        for ($i=0; $i < sizeof($trait4_name); $i++) { 
            if($user_array['trait4_ID'] == $i){
                $user_array['trait4_ID'] = $trait4_name[$i]["name_player"];
            }    
        }

        // Search in DataBase
        $incomming_game = $entityManager->getRepository(PartyUser::class)->findAllIncommingUserParty($playerID);
        
        // Creating finalized $incomming_game result array
        for ($i=0; $i < sizeof($incomming_game); $i++) { 
            $player_lat = $incomming_game[$i]['address_gps_lat'];
            $player_long = $incomming_game[$i]['address_gps_long'];
            $distance_between = SearchController::calculateDistance($user_ID_lat,$user_ID_long,$player_lat,$player_long);              
            $incomming_game[$i]['distance'] = round($distance_between,1);
        }
        $incomming_game_party_host = SearchController::checkHostInformation($incomming_game, $entityManager);
        $incomming_game_party_date = SearchController::editDate($incomming_game_party_host, $entityManager);
        $incomming_game_party_player = SearchController::checkUserInformation($incomming_game_party_date, $entityManager);
        $incomming_game_party_player_register = SearchController::checkIfUserRegistered($incomming_game_party_player, $user_ID, $entityManager);
        $incomming_game_party =$incomming_game_party_player_register;

        return $this->render('playerProfil.html.twig',[
            'nonReadMessageCount' => $non_read_message_count,
            'user' => $user_array,
            'current_user' => $user_ID,
            'incomming_game_party' => $incomming_game_party,
        ]);
    }
}

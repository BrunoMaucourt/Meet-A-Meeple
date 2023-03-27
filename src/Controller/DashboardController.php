<?PHP

namespace App\Controller;

use App\Entity\Party;
use App\Entity\User;
use App\Entity\UserFriend;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

//ini_set("memory_limit", "4000M");

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'dashboard')]
    public function home(EntityManagerInterface $entityManager): Response
    {
        // Allow acces only to connected user
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        
        /**
         * Update database with last connexion date
         * 
         * */ 
        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        $user_ID = $user->getId();
        $user_ID_lat = $user->getCityGPSLat();
        $user_ID_long = $user->getCityGPSLong();

        /**
         * Update database with last connexion date
         * 
         * */   
        date_default_timezone_set('Europe/Paris');
        $last_connexion_date = new \DateTime();
        $user->setLastConnexion($last_connexion_date);
        // Insert data in database
        $entityManager->persist($user);
        $entityManager->flush();

        /**
         * Search last added party in database
         * 
         * */ 
        // Search in database
        $result = $entityManager->getRepository(Party::class)->findLastAvailableParty();
        
        for ($i=0; $i < sizeof($result); $i++) { 
            $player_lat = $result[$i]['address_gps_lat'];
            $player_long = $result[$i]['address_gps_long'];
            $distance_between = SearchController::calculateDistance($user_ID_lat,$user_ID_long,$player_lat,$player_long);              
            $result[$i]['distance'] = round($distance_between,1);
        }

        // Edit data before export to TWIG
        $result_party_host = SearchController::checkHostInformation($result, $entityManager);
        $result_party_date = SearchController::editDate($result_party_host, $entityManager);
        $result_party_player = SearchController::checkUserInformation($result_party_date, $entityManager);
        $result_party_player_register = SearchController::checkIfUserRegistered($result_party_player, $user_ID, $entityManager);
        $result_party =$result_party_player_register;

        /**
         * Search last registered player in database
         * 
         * */ 
        // Search in database
        $result = $entityManager->getRepository(User::class)->findLastAvailableUser($user_ID);

        for ($i=0; $i < sizeof($result); $i++) { 
            $player_lat = $result[$i]['city_gps_lat'];
            $player_long = $result[$i]['city_gps_long'];
            $distance_between = SearchController::calculateDistance($user_ID_lat,$user_ID_long,$player_lat,$player_long);              
            $result[$i]['distance'] = round($distance_between,1);
        }

        // Edit data before export to TWIG
        $temp_result_date_created = SearchController::editDateCreatedAt($result);
        $temp_result_last_connexion = SearchController::editLastConnexion($temp_result_date_created);
        $temp_result_age = SearchController::calculateAge($temp_result_last_connexion);
        $temp_result_comment = SearchController::numberOfComment($temp_result_age, $entityManager);
        $result_user = $temp_result_comment;

        /**
         * Search last registered player in database
         * 
         * */ 
        $userInformations['numberOfFriend'] = $entityManager->getRepository(UserFriend::class)->findFriendNumber($user_ID);
        $userInformations['playedParty'] = $entityManager->getRepository(Party::class)->findNumberOfHostedParty($user_ID);
        $userInformations['hostedParty'] = $entityManager->getRepository(Party::class)->findNumberOfHostedParty($user_ID);
        $userInformations['registeredEvents'] = [];

        return $this->render('dashboard.html.twig', [
            'userInformations' => $userInformations,
            'current_user' => $user_ID,
            'partyResult' => $result_party,
            'userResult' => $result_user,           
        ]);
    }
}

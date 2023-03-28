<?PHP

namespace App\Controller;

use App\Entity\User;
use App\Entity\UserChat;
use App\Entity\UserFriend;
use App\Entity\UserBlackList;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

class MyFriendController extends AbstractController
{
    #[Route('/myfriend', name: 'my friend')]
    public function myFriend(EntityManagerInterface $entityManager): Response
    {
        // Allow acces only to connected user
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        
        /**
         * Get information about currend user
         * 
         * */ 
        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        $user_ID = $user->getId();
        $user_ID_lat = $user->getCityGPSLat();
        $user_ID_long = $user->getCityGPSLong();
        //$non_read_message_count = $entityManager->getRepository(UserChat::class)->findNonReadMessageCount($user_ID);

        /**
         * Search friend
         * 
         * */ 
        // Search in database
        $result = $entityManager->getRepository(UserFriend::class)->findFriend($user_ID);

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
        $userFriendResult = $temp_result_comment;

        /**
         * Search banned player in database
         * 
         * */ 
        // Search in database
        $result = $entityManager->getRepository(UserBlackList::class)->findBlackList($user_ID);

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
        $userBannedResult = $temp_result_comment;

        return $this->render('myFriend.html.twig',[
            'userFriendResult' => $userFriendResult,
            'userBannedResult' => $userBannedResult,
           // 'nonReadMessageCount' => $non_read_message_count
        ]);
    }

    #[Route('/addfriend/{target_ID}', name: 'add friend')]
    public function addFriend(EntityManagerInterface $entityManager, int $target_ID): Response
    {
        // Declaration of constant
        define('NEW_FRIEND_ALLOWED',0);

        // Allow acces only to connected user
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        /**
         * Get information about currend user
         * 
         * */ 
        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        $user_ID = $user->getId();
        // Check if already friend
        $checkIfAlreadyFriend = $entityManager->getRepository(UserFriend::class)->checkIfAlreadyFriend($user_ID, $target_ID);
        $checkIfTargetExist = $entityManager->getRepository(User::class)->find($target_ID);
        if($checkIfAlreadyFriend == [] && $checkIfTargetExist != []){
            // Add a new row in database
            $user_friend = new UserFriend();
            $user_friend->setUserFriendID($target_ID);
            $user_friend->setUserID($user_ID);
    
            // Insert data in database
            $entityManager->persist($user_friend);
            $entityManager->flush();

            $message ="Vous avez ajouté un nouvel ami";
        }else{
            $message ="Vous êtes déjà amis";
        }
        return $this->redirectToRoute('my friend', [
            'message' => $message,
        ]);
    }

    #[Route('/addblacklist/{target_ID}', name: 'add Black List')]
    public function addBlackList(EntityManagerInterface $entityManager, int $target_ID): Response
    {
        // Declaration of constant
        define('AlLREADY_BLACK_LIST',1);

        // Allow acces only to connected user
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        /**
         * Get information about current user
         * 
         * */ 
        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        $user_ID = $user->getId();
        // Check if already friend
        $checkIfAlreadyBlackList = $entityManager->getRepository(UserBlackList::class)->checkIfAlreadyBlackList($user_ID, $target_ID);
        $checkIfTargetExist = $entityManager->getRepository(User::class)->find($target_ID);
        if($checkIfAlreadyBlackList == [] && $checkIfTargetExist != []){
            // Add a new row in database
            $user_black_list = new UserBlackList();
            $user_black_list->setUserBannedID($target_ID);
            $user_black_list->setUserThatBlockID($user_ID);
    
            // Insert data in database
            $entityManager->persist($user_black_list);
            $entityManager->flush();

            $message ="Vous avez ajouté bloqué un utilisateur";
        }else{
            $message ="Vosu avez déjà bloqué cet utilisateur";
        }
        return $this->redirectToRoute('my friend', [
            'message' => $message,
        ]);
    }

    #[Route('/removefriend/{target_ID}', name: 'remove friend')]
    public function removeFriend(EntityManagerInterface $entityManager, int $target_ID): Response
    {
        // Allow acces only to connected user
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        /**
         * Get information about currend user
         * 
         * */ 
        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        $user_ID = $user->getId();
        // Check if already friend
        $checkIfAlreadyFriend = $entityManager->getRepository(UserFriend::class)->checkIfAlreadyFriend($user_ID, $target_ID);
        if($checkIfAlreadyFriend != []){
            // Remove a new row in database
            $userfriend = $entityManager->getRepository(UserFriend::class)->find($checkIfAlreadyFriend[0]["id"]);
            $entityManager->remove($userfriend);
            $entityManager->flush();

            $message ="Vous avez retiré un utilisateur favoris";
        }else{
            $message ="Vous n'êtes pas amis";
        }
        return $this->redirectToRoute('my friend', [
            'message' => $message,
        ]);
    }

    #[Route('/removeblacklist/{target_ID}', name: 'remove Black List')]
    public function removeBlackList(EntityManagerInterface $entityManager, int $target_ID): Response
    {
        // Allow acces only to connected user
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        /**
         * Get information about currend user
         * 
         * */ 
        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        $user_ID = $user->getId();
        // Check if already friend
        $checkIfAlreadyBlackList = $entityManager->getRepository(UserBlackList::class)->checkIfAlreadyBlackList($user_ID, $target_ID);
        if($checkIfAlreadyBlackList != []){
            // Add a new row in database
            $user_black_list = $entityManager->getRepository(UserBlackList::class)->find($checkIfAlreadyBlackList[0]["id"]);
            $entityManager->remove($user_black_list);
            $entityManager->flush();

            $message ="Vous avez ajouté bloqué un utilisateur";
        }else{
            $message ="Vosu avez déjà bloqué cet utilisateur";
        }
        return $this->redirectToRoute('my friend', [
            'message' => $message,
        ]);
    }
}
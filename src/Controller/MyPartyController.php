<?php

namespace App\Controller;

//use App\Entity\Party;
use App\Entity\User;
use App\Entity\PartyUser;
use App\Entity\UserChat;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class MyPartyController extends AbstractController
{
    #[Route('/myparty', name: 'my_party')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        // Allow acces only to connected user
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');


        // Variables declaration
        $incomming_game = [];
        $finished_game = [];
        $created_game = [];
        $canceled_game = [];

        // Get ID of user
        $user = $this->getUser();
        $user_ID = $user->getId();
        $user_ID_lat = $user->getCityGPSLat();
        $user_ID_long = $user->getCityGPSLong();

        //seting non read message count
        $non_read_message_count = $entityManager->getRepository(UserChat::class)->findNonReadMessageCount($user_ID);
        
        // Search in DataBase
        $incomming_game = $entityManager->getRepository(PartyUser::class)->findAllIncommingUserParty($user_ID);
        $finished_game = $entityManager->getRepository(PartyUser::class)->findAllFinishedUserParty($user_ID);
        $created_game = $entityManager->getRepository(PartyUser::class)->findAllCreatedUserParty($user_ID);
        $canceled_game = $entityManager->getRepository(PartyUser::class)->findAllCanceledUserParty($user_ID);


        
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



        // Creating finalized $finished_game result array
        for ($i=0; $i < sizeof($finished_game); $i++) { 
            $player_lat = $finished_game[$i]['address_gps_lat'];
            $player_long = $finished_game[$i]['address_gps_long'];
            $distance_between = SearchController::calculateDistance($user_ID_lat,$user_ID_long,$player_lat,$player_long);              
            $finished_game[$i]['distance'] = round($distance_between,1);
        }
        $finished_game_party_host = SearchController::checkHostInformation($finished_game, $entityManager);
        $finished_game_party_date = SearchController::editDate($finished_game_party_host, $entityManager);
        $finished_game_party_player = SearchController::checkUserInformation($finished_game_party_date, $entityManager);
        $finished_game_party_player_register = SearchController::checkIfUserRegistered($finished_game_party_player, $user_ID, $entityManager);
        $finished_game_party =$finished_game_party_player_register;



        // Creating finalized $created_game result array
        for ($i=0; $i < sizeof($created_game); $i++) { 
            $player_lat = $created_game[$i]['address_gps_lat'];
            $player_long = $created_game[$i]['address_gps_long'];
            $distance_between = SearchController::calculateDistance($user_ID_lat,$user_ID_long,$player_lat,$player_long);              
            $created_game[$i]['distance'] = round($distance_between,1);
        }
        $created_game_party_host = SearchController::checkHostInformation($created_game, $entityManager);
        $created_game_party_date = SearchController::editDate($created_game_party_host, $entityManager);
        $created_game_party_player = SearchController::checkUserInformation($created_game_party_date, $entityManager);
        $created_game_party_player_register = SearchController::checkIfUserRegistered($created_game_party_player, $user_ID, $entityManager);
        $created_game_party =$created_game_party_player_register;


        // Creating finalized $canceled_game result array
        for ($i=0; $i < sizeof($canceled_game); $i++) { 
            $player_lat = $canceled_game[$i]['address_gps_lat'];
            $player_long = $canceled_game[$i]['address_gps_long'];
            $distance_between = SearchController::calculateDistance($user_ID_lat,$user_ID_long,$player_lat,$player_long);              
            $canceled_game[$i]['distance'] = round($distance_between,1);
        }
        
        $canceled_game_party_host = SearchController::checkHostInformation($canceled_game, $entityManager);
        $canceled_game_party_date = SearchController::editDate($canceled_game_party_host, $entityManager);
        $canceled_game_party_player = SearchController::checkUserInformation($canceled_game_party_date, $entityManager);
        $canceled_game_party_player_register = SearchController::checkIfUserRegistered($canceled_game_party_player, $user_ID, $entityManager);
        $canceled_game_party =$canceled_game_party_player_register;
        
    
       
        
        
        return $this->render('myParty.html.twig',[
            'current_user' => $user_ID,
            'incommingGame' => $incomming_game_party,
            'finishedGame' => $finished_game_party,
            'createdGame' => $created_game_party,
            'canceledGame' => $canceled_game_party,
            'nonReadMessageCount' => $non_read_message_count,
        ]);
    }
}

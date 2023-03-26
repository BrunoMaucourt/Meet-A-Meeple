<?php

namespace App\Controller;

//use App\Entity\Party;
use App\Entity\User;
use App\Entity\PartyUser;
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
        
        // Search in DataBase
        $incomming_game = $entityManager->getRepository(PartyUser::class)->findAllIncommingUserParty($user_ID);
        $finished_game = $entityManager->getRepository(PartyUser::class)->findAllFinishedUserParty($user_ID);
        $created_game = $entityManager->getRepository(PartyUser::class)->findAllCreatedUserParty($user_ID);
        $canceled_game = $entityManager->getRepository(PartyUser::class)->findAllCanceledUserParty($user_ID);


        // Creating finalized result array

        for ($i=0; $i < sizeof($incomming_game) ; $i++) { 
            $party_ID = $incomming_game[$i]['id'];
            $incomming_game[$i]['date'] = str_split($incomming_game[$i]['date'], 10)[0];
            $incomming_game[$i]['participants'] = $entityManager->getRepository(PartyUser::class)->findAllParticipantExceptUser($user_ID,$party_ID);
        }
        for ($i=0; $i < sizeof($finished_game) ; $i++) { 
            $party_ID = $finished_game[$i]['id'];
            $finished_game[$i]['date'] = str_split($finished_game[$i]['date'], 10)[0];
            $finished_game[$i]['participants'] = $entityManager->getRepository(PartyUser::class)->findAllParticipantExceptUser($user_ID,$party_ID);
        }
        for ($i=0; $i < sizeof($created_game) ; $i++) { 
            $party_ID = $created_game[$i]['id'];
            $created_game[$i]['date'] = str_split($created_game[$i]['date'], 10)[0];
            $created_game[$i]['participants'] = $entityManager->getRepository(PartyUser::class)->findAllParticipantExceptUser($user_ID,$party_ID);
        }
        for ($i=0; $i < sizeof($canceled_game) ; $i++) { 
            $party_ID = $canceled_game[$i]['id'];
            $canceled_game[$i]['date'] = str_split($canceled_game[$i]['date'], 10)[0];
            $canceled_game[$i]['participants'] = $entityManager->getRepository(PartyUser::class)->findAllParticipantExceptUser($user_ID,$party_ID);
        }
       
        
        
        return $this->render('myParty.html.twig',[
            'userID' => $user_ID,
            'incommingGame' => $incomming_game,
            'finishedGame' => $finished_game,
            'createdGame' => $created_game,
            'canceledGame' => $canceled_game,
        ]);
    }
}

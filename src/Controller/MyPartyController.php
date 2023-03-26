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
        $incomming_game[0]['test'] = 'bonjour';
        
        return $this->render('myParty.html.twig',[
            'incommingGame' => $incomming_game,
            'finishedGame' => $finished_game,
            'createdGame' => $created_game,
            'canceledGame' => $canceled_game,
        ]);
    }
}

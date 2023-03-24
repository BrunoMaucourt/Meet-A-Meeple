<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Party;
use App\Entity\PartyUser;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PartyUnsubscribeController extends AbstractController
{
    #[Route('/partyunsubscribe/{partyID}', name: 'app_party_unsubscribe')]
    public function index(EntityManagerInterface $entityManager, int $partyID): Response
    {
        // Declaration of constant
        define('REGISTERED',1);

        // Allow acces only to connected user
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // Get ID of user
        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        $user_ID = $user->getId();

        // Check if user is registred
        $checkIfAlreadyRegister = $entityManager->getRepository(PartyUser::class)->checkIfAlreadyRegister($partyID, $user_ID);
        if($checkIfAlreadyRegister[0]["COUNT(id)"] == REGISTERED){
            $userpartyID = $entityManager->getRepository(PartyUser::class)->findPartyID($partyID, $user_ID);       
            $partyuser = $entityManager->getRepository(PartyUser::class)->find($userpartyID[0]["id"]);
            $entityManager->remove($partyuser);
            $entityManager->flush();     

            // Edit number of registered player
             $party = $entityManager->getRepository(Party::class)->find($partyID);
            $party->setPlayerNumberNeeded($party->getPlayerNumberNeeded()+1);
            $entityManager->persist($party);
            $entityManager->flush(); 
            return new Response('Vous êtes désinscrit de la partie');    
        }else{
            return new Response('Vous n êtes pas inscrit à la partie');
        }
    }
}

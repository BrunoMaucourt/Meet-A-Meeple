<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Party;
use App\Entity\PartyUser;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PartyRegistrationController extends AbstractController
{
    #[Route('/partyregistration/{partyID}', name: 'app_party_registration')]
    public function index(EntityManagerInterface $entityManager, int $partyID): Response
    {
        // Declaration of constant
        define('PARTY_AVAILABLE',1);
        define('NOT_REGISTERED',0);

        // Allow acces only to connected user
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // Get ID of user
        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        $user_ID = $user->getId();

        // Check if party is available
        $checkParty = $entityManager->getRepository(Party::class)->checkIfPartyIsAvailable($partyID);
        if($checkParty[0]["COUNT(id)"] == PARTY_AVAILABLE){
            // user is already register to this party
            $checkIfAlreadyRegister = $entityManager->getRepository(PartyUser::class)->checkIfAlreadyRegister($partyID, $user_ID);
            if($checkIfAlreadyRegister[0]["COUNT(id)"] == NOT_REGISTERED){
                // Add a new row
                $partyuser = new PartyUser();
                $partyuser->setPartyID($partyID);
                $partyuser->setUserID($user_ID);
        
                // Insert data in database
                $entityManager->persist($partyuser);
                $entityManager->flush();

                // Edit number of registered player
                $party = $entityManager->getRepository(Party::class)->find($partyID);
                $party->setPlayerNumberNeeded($party->getPlayerNumberNeeded()-1);
                $entityManager->persist($party);
                $entityManager->flush();
            }else{
                //return new Response('Vous êtes déjà inscrit à la partie '. $partyID .' nest pas disponible');
                return $this->redirectToRoute('my_party');
            }

        }else{
            //return new Response('La partie '. $partyID .' nest pas disponible');
            return $this->redirectToRoute('my_party');
        }
        //return new Response('La partie '. $partyID .' est disponible, le joueur ' .$user_ID. ' est inscrit');
        return $this->redirectToRoute('my_party');
    }
}

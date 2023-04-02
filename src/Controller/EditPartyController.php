<?PHP

namespace App\Controller;

use App\Entity\User;
use App\Entity\Trait1;
use App\Entity\Trait2;
use App\Entity\Trait3;
use App\Entity\Trait4;
use App\Entity\Party;
use App\Form\PartyType;
use App\Entity\UserChat;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EditPartyController extends AbstractController
{
    #[Route('/editparty/{party_ID}', name: 'edit_party')]
    public function editParty(Request $request, EntityManagerInterface $entityManager, int $party_ID): Response
    {
        // Allow acces only to connected user
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // Get data about current user
        $user = $this->getUser();
        $user_ID = $user->getId();

        // Get data about party
        $party = $entityManager->getRepository(Party::class)->find($party_ID);
        $party_user_host_id = $party->getUserHostID();

        // Check is user is allowed to edit party
        define('PARTY_CAN_BE_EDITED', '1');
        $checkIfPartyCanBeEdit = $entityManager->getRepository(Party::class)->checkIfPartyCanBeEdit($party_ID);

        if ($user_ID != $party_user_host_id || $checkIfPartyCanBeEdit[0]['COUNT(id)'] != PARTY_CAN_BE_EDITED) {
            return $this->redirectToRoute('dashboard');
        }

        // Display name of trait from database
        $trait1_name = $entityManager->getRepository(Trait1::class)->findAllTrait1();
        $trait2_name = $entityManager->getRepository(Trait2::class)->findAllTrait2();
        $trait3_name = $entityManager->getRepository(Trait3::class)->findAllTrait3();
        $trait4_name = $entityManager->getRepository(Trait4::class)->findAllTrait4();

        //DEFAUT VALUE DATE INPUTS
        $today = date("Y-m-d H:i");
        $tomorrow = date("Y-m-d H:i", strtotime('tomorrow'));

        $form = $this->createForm(PartyType::class, $party, [
            'trait1_name' =>  $trait1_name,
            'trait2_name' =>  $trait2_name,
            'trait3_name' =>  $trait3_name,
            'trait4_name' =>  $trait4_name,
        ]);
        $form->handleRequest($request);

        //setting non read message count
        $non_read_message_count = $entityManager->getRepository(UserChat::class)->findNonReadMessageCount($user_ID);

        if ($form->isSubmitted() && $form->isValid()) {
            $party = $form->getData();

            $party->setUserHostID($user_ID);

            // Update database
            $entityManager->persist($party);
            $entityManager->flush();

            // generate a URL with route arguments
            $url = $this->generateUrl('app_party_registration', [
                'partyID' => $party->getId(),
            ]);
            return $this->redirect($url);
        }

        return $this->render('editParty.html.twig', [
            'party' => $form->createView(),
            'today' => $today,
            'tomorrow' => $tomorrow,
            'nonReadMessageCount' => $non_read_message_count,
        ]);
    }
}

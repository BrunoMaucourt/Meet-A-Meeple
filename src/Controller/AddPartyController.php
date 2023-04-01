<?PHP
//CHEMIN ÉVITANT DES INCOHÉRENCES
namespace App\Controller;
//CLASS UTILISER POUR LA PAGE ADDPARTYCONTROLLER.PHP
use App\Entity\User;
use App\Entity\Trait1;
use App\Entity\Trait2;
use App\Entity\Trait3;
use App\Entity\Trait4;
use App\Entity\Party;
use App\Form\PartyType;
use App\Entity\UserChat;
//use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
//use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

//CLASS ADDPARTYCONTROLLER ENFANT DE LA CLASS ABSTRACTCONTROLLER
class AddPartyController extends AbstractController
{   //CHEMIN D'ACCCES (ROUTE)
    #[Route('/addparty', name: 'add party')]
    //APPEL DE LA FONCTION ADDPARTY
    public function addParty(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Display name of trait from database
        $trait1_name = $entityManager->getRepository(Trait1::class)->findAllTrait1();
        $trait2_name = $entityManager->getRepository(Trait2::class)->findAllTrait2();
        $trait3_name = $entityManager->getRepository(Trait3::class)->findAllTrait3();
        $trait4_name = $entityManager->getRepository(Trait4::class)->findAllTrait4();

        // Allow acces only to connected user
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $user_ID = $user->getId();
        $party = new Party();
        $form = $this->createForm(PartyType::class, $party, [
            'trait1_name' =>  $trait1_name,
            'trait2_name' =>  $trait2_name,
            'trait3_name' =>  $trait3_name,
            'trait4_name' =>  $trait4_name,
        ]);
        $form->handleRequest($request);

        //DEFAUT VALUE DATE INPUTS
        $today = date("Y-m-d H:i:s");
        $tomorrow = date("Y-m-d H:i:s", strtotime('tomorrow'));
       
        //seting non read message count
        $non_read_message_count = $entityManager->getRepository(UserChat::class)->findNonReadMessageCount($user_ID);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $party = $form->getData();
            // Get ID of user
            /** @var \App\Entity\User $user */
            $user = $this->getUser();
            $user_ID = $user->getId();

            $party->setUserHostID($user_ID);
            
            $entityManager->persist($party);
            $entityManager->flush();
            // generate a URL with route arguments
            $url = $this->generateUrl('app_party_registration', [
                'partyID' => $party->getId(),
            ]);
            return $this->redirect($url);
        }

        return $this->render('addParty.html.twig', [
            'party' => $form->createView(),
            'today'=> $today,
            'tomorrow' => $tomorrow,
            'nonReadMessageCount' => $non_read_message_count,
        ]);
    }
}
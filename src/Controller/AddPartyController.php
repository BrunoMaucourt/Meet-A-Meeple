<?PHP

namespace App\Controller;

use App\Entity\Party;
use App\Form\PartyType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\String\Slugger\SluggerInterface;

class AddPartyController extends AbstractController
{
    #[Route('/addparty', name: 'add party')]
    public function addParty(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Allow acces only to connected user
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $party = new Party();
        $form = $this->createForm(PartyType::class, $party);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $party = $form->getData(); 
            // Get ID of user
        /** @var \App\Entity\User $user */
            $user = $this->getUser();
            $user_ID = $user->getId();

            $party->setUserHostID($user_ID);
            
            $party->setAddressGPSLat(49.366669);
            $party->setAddressGPSLong(6.16667);
            
            $entityManager->persist($party);
            $entityManager->flush();
        }

        //dd($party);

        return $this->render('addParty.html.twig', [
            'party' => $form->createView(),
        ]);
    }
}

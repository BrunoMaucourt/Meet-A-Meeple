<?PHP

namespace App\Controller;
use App\Entity\UserChat;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

class EditPartyController extends AbstractController
{
    #[Route('/editparty', name: 'edit party')]
    public function editParty(EntityManagerInterface $entityManager): Response
    {
        // Allow acces only to connected user
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $user = $this->getUser();
        $user_ID = $user->getId();

        //seting non read message count
        $non_read_message_count = $entityManager->getRepository(UserChat::class)->findNonReadMessageCount($user_ID);

        return $this->render('editParty.html.twig',[
            'nonReadMessageCount' => $non_read_message_count,
        ]);
    }
}

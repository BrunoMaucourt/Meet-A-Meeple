<?PHP

namespace App\Controller;
use App\Entity\UserChat;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

class PlayerController extends AbstractController
{
    #[Route('/playerprofil/{id}', name: 'player profil')]
    public function player(EntityManagerInterface $entityManager): Response
    {
        // Allow acces only to connected user
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // Get ID of user
        $user = $this->getUser();
        $user_ID = $user->getId();

        //seting non read message count
        $non_read_message_count = $entityManager->getRepository(UserChat::class)->findNonReadMessageCount($user_ID);

        return $this->render('playerprofil.html.twig',[
            'nonReadMessageCount' => $non_read_message_count,
        ]);
    }
}

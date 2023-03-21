<?PHP

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class TestController extends AbstractController
{
    #[Route('/test', name: 'test')]
    public function home(): Response
    {

        // Allow acces only to connected user
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // returns your User object, or null if the user is not authenticated
        // use inline documentation to tell your editor your exact User class
        /** @var \App\Entity\User $user */
        $user = $this->getUser();

        return new Response('Well hi there '.$user->getFirstName().'   '.$user->getId());
    }
}

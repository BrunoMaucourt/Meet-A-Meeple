<?PHP

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class MessageMenuController extends AbstractController
{
    #[Route('/messagemenu', name: 'message menu')]
    public function messageMenu(): Response
    {
        // Allow acces only to connected user
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        return $this->render('messageMenu.html.twig');
    }
}

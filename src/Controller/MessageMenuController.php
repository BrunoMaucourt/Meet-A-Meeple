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
        return $this->render('messageMenu.html.twig');
    }
}

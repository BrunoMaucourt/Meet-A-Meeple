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
        return $this->render('test.html.twig');
    }
}

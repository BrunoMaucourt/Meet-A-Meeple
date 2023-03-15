<?PHP

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class RGPDController extends AbstractController
{
    #[Route('/rgpd', name: 'RGPD')]
    public function rgpd(): Response
    {
        return $this->render('rgpd.html.twig');
    }
}

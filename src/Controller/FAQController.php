<?PHP

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class FAQController extends AbstractController
{
    #[Route('/faq', name: 'FAQ')]
    public function faq(): Response
    {
        return $this->render('FAQ.html.twig');
    }
}

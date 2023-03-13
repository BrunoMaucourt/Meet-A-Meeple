<?PHP

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class SearchController extends AbstractController
{
    #[Route('/search', name: 'search')]
    public function search(): Response
    {
        return $this->render('search.html.twig');
    }
}

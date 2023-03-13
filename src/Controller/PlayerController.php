<?PHP

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class PlayerController extends AbstractController
{
    #[Route('/playerprofil/{id}', name: 'player profil')]
    public function player(): Response
    {
        return $this->render('playerprofil.html.twig');
    }
}

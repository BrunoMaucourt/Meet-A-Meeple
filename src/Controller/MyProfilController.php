<?PHP

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class MyProfilController extends AbstractController
{
    #[Route('/myProfil', name: 'my profil')]
    public function myProfil(): Response
    {
        return $this->render('myProfil.html.twig');
    }
}

<?PHP

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class EditProfilController extends AbstractController
{
    #[Route('/editprofil', name: 'edit profil')]
    public function editProfil(): Response
    {
        return $this->render('editProfil.html.twig');
    }
}

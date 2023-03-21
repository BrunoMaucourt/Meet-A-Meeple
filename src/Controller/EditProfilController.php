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
        // Allow acces only to connected user
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        return $this->render('editProfil.html.twig');
    }
}

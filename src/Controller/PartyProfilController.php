<?PHP

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
 // /{id}
class PartyProfilController extends AbstractController
{
    #[Route('/partyprofil', name: 'party profil')]
    public function partyProfil(): Response
    {
        // Allow acces only to connected user
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        return $this->render('partyProfil.html.twig');
    }
}

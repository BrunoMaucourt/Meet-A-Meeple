<?PHP

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class PartyProfilController extends AbstractController
{
    #[Route('/partyprofil/{id}', name: 'party profil')]
    public function partyProfil(): Response
    {
        return $this->render('partyProfil.html.twig');
    }
}

<?PHP

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class EditPartyController extends AbstractController
{
    #[Route('/editparty', name: 'edit party')]
    public function editParty(): Response
    {
        return $this->render('editParty.html.twig');
    }
}

<?PHP

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class AddPartyController extends AbstractController
{
    #[Route('/addparty', name: 'add party')]
    public function addParty(): Response
    {
        return $this->render('addParty.html.twig');
    }
}

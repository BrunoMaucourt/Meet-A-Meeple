<?PHP

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class HelpPartyController extends AbstractController
{
    #[Route('/helpparty', name: 'help party')]
    public function home(): Response
    {
        return $this->render('helpParty.html.twig');
    }
}

<?PHP

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class CalendarController extends AbstractController
{
    #[Route('/calendar', name: 'calendar')]
    public function calendar(): Response
    {
        return $this->render('calendar.html.twig');
    }
}

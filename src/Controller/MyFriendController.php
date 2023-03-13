<?PHP

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class MyFriendController extends AbstractController
{
    #[Route('/myfriend', name: 'my friend')]
    public function myFriend(): Response
    {
        return $this->render('myFriend.html.twig');
    }
}

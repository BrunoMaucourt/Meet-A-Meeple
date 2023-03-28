<?PHP

namespace App\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController
{
    #[Route('/', name:'home')]
    public function home(): Response
    {
        $testimonies = [
            [
                'name' => 'Patrick C.',
                'profil_picture' => 'img/profil_picture/profil_picture_641eb5da93584.jpg',
                'message' => 'Meet a Meeple est le meilleur site pour rencontrer des joueurs de jeux de société. Je recommande fortement Meet a Meeple à tous les amateurs de jeux de société',
            ],
            [
                'name' => 'Gabriella G.',
                'profil_picture' => 'img/profil_picture/profil_picture_641ec0921fa94.jpg',
                'message' => 'J\'ai été accueilli à bras ouverts sur Meet a meeple et j\'ai rencontré des joueurs fantastiques avec qui j\'ai passé de nombreuses soirées de jeux mémorables.',
            ],
            [
                'name' => 'Denis M.',
                'profil_picture' => 'img/profil_picture/profil_picture_641ebc807227c.jpg',
                'message' => 'La fonction de géolocalisation de Meet a Meeple est fantastique ! Grâce à elle, j\'ai pu trouver des joueurs de jeux de société qui habitent à proximité de chez moi.',
            ],
            [
                'name' => 'Julie D.',
                'profil_picture' => 'img/profil_picture/profil_picture_641ebff7a1f1b.jpg',
                'message' => 'Meet a Meeple est fantastique ! J\'ai trouvé des joueurs passionnés de jeux de société avec qui j\'ai pu découvrir de nouveaux jeux grâce à eux. Je recommande !',
            ],
            [
                'name' => 'Sophie M.',
                'profil_picture' => 'img/profil_picture/profil_picture_641eb7111842a.jpg',
                'message' => 'Si vous cherchez des joueurs passionnés de jeux de société, Meet a Meeple est le site qu\'il vous faut !',
            ],
            [
                'name' => 'Brice R.',
                'profil_picture' => 'img/profil_picture/profil_picture_641eb95f9989b.jpg',
                'message' => 'Meet a Meeple est le paradis des joueurs de jeux de société. Le site est facile à naviguer et j\'ai rencontré des joueurs incroyables avec qui je suis devenu ami.',
            ],
            [
                'name' => 'Hiromi L.',
                'profil_picture' => 'img/profil_picture/profil_picture_641ebc180f653.jpg',
                'message' => 'Meet a Meeple est génial ! J\'ai trouvé des joueurs fantastiques avec qui jouer à mes jeux préférés et j\'ai même pu découvrir de nouveaux jeux grâce à eux.',
            ],
        ];
        return $this->render('home.html.twig', [
            'testimonies' => $testimonies,
        ]);
    }
}

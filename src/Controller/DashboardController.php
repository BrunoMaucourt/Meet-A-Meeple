<?PHP

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'dashboard')]
    public function home(EntityManagerInterface $entityManager): Response
    {
        // Allow acces only to connected user
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // Update database with last connexion date
        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        date_default_timezone_set('Europe/Paris');
        $last_connexion_date = new \DateTime();
        $user->setLastConnexion($last_connexion_date);
        // Insert data in database
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->render('dashboard.html.twig');
    }
}

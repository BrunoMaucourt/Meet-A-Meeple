<?PHP

namespace App\Controller;

use App\Entity\Party;
use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Doctrine\ORM\EntityManagerInterface;

class SearchController extends AbstractController
{
    #[Route('/search', name: 'search')]
    public function search(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Allow acces only to connected user
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // Create form
        $form = $this->createFormBuilder()
            ->add('search_type', ChoiceType::class, [
                'choices'  => [
                    'Joueur' => 0,
                    'Partie' => 1,
                ],
                'expanded' => true,
                'label' => false, 
            ])
            ->add('city_name')
            ->add('distance', RangeType::class, [
                'attr' => [
                    'value' => 5,
                    'min' => 5,
                    'max' => 25,
                    'step' => 5
                ],
            ])
            ->add('send', SubmitType::class)
            ->getForm();

        // Variables declaration
        $result=[];
        $error = "";
        $rechercheNonFiltree = [];
        $product = [];
        $data = [];
        define("SEARCH_PARTY", "1");
        define("SEARCH_PLAYER", "0");

        // Get ID of user
        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        $user_ID = $user->getId();

        // Process form
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Recover data from form
            $data = $form->getData();
            
            // Check if user search player or party
            if($data['search_type'] == SEARCH_PARTY){
                // Search in database
                $product = $entityManager->getRepository(Party::class)->findAllAvailableParty();
                $rechercheNonFiltree = $entityManager->getRepository(Party::class)->findAll();
            }else if($data['search_type'] == SEARCH_PLAYER){
                // Search in database
                $product = $entityManager->getRepository(User::class)->findAllAvailableUser($user_ID);
                $rechercheNonFiltree = $entityManager->getRepository(User::class)->findAll();
            }

            // Filter 

            // Stock data in array
            $result = $product;

            // Send a message if zero results are found
            if($result == []){
                $error = "Aucun résultats pour votre recherche";
            }
        }

        return $this->render('search.html.twig', [
            'searchForm' => $form->createView(),
            'searchResult' => $result,
            'test' => $rechercheNonFiltree,
            'error' => $error,
            'data' => $data,
        ]);
    }
}

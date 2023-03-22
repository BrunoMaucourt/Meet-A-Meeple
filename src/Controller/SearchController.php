<?PHP

namespace App\Controller;

use App\Entity\Party;
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
        $defaultData = ['message' => 'Type your message here'];
        $form = $this->createFormBuilder($defaultData)
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

        //
        $result=['titi'];

        // Process form
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Recover data from form
            $data = $form->getData();
            
            // Search in database
            $product = $entityManager->getRepository(Party::class)->findAllAvailableParty();
            $product2merde = $entityManager->getRepository(Party::class)->findAll();
            // Filter 

            // Stock data in array
            $result = $product;
        }

        return $this->render('search.html.twig', [
            'searchForm' => $form->createView(),
            'searchResult' => $result,
            'test' => $product2merde,
        ]);
    }
}

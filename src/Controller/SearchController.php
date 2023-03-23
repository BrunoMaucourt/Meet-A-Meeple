<?PHP

namespace App\Controller;

use App\Entity\Party;
use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
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

        // Variables declaration
        $result=[];
        $error = "";
        $rechercheNonFiltree = [];
        $product = [];
        $data = [];
        define("SEARCH_PARTY", "1");
        define("SEARCH_PLAYER", "0");
        define("EARTH_RADIUS",6371);

        // Get ID of user
        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        $user_ID = $user->getId();
        $user_ID_city = $user->getCity();
        $user_ID_lat = $user->getCityGPSLat();
        $user_ID_long = $user->getCityGPSLong();

        // Default value for form
        $defaults = [
            'city_name' => $user_ID_city,
            'city_GPS_lat' => $user_ID_lat,
            'city_GPS_long' => $user_ID_long,
        ];

        // Create form
        $form = $this->createFormBuilder($defaults)
            ->add('search_type', ChoiceType::class, [
                'choices'  => [
                    'Joueur' => 0,
                    'Partie' => 1,
                ],
                'expanded' => true,
                'label' => false, 
            ])
            ->add('city_name')
            ->add('city_GPS_lat', TextareaType::class,[
                'label' => false,
                ])
            ->add('city_GPS_long', TextareaType::class,[
                'label' => false]
                )
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

        // Process form
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Recover data from form
            $data = $form->getData();
            $user_ID_lat = $data['city_GPS_lat'];
            $user_ID_long = $data['city_GPS_long'];
            
            $temp_result = [];

            // Check if user search player or party
            if($data['search_type'] == SEARCH_PARTY){
                // Search in database
                $result = $entityManager->getRepository(Party::class)->findAllAvailableParty();
                $rechercheNonFiltree = $entityManager->getRepository(Party::class)->findAll();
        
                
                foreach ($result as $party) {
                    $party_lat = $party['address_gps_lat'];
                    $party_long = $party['address_gps_long'];
                    $distance_between = SearchController::calculateDistance($user_ID_lat,$user_ID_long,$party_lat,$party_long);
                    if($distance_between <= $data['distance']){
                        array_push($temp_result,$party);
                    }
                }
                $result = $temp_result;

                

            }else if($data['search_type'] == SEARCH_PLAYER){
                // Search in database
                $result = $entityManager->getRepository(User::class)->findAllAvailableUser($user_ID);
                $rechercheNonFiltree = $entityManager->getRepository(User::class)->findAll();

                foreach ($result as $player) {
                    $player_lat = $player['city_gps_lat'];
                    $player_long = $player['city_gps_long'];
                    $distance_between = SearchController::calculateDistance($user_ID_lat,$user_ID_long,$player_lat,$player_long);
                    if($distance_between <= $data['distance']){
                        array_push($temp_result,$player);
                    }
                }
                $result = $temp_result;
                
            }

            // Distance Filter 

            

            // Stock data in array
            

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

    public function calculateDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo){
        // convert from degrees to radians
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);
      
        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;
      
        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
          cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return $angle * EARTH_RADIUS;
    }
}

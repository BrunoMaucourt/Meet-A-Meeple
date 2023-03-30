<?PHP

namespace App\Controller;
use App\Entity\UserChat;
use App\Entity\Party;
use App\Entity\PartyUser;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
 // /{id}
class PartyProfilController extends AbstractController
{
    #[Route('/partyprofil/{partyID}', name: 'party profil')]
    public function partyProfil(EntityManagerInterface $entityManager, int $partyID): Response
    {
        // Allow acces only to connected user
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // Get ID of user
        $user = $this->getUser();
        $user_ID = $user->getId();
        $user_ID_lat = $user->getCityGPSLat();
        $user_ID_long = $user->getCityGPSLong();

        //seting non read message count
        $non_read_message_count = $entityManager->getRepository(UserChat::class)->findNonReadMessageCount($user_ID);

        //getting party informations
        $party = $entityManager->getRepository(Party::class)->findParty($partyID);
        $party = $party[0];

        //modifying date
        $spliter_string =  str_split($party['date'], 10);
        $party['date'] = $spliter_string[0];
        $spliter_string =  str_split($party['created_at'], 10);
        $party['created_at'] = $spliter_string[0];
        $spliter_string =  str_split($party['last_sign_in'], 10);
        $party['last_sign_in'] = $spliter_string[0];
        
    //***getting host player informations***
        $host_player = $entityManager->getRepository(Party::class)->findHostPlayer($partyID);

        for ($i=0; $i < sizeof($host_player); $i++) { 
            $host_player_lat = $host_player[$i]['city_gps_lat'];
            $host_player_long = $host_player[$i]['city_gps_long'];
            $distance_between = SearchController::calculateDistance($user_ID_lat,$user_ID_long,$host_player_lat,$host_player_long);              
            $host_player[$i]['distance'] = round($distance_between,1);
        }

        // Edit data before export to TWIG
        $temp_result_date_created = SearchController::editDateCreatedAt($host_player);
        $temp_result_last_connexion = SearchController::editLastConnexion($temp_result_date_created);
        $temp_result_age = SearchController::calculateAge($temp_result_last_connexion);
        $temp_result_comment = SearchController::numberOfComment($temp_result_age, $entityManager);
        $host_player = $temp_result_comment;
    //**** ****/

    //***getting registered players informations***
        $registered_players = $entityManager->getRepository(PartyUser::class)->findAllParticipantExceptUser($host_player[0]['id'],$partyID);


        return $this->render('partyProfil.html.twig',[
            'nonReadMessageCount' => $non_read_message_count,
            'party' => $party,
            'hostPlayer' => $host_player,
            'titi' => $registered_players,
        ]);
    }
}

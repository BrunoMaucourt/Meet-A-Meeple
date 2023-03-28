<?PHP

namespace App\Controller;

use App\Entity\User;
use App\Entity\UserChat;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

use App\Form\UserChatType;

class MessageMenuController extends AbstractController
{
    #[Route('/messagemenu/{id}', name: 'message_menu_with_discussion')]
    public function messageMenu(Request $request, EntityManagerInterface $entityManager,int $id): Response
    {
        // Allow acces only to connected user
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $userchat = new UserChat();
        $current_user = $this->getUser();
        $current_user_id = $current_user->getId();
        $other_user_id = $id;

        //create users array talking with
        $user_talking_to_me = $entityManager->getRepository(UserChat::class)->findAllUserTalkingToMe($current_user_id);
        $user_talking_with = $entityManager->getRepository(UserChat::class)->findAllUserTalkingWith($current_user_id);
        $all_user_talking_with = array_unique(array_merge($user_talking_to_me, $user_talking_with), SORT_REGULAR);

        //create discussion array
        $discussion = $entityManager->getRepository(UserChat::class)->findAllMessageFromDiscussion($current_user_id,$other_user_id);
        
        // Create form
        $form = $this->createForm(UserChatType::class, $userchat);            

        // Process form
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $userchat->setUserSenderID($current_user_id);
            $userchat->setUserRecipientID($other_user_id);
            $entityManager->persist($userchat);
            $entityManager->flush();

            $url = $this->generateUrl('message_menu_with_discussion', [
                'id' => $other_user_id,
            ]);
            return $this->redirect($url);
        }

        return $this->render('messageMenu.html.twig',[
            'userChatForm' => $form->createView(),
            'allUserTalkingWith' => $all_user_talking_with,
            'discussion' => $discussion,
            'currentUserId' => $current_user_id,
            'other_id' => $other_user_id
    ]);
    }

    #[Route('/messagemenu', name: 'message menu')]
    public function messageMenu2(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Allow acces only to connected user
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $userchat = new UserChat();
        $current_user = $this->getUser();
        $current_user_id = $current_user->getId();

        $discussion = null;

        //create users array talking with
        $user_talking_to_me = $entityManager->getRepository(UserChat::class)->findAllUserTalkingToMe($current_user_id);
        $user_talking_with = $entityManager->getRepository(UserChat::class)->findAllUserTalkingWith($current_user_id);
        $all_user_talking_with = array_unique(array_merge($user_talking_to_me,$user_talking_with), SORT_REGULAR);

        return $this->render('messageMenu.html.twig',[
            'allUserTalkingWith' => $all_user_talking_with,
            'discussion' => $discussion,
    ]);
    }
}

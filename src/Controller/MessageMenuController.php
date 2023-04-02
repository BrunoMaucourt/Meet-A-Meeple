<?PHP

namespace App\Controller;

use App\Entity\User;
use App\Entity\UserChat;
use App\Entity\DisplayChat;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

use App\Form\UserChatType;

class MessageMenuController extends AbstractController
{
    #[Route('/messagemenu/{id}', name: 'message_menu_with_discussion')]
    public function messageMenuWithDiscussion(Request $request, EntityManagerInterface $entityManager,int $id): Response
    {
        // Allow acces only to connected user
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $userchat = new UserChat();
        $current_user = $this->getUser();
        $current_user_id = $current_user->getId();
        $other_user_id = $id;
        define('NO_CHAT_LIST', 0);


        //check if target is display in the list
        $checkIfUserIsInChatList = $entityManager->getRepository(DisplayChat::class)->checkIfUserIsInChatList($current_user_id,$other_user_id);
        if($checkIfUserIsInChatList[0]['count'] == NO_CHAT_LIST){
            $display_chat = new DisplayChat();
            $display_chat ->setUserSenderID($current_user_id);
            $display_chat ->setUserRecipientID($other_user_id);

            $entityManager->persist($display_chat);
            $entityManager->flush();
        }


        //create users array talking with
        $contactNonReadMessage = $entityManager->getRepository(UserChat::class)->findContactNonReadMessageCount($current_user_id);
        $non_read_message_count = $entityManager->getRepository(UserChat::class)->findNonReadMessageCount($current_user_id);
        $user_talking_with = $entityManager->getRepository(DisplayChat::class)->findAllUserIAmTalkingWith($current_user_id);


        //$user_talking_to_me = $entityManager->getRepository(UserChat::class)->findAllUserTalkingToMe($current_user_id);
       ///$user_talking_with = $entityManager->getRepository(UserChat::class)->findAllUserTalkingWith($current_user_id);
       // $all_user_talking_with = array_unique(array_merge($user_talking_to_me, $user_talking_with), SORT_REGULAR);

        //making a new row in the $all_user_talking_with array that show how many non read message for each user.
        // $all_user_talking_with['non_read_msg_count']
        foreach ($user_talking_with as &$user) {
            if($contactNonReadMessage == [] ){
                $user['non_read_msg_count'] = 0;
            }else{
                foreach ($contactNonReadMessage as $message) {
                    if($message['id'] == $user['contact_id']){
                        $user['non_read_msg_count'] = $message['count'];
                        break;
                    }else{
                        $user['non_read_msg_count'] = 0;
                    }
                }
            }   
        }
       
        //create discussion array
        $discussion = $entityManager->getRepository(UserChat::class)->findAllMessageFromDiscussion($current_user_id,$other_user_id);
        
        // Create form
        $form = $this->createForm(UserChatType::class, $userchat);            


        //set message to read when watching discussion
        $entityManager->getRepository(UserChat::class)->SetAllMessageFromDiscussionToRead($current_user_id,$other_user_id);

        // Process form
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $userchat->setUserSenderID($current_user_id);
            $userchat->setUserRecipientID($other_user_id);
            $entityManager->persist($userchat);

            $checkIfUserIsInChatList = $entityManager->getRepository(DisplayChat::class)->checkIfUserIsInChatList($other_user_id,$current_user_id);
            if($checkIfUserIsInChatList[0]['count'] == NO_CHAT_LIST){
                $display_chat = new DisplayChat();
                $display_chat ->setUserSenderID($other_user_id);
                $display_chat ->setUserRecipientID($current_user_id);
                $entityManager->persist($display_chat);
            }

            $entityManager->flush();

            $url = $this->generateUrl('message_menu_with_discussion', [
                'id' => $other_user_id,
            ]);
            return $this->redirect($url);
        }

        return $this->render('messageMenu.html.twig',[
            'userChatForm' => $form->createView(),
            'allUserTalkingWith' => $user_talking_with,
            'discussion' => $discussion,
            'currentUserId' => $current_user_id,
            'other_id' => $other_user_id,
            'nonReadMessageCount' => $non_read_message_count,
    ]);
    }

    #[Route('/messagemenu', name: 'message menu')]
    public function messageMenu(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Allow acces only to connected user
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $userchat = new UserChat();
        $current_user = $this->getUser();
        $current_user_id = $current_user->getId();
        $other_user_id = null;

        $discussion = null;

        //create users array talking with
        $contactNonReadMessage = $entityManager->getRepository(UserChat::class)->findContactNonReadMessageCount($current_user_id);
        $non_read_message_count = $entityManager->getRepository(UserChat::class)->findNonReadMessageCount($current_user_id);
        $user_talking_with = $entityManager->getRepository(DisplayChat::class)->findAllUserIAmTalkingWith($current_user_id);

        //making a new row in the $all_user_talking_with array that show how many non read message for each user.
        // $all_user_talking_with['non_read_msg_count']
        foreach ($user_talking_with as &$user) {
            if($contactNonReadMessage == [] ){
                $user['non_read_msg_count'] = 0;
            }else{
                foreach ($contactNonReadMessage as $message) {
                    if($message['id'] == $user['contact_id']){
                        $user['non_read_msg_count'] = $message['count'];
                        break;
                    }else{
                        $user['non_read_msg_count'] = 0;
                    }
                }
            }   
        }


        return $this->render('messageMenu.html.twig',[
            'allUserTalkingWith' => $user_talking_with,
            'discussion' => $discussion,
            'other_id' => $other_user_id,
            'nonReadMessageCount' => $non_read_message_count,
    ]);
    }


    #[Route('/messagemenu_close{id}', name: 'message menu close')]
    public function messageMenuClose(Request $request, EntityManagerInterface $entityManager,int $id): Response
    {
        // Allow acces only to connected user
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $userchat = new UserChat();
        $current_user = $this->getUser();
        $current_user_id = $current_user->getId();
        $other_user_id = $id;
        define('NO_CHAT_LIST', 0);

        $checkIfUserIsInChatList = $entityManager->getRepository(DisplayChat::class)->checkIfUserIsInChatList($current_user_id,$other_user_id);
            if($checkIfUserIsInChatList[0]['count'] != NO_CHAT_LIST){
                $entityManager->getRepository(DisplayChat::class)->removeUserToChatList($current_user_id,$other_user_id);
            }


        return $this->redirectToRoute('message menu');
    }
}

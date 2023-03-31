<?php

namespace App\Controller;
use App\Entity\Trait1;
use App\Entity\Trait2;
use App\Entity\Trait3;
use App\Entity\Trait4;
use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\UserAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, UserAuthenticator $authenticator, EntityManagerInterface $entityManager): Response
    {
        // Redirect to dashboard if already connected
        if($this->getUser()){
            return $this->redirectToRoute('dashboard');
        }

        // Display name of trait from database
        $trait1_name = $entityManager->getRepository(Trait1::class)->findAllTrait1();
        $trait2_name = $entityManager->getRepository(Trait2::class)->findAllTrait2();
        $trait3_name = $entityManager->getRepository(Trait3::class)->findAllTrait3();
        $trait4_name = $entityManager->getRepository(Trait4::class)->findAllTrait4();

        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user, [
            'trait1_name' =>  $trait1_name,
            'trait2_name' =>  $trait2_name,
            'trait3_name' =>  $trait3_name,
            'trait4_name' =>  $trait4_name,
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            // Add profil picture
            /** @var UploadedFile $uploaded_picture */
            $uploaded_picture = $form->get('picture_profil')->getData();
            $newFilename = 'img/profil_picture/profil_picture_' . uniqid() . '.' . $uploaded_picture->guessExtension();

            // Move the file to the directory where profil pictures are stored
            try {
                $uploaded_picture->move(
                    $this->getParameter('profil_picture_directory'),
                    $newFilename
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }
            $user->setPictureProfil($newFilename);

            // Insert data in database
            $entityManager->persist($user);
            $entityManager->flush();

            // do anything else you need here, like send an email

            return $userAuthenticator->authenticateUser(
                $user,
                $authenticator,
                $request
            );
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}

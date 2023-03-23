<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\File;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('last_name', TextType::class, [
                'required' => true,
            ])
            ->add('first_name', TextType::class, [
                'required' => true,
            ])
            ->add('gender_id', ChoiceType::class, [
                'choices'  => [
                    'Non précisé' => 0,
                    'Homme' => 1,
                    'Femme' => 2,
                ]
            ])
            ->add('pseudo')
            ->add('birthdate',BirthdayType::class)
            ->add('city')
            ->add('city_GPS_lat', TextareaType::class,[
            'label' => false]
            )
            ->add('city_GPS_long', TextareaType::class,[
                'label' => false]
                )
            ->add('description', TextareaType::class)
            ->add('favorite_game')
            ->add('trait1_id', ChoiceType::class, [
                'choices'  => [
                    'Option 1' => 0,
                    'Option 2' => 1,
                    'Option 3' => 2,
                    'Option 4' => 3,
                ]
            ])
            ->add('trait2_id', ChoiceType::class, [
                'choices'  => [
                    'Option 1' => 0,
                    'Option 2' => 1,
                    'Option 3' => 2,
                    'Option 4' => 3,
                ]
            ])
            ->add('trait3_id', ChoiceType::class, [
                'choices'  => [
                    'Option 1' => 0,
                    'Option 2' => 1,
                    'Option 3' => 2,
                    'Option 4' => 3,
                ]
            ])
            ->add('trait4_id', ChoiceType::class, [
                'choices'  => [
                    'Option 1' => 0,
                    'Option 2' => 1,
                    'Option 3' => 2,
                    'Option 4' => 3,
                ]
            ])
            ->add('picture_profil', FileType::class, [
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'maxSizeMessage' => 'La taille de la photo de profil est supérieure à 1024k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/webp',
                        ],
                        'mimeTypesMessage' => 'Le format de la photo de profil ne correspond pas à JPEG, PNG or WEBP format',
                    ])
                ]
            ])
            ->add('email')
            ->add('RGPDconsent', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

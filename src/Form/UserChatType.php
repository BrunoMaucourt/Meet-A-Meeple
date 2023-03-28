<?php

namespace App\Form;

use App\Entity\UserChat;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class UserChatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            //->add('user_sender_ID')
            //->add('user_recipient_ID')
            ->add('body',TextType::class,[
                'label' => false])
            //->add('creataed_at')
            //->add('messageRead')
            


        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UserChat::class,
        ]);
    }
}

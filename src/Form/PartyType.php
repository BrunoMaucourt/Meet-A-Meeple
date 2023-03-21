<?php

namespace App\Form;

use App\Entity\Party;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PartyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('user_host_ID')
            ->add('description')
            ->add('game')
            ->add('player_number_needed')
            ->add('player_number_total')
            ->add('address_location')
            ->add('address_GPS_lat')
            ->add('address_GPS_long')
            ->add('type_location_ID')
            ->add('date')
            ->add('last_sign_in')
            ->add('created_at')
            ->add('trait1_ID')
            ->add('trait2_ID')
            ->add('trait3_ID')
            ->add('trait4_ID')
            ->add('canceled')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Party::class,
        ]);
    }
}

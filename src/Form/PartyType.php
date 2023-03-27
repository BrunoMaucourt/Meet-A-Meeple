<?php
//CHEMIN ÉVITANT DES INCOHÉRENCES
namespace App\Form;
//CLASS UTILISER POUR LA PAGE PARTYTYPE.PHP
use App\Entity\Party;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
//use Doctrine\DBAL\Driver\Mysqli\Initializer\Options;
//use Doctrine\DBAL\Types\DateTimeType as TypesDateTimeType;
//use Symfony\Component\Form\Extension\Core\Type\DateType;
//use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\AbstractType;
//use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
//use Symfony\Component\HttpClient\HttpOptions;
use Symfony\Component\OptionsResolver\OptionsResolver;
//CLASS PARTYTYPE ENFANT DE LA CLASS ABSTRACTYPE
class PartyType extends AbstractType
{   //APPEL DE LA FONCTION BUILDFORM
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {   //CRÉATION DES NOMS COLONNES DE LA TABLE PARTY
        $builder
            //->add('user_host_ID')
            ->add('description')
            ->add('game')
            ->add('player_number_needed')
            ->add('player_number_total')
            ->add('address_location')
            ->add('address_GPS_lat', TextareaType::class,[
                'label' => false])
            ->add('address_GPS_long', TextareaType::class,[
                'label' => false])
            ->add('type_location_ID', ChoiceType::class, [
                'choices'  => [
                    'Maison d\un particulier' => 0,
                    'Bar' => 1,
                    'Boutique de jeux de société' => 2,
                ]
            ])
            ->add('date', DateTimeType::class, [
                'widget' => 'single_text',
                //'input'  => 'datetime_immutable',
                'html5' => true,
            ])
            ->add('last_sign_in', DateTimeType::class, [
                'widget' => 'single_text',
                //'input'  => 'datetime_immutable',
                'html5' => true,
            ])
            //->add('created_at')
            ->add('trait1_ID')
            ->add('trait2_ID')
            ->add('trait3_ID')
            ->add('trait4_ID')
            //->add('canceled')
        ;
    }
    //APPEL DE LA FONCTION CONFIGUREOPTIONS
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Party::class,
        ]);
    }
}

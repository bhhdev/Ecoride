<?php

namespace App\Form;

use App\Entity\Trip;
use App\Entity\Vehicle;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;

class NewTripType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('departureDay', DateType::class, [
                'widget' => 'single_text'
            ])

            ->add('departureHour', TimeType::class, [
                'widget' => 'single_text',
                'input' => 'datetime_immutable'
            ])

            ->add('departureCity')
            ->add('departureAddress')

            ->add('arrivalDay', DateType::class, [
                'widget' => 'single_text'
            ])

            ->add('arrivalHour', TimeType::class, [
                'widget' => 'single_text',
                'input' => 'datetime_immutable'
            ])

            ->add('arrivalCity')
            ->add('arrivalAddress')

            ->add('seatAvailable', IntegerType::class)

            ->add('seatPrice', IntegerType::class)

            ->add('vehicle', EntityType::class, [
                'class' => Vehicle::class,
                'choice_label' => 'vehicleName',
                'label' => false,
                'query_builder' => function (EntityRepository $er) use ($options) {
                    return $er->createQueryBuilder('v')
                        ->where('v.owner = :user') // Assurez-vous que la propriété s'appelle 'user' dans votre entité Vehicle
                        ->setParameter('user', $options['user']);
                        // ->setParameter('user', $options['user'])
                        // ->orderBy('v.vehicleName', 'ASC');
                }
            ])

            // PREFS (non mappées à Trip)

            ->add('smokeVap', CheckboxType::class, [
                'required' => false,
                'label' => false,
                'mapped' => false
            ])

            ->add('animalsAccepted', CheckboxType::class, [
                'required' => false,
                'label' => false,
                'mapped' => false
            ])

            ->add('airConditioning', CheckboxType::class, [
                'required' => false,
                'label' => false,
                'mapped' => false
            ])

            ->add('message', TextareaType::class, [
                'required' => false,
                'mapped' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Trip::class,
            'user' => null
        ]);
    }
}
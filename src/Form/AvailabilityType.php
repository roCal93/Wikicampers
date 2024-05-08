<?php

namespace App\Form;

use App\Entity\Availability;
use App\Entity\vehicle;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class AvailabilityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('startDate', null, [
                'widget' => 'single_text',
            ])
            ->add('endDate', null, [
                'widget' => 'single_text',
            ])
            ->add('pricePerDay')
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Disponible' => Availability::STATUS_AVAILABLE,
                    'Non disponible' => Availability::STATUS_UNAVAILABLE,
                ],
            ])
            ->add('vehicle', EntityType::class, [
                'class' => vehicle::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Availability::class,
        ]);
    }
}

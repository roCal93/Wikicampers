<?php
namespace App\Form;

use App\Entity\Vehicle;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DisponibiliteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('vehicule', EntityType::class, [
                'class' => Vehicle::class,
                'choice_label' => function ($vehicule) {
                    return $vehicule->getMarque() . ' ' . $vehicule->getModele();
                }
            ])
            ->add('dateDebut', DateTimeType::class, ['widget' => 'single_text'])
            ->add('dateFin', DateTimeType::class, ['widget' => 'single_text'])
            ->add('prixParJour', NumberType::class)
            ->add('statut', CheckboxType::class, [
                'label'    => 'Disponible',
                'required' => false,
            ])
            ->add('save', SubmitType::class, ['label' => 'Save Disponibilite']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DisponibiliteType::class,
        ]);
    }
}
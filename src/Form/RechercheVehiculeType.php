<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class RechercheVehiculeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateDebut', DateType::class, ['widget' => 'single_text'])
            ->add('dateRetour', DateType::class, ['widget' => 'single_text'])
            ->add('prixMax', NumberType::class, ['required' => false])
            ->add('rechercher', SubmitType::class);
    }
}

<?php

namespace App\Form;

use App\Entity\CarResearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarResearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('minYear', IntegerType::class, [
                "required" => false,
                "label" => "Year from : "
            ])
            ->add('maxYear', IntegerType::class, [
                "required" => false,
                "label" => "Year to : "
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CarResearch::class,
        ]);
    }
}

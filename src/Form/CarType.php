<?php

namespace App\Form;

use App\Entity\Car;
use App\Entity\CarModel;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('immatriculation')
            ->add('doorNumber', IntegerType::class)
            ->add('year', IntegerType::class)
            ->add('carModel', EntityType::class, [
                "class" => CarModel::class,
                "choice_label" => "wording"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
        ]);
    }
}

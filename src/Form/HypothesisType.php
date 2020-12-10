<?php

namespace App\Form;

use App\Entity\HypothesisLake;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HypothesisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nameOfBusiness',TextType::class)
            ->add('customerSegments',CollectionType::class,[
                'label'=>false,
                'entry_type'=> CustomerSegmentType::class,
                'allow_add'=>true,
                'allow_delete'=>true,
                'by_reference' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => HypothesisLake::class,
        ]);
    }
}

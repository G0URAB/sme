<?php

namespace App\Form;

use App\Entity\HypothesisLake;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HypothesisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('phase',NumberType::class,['disabled'=>true])
            ->add('nameOfBusiness',TextType::class)
            ->add('businessType',ChoiceType::class,[
                'choices' => [
                    'B2C Hardware business'=>HypothesisLake::BUSINESS_TYPES[0],
                    'B2C Software business'=>HypothesisLake::BUSINESS_TYPES[1],
                    'B2C Service business'=>HypothesisLake::BUSINESS_TYPES[2],
                    'B2B Hardware business'=>HypothesisLake::BUSINESS_TYPES[3],
                    'B2B Software business'=>HypothesisLake::BUSINESS_TYPES[4],
                    'B2B Service business'=>HypothesisLake::BUSINESS_TYPES[5],
                ],
                'placeholder' => 'Select a business type'
            ])
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

<?php

namespace App\Form;

use App\Entity\CustomerSegment;
use App\Entity\ValueProposition;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomerSegmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class,[
                'label_attr'=>['class'=>'font-weight-bold'],
                'label'=>'Name of customer-segment'
            ])
            ->add('valuePropositions', CollectionType::class,[
                'label'=>"Which solution are you proposing for a customer's problem?",
                'label_attr'=>['class'=>'font-weight-bold'],
                'entry_type'=>ValuePropositionType::class,
                'allow_add'=>true,
                'allow_delete'=>true,
                'by_reference' => false,
            ])
            ->add('marketingStrategy', CollectionType::class,[
                'label_attr'=>['class'=>'font-weight-bold'],
                'entry_type'=>MarketingStrategyType::class,
                'allow_add'=>true,
                'allow_delete'=>true,
                'by_reference' => false,
                'entry_options'=>[
                    'label'=>false,
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CustomerSegment::class,
        ]);
    }
}

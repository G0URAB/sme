<?php

namespace App\Form;

use App\Entity\CustomerSegment;
use App\Entity\ValueProposition;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomerSegmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('valuePropositions', CollectionType::class,[
                'entry_type'=>ValuePropositionType::class,
                'allow_add'=>true,
                'allow_delete'=>true,
                'by_reference' => false,
            ])
            ->add('marketingStrategy', MarketingStrategyType::class,[

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

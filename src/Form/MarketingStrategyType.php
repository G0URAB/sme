<?php

namespace App\Form;

use App\Entity\MarketingStrategy;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MarketingStrategyType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', ChoiceType::class, [
                'label'=>'Strategy type',
                'choices' => [
                    'Follow the rabbit' => MarketingStrategy::FOLLOW_THE_RABBIT,
                    'Big bang' => MarketingStrategy::BIG_BANG,
                    'Piggy back' => MarketingStrategy::PIGGY_BACK,
                    'Marquee' => MarketingStrategy::MARQUEE
                ],
                'placeholder' => 'Select a marketing strategy type'
            ])
            ->add('description', TextareaType::class, [
                'label'=>'Strategy description',
                'disabled' => true,
                'trim'=>true,
                'data' => 'Select a marketing strategy type to see the description :)'
            ])
            ->add('examples', TextareaType::class, [
                'label'=>'Strategy examples',
                'disabled' => true,
                'trim'=>true,
                'data' => 'Select a marketing strategy type to see the examples :)'
            ])
            ->add('name', TextType::class, [
                'label'=>'Specify an action for this marketing strategy?',
            ])
            ->add('channel', TextType::class, [
                'label'=>'What channel are you going to use for this strategy? E.g Google, Facebook',
            ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MarketingStrategy::class,
        ]);
    }
}

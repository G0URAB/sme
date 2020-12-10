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
        ->add('name',ChoiceType::class,[
            'choices'=>[
                'Follow the rabbit'=>MarketingStrategy::FOLLOW_THE_RABBIT,
                'Big bang'=>MarketingStrategy::BIG_BANG,
                'Piggy back'=>MarketingStrategy::PIGGY_BACK,
                'Marquee'=>MarketingStrategy::MARQUEE
            ],
            'placeholder'=>'Select a marketing strategy'
        ])
        ->add('strategies',CollectionType::class,[
                 'entry_type'=>TextType::class,
                 'allow_add'=>true,
                 'allow_delete'=>true
            ]);

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {

            $form = $event->getForm();
            $strategy = $event->getData();
            dump($strategy);
            $form->add('description', TextareaType::class, [
                'disabled'=>true,
                'data'=>"LOL"
            ]);
        });

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MarketingStrategy::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Form\EventListener\AddTestCasesFormSubscriber;
use App\Model\CubeSummation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CubeSummationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nTestCases', IntegerType::class, [
                'attr' => [
                    'min' => '1',
                    'minlength' => '1',
                    'max' => '50',
                    'maxlength' => '2',
                    'title' => '1 <= T <= 50',
                    'placeholder' => '1 <= T <= 50'
                ]
            ])
            ->add('save', SubmitType::class)
        ;

        $builder->addEventSubscriber(new AddTestCasesFormSubscriber());
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => CubeSummation::class]);
    }
}

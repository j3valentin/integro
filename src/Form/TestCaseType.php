<?php

namespace App\Form;

use App\Form\EventListener\AddQueryFormSubscriber;
use App\Model\TestCase;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TestCaseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('n', IntegerType::class, [
                'attr' => [
                    'min' => 1,
                    'minlength' => 1,
                    'max' => 100,
                    'maxlength' => 3,
                    'title' => '1 <= N <= 100',
                    'placeholder' => '1 <= N <= 100'
                ]
            ])
            ->add('m', IntegerType::class, [
                'attr' => [
                    'min' => 1,
                    'minlength' => 1,
                    'max' => 1000,
                    'maxlength' => 4,
                    'title' => '1 <= M <= 1000',
                    'placeholder' => '1 <= M <= 1000'
                ]
            ])
        ;

        $builder->addEventSubscriber(new AddQueryFormSubscriber());
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => TestCase::class]);
    }
}

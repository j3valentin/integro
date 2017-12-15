<?php

namespace App\Form;

use App\Form\EventListener\AddInputFieldsSubscriber;
use App\Model\Query;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QueryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //die(print_r(array_merge(['' => null], Query::$TYPES)));
        $builder
            ->add('type', ChoiceType::class, [
                'required' => false,
                'empty_data' => null,
                //'choices' => array_merge(['' => null], Query::$TYPES),
                'choices' => Query::$TYPES,
            ])
        ;

        $builder->addEventSubscriber(new AddInputFieldsSubscriber());
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => Query::class]);
    }
}

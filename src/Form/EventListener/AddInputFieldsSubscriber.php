<?php

namespace App\Form\EventListener;

use App\Form\QueryType;
use App\Model\Query;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class AddInputFieldsSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        // Tells the dispatcher that you want to listen on the form.pre_set_data
        // event and that the preSetData method should be called.
        return [
            FormEvents::PRE_SUBMIT => 'onPreSubmit',
        ];
    }

    public function onPreSubmit(FormEvent $event)
    {
        $query = $event->getData();
        $form = $event->getForm();

        //  die(print_r($query));
        if (!in_array($query['type'], Query::$TYPES)) {
            return;
        }

        $form->add('fields', CollectionType::class, [
            'entry_type' => IntegerType::class,
            'by_reference' => false,
            'allow_add' => true,
            'entry_options'  => [
                'label' => false,
                'attr' => [
                    'min' => 1,
                    'minlength' => 1,
                    'max' => 100,
                    'maxlength' => 3,
                    'title' => '1 <= x,y,z <= 100',
                    'placeholder' => '1 <= x,y,z <= 100'
                ]
            ],
        ]);

        for ($i = 0; $i < $query['type']; $i++) {
            if (isset($query['fields'][$i])) {
                continue;
            }
            $query['fields'][] = '';
        }

        $event->setData($query);
    }
}

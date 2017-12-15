<?php

namespace App\Form\EventListener;

use App\Form\QueryType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class AddQueryFormSubscriber implements EventSubscriberInterface
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
        $tc = $event->getData();
        $form = $event->getForm();

        if ($tc['m'] < 1 || $tc['m'] > 1000) {
            return;
        }

        $form->add('queries', CollectionType::class, [
            'entry_type' => QueryType::class,
            'by_reference' => false,
            'allow_add' => true,
            'entry_options'  => [
                'label' => false
            ]
        ]);

        for ($i = 0; $i < $tc['m']; $i++) {
            if (isset($tc['queries'][$i])) {
                continue;
            }
            $tc['queries'][] = ['type' => ''];
        }

        $event->setData($tc);
    }
}

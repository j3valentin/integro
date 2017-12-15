<?php

namespace App\Form\EventListener;

use App\Form\TestCaseType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class AddTestCasesFormSubscriber implements EventSubscriberInterface
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
        $cs = $event->getData();
        $form = $event->getForm();

        if ($cs['nTestCases'] < 1 || $cs['nTestCases'] > 50) {
            return;
        }

        $form->add('testCases', CollectionType::class, [
            'entry_type' => TestCaseType::class,
            'by_reference' => false,
            'allow_add' => true,
            'entry_options'  => [
                'label' => false
            ]
        ]);

        if (!isset($cs['testCases'])) {
            $cs['testCases'] = [];
        }

        for ($i = 0; $i < $cs['nTestCases']; $i++) {
            if (isset($cs['testCases'][$i])) {
                continue;
            }
            $cs['testCases'][] = ['n' => '', 'm' => ''];
        }

        $event->setData($cs);
    }
}

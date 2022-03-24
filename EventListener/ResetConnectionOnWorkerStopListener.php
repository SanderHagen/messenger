<?php

namespace Symfony\Component\Messenger\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Messenger\Event\WorkerStoppedEvent;
use Symfony\Contracts\Service\ResetInterface;

class ResetConnectionOnWorkerStopListener implements EventSubscriberInterface
{
    public function onWorkerStopped(WorkerStoppedEvent $event): void
    {
        foreach($event->getReceivers() as $transportName => $receiver) {
            if ($receiver instanceof ResetInterface) {
                $receiver->reset();
            }
        }
    }

    public static function getSubscribedEvents()
    {
        return [
            WorkerStoppedEvent::class => 'onWorkerStopped',
        ];
    }
}
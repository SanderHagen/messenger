<?php

namespace Symfony\Component\Messenger\EventListener;

use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Messenger\Event\WorkerStoppedEvent;
use Symfony\Component\Messenger\Transport\Receiver\MessageCountAwareInterface;
use Symfony\Contracts\Service\ResetInterface;

class ResetConnectionOnWorkerStopListener implements EventSubscriberInterface
{
    private $logger = null;
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function onWorkerStopped(WorkerStoppedEvent $event): void
    {
        $this->logger?->debug('Reset connection called');
        foreach($event->getReceivers() as $transportName => $receiver) {
            $this->logger?->debug($transportName);
            if ($receiver instanceof ResetInterface) {
                $this->logger?->debug(sprintf('Receiver for %s reset', $transportName));
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
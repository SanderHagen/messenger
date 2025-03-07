<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Messenger\Event;

use Symfony\Component\Messenger\Worker;

/**
 * Dispatched when a worker has been stopped.
 *
 * @author Robin Chalas <robin.chalas@gmail.com>
 */
final class WorkerStoppedEvent
{
    private $worker;
    private $receivers;

    public function __construct(Worker $worker, array $receivers)
    {
        $this->worker = $worker;
        $this->receivers = $receivers;
    }

    public function getWorker(): Worker
    {
        return $this->worker;
    }

    public function getReceivers(): array
    {
        return $this->receivers;
    }
}

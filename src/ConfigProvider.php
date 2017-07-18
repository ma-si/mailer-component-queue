<?php

/**
 * Mailer Queue Component (http://mateuszsitek.com/projects/mailer-component-queue)
 *
 * @copyright Copyright (c) 2017 DIGITAL WOLVES LTD (http://digitalwolves.ltd) All rights reserved.
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */

namespace Aist\Mailer\Component\Queue;

use Aist\Mailer\Component\Queue\Job\SendJob;
use Aist\Mailer\Component\Queue\Job\SendJobFactory;
use SlmQueueDoctrine\Factory\DoctrineQueueFactory;

/**
 * ConfigProvider for Mailer Queue Component
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     *
     * @return array
     */
    public function __invoke()
    {
        return [
            'dependencies' => $this->getDependencies(),
            'slm_queue' => $this->getSlmQueue(),
        ];
    }

    /**
     * Returns the container dependencies
     *
     * @return array
     */
    public function getDependencies()
    {
        return [
            'invokables' => [
            ],
            'factories'  => [
                SendJob::class => SendJobFactory::class,
            ],
        ];
    }

    /**
     * Returns the queue dependencies
     *
     * @return array
     */
    public function getSlmQueue()
    {
        return [
            'queue_manager' => [
                'factories' => [
                    'mail' => DoctrineQueueFactory::class,
                ],
            ],
            'queues' => [
            ],
            'job_manager' => [
                'factories' => [
                    SendJob::class => SendJobFactory::class,
                ],
            ],
        ];
    }
}

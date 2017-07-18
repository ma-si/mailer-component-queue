<?php

/**
 * Mailer Queue Component (http://mateuszsitek.com/projects/mailer-component-queue)
 *
 * @copyright Copyright (c) 2017 DIGITAL WOLVES LTD (http://digitalwolves.ltd) All rights reserved.
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */

namespace Aist\Mailer\Component\Queue\Job;

use Interop\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

/**
 * Class SendJobFactory
 */
class SendJobFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return SendJob
     */
    public function __invoke(ContainerInterface $container)
    {
        $mailer = $container->get('mailer');
        $logger = $container->get(LoggerInterface::class);

        return new SendJob($mailer, $logger);
    }
}

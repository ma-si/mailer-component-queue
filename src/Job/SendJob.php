<?php

/**
 * Mailer Queue Component (http://mateuszsitek.com/projects/mailer-component-queue)
 *
 * @copyright Copyright (c) 2017 DIGITAL WOLVES LTD (http://digitalwolves.ltd) All rights reserved.
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */

namespace Aist\Mailer\Component\Queue\Job;

use Psr\Log\LoggerInterface;
use SlmQueue\Job\AbstractJob;
use Zend\Mail\Transport\TransportInterface;

/**
 * Class SendJob
 */
class SendJob extends AbstractJob
{
    /**
     * @var TransportInterface
     */
    private $mailer;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * SendJob constructor.
     *
     * @param TransportInterface $mailer
     * @param LoggerInterface $logger
     */
    public function __construct(TransportInterface $mailer, LoggerInterface $logger)
    {
        $this->mailer = $mailer;
        $this->logger = $logger;
    }

    /** @inheritdoc */
    public function execute()
    {
        $payload = $this->getContent();

        try {
            $this->mailer->send($payload['message']);

            $this->logger->info(
                self::class,
                [
                    'email' => $payload['email'],
                    'subject' => $payload['subject'],
                ]
            );
            echo 'Subject <info>' .
                $payload['subject'] .
                '</info> email <info>' .
                $payload['email'] .
                '</info>' .
                PHP_EOL;
        } catch (\RuntimeException $e) {
            $this->logger->error(
                self::class,
                [
                    'email' => $payload['email'],
                    'subject' => $payload['subject'],
                    'error' => $e->getMessage(),
                ]
            );
            echo '<error>' . $e->getMessage() . '</error> Subject <info>' .
                $payload['subject'] .
                '</info> email <info>' .
                $payload['email'] .
                '</info>' .
                PHP_EOL;
        }
    }
}

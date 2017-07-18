<?php

/**
 * Mailer Queue Component (http://mateuszsitek.com/projects/mailer-component-queue)
 *
 * @copyright Copyright (c) 2017 DIGITAL WOLVES LTD (http://digitalwolves.ltd) All rights reserved.
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */

namespace Test\Aist\Mailer\Component\Queue\Job;

use Aist\Mailer\Component\Queue\Job\SendJob;
use Aist\Mailer\Component\Queue\Job\SendJobFactory;
use Interop\Container\ContainerInterface;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ProphecyInterface;
use Psr\Log\LoggerInterface;
use Zend\Mail\Transport\TransportInterface;

class SendJobFactoryTest extends TestCase
{
    /**
     * @var ContainerInterface|ProphecyInterface
     */
    private $container;

    /** @inheritdoc */
    public function setUp()
    {
        $this->container = $this->prophesize(ContainerInterface::class);

        $mailer = $this->prophesize(TransportInterface::class);
        $this->container->get('mailer')->willReturn($mailer);

        $logger = $this->prophesize(LoggerInterface::class);
        $this->container->get(LoggerInterface::class)->willReturn($logger);
    }

    public function testCallingFactoryReturnsJobInstance()
    {
        $factory = new SendJobFactory();
        $this->assertInstanceOf(SendJobFactory::class, $factory);

        $class = $factory($this->container->reveal());

        $this->assertInstanceOf(SendJob::class, $class);
    }
}

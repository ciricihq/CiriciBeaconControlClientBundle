<?php

namespace Cirici\JWTClientBundle\Tests\Manager;

use Liip\FunctionalTestBundle\Test\WebTestCase;

class BaseTestCase extends WebTestCase
{
    private $container;

    protected function setUp()
    {
        $kernel = new \AppKernel('test', true);
        $kernel->boot();

        $this->container = $kernel->getContainer();
    }
}

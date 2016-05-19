<?php

namespace Cirici\JWTClientBundle\Tests\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase;

class ApplicationManagerTest extends WebTestCase
{
    public function testGetApplications()
    {
        $client = static::makeClient();
        $applicationManager = $client->getContainer()->get('cirici_beacon_control_client.application_manager');
        $applications = $applicationManager->getApplications();
        $this->assertNotNull($applications);
    }
}

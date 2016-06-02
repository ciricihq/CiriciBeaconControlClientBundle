<?php

namespace Cirici\JWTClientBundle\Tests\Manager;

use Cirici\JWTClientBundle\Tests\BaseTestCase;

class ApplicationManagerTest extends BaseTestCase
{
    public function testGetApplications()
    {
        $client = static::makeClient();
        $applicationManager = $client->getContainer()->get('cirici_beacon_control_client.application_manager');
        $applications = $applicationManager->getApplications();
        $this->assertNotNull($applications);
    }

    public function testPostApplications()
    {
        $client = static::makeClient();
        $applicationManager = $client->getContainer()->get('cirici_beacon_control_client.application_manager');
        $application = $applicationManager->postApplication('delete me - ' . rand(0, 9999));
        $this->assertNotNull($application);
    }
}

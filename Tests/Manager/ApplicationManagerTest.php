<?php

namespace Cirici\BeaconControlClientBundle\Tests\Manager;

use Cirici\BeaconControlClientBundle\Tests\BaseTestSuite;

class ApplicationManagerTest extends BaseTestSuite
{
    public function testGetApplications()
    {
        $applicationManager = $this->client->getContainer()->get('cirici_beacon_control_client.application_manager');
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

<?php

namespace Cirici\BeaconControlClientBundle\Tests\Manager;

use Cirici\BeaconControlClientBundle\Tests\BaseTestSuite;

class ActivityManagerTest extends BaseTestSuite
{
    public function testGetActivitiesByApp()
    {
        $this->mockApiServices();
        $activityManager = $this->client->getContainer()->get('cirici_beacon_control_client.activity_manager');
        $activities = $activityManager->getActivitiesByApplication(1);
        $this->assertNotNull($activities);
    }

    public function testRetrieveActivity()
    {
        $this->mockApiServices();
        $activityManager = $this->client->getContainer()->get('cirici_beacon_control_client.activity_manager');
        $activity = $activityManager->retrieveActivity(1, 1);
        $this->assertNotNull($activity);
        $this->assertInstanceOf('Cirici\BeaconControlClientBundle\Entity\Activity', $activity);
    }
}

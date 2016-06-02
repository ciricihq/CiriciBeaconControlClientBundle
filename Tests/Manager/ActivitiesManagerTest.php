<?php

namespace Cirici\JWTClientBundle\Tests\Manager;

class ActivityManagerTest extends BaseTestCase
{
    public function testGetActivitiesByApp()
    {
        $client = static::makeClient();
        $activityManager = $client->getContainer()->get('cirici_beacon_control_client.activity_manager');
        // $activities = $activityManager->getActivitiesByApplication(1);
        // $this->assertNotNull($activities);
    }
}

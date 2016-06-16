<?php

namespace Cirici\BeaconControlClientBundle\Tests\Manager;

use Liip\FunctionalTestBundle\Test\WebTestCase;

class ActivityManagerTest extends WebTestCase
{
    public function testGetActivitiesByApp()
    {
        $client = static::makeClient();
        $activityManager = $client->getContainer()->get('cirici_beacon_control_client.activity_manager');
        // $activities = $activityManager->getActivitiesByApplication(1);
        // $this->assertNotNull($activities);
    }
}

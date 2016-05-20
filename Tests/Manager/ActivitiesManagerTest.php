<?php

namespace Cirici\JWTClientBundle\Tests\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase;

class ActivityManagerTest extends WebTestCase
{
    public function testGetActivitiesByApp()
    {
        $client = static::makeClient();
        $activityManager = $client->getContainer()->get('cirici_beacon_control_client.activities_manager');
        $activities = $activityManager->getActivitiesByApplication();
        $this->assertNotNull($activities);
    }
}

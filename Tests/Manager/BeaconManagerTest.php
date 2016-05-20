<?php

namespace Cirici\JWTClientBundle\Tests\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase;

class BeaconManagerTest extends WebTestCase
{
    public function testGetBeacons()
    {
        $client = static::makeClient();
        $beaconManager = $client->getContainer()->get('cirici_beacon_control_client.beacon_manager');
        $beacons = $beaconManager->getBeacons();
        $this->assertNotNull($beacons);
    }
}

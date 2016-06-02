<?php

namespace Cirici\JWTClientBundle\Tests\Manager;

class BeaconManagerTest extends BaseTestCase
{
    public function testGetBeacons()
    {
        $client = static::makeClient();
        $beaconManager = $client->getContainer()->get('cirici_beacon_control_client.beacon_manager');
        $beacons = $beaconManager->getBeacons();
        $this->assertNotNull($beacons);
    }
}

<?php

namespace Cirici\BeaconControlClientBundle\Tests\Manager;

use Cirici\BeaconControlClientBundle\Tests\BaseTestSuite;

class BeaconManagerTest extends BaseTestSuite
{
    public function testGetBeacons()
    {
        $this->mockApiServices();
        $beaconManager = $this->client->getContainer()->get('cirici_beacon_control_client.beacon_manager');
        $beacons = $beaconManager->getBeacons();
        $this->assertNotNull($beacons);
    }
}

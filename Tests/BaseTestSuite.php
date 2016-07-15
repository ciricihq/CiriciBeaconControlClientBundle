<?php

namespace Cirici\BeaconControlClientBundle\Tests;

use Liip\FunctionalTestBundle\Test\WebTestCase;

use Cirici\BeaconControlClientBundle\Entity\Activity;

class BaseTestSuite extends WebTestCase
{
    /**
     * @var \Symfony\Bundle\FrameworkBundle\Client $client
     */
    public $client = null;

    public function setUp()
    {
        parent::setUp();

        $this->client = static::createClient();
    }

    public function tearDown()
    {
        $this->unmockServices();
        parent::tearDown();
    }

    public function mockApiServices()
    {
        // Mocking s2s beacon-control api request with timeout error, authentication
        $this->client->getContainer()->mock('cirici_beacon_control_client.authentication_manager', 'Cirici\BeaconControlClientBundle\Manager\AuthenticationManager')
            ->shouldReceive('getAccessToken')
            ->andReturn((object) ['access_token' => '1234'])
        ;

        // Mockgin activity_manager service
        $mockedNewActivity = json_decode('
            {
                "activity": {
                    "id": 16,
                    "name": "Activity3",
                    "scheme": "url",
                    "payload": {
                        "url": "example.com"
                    },
                    "custom_attributes": [],
                    "trigger": {
                        "id": 16,
                        "type": "ZoneTrigger",
                        "event_type": "enter",
                        "dwell_time": 5,
                        "beacon_ids": [],
                        "zone_ids": [1],
                        "test": false
                    }
                }
            }
            ');

        $this->client->getContainer()->mock('cirici_beacon_control_client.activity_manager', 'Cirici\BeaconControlClientBundle\Manager\ActivityManager')
            ->shouldReceive('getActivitiesByApplication')
            ->andReturn([])
            ->shouldReceive('createActivity')
            ->andReturn([])
            ->shouldReceive('retrieveActivity')
            ->andReturn(new Activity($mockedNewActivity->activity))
        ;

        // Mocking s2s beacon-control api request with timeout error, application
        $this->client->getContainer()->mock('cirici_beacon_control_client.application_manager', 'Cirici\BeaconControlClientBundle\Manager\ApplicationManager')
            ->shouldReceive('getApplications')
            ->andReturn([])
            ->shouldReceive('postApplication')
            ->andReturn([])
            ->shouldReceive('getApplicationById')
            ->andReturn([])
        ;

        // Mocking s2s beacon-control api request with timeout error
        $this->client->getContainer()->mock('cirici_beacon_control_client.beacon_manager', 'Cirici\BeaconControlClientBundle\Manager\BeaconManager')
            ->shouldReceive('getBeacons')
            ->andReturn((object) [
                'ranges' => (object) [
                    (object) [
                        'id' => 123,
                        'name' => 'whatever',
                        'location' => (object ) ['lat' => 23, 'lng' => 23]
                    ]
                ]
            ]);
    }

    public function unmockServices()
    {
        if ($this->client->getContainer()) {
            foreach ($this->client->getContainer()->getMockedServices() as $id => $service) {
                $this->client->getContainer()->unmock($id);
            }

            \Mockery::close();

            $this->client = null;
        }
    }
}

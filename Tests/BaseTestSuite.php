<?php

namespace Cirici\BeaconControlClientBundle\Tests;

use Liip\FunctionalTestBundle\Test\WebTestCase;

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
        $this->client->getContainer()->mock('cirici_beacon_control_client.activity_manager', 'Cirici\BeaconControlClientBundle\Manager\ActivityManager')
            ->shouldReceive('getActivitiesByApplication')
            ->andReturn([])
            ->shouldReceive('createActivity')
            ->andReturn([])
            ->shouldReceive('retrieveActivity')
            ->andReturn([])
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

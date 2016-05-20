<?php

namespace Cirici\BeaconControlClientBundle\Manager;

class BeaconManager
{
    private $client;

    private $authManager;

    public function __construct($client, $authManager)
    {
        $this->client = $client;
        $this->authManager = $authManager;
    }

    /**
     * getBeacons
     *
     * @access public
     * @return stdObject
     */
    public function getBeacons()
    {
        $accessToken = $this->authManager->getAccessToken();

        $result = $this->client->get('beacons.json', [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken->access_token
            ]
        ]);
        return json_decode((string) $result->getBody());
    }
}

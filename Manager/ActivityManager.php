<?php

namespace Cirici\BeaconControlClientBundle\Manager;

class ActivityManager
{
    private $client;

    private $authManager;

    public function __construct($client, $authManager)
    {
        $this->client = $client;
        $this->authManager = $authManager;
    }

    /**
     * getActivitiesByApplication
     *
     * @access public
     * @return stdObject
     */
    public function getActivitiesByApplication($appId)
    {
        $accessToken = $this->authManager->getAccessToken();

        $result = $this->client->get('applications/' . $appId . '/activities.json', [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken->access_token
            ]
        ]);
        return json_decode((string) $result->getBody());
    }
}

<?php

namespace Cirici\BeaconControlClientBundle\Manager;

use GuzzleHttp\Exception\RequestException;

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

    /**
     * updateBeaconPosition
     *
     * @param mixed $beaconId
     * @param array $position
     * @access public
     * @return void
     */
    public function updateBeaconPosition($beaconId, array $position)
    {
        $accessToken = $this->authManager->getAccessToken();

        $result = $this->client->put('beacons/' . $beaconId . '.json', [
            'form_params' => [
                'beacon[lat]' => $position['lat'],
                'beacon[lng]' => $position['lng'],
            ],
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken->access_token
            ]
        ]);
        return json_decode((string) $result->getBody());
    }

    /**
     * postBeacon
     *
     * @access public
     * @return stdObject
     */
    public function postBeacon($beacon)
    {
        $accessToken = $this->authManager->getAccessToken();

        try {
            $result = $this->client->post('beacons.json', [
                'form_params' => [
                    'beacon[name]' => $beacon['name'],
                    'beacon[uuid]' => $beacon['uuid'],
                    'beacon[major]' => $beacon['major'],
                    'beacon[minor]' => $beacon['minor'],
                    // 'beacon[lat]' => $beacon['lat'],
                    // 'beacon[lng]' => $beacon['lng'],
                    // 'beacon[floor]' => $beacon['zone_id'],
                ],
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken->access_token
                ]
            ]);
        } catch (RequestException $e) {
            return json_decode((string) $e->getResponse()->getBody());
        }
        return json_decode((string) $result->getBody());
    }

    /**
     * deleteBeacon
     *
     * @param mixed $id
     * @access public
     * @return void
     */
    public function deleteBeacon($id)
    {
        $accessToken = $this->authManager->getAccessToken();

        try {
            $result = $this->client->delete('beacons/' . $id . '.json', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken->access_token
                ]
            ]);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return json_decode((string) $e->getResponse()->getBody());
        }

        return json_decode((string) $result->getBody());
    }

    public function retrieveBeacon($name)
    {
        $accessToken = $this->authManager->getAccessToken();

        $result = $this->client->get('beacons.json?name=' . $name, [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken->access_token
            ]
        ]);
        return json_decode((string) $result->getBody());
    }
}

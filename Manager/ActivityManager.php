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
        $resultArr = json_decode((string) $result->getBody());
        return $resultArr->activities;
    }

    public function createActivity($appId, $activity)
    {
        $accessToken = $this->authManager->getAccessToken();

        $schema = $this->generateSchema($activity);

        try {
            $result = $this->client->post('applications/' . $appId . '/activities.json', [
                'json' => $schema,
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken->access_token
                ]
            ]);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return (json_decode((string) $e->getResponse()->getBody()));
        }

        $resultArr = json_decode((string) $result->getBody());
        return $resultArr->activity;
    }

    public function updateActivity($appId, $activity)
    {
        $accessToken = $this->authManager->getAccessToken();

        $schema = $this->generateSchema($activity);

        try {
            $result = $this->client->put('applications/' . $appId . '/activities/' . $activity['id'] . '.json', [
                'json' => $schema,
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken->access_token
                ]
            ]);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return (json_decode((string) $e->getResponse()->getBody()));
        }

        $resultArr = json_decode((string) $result->getBody());
        return $resultArr;
    }

    public function deleteActivity($appId, $activityId)
    {
        $accessToken = $this->authManager->getAccessToken();

        try {
            $result = $this->client->delete('applications/' . $appId . '/activities/' . $activityId . '.json', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken->access_token
                ]
            ]);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return (json_decode((string) $e->getResponse()->getBody()));
        }

        return $result;
    }

    private function generateSchema($activity)
    {
        return [
            'activity' => [
                'scheme' => 'url',
                'name' => $activity['name'],
                'url' => $activity['url'],
                'trigger_attributes' => [
                    'type' => 'BeaconTrigger',
                    'event_type' => 'enter',
                    'beacon_ids' => isset($activity['beacons']) ? $activity['beacons'] : [],
                    'sources' => '',
                    'add_beacon' => '',
                    'add_zone' => ''
                ]
            ]
        ];
    }
}

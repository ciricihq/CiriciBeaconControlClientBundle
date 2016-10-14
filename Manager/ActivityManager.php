<?php

namespace Cirici\BeaconControlClientBundle\Manager;

use Cirici\BeaconControlClientBundle\Entity\Activity;

class ActivityManager
{
    private $client;

    private $authManager;

    /**
     * __construct
     *
     * @param mixed $client
     * @param mixed $authManager
     * @access public
     * @return void
     */
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

    /**
     * createActivity
     *
     * @param mixed $appId
     * @param mixed $activity
     * @access public
     * @return void
     */
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
            $result = $this->client->put('applications/' . $appId . '/activities/' . $activity->getId() . '.json', [
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

    public function retrieveActivity($appId, $activityId)
    {
        $activities = $this->getActivitiesByApplication($appId);

        foreach ($activities as $activity) {

            if ($activity->id == $activityId) {
                return new Activity($activity);
            }
        }

        return;
    }

    private function generateSchema(Activity $activity)
    {
        switch ($activity->getScheme()) {
            case 'url':
                return [
                    'activity' => [
                        'scheme' => $activity->getScheme(),
                        'name' => $activity->getName(),
                        'url' => $activity->getUrl(),
                        'trigger_attributes' => [
                            'type' => 'BeaconTrigger',
                            'event_type' => 'enter',
                            'beacon_ids' => $activity->getBeaconsIds(),
                            'sources' => [],
                            'add_beacon' => [],
                            'add_zone' => []
                        ]
                    ]
                ];
            case 'custom':
                return [
                    'activity' => [
                        'scheme' => $activity->getScheme(),
                        'name' => $activity->getName(),
                            'trigger_attributes' => [
                                'type' => 'BeaconTrigger',
                                'event_type' => 'enter',
                                'beacon_ids' => $activity->getBeaconsIds(),
                                'sources' => [],
                                'add_beacon' => [],
                                'add_zone' => []
                            ],
                            'custom_attributes_attributes' => [[
                                'name'=>'text',
                                'value' => 'hola?',
                                'type' => 'PUSH'
                            ]]
                    ]
                ];
        }

    }
}

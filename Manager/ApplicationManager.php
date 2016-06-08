<?php

namespace Cirici\BeaconControlClientBundle\Manager;

class ApplicationManager
{
    private $client;

    private $authManager;

    public function __construct($client, $authManager)
    {
        $this->client = $client;
        $this->authManager = $authManager;
    }

    /**
     * getApplications
     *
     * @access public
     * @return stdObject
     */
    public function getApplications()
    {
        $accessToken = $this->authManager->getAccessToken();

        $result = $this->client->get('applications.json', [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken->access_token
            ]
        ]);
        $collection = json_decode((string) $result->getBody());
        return $collection->applications;
    }

    /**
     * purgueAll
     *
     * @access public
     * @return void
     */
    public function purgueAll()
    {
        $applications = $this->getApplications();

        foreach ($applications->applications as $app) {
            $this->deleteApplication($app->id);
        }
    }

    /**
     * deleteApplication
     *
     * @param mixed $id
     * @access public
     * @return void
     */
    public function deleteApplication($id)
    {
        $accessToken = $this->authManager->getAccessToken();

        try {
            $result = $this->client->delete('applications/' . $id . '.json', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken->access_token
                ]
            ]);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return $e->getMessage();
        }

        return json_decode((string) $result->getBody());
    }

    /**
     * getApplicationById
     *
     * @param mixed $id
     * @access public
     * @return stdObject
     */
    public function getApplicationById($id)
    {
        $applications = $this->getApplications();
        foreach ($applications as $app) {
            if ($app->id === $id) {
                return $app;
            }
        }

        return;
    }

    /**
     * postApplication
     *
     * @access public
     * @return stdObject
     */
    public function postApplication($name)
    {
        $accessToken = $this->authManager->getAccessToken();

        $result = $this->client->post('applications.json', [
            'form_params' => [
                'application[name]' => $name
            ],
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken->access_token
            ]
        ]);
        return json_decode((string) $result->getBody());
    }
}

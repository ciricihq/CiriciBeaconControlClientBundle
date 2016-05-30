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
        $accessToken = $this->authManager->getAccessToken();

        $result = $this->client->get('applications/' . $id . '.json', [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken->access_token
            ]
        ]);
        return json_decode((string) $result->getBody());
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

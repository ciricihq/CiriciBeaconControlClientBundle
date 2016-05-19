<?php

namespace Cirici\BeaconControlClientBundle\Manager;

class ApplicationManager
{
    private $client;
    private $clientId;
    private $clientSecret;
    private $adminEmail;
    private $adminPassword;

    public function __construct($client, $clientId, $clientSecret, $adminEmail, $adminPassword)
    {
        $this->client = $client;
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->adminEmail = $adminEmail;
        $this->adminPassword = $adminPassword;
    }

    /**
     * getApplications
     *
     * @access public
     * @return string (json)
     */
    public function getApplications()
    {
        $accessToken = $this->getAccessToken();

        $result = $this->client->get('applications.json', [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken->access_token
            ]
        ]);
        return json_decode((string) $result->getBody());
    }

    /**
     * getAccessToken
     *
     * @access public
     * @return string
     */
    public function getAccessToken()
    {
        $result = $this->client->post('oauth/token', [
            'form_params' => [
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret,
                'grant_type' => 'password',
                'email' => $this->adminEmail,
                'password' => $this->adminPassword,
            ]
        ]);

        return json_decode((string) $result->getBody());
    }
}

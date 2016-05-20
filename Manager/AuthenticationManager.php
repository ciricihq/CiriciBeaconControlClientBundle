<?php

namespace Cirici\BeaconControlClientBundle\Manager;

class AuthenticationManager
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
     * getAccessToken
     *
     * @access public
     * @return stdObject
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

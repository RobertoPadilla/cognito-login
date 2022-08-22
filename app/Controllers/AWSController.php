<?php

namespace App\Controllers;

use Kodus\Logging\ChromeLogger;
use App\Controllers\BaseController;
use Aws\CognitoIdentityProvider\CognitoIdentityProviderClient;

class AWSController extends BaseController
{
    public $config;
    public $client;

    public function __construct()
    {
        $this->config = config('AWS');
        $this->client = new CognitoIdentityProviderClient([
            'region' => 'us-east-1',
            'version' => 'latest',
            'credentials' => [
                'key' => $this->config->credentials['access_key_id'],
                'secret' => $this->config->credentials['secret_access_key']
            ]
        ]);
    }

    public function registrate($nickname, $password)
    {
        $this->client->adminCreateUser([
            'UserPoolId' => 'us-east-1_eqkRP9Uyb', // REQUIRED
            'Username' => $nickname, // REQUIRED
        ]);
        $this->client->adminSetUserPassword([
            'Password' => $password, // REQUIRED
            'Permanent' => true,
            'UserPoolId' => 'us-east-1_eqkRP9Uyb', // REQUIRED
            'Username' => $nickname, // REQUIRED
        ]);
    }

    public function authenticate($nickname, $password) {
        $result = $this->client->adminInitiateAuth([
            'AuthFlow' => 'ADMIN_USER_PASSWORD_AUTH', // REQUIRED
            'AuthParameters' => [ // REQUIRED
                'USERNAME' => $nickname,
                'PASSWORD' => $password,
            ],
            'ClientId' => '3vkb6j7ohukcaqd6m38dud50oh', // REQUIRED
            'UserPoolId' => 'us-east-1_eqkRP9Uyb', // REQUIRED
        ]);

        return $result;
    }

    public function deleteUsers()
    {
        $result = $this->client->listUsers([
            'UserPoolId' => 'us-east-1_eqkRP9Uyb', // REQUIRED
        ]);
        for ($i = 0; $i < count($result['Users']); $i++) {
            $this->client->adminDeleteUser([
                'UserPoolId' => 'us-east-1_eqkRP9Uyb', // REQUIRED
                'Username' => $result['Users'][$i]['Username'], // REQUIRED
            ]);
        }
    }
}

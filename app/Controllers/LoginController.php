<?php

namespace App\Controllers;

use ChromePhp;
use App\Models\User;

class LoginController extends BaseController
{
    public function index()
    {
        return view('login');
    }

    public function login()
    {
        $postParams = $this->request->getPost();
        $userModel = new User();

        $user = $userModel->getByNickname($postParams['user']);
        
        if (is_null($user)) {
            throw new \Exception('User not found');
        }

        if (!password_verify($postParams['password'], $user->password) ) {
            throw new \Exception('Password is incorrect');
        }
        
        $aws = new \App\Controllers\AWSController();
        $results = $aws->authenticate($postParams['user'], $postParams['password']);

        if ($results['@metadata']['statusCode'] != 200) {
            throw new \Exception('Cognito authentication failed');
        }

        $session = session();
        $session->set([
            'user_id' => $user->id,
            'nickname' => $user->nickname,
            'logged_in' => true,
            'token' => $results['AuthenticationResult']['AccessToken'],
            'id_token' => $results['AuthenticationResult']['IdToken'],
        ]);

        return redirect()->to('/gallery');
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
}

<?php

namespace App\Controllers;

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

        if (!password_verify($postParams['password'], $user->password)) {
            throw new \Exception('Password is incorrect');
        }

        $session = session();
        $session->set([
            'user_id' => $user->id,
            'logged_in' => true
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

<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class Login extends BaseController
{
    public function index()
    {
        return view('login');
    }

    public function authenticate()
    {
        try {
            $userModel = new UserModel();
            $session = session();

            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            $user = $userModel->where('username', $username)->first();

            if ($user && password_verify($password, $user['password'])) {
                $sessionData = [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'isLoggedIn' => true,
                ];
                $session->set($sessionData);

                if ($this->request->isAJAX()) {
                    return $this->respond(['status' => 200, 'message' => 'Login successful', 'data' => $sessionData]);
                }

                return redirect()->to('/login/success');
            } else {
                $error = 'Invalid Username or Password';
                if ($this->request->isAJAX()) {
                    return $this->failUnauthorized($error);
                }
                $session->setFlashdata('error', $error);
                return redirect()->back()->withInput();
            }
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            return $this->failServerError('An error occurred');
        }
    }

    public function success()
    {
        return view('login_success');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}

<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\HTTP\Response;

class Register extends BaseController
{
    public function index()
    {
        return view('register');
    }
    public function save()
    {
        $userModel = new UserModel();
    
        // Check if the request is JSON
        if ($this->request->getHeaderLine('Content-Type') === 'application/json') {
            $data = $this->request->getJSON(true);
        } else {
            $data = $this->request->getPost();
        }
    
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
    
        if ($userModel->insert($data)) {
            if ($this->request->isAJAX() || $this->request->getHeaderLine('Content-Type') === 'application/json') {
                return $this->respondCreated(['status' => 201, 'message' => 'User registered successfully']);
            }
            return redirect()->to('/register/success');
        } else {
            $errors = $userModel->errors();
            if ($this->request->isAJAX() || $this->request->getHeaderLine('Content-Type') === 'application/json') {
                return $this->failValidationErrors($errors);
            }
            return redirect()->back()->withInput()->with('errors', $errors);
        }
    }

    protected function respondCreated($data = null)
    {
        return $this->response->setStatusCode(Response::HTTP_CREATED)->setJSON($data);
    }

    public function success()
    {
        return view('register_success');
    }
}

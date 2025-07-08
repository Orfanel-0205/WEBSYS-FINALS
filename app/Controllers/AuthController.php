<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;
use Config\Auth;

class AuthController extends Controller
{
    protected $auth;
    protected $userModel;

    public function __construct()
    {
        $this->auth = new Auth();
        $this->userModel = new UserModel();
        helper(['form', 'url', 'security']);
    }

    public function login()
    {
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'email' => 'required|valid_email',
                'password' => 'required|min_length[8]',
            ];

            if ($this->validate($rules)) {
                $email = $this->request->getPost('email');
                $password = $this->request->getPost('password');
                $user = $this->userModel->where('email', $email)->first();

                if ($user && password_verify($password, $user['password'])) {
                    $session = session();
                    $session->set([
                        'user_id' => $user['id'],
                        'role' => $user['role'],
                        'is_logged_in' => true
                    ]);
                    return redirect()->to($this->auth->afterLoginRoute);
                } else {
                    return redirect()->back()->with('error', 'Invalid credentials');
                }
            } else {
                return redirect()->back()->with('errors', $this->validator->getErrors());
            }
        }

        return view('auth/login');
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to($this->auth->loginRoute);
    }
}

<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        if (session()->get('user_id')) {
            return redirect()->to('/tasks');
        }

        return view('auth/login', ['pageTitle' => 'Sign in']);
    }

    public function authenticate()
    {
        $data = [
            'email' => trim((string) $this->request->getPost('email')),
            'password' => (string) $this->request->getPost('password'),
        ];
        $rules = ['email' => 'required|valid_email', 'password' => 'required'];
        if (! $this->validateData($data, $rules)) {
            return redirect()->to('/login')->withInput()->with('errors', $this->validator->getErrors());
        }

        $user = (new UserModel())->where('email', $data['email'])->first();
        if (! $user || ! is_string($user['password']) || ! password_verify($data['password'], $user['password'])) {
            return redirect()->to('/login')->withInput()->with('error', 'That email and password do not match.');
        }

        session()->regenerate();
        session()->set(['user_id' => (int) $user['id'], 'user_name' => $user['full_name']]);
        return redirect()->to('/tasks')->with('success', 'Welcome back, ' . $user['full_name'] . '.');
    }

    public function logout()
    {
        session()->remove(['user_id', 'user_name']);
        session()->regenerate();
        return redirect()->to('/')->with('success', 'You have signed out.');
    }
}

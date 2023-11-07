<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\I18n\Time;

class Auth extends BaseController
{

    public function indexregister()
    {
        helper(['form']);
        $data = [];

        return view('auth/register', $data);
    }

    public function saveRegister()
    {
        helper(['form']);
        //set rules validation form
        $rules = [
            'username'      => 'required|min_length[3]|max_length[20]',
            'email'      => 'required|min_length[6]|max_length[50]|valid_email|is_unique[user.email]',
            'password'      => 'required|min_length[6]|max_length[200]',
            'pass_confirm'      => 'matches[password]'
        ];
        // dd($rules);
        // $validation = \Config\Services::validation();
        if ($this->validate($rules)) {
            $model = new UserModel();
            $data = [
                'username'     => $this->request->getVar('username'),
                'email'     => $this->request->getVar('email'),
                'password'     => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),

            ];
            $model->save($data);
            return redirect()->to('/login');
        } else {
            $data['validation'] = $this->validator;
            echo view('auth/register', $data);
        }
    }

    public function indexlogin()
    {
        helper(['form']);
        echo view('auth/login');
    }

    public function auth()
    {
        $session = session();
        $model = new UserModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $data = $model->where('email', $email)->orWhere('username', $email)->first();

        if ($data) {
            $pass = $data['password'];
            $verify_pass = password_verify($password, $pass);
            if ($verify_pass) {
                $ses_data = [
                    'user_id'   => $data['user_id'],
                    'username'   => $data['username'],
                    'email'   => $data['email'],
                    'logged_in'   => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('/');
            } else {
                $session->setFlashdata('msg', 'Email atau Username Tidak Ada');
                return redirect()->to('/login')->withInput();
            }
        } else {
            $session->setFlashdata('msg', 'Email atau Username Tidak Ada');
            return redirect()->to('/login')->withInput();
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}

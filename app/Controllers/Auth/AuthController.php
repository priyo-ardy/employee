<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Auth\AuthModel;
use Config\Database;
use Config\Services;

class AuthController extends BaseController
{
    protected $authModel;
    protected $db;

    public function __construct()
    {
        $this->authModel = new AuthModel();
        $this->db = Database::connect();
    }


    public function index()
    {
        return view('Auth/index.php');
    }

    public function processLogin()
    {
        if ($this->request->getMethod() !== 'POST') {
            if ($this->request->isAJAX()) {
                log_message('security', "Request method not allowed for " . current_url() . " from " . $this->request->getIPAddress());
                return pesan(ResponseInterface::HTTP_METHOD_NOT_ALLOWED, "Method not allowed");
            }

            return view('errors/html/error_405');
        }

        try {
            $rules = [
                'email' => [
                    'label' => "Email address",
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => 'Email address is required.',
                        'valid_email' => 'Email address is invalid.'
                    ]
                ],
                'password' => [
                    'label' => "Password",
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Password is required.'
                    ]
                ]
            ];

            validasi_form($rules);

            $email = $this->request->getPost('email');
            $email_hash = email_hash($email);
            $password = $this->request->getPost('password');
            $attempt = 1;

            $get_user_data = $this->authModel->getUserData($email_hash);
            if (!$get_user_data) {
                log_message('error', 'User not found. : ' . $email_hash);
                return pesan(ResponseInterface::HTTP_BAD_REQUEST, "Incorrect username or password");
            }

            if ($get_user_data->user_status == 0) {
                log_message('error', 'Account is not active.' . $email_hash);
                return pesan(ResponseInterface::HTTP_BAD_REQUEST, "Your account is not active.");
            }

            if ($get_user_data->login_attempt >= 3) {
                log_message('error', 'Account is locked.' . $email_hash);
                return pesan(ResponseInterface::HTTP_BAD_REQUEST, "Failed to processing your request, your account is locked, contact your administrator to unlock your account.");
            }

            $verify = password_verify($password, $get_user_data->user_password);
            if (!$verify) {
                log_message('error', 'Incorrect username or password.' . $email_hash);

                $attempt = $get_user_data->login_attempt + 1;
                $update = $this->authModel->update($get_user_data->user_id, ['login_attempt' => $attempt]);
                if (!$update) {
                    log_message('error', 'Failed to update login attempt. ' . $attempt . ' ' . $email_hash);
                    return;
                }

                return pesan(ResponseInterface::HTTP_BAD_REQUEST, "Incorrect username or password.");
            }

            $session_data = [
                'logged' => true,
                'user_id' => enkripsi($get_user_data->user_id),
                'user_name' => enkripsi($get_user_data->user_name),
                'full_name' => enkripsi($get_user_data->full_name),
                'user_level' => enkripsi($get_user_data->user_level)
            ];

            $this->authModel->update($get_user_data->user_id, ['last_login' => date('Y-m-d H:i:s'), 'login_from' => $this->request->getIPAddress(), 'login_attempt' => 0]);
            session()->set($session_data);

            return pesan(ResponseInterface::HTTP_OK, "Login success.");
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());

            return pesan(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR, "Unexpected error occured : " . $e->getMessage());
        }
    }

    function forgotPassword()
    {
        return view('Auth/forgot');
    }

    function logOut(){
        session()->destroy();
        return redirect()->to(base_url());
    }
}

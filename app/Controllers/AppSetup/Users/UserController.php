<?php

namespace App\Controllers\AppSetup\Users;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Auth\AuthModel;
use App\Models\DataTableModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\Pager\Exceptions\PagerException;
use Config\Database;
use Config\Services;

class UserController extends BaseController
{
    protected $userModel;
    protected $module;
    protected $dataTable;
    protected $db;

    public function __construct()
    {
        $this->userModel = new AuthModel();
        $this->module = "User Management";
        $this->db = Database::connect();

        $table = 'm_user_auth';
        $column_order = [];
        $column_search = [];
        $order = array('user_name' => 'asc');

        $this->dataTable = new DataTableModel(Services::request(), $table, $column_order, $column_search, $order);
    }

    function loadTable()
    {
        $lists = $this->dataTable->get_datatables();
        $data = [];

        foreach ($lists as $item) {
            $row = [];

            $row[] = enkripsi($item->user_id);
            $row[] = '
                        <a href="' . base_url() . 'users/show/' . enkripsi($item->user_id) . '" class="text-primary-emphasis fw-bolder" title="Click to edit">' . $item->user_name . '</a>
                    ';
            $row[] = $item->full_name;
            $row[] = (isset($item->user_email) && $item->user_email !== null) ? dekripsi($item->user_email) : '-';
            $row[] = (isset($item->user_phone) && $item->user_phone !== null) ? dekripsi($item->user_phone) : '-';
            $row[] = $item->user_status;
            $row[] = $item->user_level;
            $row[] = $item->remark;
            $row[] = $item->last_login;
            $row[] = $item->login_from;
            $row[] = '
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-primary rounded-0 btn-xs" title="Reset Password"><i class="fa-solid fa-key"></i></button>
                    </div>
                ';

            $data[] = $row;
        }

        $response = [
            "draw" => intval($this->request->getPost('draw')),
            "recordsTotal" => $this->dataTable->count_all(),
            "recordsFiltered" => $this->dataTable->count_filtered(),
            "data" => $data
        ];

        return $this->response->setJSON($response);
    }

    public function index()
    {
        $data = [
            'title' => "User Management",
            'footer' => [
                '<script src="' . base_url() . 'js/AppSetup/Users/users.js' . '"></script>'
            ]
        ];

        return view('AppSetup/Users/index', $data);
    }

    public function addUser()
    {
        $data = [
            'title' => "Add New User",
            'karyawan' => $this->userModel->getUserListForRegister(),
            'footer' => [
                '<script src="' . base_url() . 'js/AppSetup/Users/add.js' . '"></script>'
            ]
        ];

        return view('AppSetup/Users/add', $data);
    }

    function getUserByNik($NIK)
    {
        if ($this->request->getMethod() !== 'GET') {
            if ($this->request->isAjax()) {
                return pesan(ResponseInterface::HTTP_METHOD_NOT_ALLOWED, "Method not allowed");
            }

            return view('errors/html/error_405');
        }

        try {
            $getData = $this->userModel->getUserByNik(base64_decode($NIK));
            if (!$getData) {
                return pesan(ResponseInterface::HTTP_NOT_FOUND, "Data not found");
            }

            return pesan(ResponseInterface::HTTP_OK, "Data found", $getData);
        } catch (\Exception $e) {
            logFile(
                'error',
                "Unexpected error",
                [
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'trace' => $e->getTraceAsString(),
                    'NIK' => dekripsi(session()->get('user_name'))
                ],
                'UsersController::getUserByNik'
            );
            return pesan(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
        }
    }

    function saveUser()
    {

        if ($this->request->getMethod() !== 'POST') {
            if ($this->request->isAJAX()) {
                return pesan(ResponseInterface::HTTP_METHOD_NOT_ALLOWED, 'Request method not allowed');
            }

            return view('errors/html/error_405');
        }

        try {
            $rules = [
                'data_username' => [
                    'label' => "Username",
                    'rules' => 'trim|required|is_unique[m_user_auth.user_name]',
                    'errors' => [
                        'required' => '{field} is required.',
                    ]
                ],
                'data_fullname' => [
                    'label' => "Full Name",
                    'rules' => 'trim|required|min_length[3]|max_length[150]',
                    'errors' => [
                        'required' => '{field} is required.',
                        'min_length' => '{field} must be at least {param} characters in length.',
                        'max_length' => '{field} cannot exceed {param} characters in length.',
                    ]
                ],
                'data_email' => [
                    'label' => "Email Address",
                    'rules' => 'trim|required|valid_email|max_length[100]',
                    'errors' => [
                        'required' => '{field} is required.',
                        'valid_email' => '{field} is invalid.',
                        'max_length' => '{field} cannot exceed {param} characters in length.',
                    ]
                ],
                'data_phone' => [
                    'label' => "Phone Number",
                    'rules' => 'trim|required|numeric|max_length[20]',
                    'errors' => [
                        'required' => '{field} is required.',
                        'numeric' => '{field} is invalid.',
                        'max_length' => '{field} cannot exceed {param} characters in length.',
                    ]
                ],
                'data_level' => [
                    'label' => "User Level",
                    'rules' => 'trim|required',
                    'errors' => [
                        'required' => '{field} is required.',
                    ]
                ],
                'data_password' => [
                    'label' => "Password",
                    'rules' => 'trim|required|min_length[8]|max_length[20]',
                    'errors' => [
                        'required' => '{field} is required.',
                        'min_length' => '{field} must be at least {param} characters in length.',
                        'max_length' => '{field} cannot exceed {param} characters in length.',
                    ]
                ]
            ];

            validasi_form($rules);

            $email_hash = email_hash(trim($this->request->getPost('data_email')));
            $phone_hash = phone_hash(trim($this->request->getPost('data_phone')));

            $check_phone = $this->userModel->getUserByPhone($phone_hash);
            if ($check_phone) {
                return pesan(ResponseInterface::HTTP_BAD_REQUEST, "Phone number already registered");
            }

            $chek_email = $this->userModel->getUserByEmail($email_hash);
            if ($chek_email) {
                return pesan(ResponseInterface::HTTP_BAD_REQUEST, "Email address already registered");
            }

            $data = [
                'user_id' => generate_uuid(),
                'user_name' => trim($this->request->getPost('data_username')),
                'full_name' => ucwords(trim($this->request->getPost('data_fullname'))),
                'user_email' => enkripsi(trim($this->request->getPost('data_email'))),
                'email_hash' => email_hash(trim($this->request->getPost('data_email'))),
                'user_phone' => enkripsi(trim($this->request->getPost('data_phone'))),
                'phone_hash' => phone_hash(trim($this->request->getPost('data_phone'))),
                'user_password' => password_hash(trim($this->request->getPost('data_password')), PASSWORD_DEFAULT),
                'user_photo' => 'default.png',
                'login_attempt' => 0,
                'user_status' => 1,
                'user_level' => trim($this->request->getPost('data_level')),
                'remark' => trim($this->request->getPost('data_remark')),
            ];

            $this->db->transStart();
            $this->userModel->insert($data);
            $this->db->transComplete();

            if ($this->db->transStatus() === false) {
                $this->db->transRollback();

                logFile(
                    'error',
                    'Failed to save a new user data',
                    [
                        'message' => $this->db->error()['message'],
                        'NIK' => dekripsi(session()->get('user_name'))
                    ],
                    'UsersController::addUser'
                );

                return pesan(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR, 'Failed to save a new user data');
            }

            logFile(
                'audit',
                'Successfully created a new user data',
                [
                    'user_id' => $data['user_id'],
                    'NIK' => dekripsi(session()->get('user_name'))
                ],
                'UsersController::addUser'
            );

            return pesan(ResponseInterface::HTTP_OK, 'Successfully created a new user data');
        } catch (\Exception $e) {
            logFile(
                'error',
                "Unexpected error",
                [
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'trace' => $e->getTraceAsString(),
                    'NIK' => dekripsi(session()->get('user_name'))
                ],
                'UsersController::addUser'
            );

            return pesan(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
        }
    }

    function showData($token)
    {
        $user_id = dekripsi($token);

        try {
            $getData = $this->userModel->getUserById($user_id);
            if (!$getData) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("User data not found");
            }

            $data = [
                'title' => "User Details",
                'footer' => [
                    '<script src="' . base_url() . 'js/AppSetup/Users/show.js' . '"></script>'
                ]
            ];

            return view('AppSetup/Users/show', $data);
        } catch (\Exception $e) {
            // Handle exception
            logFile(
                'error',
                'Unexpected error in showData: ' . $e->getMessage(),
                [
                    'user_id' => $user_id,
                    'trace' => $e->getTraceAsString()
                ],
                'UsersController::showData'
            );


            return view('errors/html/error_exceptions', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTrace()
            ]);
        }
    }
}

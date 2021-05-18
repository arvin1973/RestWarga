<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class User extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'user');
    }
    public function index_get()
    {
        $id = $this->get('id');
        if ($id === null) {
            $user = $this->user->getUser();
        } else {
            $user = $this->user->getUser($id);
        }


        if ($user) {
            $this->response([
                'status' => true,
                'user' => $user
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'user' => 'id tidak ada'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_post()
    {
        $data = [
            'username' => $this->post('username'),
            'image' => 'default.jpg',
            'password' => $this->post('password'),
            'role_id' => '2'
        ];

        if ($this->user->createUser($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'Data berhasil ditambahkan'
            ], REST_Controller::HTTP_CREATED);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Gagal Menambahkan'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
}

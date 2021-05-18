<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Warga extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Warga_model', 'warga');
    }
    public function index_get()
    {
        $id = $this->get('id');
        if ($id === null) {
            $warga = $this->warga->getWarga();
        } else {
            $warga = $this->warga->getWarga($id);
        }


        if ($warga) {
            $this->response([
                'status' => true,
                'warga' => $warga
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'id tidak ada'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_post()
    {
        $data = [
            'nama' => $this->post('nama'),
            'no_rumah' => $this->post('no_rumah'),
            'no_telepon' => $this->post('no_telepon'),
            'umur' => $this->post('umur'),
            'status' => '1'
        ];

        if ($this->warga->createWarga($data) > 0) {
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

    public function index_put()
    {
        $id = $this->put('id');
        $data = [
            'nama' => $this->put('nama'),
            'no_rumah' => $this->put('no_rumah'),
            'no_telepon' => $this->put('no_telepon'),
            'umur' => $this->put('umur')
        ];

        if ($this->warga->updateWarga($data, $id) > 0) {
            $this->response([
                'status' => true,
                'message' => 'Berhasil'
            ], REST_Controller::HTTP_ACCEPTED);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Gagal Mengubah'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function index_delete()
    {
        $id = $this->delete('id');

        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => 'Id tidak ada'
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            if ($this->warga->deleteWarga($id) > 0) {
                $this->response([
                    'status' => true,
                    'message' => 'Data Sudah Terhapus'
                ], REST_Controller::HTTP_ACCEPTED);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Id tidak ada'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }
}

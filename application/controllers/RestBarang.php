<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

require APPPATH . '/libraries/Format.php';
require APPPATH . '/libraries/RestController.php';

class RestBarang extends RestController{
    
    public function __construct(){
        parent::__construct();
        $this->load->model('M_barang', 'brg');
    }
    
    public function index_get(){

        $id = $this->get('id');
        if($id === null){
            $data = $this->brg->getBarang(null);
        } else {
            $data = $this->brg->getBarang($id);
        }
        if($data){
            $this->response( [
                'status' => true,
                'message' => 'Rest complete get Barang!',
                'data' => $data
            ], RestController::HTTP_OK );
        } else {
            $this->response([
                'status' => false,
                'message' => 'Rest failed to get Barang'
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function index_post(){
        $data = [
            'id_barang' => $this->post('id_barang'),
            'id_kategori' => $this->post('id_kategori'),
            'nama_barang' => $this->post('nama_barang'),
            'harga_barang' => $this->post('harga_barang'),
            'stok_barang' => $this->post('stok_barang')
        ];

        if($this->brg->insertBarang($data) > 0){
            $this->response([
                'status' => true,
                'message' => 'Rest success to add barang'
            ], RestController::HTTP_CREATED);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Rest failed to add barang'
            ], RestController::HTTP_NOT_MODIFIED);
        }
    }

    public function index_put($id){
        if($id === null){
            $this->response([
                'status' => false,
                'message' => 'Rest failed to recognize id, please fill it'
            ], RestController::HTTP_NOT_MODIFIED);
        } else {
            $data = [
                'id_kategori' => $this->put('id_kategori'),
                'nama_barang' => $this->put('nama_barang'),
                'harga_barang' => $this->put('harga_barang')
            ];

            if($this->brg->updateBarang($data, $id) > 0){
                $this->response([
                    'status' => true,
                    'message' => 'Rest success to update Barang'
                ], RestController::HTTP_OK);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Rest failed to update Barang'
                ], RestController::HTTP_NOT_MODIFIED);
            }
        }
    }

    public function index_delete($id){
        //$id = $this->delete('id');
        if($id === null){
            $this->response([
                'status' => false,
                'message' => 'Rest failed to recognize id, please fill it'
            ], RestController::HTTP_NOT_MODIFIED);
        } else {
            if($this->brg->deleteBarang($id) > 0){
                $this->response([
                    'status' => true,
                    'message' => 'Rest success to delete'
                ], RestController::HTTP_OK);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Rest failed to delete'
                ], RestController::HTTP_NOT_MODIFIED);
            }
        }
    }

    public function kategori_get(){

        $data = $this->brg->getKategori(null);
        if($data){
            $this->response( [
                'status' => true,
                'message' => 'Rest complete get Kategori!',
                'data' => $data
            ], RestController::HTTP_OK );
        } else {
            $this->response([
                'status' => false,
                'message' => 'Rest failed to get Kategori'
            ], RestController::HTTP_NOT_FOUND);
        }
    }
}
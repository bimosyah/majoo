<?php


defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Product extends REST_Controller
{
    const TABLE = "tbl_produk";

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    public function index_post()
    {
        $nama = $this->post('nama');
        $deskripsi = $this->post('deskripsi');
        $id_kategori = $this->post('id_kategori');
        $harga = $this->post('harga');
        $image = $this->post('image');

        if ($nama == "" || $deskripsi == "" || $id_kategori == "" || $harga == ""){
            $this->response(array("status_code"=>502, "msg" => "field must be not empty"),502);
        }else{
            $this->db->where('nama',$nama);
            $unique_name = $this->db->get(self::TABLE)->num_rows();
            if ($unique_name > 0){
                $this->response(array("status_code"=>502, "msg" => "nama have registered, change other name"),502);
            }else{
                $upload = self::upload_helper();
                if ($upload['status']){
                    $data = array(
                        'nama' => $nama,
                        'deskripsi' => $deskripsi,
                        'id_kategori' => $id_kategori,
                        'harga' => $harga,
                        'image' => $upload['msg'],
                        'is_deleted' => "0"
                    );
                    $insert = $this->db->insert(self::TABLE,$data);
                    if ($insert){
                        $this->response(array("status_code"=>201, "data" => $data),201);
                    }else{
                        $this->response(array("status_code"=>502, "msg" => "fail"),502);
                    }
                }else{
                    $this->response(array("status_code"=>502, "msg" => $upload['msg']),502);
                }
            }
        }
    }

    public function index_get(){
        $id = $this->uri->segment(4);
        if ($id == ""){
            $this->db->where("is_deleted",0);
            $data = $this->db->get(self::TABLE)->result();
            $this->response(array("status_code" => 200, "data" => $data),200);
        }else{
            $this->db->where('id',$id);
            $this->db->where("is_deleted",0);
            $data = $this->db->get(self::TABLE)->result();
            if ($data){
                $this->response(array("status_code" => 200, "data" => $data),200);
            }else{
                $this->response(array("status_code"=>502, "msg" => "id not found"),502);
            }
        }
    }

    function upload_helper()
    {
        $image = time().'-'.$_FILES["image"]['name'];

        $config['upload_path']          = realpath(APPPATH . '../upload');
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 100;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;
        $config['file_name']            = $image;

        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload("image"))
        {
            $error = array('error' => $this->upload->display_errors());
            return array("status" => false, "msg" => $error);
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            return array("status" => true, "msg" => $data['upload_data']['file_name']);
        }
    }
}
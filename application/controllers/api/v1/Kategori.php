<?php


defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Kategori extends REST_Controller
{
    const TABLE = "tbl_kategori";

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    public function index_get()
    {
        $id = $this->uri->segment(4);
        if ($id == ""){
            $this->db->where("is_deleted",0);
            $user = $this->db->get(self::TABLE)->result();
        }else{
            $this->db->where('id',$id);
            $this->db->where("is_deleted",0);
            $user = $this->db->get(self::TABLE)->result();
            if ($user){
                $this->response(array("status_code" => 200, "data" => $user),200);
            }else{
                $this->response(array("status_code"=>502, "msg" => "id not found"),502);
            }
        }
    }

    public function index_post(){
        if ($this->post('nama') == ""){
            $this->response(array("status_code"=>502, "msg" => "nama must filled"),502);
        }else{
            $data = array(
                'nama' => $this->post('nama'),
                'is_deleted' => "0"
            );
            $insert = $this->db->insert(self::TABLE,$data);
            if ($insert){
                $this->response(array("status_code"=>201, "data" => $data),201);
            }else{
                $this->response(array("status_code"=>502, "msg" => "fail"),502);
            }
        }
    }
}
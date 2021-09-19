<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("categories_model",'category');
        $this->load->model("products_model",'product');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['data'] = $this->product->get_list();
        $this->load->view('product_list/index',$data);
    }

    public function master(){
        $this->load->view('product_master/index');
    }

    public function add(){
        $data['category'] = $this->category->get_list();
        $this->load->view('product_master/add',$data);
    }

    public function insert()
    {
        header("Content-Type: application/json");

        $arr = array();
        foreach ($this->input->post() as $key => $value){
            if ($value == ""){
                echo json_encode(array('status' => "0", "msg" => "Cek kembali form input. Semua harus terisi !"));
                die();
            }
            $arr[$key] = $value;
        }

        if (!$this->product->isNameExist($arr['nama'])){
            $upload_file = self::upload_helper();
            if ($upload_file['status']){
                $arr['image'] = $upload_file['msg'];
                $insert = $this->product->insert($arr);
                if ($insert){
                    echo json_encode(array('status' => "1", "msg" => "Tersimpan"));
                }else{
                    echo json_encode(array('status' => "0", "msg" => "Gagal tersimpan"));
                }
            }else{
                echo json_encode(array('status' => "0", "msg" => $upload_file['msg']));
            }
        }else{
            echo json_encode(array('status' => "0", "msg" => "Nama Produk Sudah Terdaftar"));
        }

    }

    function upload_helper()
    {
        if (isset($_FILES["image"]['name'])){
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
        }else{
            return array("status" => false, "msg" => "file not uploaded");
        }

    }

    public function get_list(){
        $list = $this->product->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $product) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $product->nama;
            $row[] = $product->deskripsi;
            $row[] = $product->harga;
            $row[] = $product->kategori;
            $row[] = $product->image;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->product->count_all(),
            "recordsFiltered" => $this->product->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
}

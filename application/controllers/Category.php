<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("categories_model",'category');
    }

    public function delete($id){
        if ($this->category->delete($id)){
            redirect("category/master");
        }
    }

    public function update($id){
        $temp  = $this->category->getById($id);
        $data['nama'] = $temp[0]->nama;
        $this->load->view('category/edit',$data);
    }

    public function saveUpdate($id){
        header("Content-Type: application/json");

        $arr = array();

        foreach ($this->input->post() as $key => $value){
            if ($value == ""){
                echo json_encode(array('status' => "0", "msg" => "Cek kembali form input. Semua harus terisi !"));
                die();
            }
            $arr[$key] = $value;
        }
        $update = $this->category->update($id,$arr);
        if ($update){
            echo json_encode(array('status' => "1", "msg" => "Tersimpan"));
        }else{
            echo json_encode(array('status' => "0", "msg" => "Gagal Tersimpan"));
        }
    }

    public function master(){
        $this->load->view('category/index');
    }

    public function add(){
        $this->load->view('category/add');
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
        $insert = $this->category->insert($arr);
        if ($insert){
            echo json_encode(array('status' => "1", "msg" => "Tersimpan"));
        }else{
            echo json_encode(array('status' => "0", "msg" => "Gagal Tersimpan"));
        }
    }

    public function get_list(){
        $list = $this->category->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $product) {
            $link_delete = site_url("category/master/delete/").$product->id;
            $link_edit = site_url("category/master/update/").$product->id;
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $product->nama;
            $row[] = '
            <a href="'.$link_delete.'" type="button" class="btn btn-danger btn-sm">Delete</a> 
            <a href="'.$link_edit.'" type="button" class="btn btn-warning btn-sm">Edit</a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->category->count_all(),
            "recordsFiltered" => $this->category->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

}

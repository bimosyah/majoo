<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('products_model','product');
    }

    public function index()
    {
        $this->load->view('product_list/index');
    }

    public function master(){
        $this->load->view('product_master/index');
    }

    public function get_list(){
        $list = $this->product->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $product) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $product->nama_produk;
            $row[] = $product->deskripsi;
            $row[] = $product->harga;
            $row[] = $product->nama_kategori;
            $row[] = $product->image;
            $row[] = "";

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

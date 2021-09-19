<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_list(){
        $this->db->where('is_deleted',0);
        return $this->db->get('tbl_kategori')->result();
    }
}
?>
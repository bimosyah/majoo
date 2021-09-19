<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		$this->load->view('login/index');
	}

    public function auth(){
        header("Content-Type: application/json");

        $username = $this->input->post('username');
        $password = $this->input->post('password');
        if ($username == "" || $password == ""){
            echo json_encode(array('status' => "0", "msg" => "Username or Password must Filled !"));
        }else{
            $this->db->where('username',$username);
            $this->db->where('password',md5($password));
            $data = $this->db->get("tbl_user")->result();
            if ($data){
                echo json_encode(array('status' => "1", "msg" => "Welcome.."));
            }else{
                echo json_encode(array('status' => "0", "msg" => "Wrong username or Password !"));
            }
        }
    }
}

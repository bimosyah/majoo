<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		$this->load->view('login/index');
	}

    public function auth(){
        $username = $this->post('username');
        $password = $this->post('password');
        if ($username == "" || $password == ""){
            $this->response(array("status_code"=>502, "msg" => "username or password must filled"),502);
        }else{
            $this->db->where('username',$username);
            $this->db->where('password',md5($password));
            $data = $this->db->get(self::TABLE)->result();
            if ($data){
                $this->response(array("status_code"=>200, "data" => $data),200);
            }else{
                $this->response(array("status_code"=>502, "msg" => "username or password wrong!"),502);
            }
        }
    }
}

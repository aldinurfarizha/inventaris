<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Header('Access-Control-Allow-Origin: *');
class Auth extends CI_Controller  {
    public function index()
    {
        $this->load->view('login');
    }
    public function prosess_login(){
        $username=$this->input->post('username');
        $password=$this->input->post('password');
        $data=array(
            'username'=>$username,
            'password'=>$password,
        );
        $result=$this->Authentication->login($data);
        if($result->num_rows() > 0){
            $row=$result->row();
            $params=array(
                'id_user'=>$row->id_user,
                'username'=>$row->username,
                'nama'=>$row->nama,
            );
            $this->session->set_userdata($params);
            return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(array(
                    'status' => true,
                    'messages' => 'Login Sukses'
            )));
        }else{
            return $this->output
            ->set_content_type('application/json')
            ->set_status_header(500)
            ->set_output(json_encode(array(
                    'status' => False,
                    'messages' => 'Username Atau Password salah !'
            )));
        }
        
    }
    public function logout(){
        $this->session->sess_destroy();
        redirect(base_url());
    }
   
}


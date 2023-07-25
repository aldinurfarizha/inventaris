<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Header('Access-Control-Allow-Origin: *');
class Api extends CI_Controller  {

    public function login(){
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
            return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(array(
                    'status' => true,
                    'messages' => 'Login Sukses',
                    'data'=>$params
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
    public function detailInventaris(){
        $id=$this->input->post('id');
        $data=get_detail_barang($id);
        $history_update=getHistoryUpdate($id)->result();
        if($data==null){
            return $this->output
            ->set_content_type('application/json')
            ->set_status_header(500)
            ->set_output(json_encode(array(
                    'status' => False,
                    'messages' => 'Invalid Id Aset/Tidak ditemukan !'
            )));
        }
        return $this->output
        ->set_content_type('application/json')
        ->set_status_header(200)
        ->set_output(json_encode(array(
                'status' => true,
                'data'=>$data,
                'history_update'=>$history_update
        )));
    }
}


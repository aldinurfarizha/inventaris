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
        $id=filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        if($id==''){
             return $this->output
            ->set_content_type('application/json')
            ->set_status_header(500)
            ->set_output(json_encode(array(
                    'status' => False,
                    'messages' => 'Barcode Tidak Cocok'
            )));
        }
        $data=get_detail_barang($id);
        $history_update=getHistoryUpdate($id)->result();
        if($data==null){
            return $this->output
            ->set_content_type('application/json')
            ->set_status_header(500)
            ->set_output(json_encode(array(
                    'status' => False,
                    'messages' => 'Invalid Id ! Aset Tidak ditemukan.'
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
    public function updateHistoryInventaris(){
        $id_inventaris=$this->input->post('id_inventaris');
        $keterangan=$this->input->post('keterangan');
        $kondisi_baik=$this->input->post('kondisi_baik');
        $user=$this->input->post('user');
        $config["upload_path"]   = TEMP_PATH;
        $config["allowed_types"] = '*';
        $config['encrypt_name'] = TRUE;
        $config['max_size'] = '10000';
        $this->load->library('image_lib');
        $conf_resize['image_library'] = 'gd2';
        $conf_resize['maintain_ratio'] = true;
        $conf_resize['width'] = 480;
        $this->load->library('upload', $config);			
        if ( ! $this->upload->do_upload("foto")) {
            $error = array('error' => $this->upload->display_errors());
            $response=array(
                'message'=>$error
            );
            return $this->output
            ->set_content_type('application/json')
            ->set_status_header(400)
            ->set_output(json_encode($response
            ));
        }else{
            $data_file = array('upload_data' => $this->upload->data());
            $foto_name= $data_file['upload_data']['file_name'];
            $conf_resize['source_image'] = TEMP_PATH.$foto_name;
            $conf_resize['new_image'] = FOTO_HISTORY_BARANG_PATH.$foto_name;
            $this->image_lib->initialize($conf_resize);
            $this->image_lib->resize();
            if ($foto_name && file_exists(TEMP_PATH . $foto_name)) {
                unlink(TEMP_PATH . $foto_name);
            }
            if($kondisi_baik=="BAIK"){
                $kondisi=1;
            }else{
                $kondisi=0;
            }
            $data=array(
                'foto'=>$foto_name,
                'keterangan'=>$keterangan,
                'kondisi_baik'=>$kondisi,
                'id_inventaris'=>$id_inventaris,
                'user'=>$user,
                'date_updated'=>date('Y-m-d h:i:s')
            );
            $inventaris=array(
                'kondisi_baik'=>$kondisi,
                'last_update'=>date('Y-m-d h:i:s')
            );
            $inventaris_where=array(
                'id_inventaris'=>$id_inventaris

            );
            $this->Global_model->update('inventaris',$inventaris_where,$inventaris);
            $this->Global_model->insert('history_update', $data);
            $response=array(
                'message'=>"Berhasil Menambahkan history Update"
            );
            return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode($response
            ));
        }
    }
      public function updateFotoInventaris(){
        $id_inventaris=$this->input->post('id_inventaris');
        $user=$this->input->post('user');
        $config["upload_path"]   = TEMP_PATH;
        $config["allowed_types"] = '*';
        $config['encrypt_name'] = TRUE;
        $config['max_size'] = '10000';
        $this->load->library('image_lib');
        $conf_resize['image_library'] = 'gd2';
        $conf_resize['maintain_ratio'] = true;
        $conf_resize['width'] = 480;
        $this->load->library('upload', $config);			
        if ( ! $this->upload->do_upload("foto")) {
            $error = array('error' => $this->upload->display_errors());
            $response=array(
                'message'=>$error
            );
            return $this->output
            ->set_content_type('application/json')
            ->set_status_header(400)
            ->set_output(json_encode($response
            ));
        }else{
            $data_file = array('upload_data' => $this->upload->data());
            $foto_name= $data_file['upload_data']['file_name'];
            $conf_resize['source_image'] = TEMP_PATH.$foto_name;
            $conf_resize['new_image'] = FOTO_BARANG_PATH.$foto_name;
            $this->image_lib->initialize($conf_resize);
            $this->image_lib->resize();
            if ($foto_name && file_exists(TEMP_PATH . $foto_name)) {
                unlink(TEMP_PATH . $foto_name);
            }
            $data=array(
                'foto_barang'=>$foto_name,
                'admin'=>$user,
                'last_update'=>date('Y-m-d h:i:s')
            );
            $where=array(
                'id_inventaris'=>$id_inventaris
            );
            $this->Global_model->update('inventaris',$where,$data);
            $response=array(
                'message'=>"Berhasil Ubah gambar"
            );
            return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode($response
            ));
        }
    }
    public function dashboard(){
        $data=$this->Global_model->dashboard();
        $datar=array(
            'data'=>$data
        );
           return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode($datar
            ));
    }
}


<?php

class UserM extends CI_Model{

    // response jika field kosong
    public function empty_response() {
        $response['status']=502;
        $response['error']=true;
        $response['message']='Field tidak boleh kosong';
        return $response;
    }

    // fungsi memasukan data ke tbl user
    public function add_user($name, $email, $password) {

        date_default_timezone_set("Asia/Bangkok");
        $date = date("Y-m-d h:i:s");
        // kalau data yg dikirim kosong
        if (empty($name) || empty($email) || empty($password)) {
            return $this->empty_response();
        } else {
            $data = array (
                "name" => $name,
                "email" => $email,
                "password" => $password,
                "created" => $date,
                "updated" => $date
            );

            // query masukin data
            $insert = $this->db->insert("user", $data);

            // kalau berhasil masuk
            if($insert) {
                $response['status'] = 200;
                $response['error'] = false;
                $response['message']='Data User Berhasil Ditambahkan';
                return $response;
            } else {
                $response['status']=502;
                $response['error']=true;
                $response['message']='Data User Gagal Ditambahkan';
                return $response;
            }
        }
    }

    // ambil semua data
    public function get_all_user() {
        $all_user = $this->db->get("user")->result();
        $response['status']=200;
        $response['error']=false;
        $response['user']=$all_user;
        return $response;
    }

    // hapus data user
    public function delete_user() {

        // kalau id nya kosong
        if($id == '') {
            return $this->empty_response();
        } else {
            $where = array(
                "id" => $id
            );

            $this->db->where($where);
            $delete = $this->db->delete("user");

            // kalau berhasil dihapus
            if($delete) {
                $response['status']=200;
                $response['error']=false;
                $response['message']='Data User Berhasil Dihapus';
                return $response;
            } else {
                $response['status']=502;
                $response['error']=true;
                $response['message']='Data User Gagal Dihapus';
                return $response;
            }
        }
    }

    // mengupdate data user
    public function update_user($id,$name, $email, $password) {

        date_default_timezone_set("Asia/Bangkok");
        $date = date("Y-m-d h:i:s");
        // kalau id nya kosong
        if($id == '' || empty($name) || empty($email) || empty($password)) {
            return $this->empty_response();
        } else{
            $where = array(
              "id" => $id
            );

            $set = array(
                "name" => $name,
                "email" => $email,
                "password" => $password,
                "updated" => $date
            );

            $this->db->where($where);
            $update = $this->db->update("user",$set);
            if($update){
              $response['status']=200;
              $response['error']=false;
              $response['message']='Data User Berhasil Diubah';
              return $response;
            }else{
              $response['status']=502;
              $response['error']=true;
              $response['message']='Data User Gagal Diubah';
              return $response;
            }
        }
    }

}

?>
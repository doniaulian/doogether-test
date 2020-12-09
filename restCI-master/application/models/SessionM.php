<?php

class SessionM extends CI_Model{

    // response jika field kosong
    public function empty_response() {
        $response['status']=502;
        $response['error']=true;
        $response['message']='Field tidak boleh kosong';
        return $response;
    }

    // fungsi memasukan data  register ke tbl user
    public function register_user($name, $email, $password) {
        date_default_timezone_set("Asia/Bangkok");
        $date = date("Y-m-d h:i:s");

        // kalau data yg dikirim kosong
        if (empty($name) || empty($email) || empty($password)) {
            return $this->empty_response();
        } else {
            $data = array (
                "name" => $name,
                "email" => $email,
                "password" => md5($password),
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

    // fungsi memasukan data ke tbl session
    public function add_session($name, $description, $start, $duration) {

        date_default_timezone_set("Asia/Bangkok");
        $date = date("Y-m-d h:i:s");
        // kalau data yg dikirim kosong
        if (empty($name) || empty($description) || empty($start)) {
            return $this->empty_response();
        } else {
            $data = array (
                "name" => $name,
                "description" => $description,
                "start" => $start,
                "duration" => $duration,
                "created" => $date,
                "updated" => $date
            );

            // query masukin data
            $insert = $this->db->insert("session", $data);

            // kalau berhasil masuk
            if($insert) {
                $response['status'] = 200;
                $response['error'] = false;
                $response['message']='Data Session Berhasil Ditambahkan';
                return $response;
            } else {
                $response['status']=502;
                $response['error']=true;
                $response['message']='Data Session Gagal Ditambahkan';
                return $response;
            }
        }
    }

    // ambil data user
    public function get_user_data() {
        $all_user_data = $this->db->get("user")->result();
        $response['status']=200;
        $response['error']=false;
        $response['user']=$all_user_data;
        return $response;
    }

    public function getRows($params = array()){
        // $this->db->select('*');
        $this->db->get("user")->result();
        
        //fetch data by conditions
        if(array_key_exists("conditions",$params)){
            foreach($params['conditions'] as $key => $value){
                $this->db->where($key,$value);
            }
        }
        
        if(array_key_exists("id",$params)){
            $this->db->where('id',$params['id']);
            $query = $this->db->get("user");
            $result = $query->row_array();
        }else{
            //set start and limit
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }
            
            if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
                $result = $this->db->count_all_results();    
            }elseif(array_key_exists("returnType",$params) && $params['returnType'] == 'single'){
                $query = $this->db->get("user");
                $result = ($query->num_rows() > 0)?$query->row_array():false;
            }else{
                $query = $this->db->get("user");
                $result = ($query->num_rows() > 0)?$query->result_array():false;
            }
        }

        //return fetched data
        return $result;
    }





    // ambil semua data
    public function get_all_session() {
        $all_session = $this->db->get("session")->result();
        $response['status']=200;
        $response['error']=false;
        $response['user']=$all_session;
        return $response;
    }
    
    // ambil beberapa data
    public function get_list_session() {
        $query = $this->db->query('SELECT name, description FROM session')->result();
        $response['status']=200;
        $response['error']=false;
        $response['user']=$query;
        return $response;
    }

    // hapus data session
    public function delete_session($id) {

        // kalau id nya kosong
        if($id == '') {
            return $this->empty_response();
        } else {
            $where = array(
                "id" => $id
            );

            $this->db->where($where);
            $delete = $this->db->delete("session");

            // kalau berhasil dihapus
            if($delete) {
                $response['status']=200;
                $response['error']=false;
                $response['message']='Data Session Berhasil Dihapus';
                return $response;
            } else {
                $response['status']=502;
                $response['error']=true;
                $response['message']='Data Session Gagal Dihapus';
                return $response;
            }
        }
    }

    // mengupdate data session
    public function update_session($id,$name, $description, $start, $duration) {

        date_default_timezone_set("Asia/Bangkok");
        $date = date("Y-m-d h:i:s");
        // kalau id nya kosong
        if($id == '' || empty($name) || empty($description) || empty($start || empty($duration))) {
            return $this->empty_response();
        } else{
            $where = array(
              "id" => $id
            );

            $set = array(
                "name" => $name,
                "description" => $description,
                "start" => $start,
                "duration" => $duration,
                "updated" => $date
            );

            $this->db->where($where);
            $update = $this->db->update("session",$set);
            if($update){
              $response['status']=200;
              $response['error']=false;
              $response['message']='Data Session Berhasil Diubah';
              return $response;
            }else{
              $response['status']=502;
              $response['error']=true;
              $response['message']='Data Session Gagal Diubah';
              return $response;
            }
        }
    }

}

?>
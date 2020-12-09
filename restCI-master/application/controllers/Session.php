<?php

require APPPATH . 'libraries/REST_Controller.php';

class Session extends REST_Controller{

  // construct
    public function __construct(){
        parent::__construct();
        $this->load->model('SessionM');
    }

  // method index untuk menampilkan semua data session menggunakan method get
    public function index_get(){
        $response = $this->SessionM->get_all_session();
        $this->response($response);
    }

  // method index untuk menampilkan semua data session menggunakan method get
     public function list_get(){
         $response = $this->SessionM->get_list_session();
         $this->response($response);
}

  // untuk menambah session menggunakan method post
    public function add_post(){
        $response = $this->SessionM->add_session(
            $this->post('name'),
            $this->post('description'),
            $this->post('start'),
            $this->post('duration')
        );
        $this->response($response);
    }

  // update data session menggunakan method put
    public function update_put(){
        $response = $this->SessionM->update_session(
            $this->put('id'),
            $this->put('name'),
            $this->put('description'),
            $this->put('start'),
            $this->put('duration')
        );
        $this->response($response);
    }

  // hapus data session menggunakan method delete
    public function delete_delete(){
        $response = $this->SessionM->delete_session(
            $this->delete('id')
        );
        $this->response($response);
    }

}

?>

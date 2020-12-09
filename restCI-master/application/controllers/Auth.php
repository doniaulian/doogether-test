<?php

require APPPATH . 'libraries/REST_Controller.php';

class Auth extends REST_Controller{

  // construct
    public function __construct(){
        parent::__construct();
        $this->load->model('SessionM');
    }

  // method untuk register user menggunakan method post
    public function register_post(){
        $response = $this->SessionM->register_user(
            $this->post('name'),
            $this->post('email'),
            $this->post('password')
        );
        $this->response($response);
    }

  // method untuk login menggunakan method post
    public function login_post(){
     // Get the post data
     $email = $this->post('email');
     $password = $this->post('password');
     
     // Validate the post data
     if(!empty($email) && !empty($password)){
         
         // Check if any user exists with the given credentials
         $con['returnType'] = 'single';
         $con['conditions'] = array(
             'email' => $email,
             'password' => $password
         );
         $user = $this->SessionM->getRows($con);
         
         if($user){
             // Set the response and exit
             $this->response([
                 'status' => TRUE,
                 'message' => 'User login successful.',
                 'data' => $user
             ], REST_Controller::HTTP_OK);
         }else{
             // Set the response and exit
             //BAD_REQUEST (400) being the HTTP response code
             $this->response("Wrong email or password.", REST_Controller::HTTP_BAD_REQUEST);
         }
     }else{
         // Set the response and exit
         $this->response("Provide email and password.", REST_Controller::HTTP_BAD_REQUEST);
     }
    }
}

?>

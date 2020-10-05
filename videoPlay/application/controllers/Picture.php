<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Picture extends CI_Controller {

  public function __construct(){

    parent::__construct();
    $this->load->helper('url');
    $this->load->model('user_model');

  }

  public function index(){

    // load view
    $data['userLogged']=$this->session->userdata('username');
    $this->load->view('templates/headerLogged',$data);
    $this->load->view('picture');
    $this->load->view('templates/footer');

  }

  // File upload
  public function fileUpload(){

   if(!empty($_FILES['file']['name'])){

     // Set preference
     $config['upload_path'] = 'uploads/'; 
     $config['allowed_types'] = 'jpg|jpeg|png|gif';
     $config['max_size'] = '3024'; // max_size in kb
     $config['file_name'] = $_FILES['file']['name'];

     //Load upload library
     $this->load->library('upload',$config); 

     // File upload
     if($this->upload->do_upload('file')){
       // Get data about the file
       $uploadData = $this->upload->data();
       $file_name = $uploadData['file_name'];
       $finalPath = 'uploads/'. $file_name;
       
       $this->user_model->updateProfilePic($this->session->userdata('username'),$finalPath);
       $user=$this->user_model->getUserByUsername($this->session->userdata('username'));
       $this->session->set_userdata('picture',$user->profilePic );
       $urlProfile='profile?username='.$this->session->userdata('username');
       
     }
   }

 }

}
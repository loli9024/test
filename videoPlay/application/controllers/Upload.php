<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Upload extends CI_Controller {

        private $con;
        private $sizeLimit = 500000000;
        private $allowedTypes = array("mp4", "flv", "webm", "mkv", "vob", "ogv", "ogg", "avi", "wmv", "mov", "mpeg", "mpg");
  

        public function __construct()
        {
                parent::__construct();
                $this->load->helper(array('form', 'url'));
                $this->load->model('video_model');
                $this->load->model('user_model');
                $this->load->library('session');
        }

        public function index()
        {
            $data['category'] = $this->video_model->fetch_category();
            $data['error'] = ' ' ;

               if(isset($_SESSION["userLoggedIn"] )){
                
                if($this->session->userdata('username')){
                
                    $data['userLogged']=$this->session->userdata('username');
                    $this->load->view('templates/headerLogged',$data);
                }
                else{
                    $this->load->view('templates/header');
                }
                $this->load->view('upload_form', $data);
                $this->load->view('templates/footer');
               }
                else{
                    $data['category'] = '';
                    $this->load->view('templates/header');
                    $this->session->set_flashdata('message','Sorry, you must sign In first');
                    $this->load->view('upload_form', $data);
                    $this->load->view('templates/footer');
                }
                
                
        }

        public function do_upload()
        {

                $config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'mp4|flv|webm|mkv|vob|ogv|ogg|avi|wmv|mov|mpeg|mpg';
                $config['max_size']             = 100000;
                $config['max_width']            = 5024;
                $config['max_height']           = 5768;
                $new_name =  uniqid();
                $config['file_name'] = $new_name;
                $this->load->library('upload', $config);

                $targetDir="uploads/";

               

                if ( ! $this->upload->do_upload('video'))
                {       
                        $error = array('error' => $this->upload->display_errors());
                        $this->load->view('templates/header');
                        $this->load->view('upload_form', $error);
                        $this->load->view('templates/footer');
                }
                else
                {
                    $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
                    $file_name = $upload_data['file_name'];
                    $finalPath = $targetDir . $file_name;
                    $data = array('upload_data' => $upload_data);
                    
                            if($this->insertVideoData($finalPath)<=0){
                                $this->session->set_flashdata('message','Upload failed!');
            
                                return false;
                              
                            }
                        $urlProfile='profile?username='.$this->session->userdata('username');
                        redirect($urlProfile);
                }
        }

        

    
   

    private function hasError($data){

        return $data["error"]!=0;
    }

    private function insertVideoData ($filePath){
        
             
        $data['title'] = $_POST["title"];
        $data['uploadedBy'] =  $this->session->userdata('username') ;
        $data['description'] = $_POST["description"];
        $data['privacy'] =  $_POST["privacity"];
        $data['category'] =  $_POST["category"];
        $data['filePath'] = $filePath;
            
            $result = $this->video_model->insert_video($data);

            $subscriptions = $this->user_model->getSubscribers($this->session->userdata('username'));

            foreach($subscriptions as $row){
    
                $notification['message']='New video called '.$_POST["title"].' uploaded by '.$this->session->userdata('username');
                $notification['user_from']=$this->session->userdata('username');
                $notification['videoId']=$result;
                $notification['user_to']=$row->userFrom;
        
                $this->user_model->insert_notification($notification);
        
                
           
            }
       
        return $result;
       

        
    }



    
  


}
?>
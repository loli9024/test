<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class ForgotPassword extends CI_Controller {

    protected $_enable_log_output = TRUE;

        public function __construct()
        {
                parent::__construct();
                $this->load->helper(array('form', 'url','string'));
                $this->load->model('user_model');
                $this->load->library('session');
               
        }

        public function index()
        {
        

            $data['error'] = ' ' ;
            $this->load->view('forgotPassword');
                
                
        }

        public function forgotPwd(){

            $username=$this->input->post('username');
            $user=$this->user_model->getUserByUsername($username);
            
           
            if(isset($user)){
                $p=random_string('alnum', 16);
                $pwd=hash("sha512", $p ) ;
                $this->user_model->changePassword($username,$pwd) ;
                $to = $user->email;
                $subject = "Password";
                
				$txt = "Your password has been reset, your new password is ".$p ;
				$headers = "From: password@videoPlay.com" . "\r\n" .
				"CC: admin@videoPlay.com";

                mail($to,$subject,$txt,$headers);
                $this->session->set_flashdata('info',' Your new password was sent to your Email');
                $this->load->view('forgotPassword');
            }
            else{

                $this->session->set_flashdata('message',' Sorry, incorrect Username ');
                $this->load->view('forgotPassword');
            }
                
        }

    }
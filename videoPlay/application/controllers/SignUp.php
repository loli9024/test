<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class SignUp extends CI_Controller {

    private $exp_time = 60 * 20;

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
               $this->load->view('signUp', $data);
                
                
        }
        public function signUp(){
            $this->load->library('form_validation');

            $this->form_validation->set_rules('firstName', 'First Name', 'trim|required|min_length[2]|max_length[12]|is_unique[user.username]');
            $this->form_validation->set_rules('lastName', 'Last Name', 'trim|required|min_length[2]|max_length[12]|is_unique[user.username]');
            $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[12]|is_unique[user.username]');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');
            $this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password]');
            $this->form_validation->set_rules('email', 'Email', 'required|is_unique[user.email]');

            if ($this->form_validation->run() == FALSE)
            {
                
                    $this->load->view('signUp');
            }
            else
            {
                $data = array(
                    'firstName' => $this->input->post('firstName'),
                    'lastName' => $this->input->post('lastName'),
                    'username' => $this->input->post('username'),
                    'password' => hash("sha512", $this->input->post('password') ),
                    'email' => $this->input->post('email')
                    );

                $result = $this->user_model->registration_insert($data);
                if ($result == TRUE) {
               
                //redirect('welcome');

                $token=random_string('alnum', 20);
                $tokeEncrip=hash("sha512", $token ) ;
                set_cookie("token", $tokeEncrip, $this->exp_time);
                set_cookie("usernameV", $this->input->post('username'), $this->exp_time);

                $to = $this->input->post('email');
                $subject = "Email verification";
                
				$txt = "Please clic this <b><a href='".base_url('signUp/verification?token='.$tokeEncrip."'>link</a></b> to verify your email  ") ;
				$headers = "From: password@videoPlay.com" . "\r\n" .
				"CC: admin@videoPlay.com";

                mail($to,$subject,$txt,$headers);

                $this->session->set_flashdata('info','An email was sent to verify your account');
            
                $this->load->view('signUp');
                

                } else {
                $this->session->set_flashdata('message','Error saving the information');
            
                $this->load->view('signUp');
            }
            }

        }

        public function verification(){

            $param=$this->input->get('token');
            $token=get_cookie('token');
            if($param==get_cookie('token')){

                $_SESSION["userLoggedIn"] = get_cookie('usernameV');
                $this->session->set_userdata('username',get_cookie('usernameV'));
                $this->user_model->activeUser($this->session->userdata('username'));
                $subscriptions=$this->user_model->getSubscriptions($this->session->userdata('username'));
                $this->session->set_userdata('subscriptions',$subscriptions);
                redirect('welcome');

            }else{
                $this->session->set_flashdata('message','prueba'.$token);
            
                $this->load->view('signUp');

            }

            


        }


}
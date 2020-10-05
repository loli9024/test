<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class EditProfile extends CI_Controller {

    private $userLogged;

        public function __construct()
        {
                parent::__construct();
                $this->load->helper(array('form', 'url'));
                $this->load->model('user_model');
                $this->load->library('session');
               
        }

        public function index()
        {
            $this->userLogged=$this->session->userdata('username');
            
            if($this->session->userdata('username')){
                
                $data['userLogged']=$this->session->userdata('username');
                $this->load->view('templates/headerLogged',$data);
            }
            else{
                $this->load->view('templates/header');
            }
            $users=$this->user_model->getUserByUsername($this->userLogged);
            $data['firstName'] = $users->firstName;
            $data['lastName'] = $users->lastName;
            $data['email'] = $users->email;
                
            
           
            $this->load->view('editProfile', $data);
            $this->load->view('templates/footer');


                
                
        }
        public function edit(){
        $userName=$this->session->userdata('username');
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $email = $_POST["email"];
        $this->user_model->editProfile($userName,$firstName,$lastName,$email) ;
        redirect('profile?username='.$userName);
        }

        public function changePassword(){
            $userName=$this->session->userdata('username');
            $users=$this->user_model->getUserByUsername($userName);
            $data['firstName'] = $users->firstName;
            $data['lastName'] = $users->lastName;
            $data['email'] = $users->email;
            $data['userLogged']=$userName;
            $this->load->library('form_validation');
            $this->form_validation->set_rules('newpasswrod', 'Password', 'trim|required|min_length[5]');
            $this->form_validation->set_rules('confirmpassword', 'Password Confirmation', 'trim|required|matches[newpasswrod]');
            
            if ($this->form_validation->run() == FALSE)
            {
            $this->load->view('templates/headerLogged',$data);
            $this->load->view('editProfile', $data);
            $this->load->view('templates/footer');
            }
            else{
                
                $user=$this->user_model->getUserByUsername($userName);
                $pw = hash("sha512", $_POST["oldpassword"] );
                if($user->password==$pw){
                    $newPassword=hash("sha512", $_POST["newpasswrod"] );
                    $this->user_model->changePassword($userName,$newPassword) ;
                    $this->session->set_flashdata('info',' Your password has been changed');
                    $this->load->view('templates/headerLogged',$data);
                    $this->load->view('editProfile',$data);
                    $this->load->view('templates/footer');
        
                }else{
                    $this->session->set_flashdata('message',' Error, Incorrect old password');
                    $this->load->view('templates/headerLogged',$data);
                    $this->load->view('editProfile',$data);
                    $this->load->view('templates/footer');
                }
            }
            

            
        
        }
}
<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Profile extends CI_Controller {

        var $userLogged;

        public function __construct()
        {
                parent::__construct();
                $this->load->helper(array('form', 'url'));
                $this->load->model('user_model');
                $this->load->model('video_model');
                $this->load->library('session');
               
        }

        function index()
        {
            $param=$this->input->get('username');
            $user=$this->user_model->getUserByUsername($param);
            $views=$this->user_model->viewsByUser($param);
            $subscribers=$this->user_model->getSubscriberCount($param);
            if($this->session->userdata('username')){
                $notification=$this->video_model->getNotification($this->session->userdata('username'));
                $this->session->set_userdata('notification',$notification);
                $this->userLogged=$this->session->userdata('username');
                $data['userLogged']=$this->userLogged;
                $this->load->view('templates/headerLogged',$data);
                
            }else{
                $this->userLogged='';
                $this->load->view('templates/header');
            }
            
            
            $data['userLogged']=$this->userLogged;
            $data['userTo']=$param;
            $data['firstName']=$user->firstName;
            $data['lastName']=$user->lastName;
            $data['picture']=$user->profilePic; 
            $data['subscribers']=$subscribers;

            if($this->user_model->isSubscribedTo($param,$this->userLogged)){
                $data['textButton'] = 'SUBSCRIBED';
                $data['styleButton'] = 'unsubscribe button';
    
            }else{
                $data['textButton'] = 'SUBSCRIBE';
                $data['styleButton'] = 'subscribe button';
                
    
    
            }

            $this->load->view('profile', $data);
            $videos=$this->video_model->getVideoByUser($param);
            foreach ($videos as $video){
                
                $this->load->view('search',$video);
            } 
            $data["views"]=$views->views;
            $data["firstName"]=$user->firstName;
            $data["lastName"]=$user->lastName;
            $data["signUpDate"]=$user->signUpDate;
            $data['picture']=$user->profilePic; 
            $data['userLogged']=$this->userLogged;

            $this->load->view('profileAbout', $data);

            $this->load->view('templates/footer');
                
                
        }
        
}
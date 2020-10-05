<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class SignIn extends CI_Controller {

    protected $_enable_log_output = TRUE;
    private $exp_time = 60 * 50; //50 minutes

        public function __construct()
        {
                parent::__construct();
                $this->load->helper(array('form', 'url','captcha'));
                $this->load->model('user_model');
                $this->load->model('video_model');
                $this->load->library('session');
                $this->load->library('form_validation');
               
        }

        public function index()
        {
        // Captcha configuration
            $config = array(
                'img_path'      => 'captcha_images/',
                'img_url'       => base_url().'captcha_images/',
                'font_path'     => 'system/fonts/texb.ttf',
                'img_width'     => '160',
                'img_height'    => 50,
                'word_length'   => 8,
                'font_size'     => 18
            );
            $captcha = create_captcha($config);
            
            // Unset previous captcha and set new captcha word
            $this->session->unset_userdata('captchaCode');
            $this->session->set_userdata('captchaCode', $captcha['word']);
            
            // Pass captcha image to view
            $data['captchaImg'] = $captcha['image'];

            $data['error'] = ' ' ;
            

            $this->load->view('signIn', $data);
                
                
        }
        public function login(){

            
                $inputCaptcha = $this->input->post('captcha');
                $sessCaptcha = $this->session->userdata('captchaCode');
                
                // Captcha configuration
            $config = array(
                'img_path'      => 'captcha_images/',
                'img_url'       => base_url().'captcha_images/',
                'font_path'     => 'system/fonts/texb.ttf',
                'img_width'     => '160',
                'img_height'    => 50,
                'word_length'   => 8,
                'font_size'     => 18
            );
            $captcha = create_captcha($config);
            
            // Unset previous captcha and set new captcha word
            $this->session->unset_userdata('captchaCode');
            $this->session->set_userdata('captchaCode', $captcha['word']);
            
            // Pass captcha image to view
            $datacaptcha['captchaImg'] = $captcha['image'];
                if($inputCaptcha === $sessCaptcha){
                    if(get_cookie('remember')) {
                        
                        $data = array(
                            'username' => get_cookie('username'),
                            'password' => get_cookie('password')
                            
                            );
                        
                        
                        if ($this->user_model->login($data)) {
                            if($this->user_model->login($data))
                            $_SESSION["userLoggedIn"] = $this->input->post('username');
                            $this->session->set_userdata('username',$this->input->post('username') );
                            
                            $subscriptions=$this->user_model->getSubscriptions($this->session->userdata('username'));
                            $this->session->set_userdata('subscriptions',$subscriptions);
                            
                            $notification=$this->video_model->getNotification($this->session->userdata('username'));
                            $this->session->set_userdata('notification',$notification);
                        
                            $this->session->set_flashdata('login', 'You have been successfully logged in');
                            $this->session->keep_flashdata('login');					
                            redirect('welcome');
                            
                        } else {
                            $this->session->set_flashdata('message',' Invalid username or password');
                            $this->load->view('signIn', $datacaptcha);
                        }
                    } else{
                        $this->form_validation->set_rules('username', 'Username', 'trim|required|max_length[100]|xss_clean');
                        $this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[25]|xss_clean');
                        
                        if ($this->form_validation->run()) {
                            $username = $this->input->post('username');
                            $password = $this->input->post('password');
                            $remember = $this->input->post('remember');
                            
                            if($remember) {
                                set_cookie("username", $username, $this->exp_time);
                                set_cookie("password", $password, $this->exp_time);
                                set_cookie("remember", $remember, $this->exp_time);
                            } else {
                                delete_cookie("username");
                                delete_cookie("password");
                                delete_cookie("remember");
                            }
                            $data = array(
                                'username' => $username,
                                'password' => $password
                                
                                );
                            
                            if ($this->user_model->login($data)) {
                                $_SESSION["userLoggedIn"] = $this->input->post('username');
                                $this->session->set_userdata('username',$this->input->post('username') );

                                $user=$this->user_model->getUserByUsername($this->session->userdata('username'));
                                $this->session->set_userdata('picture',$user->profilePic );


                                $subscriptions=$this->user_model->getSubscriptions($this->session->userdata('username'));
                                $this->session->set_userdata('subscriptions',$subscriptions);
                                
                                $notification=$this->video_model->getNotification($this->session->userdata('username'));
                                $this->session->set_userdata('notification',$notification);
                            

                                $this->session->set_flashdata('login', 'You have been successfully logged in');
                                $this->session->keep_flashdata('login');					
                                redirect('welcome');
                            } else {
                                $this->session->set_flashdata('message',' Invalid username or password or inactive user ');
                            $this->load->view('signIn', $datacaptcha);
                            }
                        }


                    }
                    
                }else{

                    $this->session->set_flashdata('message',' Captcha code does not match, please try again');
                    $this->load->view('signIn', $datacaptcha);
                }
        

           

        }
        
        public function refresh(){
            // Captcha configuration
            $config = array(
                'img_path'      => 'captcha_images/',
                'img_url'       => base_url().'captcha_images/',
                'font_path'     => 'system/fonts/texb.ttf',
                'img_width'     => '160',
                'img_height'    => 50,
                'word_length'   => 8,
                'font_size'     => 18
            );
            $captcha = create_captcha($config);
            
            // Unset previous captcha and set new captcha word
            $this->session->unset_userdata('captchaCode');
            $this->session->set_userdata('captchaCode',$captcha['word']);
            
            // Display captcha image
            echo $captcha['image'];
        }
       



    }
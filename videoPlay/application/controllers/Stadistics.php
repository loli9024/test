<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stadistics extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		
		$this->load->model('video_model');
		$this->load->model('user_model');
		$this->load->library('form_validation');
		
	}

	public function index() {
		if($this->session->userdata('username')){

			
			$subscriptions=$this->user_model->getSubscriptions($this->session->userdata('username'));
			$this->session->set_userdata('subscriptions',$subscriptions);
			$notification=$this->video_model->getNotification($this->session->userdata('username'));
			$this->session->set_userdata('notification',$notification);
			$this->userLogged=$this->session->userdata('username');
			$data['userLogged']=$this->userLogged;
			$this->load->view('templates/headerLogged',$data);
			$this->load->view('xchart');
			$this->load->view('templates/footer');


		
		}
	}

	function get_chart_data() {
		if (isset($_POST['start']) AND isset($_POST['end'])) {
			$start_date = $_POST['start'];
			$end_date = $_POST['end'];
			
			$results = $this->video_model->get_chart_data_for_views($this->session->userdata('username'),$start_date,$end_date);
			
			if ($results === NULL) {
				echo json_encode('No record found');
			} else {
				echo json_encode($results);
			}
		} else {
			echo json_encode('You must select date');
		}
	}
}
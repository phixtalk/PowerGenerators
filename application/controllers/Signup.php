<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signup extends CI_Controller {
	public function index(){
		$this->load->model('entity');
		$data['active']=2;
		$data['title']="Register/Get Started";
		$this->load->view('templates/public/header',$data);
		//$this->load->view('templates/public/home_css');
		$this->load->view('templates/public/close_head');
		$this->load->view('templates/public/open_content');
		$this->load->view('public/signup');
		$this->load->view('templates/public/footer');
		//$this->load->view('templates/public/home_js');
		//$this->load->view('templates/public/close_site');
	}
}

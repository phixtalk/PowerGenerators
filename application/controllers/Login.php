<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function index(){
		$data['active']=3;
		$data['title']="Login";
		$this->load->view('templates/public/header',$data);
		//$this->load->view('templates/public/home_css');
		$this->load->view('templates/public/close_head');
		$this->load->view('templates/public/open_content');
		$this->load->view('public/login');
		$this->load->view('templates/public/footer');
		//$this->load->view('templates/public/home_js');
		//$this->load->view('templates/public/close_site');
	}
}

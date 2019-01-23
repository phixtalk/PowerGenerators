<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends CI_Controller {
	public function index(){
		$this->load->model('entity');
		$data['active']=2;
		$data['title']="Available Diesel Generators for Sale";
		$this->load->view('templates/public/header',$data);
		$this->load->view('templates/public/close_head');
		$this->load->view('templates/public/open_content');
		$this->load->view('public/sales');
		$this->load->view('templates/public/footer');
	}
}

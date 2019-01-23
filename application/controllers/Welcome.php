<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data['active']=1;
		$data['title']="PowerGenerators.com.ng";
		$this->load->view('templates/public/header',$data);
		//$this->load->view('templates/public/home_css');
		$this->load->view('templates/public/close_head');
		$this->load->view('templates/public/open_content');
		$this->load->view('public/welcome_message');
		
		
		$this->load->view('templates/public/footer');
		
		//$this->load->view('templates/public/close_content');
		//$this->load->view('templates/public/home_js');
		//$this->load->view('templates/public/close_site');
	}
}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Forgot extends CI_Controller {
	public function index(){
		$data['active']=3;
		$data['title']="Login";
		$this->load->view('templates/public/header',$data);
		$this->load->view('templates/public/close_head');
		$this->load->view('templates/public/open_content');
		$this->load->view('public/requestpassword');
		$this->load->view('templates/public/footer');
	}
	
	
	public function show($uid="",$rlink=""){
		$continue="false";$email="";$needreset="";$thisuser="";
		if($uid!=""&&is_numeric($uid)&&$rlink!=""){
			$this->db->select('usernames,email,needreset');
			$this->db->where('id', $uid);
			$this->db->where('resetlink', $rlink);
			$query = $this->db->get('userbase',1);				
			if ($query->num_rows() > 0){
				$row = $query->row_array();
				$email = $row['email'];
				$needreset = $row['needreset'];
				$thisuser = $row['usernames'];
				$continue="true";
			}
		}
		if($needreset==""){
			$continue="false";
		}elseif($needreset==0){
			$continue="reset-false";
		}
		$data['continue'] = $continue;
		
		$data['uid'] = $uid;
		$data['rlink'] = $rlink;
		$data['email'] = $email;
		$data['thisuser'] = $thisuser;
		
		$data['active']=0;
		$data['title'] = 'Reset Password';
		
		$this->load->view('templates/public/header',$data);
		$this->load->view('templates/public/close_head');
		$this->load->view('templates/public/open_content');
		$this->load->view('public/resetpassword',$data);
		$this->load->view('templates/public/footer');
	}
}
	
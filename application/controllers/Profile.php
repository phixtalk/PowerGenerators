<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');class Profile extends CI_Controller {	public function index(){		$this->utilities->check_login_status();		$this->load->model(array('entity','users'));		$data['title'] = 'My Profile';		$data['current'] = '3';		$crumb[0][0] = base_url("dashboard");		$crumb[0][1] = 'my dashboard';		$crumb[0][2] = 'My Dashboard';		$crumb[1][0] = current_url();		$crumb[1][1] = 'my profile';		$crumb[1][2] = 'My Profile';				$data['crumb']=$crumb;		$this->load->view('templates/appheader',$data);		$this->load->model('users');		$callstyles['direct_css'] = array(            'assets/user/dist/css/skins/_all-skins.min.css'        );		$this->load->view('templates/plugins/loadstyles',$callstyles);		/*END LOAD CSS SCRIPTS*/		$filedirect['filedirect']='assets/user/plugins/jQuery/jquery-2.2.3.min.js';		$this->load->view('templates/plugins/loaddirect',$filedirect);		$data['bodyclass'] = '';		$this->load->view('templates/closeheader',$data);		$this->load->view('templates/menusidelink',$data);				$this->load->view('members/profile',$data);		$this->load->view('templates/closecontent',$data);//google ads		$callscripts['direct_js'] = array(			'assets/user/bootstrap/js/bootstrap.min.js',			'assets/user/plugins/datatables/dataTables.bootstrap.min.js',			'assets/user/dist/js/app.min.js'		);				$this->load->view('templates/plugins/loadscripts',$callscripts);		$this->load->view('templates/appfooter');	}	public function edit(){		$this->utilities->check_login_status();		$this->load->model(array('entity','users'));		$data['title'] = 'Edit Profile';		$data['current'] = '24';		$crumb[0][0] = base_url("dashboard");		$crumb[0][1] = 'my dashboard';		$crumb[0][2] = 'My Dashboard';		$crumb[1][0] = current_url();		$crumb[1][1] = 'edit profile';		$crumb[1][2] = 'Edit Profile';				$data['crumb']=$crumb;		$this->load->view('templates/appheader',$data);		$this->load->model('users');		$callstyles['direct_css'] = array(			'assets/user/plugins/datepicker/datepicker3.css',            'assets/user/dist/css/skins/_all-skins.min.css'        );		$this->load->view('templates/plugins/loadstyles',$callstyles);		/*END LOAD CSS SCRIPTS*/		$filedirect['filedirect']='assets/user/plugins/jQuery/jquery-2.2.3.min.js';		$this->load->view('templates/plugins/loaddirect',$filedirect);		$data['bodyclass'] = '';		$this->load->view('templates/closeheader',$data);		$this->load->view('templates/menusidelink',$data);				$this->load->view('members/profile_edit',$data);		$this->load->view('templates/closecontent',$data);//google ads		$callscripts['direct_js'] = array(			'assets/user/bootstrap/js/bootstrap.min.js',			'assets/user/plugins/datepicker/bootstrap-datepicker.js',			'assets/user/dist/js/app.min.js'		);		$doptions['doptions']='{autoclose: true,format: "yyyy-mm-dd",endDate: "'.date("Y-m-d").'"}';		$this->load->view('templates/plugins/loadscripts',$callscripts);		$this->load->view('templates/plugins/datepicker',$doptions);		$this->load->view('templates/appfooter');	}	public function indexold(){		//$this->utilities->check_login_status();		if($this->session->userdata('logged_in')!=TRUE){			$array_items = array('logged_in'=>'',''=>'');						$this->session->set_userdata($array_items);			$this->session->set_flashdata('flag','failure');			$this->session->set_flashdata('message','Please login to continue.');							redirect(base_url('/signin?redir=true&nxturl='.urlencode(current_url())));			exit;		}		$data['title'] = 'Profile';		$data['current'] = '3';		$this->load->view('templates/appheader',$data);		//$this->load->model('entity');				$callstyles['direct_css'] = array(            'assets/user/dist/css/skins/_all-skins.min.css'        );				$this->load->view('templates/plugins/loadstyles',$callstyles);		/*END LOAD CSS SCRIPTS*/		$filedirect['filedirect']='assets/user/plugins/jQuery/jquery-2.2.3.min.js';		$this->load->view('templates/plugins/loaddirect',$filedirect);		$data['bodyclass'] = '';		$this->load->view('templates/closeheader',$data);		$this->load->view('templates/menusidelink',$data);				$this->load->view('profile/index',$data);		$this->load->view('templates/closecontent',$data);//google ads		$callscripts['direct_js'] = array(			'assets/user/bootstrap/js/bootstrap.min.js',			'assets/user/dist/js/app.min.js'		);		$this->load->view('templates/plugins/loadscripts',$callscripts);		$this->load->view('templates/appfooter');	}	public function edit_old($uid="",$rlink=""){		$this->utilities->check_login_status();						$continue="false";$email="";$needreset="";$thisuser="";		if($uid!=""&&is_numeric($uid)&&$rlink!=""){			$this->db->select('username,email,neededit');			$this->db->where('id', $uid);			$this->db->where('editlink', $rlink);			$query = $this->db->get('userbase',1);							if ($query->num_rows() > 0){				$row = $query->row_array();				$email = $row['email'];				$needreset = $row['neededit'];				$thisuser = $row['username'];				$continue="true";			}		}		if($needreset==""){			$continue="false";		}elseif($needreset==0){			$continue="reset-false";		}		$data['continue'] = $continue;				$data['uid'] = $uid;		$data['rlink'] = $rlink;		$data['email'] = $email;		$data['thisuser'] = $thisuser;				$data['title'] = 'Edit Information';		$data['current'] = '3';		$this->load->view('templates/appheader',$data);		$this->load->model('entity');		$callstyles['direct_css'] = array(            'assets/user/dist/css/skins/_all-skins.min.css'        );		$this->load->view('templates/plugins/loadstyles',$callstyles);		/*END LOAD CSS SCRIPTS*/		$filedirect['filedirect']='assets/user/plugins/jQuery/jquery-2.2.3.min.js';		$this->load->view('templates/plugins/loaddirect',$filedirect);		$data['bodyclass'] = '';		$this->load->view('templates/closeheader',$data);		$this->load->view('templates/menusidelink',$data);		$this->load->view('profile/edit',$data);		$this->load->view('templates/closecontent',$data);		$callscripts['direct_js'] = array(			'assets/user/bootstrap/js/bootstrap.min.js',			'assets/user/dist/js/app.min.js'		);		$this->load->view('templates/plugins/loadscripts',$callscripts);		$this->load->view('templates/appfooter');	}}	
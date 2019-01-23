<?php

class Handle extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->library(array('form_validation'));
		$this->form_validation->set_error_delimiters('', '<br>');		
	}	
	var $nextURL = NULL;
	
    public function getNextURL() {
        return $this->nextURL;
    }

    public function setNextURL($nextURL) {
        $this->nextURL = $nextURL;
    }
	
	public function new_signup(){
		$this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
		$this->form_validation->set_rules('lastname', 'Surname', 'trim|required');
		$this->form_validation->set_rules('mobile', 'Phone Number', 'trim|required|is_unique[userbase.mobile]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[userbase.email]');
		$this->load->model('entity');
		$this->setNextURL(base_url("signup"));
		
		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('flag','alert');
			$this->session->set_flashdata('message',validation_errors());
			$this->session->set_flashdata('accountpost', $this->input->post());			
		} else {
			$this->load->library('email');
			
			//$this->db->trans_start();//START TRANSACTION
			
			$firstname = $this->input->post('firstname');
			$lastname = $this->input->post('lastname');
			$mobile = $this->input->post('mobile');
			$email = $this->input->post('email');
			//$address = $this->input->post('address'); 
			$city = $this->input->post('city'); 
			$state = $this->input->post('state'); 
			$password = $this->input->post('pasword'); 
			$confirmpass = $this->input->post('confirmpass');
			$organization = $this->input->post('organization'); 
			//;
			
			$data = array(
			   'firstname' => $firstname ,
			   'lastname' => $lastname ,
			   'usernames' => $lastname." ".$firstname,
			   'mobile' => $mobile ,
			   'email' => $email ,
			   'organization' => $organization ,
			   'city' => $city ,
			   'state' => $state ,
			   'loginpass' => sha1($password),
			   'createdon' => date("Y-m-d H:i:s") ,
			   'modifiedon' => date("Y-m-d H:i:s") 
			   
			);
			
			//generate unique password
			//$code=md5(time().date('H:i:s').$uid.rand(1000,10000));
			//$uniquecode = substr($code,5,5);//start from the 5th character and get only 5 characters
			
			/*
			$addzero="";
			$cntt = 6-strlen($uid);
			for($d=0;$d<$cntt;$d++){
				$addzero.="0";
			}
			$uniquecode=$addzero.$uid;

			//next update user password
			$updata = array(
			   'loginid' => $uniquecode,
			   'createdon' => date("Y-m-d H:i:s") ,
			   'modifiedon' => date("Y-m-d H:i:s") 
			);
			$this->db->where('id', $uid);
			$this->db->update('userbase', $updata);
			
			*/
			
			//$this->db->trans_complete();//STOP TRANSACTION			

			if ($this->db->insert('userbase', $data)){
				$uid = $this->db->insert_id();
				
				$body ="Your Sign Up was Successfully<br>
				Thank you<br>";
				$message = $this->utilities->custom_email_template($body,$email);
					
				$this->email->from('help@powergenerators.com.ng', 'Powergenerators.com.ng');
				$this->email->to($email);	
				$this->email->subject('Powergenerators.Com.Ng SignUp Successful');
				$this->email->message($message);				
				$this->email->send();			
				
				$this->email->clear(TRUE);
				
				$body2="This is a notification that <i>".$lastname.", ".$firstname."</i> has just registered on the Powergenerators.com.ng Platform.<br>Thank you.";
				$message2 = $this->utilities->custom_email_template($body2,'help@powergenerators.com.ng');
				$this->email->from('help@powergenerators.com.ng', 'Powergenerators.com.ng');
				$this->email->to('help@powergenerators.com.ng');	
				$this->email->subject('New Signup Submission');
				$this->email->message($message2);
				
				//attach picture
				$file_path = "/assets/img/generator_flyer.jpg";
				$this->email->attach($file_path);
				
				$this->email->send();
				$this->session->set_flashdata('flag','success');
				$this->session->set_flashdata('message','Your Registration was successful.<br><a title="access your account now" href="'.base_url("handlers/handle/login/?loginid=".$mobile."&password=".$password).'">Click Here to access your account.</a>');
				$this->setNextURL(base_url("login"));
				
			}else{
				$this->session->set_flashdata('flag','failure');
				$this->session->set_flashdata('message','Sorry an error occurred. Please try again later');
				$this->session->set_flashdata('accountpost', $this->input->post());
			}
			//$this->db->trans_off();//DISABLE TRANSACTION
		}
		
		redirect($this->getNextURL());
	}
	public function next_step(){
		$app_number = $this->input->post('app_number'); 
		$phone = $this->input->post('phone');
		$this->setNextURL(base_url("register/?nextstep=true&paid=true&appid=".$app_number."&phone=".$phone));
		redirect($this->getNextURL());
	}
	public function login(){
		$this->load->model(array('users','entity'));		
		$this->load->library(array('mobile_detect'));		 
		if($this->input->get_post('redir')!=""&&$this->input->get_post('nxturl')!=""){			
			$this->setNextURL(base_url('?redir=true&nxturl='.$this->input->get_post('nxturl')));
		}else{
			$this->setNextURL(base_url("login"));
		}
		
		$this->form_validation->set_rules('loginid', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		
		$userid = $this->input->get_post('loginid');
		$userpass = sha1($this->input->get_post('password'));
		$userlogin = $this->users->get_login_user($userid,$userpass);
		
		$layout="";			
		if (count($userlogin) > 0){
			//check device of user
			//$detect = new Mobile_Detect();
			$mobile="";
			foreach($this->mobile_detect->getRules() as $name => $regex){
				$check = $this->mobile_detect->{'is'.$name}();                     					 
				if($check){
					$layout = $name;//set the customize mobile's name
					$mobile = "true";//set a flag to indicate that a customer version was found
					break;
				} 
			}
			if($mobile!="true"){
				if($this->mobile_detect->isTablet()){
					$layout = "Tablet";
				}elseif($this->mobile_detect->isMobile()){
					$layout = "Mobile";	
				}else{
					$layout = "Desktop";
				}
			}
			$row = $userlogin;
			$newdata = array(
			   'id'  		=> $row['id'],
			   'lastname'  => $row['lastname'],
			   'firstname'  => $row['firstname'],
			   'usernames'  	=> $row['lastname']." ".$row['firstname'],
			   'email'  => $row['email'],
			   'memberid'  => $row['loginid'],
			   'state'  => $row['state'],
			   'registeredon'  => $row['registeredon'],
			   'phone'  => $row['mobile'],
			   'memberstatus'=>  $row['memberstatus'],
			   'isadmin'  => $row['isadmin'],
			   'firstlogin'  => $row['firstlogin'],
			   'registeredon'  => $row['createdon'],
			   'global_email'  => 'help@powergenerators.com.ng',
			   'global_company'  => 'Powergenerators.com.ng',
			   'global_website'  => 'http://powergenerators.com.ng/',
			   'logged_in' => TRUE
			);
			//save users details in session
			$this->session->set_userdata($newdata);				
			//next save base record settings
			
			//update logged in status
			/*$updata = array(
			'loggedin' => 1,
			'lastlogin' => date("Y-m-d H:i:s"),
			'device' => $layout
			);
			$this->db->update('userbase', $updata, 
			"id = ".$this->session->userdata('id'));
			*/
			//check if remember me is set			
			if($this->input->get_post('remember')!=""){
				$exp=time()+60*60*24*365;
				$this->input->set_cookie('gnuser', $this->input->get_post('loginid'), $exp);
				$this->input->set_cookie('gnpass', $this->input->get_post('password'), $exp);
			}
			
			//check if redir url is set
			if($this->input->get_post('redir')!=""&&$this->input->get_post('nxturl')!=""){
				$this->setNextURL($this->input->get_post('nxturl'));
			}else{
				if($row['isadmin']=="1"){
					$this->setNextURL(base_url("cpanel"));
				}else{
					$this->setNextURL(base_url("dashboard"));
				}
			}
			//echo $userid." - ".$userpass; exit;
		}else{
			$this->session->set_flashdata('flag','failure');
			$this->session->set_flashdata('message','Username or Password is incorrect. If you forgot your password, <a title="request for a password reset" href="'.base_url("forgot").'">Click Here</a> to reset it.');
			$this->session->set_flashdata('loginpost', $this->input->post());			
		}
		
		redirect($this->getNextURL());
	}
	public function request_password(){
		$this->form_validation->set_rules('rstemail', 'Email Address', 'trim|required|valid_email');
		$this->load->library('email');
		$this->setNextURL(base_url("forgot"));
		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('flag','alert');
			$this->session->set_flashdata('message',validation_errors());	
		}else {
			$email = trim($this->input->post('rstemail'));			
			$this->db->select('id');
			$this->db->where('email', $email);
			$query = $this->db->get('userbase',1);			
			if ($query->num_rows() > 0){
				$uid=0;
				$row = $query->row_array();
				$uid = $row['id'];
   				$clink = $uid.sha1(time().date("Ymd"));
				$updata2 = array('resetlink' => $clink,'needreset' => 1);
				$this->db->update('userbase', $updata2, "id = ".$uid);
				
				$body ="You requested a <b>Password Reset</b>.<br>Please click the link below to continue<br><br><a style='color:#4c7cbd' href='".base_url("forgot/show/".$uid."/".$clink)."' title='go to password reset page'><b>Click Here To Continue</b></a>";

				$message = $this->utilities->custom_email_template($body,$email);									
				$this->email->from('help@powergenerators.com.ng', 'Powergenerators.com.ng');
				$this->email->to($email);	
				$this->email->subject('Password Reset Link');
				$this->email->message($message);				
				$this->email->send();			

				$this->session->set_flashdata('flag','success');
				$this->session->set_flashdata('message','A password reset link has been sent to your inbox or span or junk mail.<br>Please login to your mailbox and click on the link to proceed.');	
			
			}else{
				$this->session->set_flashdata('flag','alert');
				$this->session->set_flashdata('message','Sorry, the email address you entered is not registered in our database.');				
			}
		}
		redirect($this->getNextURL());	
	}
	public function reset_password(){
		$newpassword = $this->input->post('newpassword');		
		$cnewpassword = $this->input->post('cnewpassword');
		$uid = $this->input->post('uid');
		$email = $this->input->post('email');
		$rlink = $this->input->post('rlink');			
		$this->setNextURL(base_url("forgot/show/".$uid."/".$rlink));
		if(trim($newpassword)==""||trim($cnewpassword)==""||trim($uid)==""||trim($rlink)==""){
			$this->session->set_flashdata('flag','alert');
			$this->session->set_flashdata('message','Please enter valid data for all required fields');	
		}elseif($newpassword!=$cnewpassword){
			$this->session->set_flashdata('flag','alert');
			$this->session->set_flashdata('message','Your new password MUST match your confirmation password');	
		}else{
			$this->load->library('email');
			$data = array('loginpass' => sha1($newpassword),'needreset'=>'0');
			$this->db->where('id', $uid);
			if ($this->db->update('userbase', $data)){
				$this->setNextURL(base_url("login"));

				$body ="Your password reset was successful, and your new password is<br><b>".$newpassword."</b><br>Please note that we do not save users passwords on our database.";
				
				$message = $this->utilities->custom_email_template($body,$email);
									
				$this->email->from('help@powergenerators.com.ng', 'Powergenerators.com.ng');
				$this->email->to($email);
				$this->email->subject('Password Reset Successful');
				$this->email->message($message);
				$this->email->send();
				$this->session->set_flashdata('flag','success');
				$this->session->set_flashdata('message','Your password reset was successful.<br>You can now login');	
			}else{			
				$this->session->set_flashdata('post', $this->input->post());
				$this->session->set_flashdata('flag','failure');
				$this->session->set_flashdata('message','Something went wrong. Please try again later');				
			}
		}
		redirect($this->getNextURL());
	}
	public function deactivate_user(){
		$updata = array('accountstatus' => 2);
		$this->db->where('id', $this->session->userdata('id'));
		$this->db->update('userbase', $updata);
		$this->setNextURL(base_url("login"));
		redirect($this->getNextURL());	
	}
	public function download_member_form(){
		$picturename = "assets/user/dist/pdf/Member_Registration_Form_TCMCS.pdf"; //Specify directory where file is saved
		if (file_exists($picturename)){//Check if any such file exist
			$itema = ".pdf";  $itemb = ".txt";  $itemc = ".text";//Define possible download formats,...pdf,txt,text,rar,zip,tar,tgz,tar.gz
			$itemd = ".zip";  $iteme = ".tar";  $itemf = ".tgz"; $itemg = ".tar.gz"; $itemh = ".doc";
			$name = $picturename;
			if(preg_match("/$itema\$/i", $name)) {
				$myattach = 'application/pdf';
			}elseif(preg_match("/$itemb\$/i", $name)){
				$myattach = 'text/plain';
			}elseif(preg_match("/$itemc\$/i", $name)){
				$myattach = 'text/plain';
			}elseif(preg_match("/$itemd\$/i", $name)){
				$myattach = 'application/zip';
			}elseif(preg_match("/$iteme\$/i", $name)){
				$myattach = 'application/x - tar';
			}elseif(preg_match("/$itemf\$/i", $name)){
				$myattach = 'application/x - tgz';
			}elseif(preg_match("/$itemg\$/i", $name)){
				$myattach = 'application/x - tgz';
			}elseif(preg_match("/$itemh\$/i", $name)){
				$myattach = 'application/msword';
			}elseif(preg_match("/$itemi\$/i", $name)){
				$myattach = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
			}
			//open/save dialog box  
			header('Content-Disposition: attachment; filename="'.$name.'"');
			//content type
			header('Content-type: '.$myattach);
			//read from server and write to buffer
			readfile($picturename);
		}
	}
	public function upload_file($file,$uploadpath,$picturepath,$allowtypes,$field_name,$unlinkpath,$resize,$resizewidth,$resizeheight,$updatefield,$updatetable,$uid,$updatesession="false"){
		$file_name = $uid.rand(0,20000)."_".date("Ymd").'_'.time().".".$this->get_extension($file['name']);
		//$config = array();
		$config['file_name'] = $file_name;
		$config['upload_path'] = $uploadpath;
		$picturename = $picturepath.$file_name;
		
		if(!is_dir($config['upload_path'])){
			if(!mkdir($config['upload_path'], 0777, TRUE)){
			}
		} 
		//users can upload any width/height,
		//but our system will resize them
		$config['allowed_types'] = $allowtypes;
		$config['max_size']	= '4096';
		$config['max_width']  = '0';
		$config['max_height']  = '0';
		$this->load->library('upload', $config);
						
		if ( ! $this->upload->do_upload($field_name)){
			$return = array('error' => $this->upload->display_errors());

			$this->session->set_flashdata('flag','alert');
			$this->session->set_flashdata('message',$this->upload->display_errors());	

		}else{//upload was successful
			if(trim($unlinkpath)!=""){
				@unlink('assets/'.$unlinkpath);
			}
			$return = array('upload_data' => $this->upload->data());
			if($resize){
				$imgpath = $uploadpath.'/'.$return['upload_data']['file_name'];
				$img_array['image_library'] = 'gd2';
				$img_array['source_image'] = $imgpath;
				$img_array['quality'] = 100;
				$img_array['maintain_ratio'] = TRUE;
				$img_array['width'] = $resizewidth;
				$img_array['height'] = $resizeheight;
		
				$this->load->library('image_lib', $img_array);	
				$this->image_lib->resize();
			}
			//update database
			$imgdir = array($updatefield => $picturename);
			$this->db->update($updatetable, $imgdir, "id = ".$uid);
		}//end of success attachment of picture			
	}
	public function get_extension($str) {
	
		 $i = strrpos($str,".");
		 if (!$i) { return ""; } 
	
		 $l = strlen($str) - $i;
		 $ext = substr($str,$i+1,$l);
		 return $ext;
	}
	public function logout(){
		//log users as loggedout in db
		/**$updata = array('loggedin' => 0);
		$this->db->where('id', $this->session->userdata('id'));
		$this->db->update('userbase', $updata);**/

		$this->session->sess_destroy();
		session_destroy();//Then destroy all sessions
		$this->setNextURL(base_url("/login"));
		redirect($this->getNextURL());
	}/* End of logout Method */
}
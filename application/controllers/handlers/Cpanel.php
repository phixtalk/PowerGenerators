<?php

class Cpanel extends CI_Controller {
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
	public function new_service_schedule(){
		$this->load->library('email');
		/*
		ServiceSchedule [id, start_date, technician (i.e. employee), issue, cause, parts_used, service_request_id, service_status(PENDING, COMPLETED)
		*/
		
		$userid = $this->session->userdata('id');
		$email = $this->session->userdata('email');
		$usernames = $this->session->userdata('usernames');
		$global_email = $this->session->userdata('global_email');
		$global_company = $this->session->userdata('global_company');

		$start_date = $this->input->post('start_date'); 
		$technician = $this->input->post('technician'); 
		$issue = $this->input->post('issue'); 
		$cause = $this->input->post('cause'); 
		$parts_used = $this->input->post('parts_used'); 
		$requestid = $this->input->post('requestid'); 
		
		$this->setNextURL(base_url("cpanel/request_details/".$requestid));
		
		$data = array(
		   'start_date' => $start_date ,
		   'technician' => $technician ,
		   'issue' => $issue,
		   'cause' => $cause ,
		   'parts_used' => $parts_used ,
		   'service_request_id' => $requestid,
		   'service_status' => "PENDING",
		   'createdon' => date("Y-m-d H:i:s")  ,
		   'createdby' => $userid,
		   'modifiedon' => date("Y-m-d H:i:s")  ,
		   'modifiedby' => $userid
		);
		
		if ($this->db->insert('service_schedule', $data)){
			$this->session->set_flashdata('flag','success');
			$this->session->set_flashdata('message','New Service Schedule was created successfully.');
			
			/*
			$body ="Your Service Request was sent successfully<br>
			Appropriate channels have been notified.<br>We will get back to you shortly.<br>Thank you.";
			$message = $this->utilities->custom_email_template($body,$email);
				
			$this->email->from($global_email, $global_company);
			$this->email->to($email);	
			$this->email->subject('New Service Request');
			$this->email->message($message);				
			$this->email->send();			
			
			$this->email->clear(TRUE);
			
			$body2="This is a notification that <i>".$usernames."</i> has just generated a new service request.<br>Please attend to it.";
			$message2 = $this->utilities->custom_email_template($body2,$global_email);
			$this->email->from($global_email, $global_company);
			$this->email->to($global_email);	
			$this->email->subject('New Signup Submission');
			$this->email->message($message2);				
			$this->email->send();
			*/
		}else{
			$this->session->set_flashdata('flag','failure');
			$this->session->set_flashdata('message','Sorry an error occurred. Please try again later');
			$this->session->set_flashdata('accountpost', $this->input->post());
		}
		
		redirect($this->getNextURL());
	}
	public function new_invoice(){
		//$this->setNextURL(base_url("cpanel/service_requests"));
		
		$userid = $this->session->userdata('id');
		$email = $this->session->userdata('email');
		$usernames = $this->session->userdata('usernames');
		$global_email = $this->session->userdata('global_email');
		$global_company = $this->session->userdata('global_company');

		$description = $this->input->post('description'); 
		$total_amount = $this->input->post('total_amount'); 
		$discount_amount = $this->input->post('discount_amount');
		//$paid_amount = $this->input->post('paid_amount');
		$record_date = $this->input->post('record_date');
		$rid = $this->input->post('rid'); 
		
		$this->setNextURL(base_url("cpanel/request_details/".$rid));
		
		//Invoice [id, description, total_amount, paid_amount, amount_owed, createdon, i_status, payment_count (PENDING, OWING, PAID), service_request_id]
		
		$data = array(
		   'description' => $description ,
		   'total_amount' => $total_amount ,
		   'discount_amount' => $discount_amount ,
		   'amount_owed' => ($total_amount - $discount_amount),
		   'i_status' => 'PENDING',
		   'payment_count' => 1,
		   'service_request_id' => $rid,
		   'record_date' => $record_date,
		   'createdon' => date("Y-m-d H:i:s"),
		   'createdby' => $userid
		);
		
		if ($this->db->insert('invoices', $data)){
			$this->session->set_flashdata('flag','success');
			$this->session->set_flashdata('message','Invoice was generated successfully.');
		}else{
			$this->session->set_flashdata('flag','failure');
			$this->session->set_flashdata('message','Sorry an error occurred. Please try again later');
			$this->session->set_flashdata('accountpost', $this->input->post());
		}
		
		redirect($this->getNextURL());
	}
	public function new_payment(){
		$userid = $this->session->userdata('id');
		$email = $this->session->userdata('email');
		$usernames = $this->session->userdata('usernames');
		$global_email = $this->session->userdata('global_email');
		$global_company = $this->session->userdata('global_company');

		$description = $this->input->post('description'); 
		$customer_id = $this->input->post('customer_id'); 
		$invoice_id = $this->input->post('invoice_id');
		$request_id = $this->input->post('request_id');
		$amount = $this->input->post('amount');
		$payment_date = $this->input->post('payment_date');
		$payment_method = $this->input->post('payment_method');
		$balance = $this->input->post('balance');
		
		$this->setNextURL(base_url("cpanel/request_details/".$request_id));
		if($amount<=$balance){
			$data = array(
			   'description' => $description ,
			   'customer_id' => $customer_id ,
			   'invoice_id' => $invoice_id ,
			   'request_id' => $request_id,
			   'amount' => $amount,
			   'payment_date' => $payment_date,
			   'payment_method' => $payment_method,
			   'added_on' => date("Y-m-d H:i:s"),
			   'added_by' => $userid
			);
			if ($this->db->insert('payments', $data)){
				//next check invoice status, increase paid amount, decrease amount_owed accordingly
				$sql = 'UPDATE invoices set paid_amount=paid_amount+?, amount_owed=amount_owed-? WHERE id=?';
				$this->db->query($sql, array($amount,$amount,$invoice_id));
				if($amount==$balance){//update invoice status if balance is 0
					$sql2 = "UPDATE invoices set i_status = 'PAID' WHERE id=?";
					$this->db->query($sql2, array($invoice_id));
				}
				$this->session->set_flashdata('flag','success');
				$this->session->set_flashdata('message','Payment was registered successfully.');
			}else{
				$this->session->set_flashdata('flag','failure');
				$this->session->set_flashdata('message','Sorry an error occurred. Please try again later');
				$this->session->set_flashdata('accountpost', $this->input->post());
			}
		}else{
			$this->session->set_flashdata('flag','alert');
			$this->session->set_flashdata('message','Amount paid should be lower or equal to amount owed.');
		}
		redirect($this->getNextURL());
	}
	public function new_employee(){
		$this->setNextURL(base_url("cpanel/employees"));
		//$this->load->library('email');
		/*
		Employee [id, gender, first_name, last_name, state, employment_date, role (DIRECTOR, TECHNICIAN, ADMIN)]
		*/
		
		$userid = $this->session->userdata('id');
		$email = $this->session->userdata('email');
		$usernames = $this->session->userdata('usernames');
		$global_email = $this->session->userdata('global_email');
		$global_company = $this->session->userdata('global_company');

		$gender = $this->input->post('gender'); 
		$first_name = $this->input->post('first_name'); 
		$last_name = $this->input->post('last_name'); 
		$state = $this->input->post('state'); 
		$employment_date = $this->input->post('employment_date'); 
		$role = $this->input->post('role'); 
		
		$data = array(
		   'gender' => $gender ,
		   'first_name' => $first_name ,
		   'last_name' => $last_name,
		   'stateid' => $state ,
		   'employment_date' => $employment_date,
		   'role' => $role,
		   'createdon' => date("Y-m-d H:i:s")  ,
		   'createdby' => $userid,
		   'modifiedon' => date("Y-m-d H:i:s")  ,
		   'modifiedby' => $userid
		);
		
		if ($this->db->insert('employee', $data)){
			$uid = $this->db->insert_id();
			if(isset($_FILES['userfile'])&&$_FILES['userfile']['name']!=""){//for passport upload
				$picturepath = "user/passport/";	
				$uploadpath="assets/user/passport";
				$allowtypes='gif|jpg|png|jpeg';
				$field_name="userfile";//passport
				$unlinkpath="";
				$resize=true;					
				$resizewidth=180;
				$resizeheight=180;
				$updatefield="picture";//passport field
				$updatetable="employee";					
				$this->upload_file($_FILES['userfile'],$uploadpath,$picturepath,$allowtypes,$field_name,$unlinkpath,$resize,$resizewidth,$resizeheight,$updatefield,$updatetable,$uid);
			}
			$this->session->set_flashdata('flag','success');
			$this->session->set_flashdata('message','New Employee record was created successfully.');
		}else{
			$this->session->set_flashdata('flag','failure');
			$this->session->set_flashdata('message','Sorry an error occurred. Please try again later');
			$this->session->set_flashdata('accountpost', $this->input->post());
		}
		
		redirect($this->getNextURL());
	}
	public function new_customer(){
		$this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
		$this->form_validation->set_rules('lastname', 'Surname', 'trim|required');
		$this->form_validation->set_rules('mobile', 'Phone Number', 'trim|required|is_unique[userbase.mobile]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[userbase.email]');
		$this->load->model('entity');
		$this->setNextURL(base_url("cpanel/customers"));
		
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
			$organization = $this->input->post('organization'); 
			$confirmpass = $this->input->post('confirmpass');
			//;
			
			$data = array(
			   'firstname' => $firstname ,
			   'lastname' => $lastname ,
			   'usernames' => $lastname." ".$firstname,
			   'mobile' => $mobile ,
			   'organization' => $organization ,
			   'email' => $email ,
			   'city' => $city ,
			   'state' => $state ,
			   'loginpass' => sha1($password),
			   'createdon' => date("Y-m-d H:i:s") ,
			   'modifiedon' => date("Y-m-d H:i:s") 
			   
			);
			
			if ($this->db->insert('userbase', $data)){
				$uid = $this->db->insert_id();
				
				$body ="Your Sign Up was Successfully<br>
				Thank you<br>";
				$message = $this->utilities->custom_email_template($body,$email);
					
				$this->email->from('help@powergenerators.com.ng', 'Powergenerators.com.ng');
				$this->email->to($email);	
				$this->email->subject('Powergenerators.com.ng SignUp Successful');
				$this->email->message($message);				
				$this->email->send();			
				
				$this->email->clear(TRUE);
				
				$body2="This is a notification that <i>".$lastname.", ".$firstname."</i> has just registered on the powergenerators.com.ng Platform.<br>Thank you.";
				$message2 = $this->utilities->custom_email_template($body2,'help@powergenerators.com.ng');
				$this->email->from('help@powergenerators.com.ng', 'Powergenerators.com.ng');
				$this->email->to('help@powergenerators.com.ng');	
				$this->email->subject('New Signup Submission');
				$this->email->message($message2);				
				$this->email->send();
				$this->session->set_flashdata('flag','success');
				$this->session->set_flashdata('message','Customer registration was successful.');
				//$this->setNextURL(base_url("login"));
				
			}else{
				$this->session->set_flashdata('flag','failure');
				$this->session->set_flashdata('message','Sorry an error occurred. Please try again later');
				$this->session->set_flashdata('accountpost', $this->input->post());
			}
			//$this->db->trans_off();//DISABLE TRANSACTION
		}
		
		redirect($this->getNextURL());
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
}
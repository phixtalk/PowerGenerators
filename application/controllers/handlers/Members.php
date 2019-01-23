<?php

class Members extends CI_Controller {
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
	public function contribution(){
		$this->load->model('entity');
		$uid = $this->session->userdata('id');
		$sender = $this->session->userdata('usernames');
		
		$global_email = $this->session->userdata('global_email');
		$global_company = $this->session->userdata('global_company');
		
		$mode = $this->input->get_post('mode');
		$member = $this->session->userdata('usernames');
		$memberid = $this->session->userdata('memberid');
		$amount = $this->input->get_post('amount');
		$paymentdate = $this->input->get_post('paymentdate');
		$paymentmode = $this->input->get_post('paymentmode');
		$month = $this->input->get_post('month');
		$year = $this->input->get_post('year');
		$description = $this->input->get_post('description');
					
		$noticeType="";
		$non="";
		$wc="Withdrawable Contribution";
		if($mode==1){
			$this->setNextURL(base_url("members/non_withdraw_contribute/?mode=2"));
			$noticeType="NON-WITHDRAWABLE";
			$non="Non";
		}elseif($mode==2){
			$this->setNextURL(base_url("members/withdraw_contribute/?mode=2"));
			$noticeType="WITHDRAWABLE";
		}else{
			$this->setNextURL(base_url("members/withdrawals/?mode=2"));
			$noticeType="WITHDRAWALS";
			$wc="Withdrawals";
			//$pdate = explode("-",$paymentdate);
			$month = NULL;
			$year = NULL;
			$paymentdate = NULL;
			$paymentmode = NULL;
		}
		if($amount!=""){
			$this->load->library('email');
			$this->db->trans_start();//START TRANSACTION
			$updata = array(
			   'monthPeriodId'  => $month,
			   'yearId'  => $year,
			   'amount'  => $amount,
			   'paymentMethod'  => $paymentmode,
			   'memberId'  => $memberid,
			   'postedByName'  => $sender,
			   'postedOn'  => date("Y-m-d H:i:s"),
			   'postedById'  => $uid,
			   'paymentDate'  => $paymentdate,
			   'description'  => $description,
			   'noticeType'  => $noticeType
			);
			$this->db->insert('notifications', $updata);
			$nid = $this->db->insert_id();
			$this->db->trans_complete();//STOP TRANSACTION
			if ($this->db->trans_status() === FALSE){
				$this->session->set_flashdata('flag','failure');
				$this->session->set_flashdata('message','Something went wrong. Please try again later');
			}else{
				if(isset($_FILES['picture'])&&$_FILES['picture']['name']!=""){//for receipt upload
					$picturepath = "user/receipts/";	
					$uploadpath="assets/user/receipts";
					$allowtypes='gif|jpg|png|jpeg';
					$field_name="picture";//signature
					$unlinkpath="";//$this->input->post('currentsign');
					$resize=true;					
					$resizewidth=400;
					$resizeheight=180;
					$updatefield="receiptDirectory";//signature
					$updatetable="notifications";					
					$this->upload_file($_FILES['picture'],$uploadpath,$picturepath,$allowtypes,$field_name,$unlinkpath,$resize,$resizewidth,$resizeheight,$updatefield,$updatetable,$nid);
				}
				$body ="<span style='font-family: verdana, helvetica, sans-serif;font-size:14px'>Hello Admin, 
				This is to notify you that ".$member." just posted a new notification for a ".$non." ".$wc." payment transaction. See details below<br>
				Payment Date: ".$this->utilities->system_date($paymentdate)."
				Period: ".substr($this->utilities->convert_month($month),0,3)." ".$year."
				Payment Method: ".$paymentmode."
				Amount: N".$this->utilities->format_number($amount)."
				Description: ".$description."
				Posted On: ".$this->utilities->system_date(date("Y-m-d H:i:s"))."<br><br>";

				$message = $this->utilities->custom_email_template($body,$global_email);
				$this->email->from($global_email, $global_company);
				$this->email->to($global_email);
				//$this->email->cc("charles_unn@yahoo.com"); 
				//$this->email->bcc("ofoefulec_fny@yahoo.com"); 
				$this->email->subject($non." ".$wc." Notification");
				$this->email->message($message);				
				$this->email->send();
				
				$this->session->set_flashdata('flag','success');
				$this->session->set_flashdata('message','Notification was sent successful.');
			}
		}else{
			$this->session->set_flashdata('flag','info');
			$this->session->set_flashdata('message','Please enter all amount.');
		}
		redirect($this->getNextURL());
	}
	public function edit_profile(){
		$this->form_validation->set_rules('city', 'City', 'trim|required');
		$this->form_validation->set_rules('address', 'Address', 'trim|required');
		$this->form_validation->set_rules('state', 'State', 'trim|required');
		
		$this->setNextURL($this->input->post('nexturl'));
		$memberid = $this->input->post('memberid');
		//echo $memberid;exit;
		$this->load->model('entity');
		
		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('flag','alert');
			$this->session->set_flashdata('message',validation_errors());
			$this->session->set_flashdata('accountpost', $this->input->post());			
		} else {
			$this->load->library('email');
			
			$address = $this->input->post('address'); 
			$city = $this->input->post('city'); 
			$state = $this->input->post('state'); 
			
			$data = array(
			   'address' => $address ,
			   'city' => $city ,
			   'state' => $state
			);
			
			$this->db->where('email', $memberid);

			if ($this->db->update('userbase', $data)){
				//next update pictures
				/*
				if(isset($_FILES['userfile'])&&$_FILES['userfile']['name']!=""){//for passport upload
					$picturepath = "user/passport/";	
					$uploadpath="assets/user/passport";
					$allowtypes='gif|jpg|png|jpeg';
					$field_name="userfile";//passport
					$unlinkpath=$this->input->post('currentpic');
					$resize=true;					
					$resizewidth=180;
					$resizeheight=180;
					$updatefield="picture";//passport field
					$updatetable="userbase";					
					$this->upload_file($_FILES['userfile'],$uploadpath,$picturepath,$allowtypes,$field_name,$unlinkpath,$resize,$resizewidth,$resizeheight,$updatefield,$updatetable,$memberid,"loginid");
				}
				*/
				$this->session->set_flashdata('flag','success');
				$this->session->set_flashdata('message','Profile Information updated successfully.');
			}else{
				$this->session->set_flashdata('flag','failure');
				$this->session->set_flashdata('message','Sorry an error occurred. Please try again later');
				$this->session->set_flashdata('accountpost', $this->input->post());
			}
		}
		
		redirect($this->getNextURL());
	}
	public function upload_file($file,$uploadpath,$picturepath,$allowtypes,$field_name,$unlinkpath,$resize,$resizewidth,$resizeheight,$updatefield,$updatetable,$uid,$update_field="id"){
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
		$config['max_size']	= '2048';
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
			$this->db->update($updatetable, $imgdir, $update_field." = ".$uid);
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
<?php

class Services extends CI_Controller {
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
	public function new_request(){
		$this->form_validation->set_rules('service_type', 'Service Type', 'trim|required');
		$this->form_validation->set_rules('desired_date', 'Desired Date', 'trim|required');
		$this->form_validation->set_rules('generator_type', 'Generator Make', 'trim|required');
		$this->form_validation->set_rules('generator_kva', 'Generator KVA', 'trim|required');
		$this->form_validation->set_rules('address', 'Address of Location', 'trim|required');
		$this->form_validation->set_rules('state', 'State of Location', 'trim|required');
		$this->form_validation->set_rules('description', 'Description', 'trim|required');
		
		$userid = $this->input->post('userid'); 
		
		if($this->input->post('usermode')=="CUSTOMER"){
			$this->setNextURL(base_url("services/new_request"));
		}else{
			$this->setNextURL(base_url("services/new_request/?customerid".$userid));
		}
		
		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('flag','alert');
			$this->session->set_flashdata('message',validation_errors());
			$this->session->set_flashdata('accountpost', $this->input->post());			
		} else {
			$this->load->library('email');
			//id, user_id, service_type, source_type, submitted_on, desired_date, completion_date, a_status, generator_type, generator_kva, state, address, description
		
			//$userid = $this->session->userdata('id');
			$email = $this->session->userdata('email');
			$usernames = $this->session->userdata('usernames');
			$global_email = $this->session->userdata('global_email');
			$global_company = $this->session->userdata('global_company');

			$service_type = $this->input->post('service_type'); 
			$desired_date = $this->input->post('desired_date'); 
			$generator_type = $this->input->post('generator_type'); 
			$generator_kva = $this->input->post('generator_kva'); 
			$description = $this->input->post('description'); 
			$state = $this->input->post('state'); 
			$address = $this->input->post('address');
			
			
			$data = array(
			   'user_id' => $userid ,
			   'service_type' => $service_type ,
			   'source_type' => 1,
			   'submitted_on' => date("Y-m-d H:i:s")  ,
			   'desired_date' => $desired_date ,
			   'generator_type' => $generator_type,
			   'generator_kva' => $generator_kva ,
			   'description' => $description ,
			   'state' => $state,
			   'address' => $address
			);
			
			if ($this->db->insert('servicerequest', $data)){
				$this->session->set_flashdata('flag','success');
				$this->session->set_flashdata('message','New Service Request was sent successfully. Thank you.');
				
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
				
				if($this->input->post('usermode')=="CUSTOMER"){
					$this->setNextURL(base_url("dashboard"));
				}else{
					$this->setNextURL(base_url("cpanel/customers"));
				}
		
			}else{
				$this->session->set_flashdata('flag','failure');
				$this->session->set_flashdata('message','Sorry an error occurred. Please try again later');
				$this->session->set_flashdata('accountpost', $this->input->post());
			}
		}
		
		redirect($this->getNextURL());
	}
	
}
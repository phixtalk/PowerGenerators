<?
$userid = $this->session->userdata('id');
$memberid = $this->session->userdata('email');
$usernames = $this->session->userdata('usernames');
$registeredon = $this->session->userdata('registeredon');
$stateid = $this->session->userdata('state');

$closeurl=base_url("dashboard");
$customer_caption = "";
$usermode = "CUSTOMER";
if($this->session->userdata('isadmin')==1){
	if(is_numeric($this->input->get('customerid'))&&$this->input->get('customerid')>0){
		$userid = $this->input->get('customerid');
		$query = $this->db->query("SELECT a.usernames FROM userbase a WHERE a.isadmin='0' AND a.id = ?",array($userid));
		
		if($query->num_rows()>0){
			$get_row = $query->row_array();
			$usermode = "ADMIN";
			$customer_caption = "<b style='color:green'>Service Request For: ".$get_row['usernames']."</b>";
		}
		$closeurl=base_url("cpanel/customers");
	}
}
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->	
    <section class="content-header">
	  <div class="row">
		<div class="col-md-5">
			<h5 class="text-primary" style="font-size:24px;font-weight:500">New Service/Repair Request</h5>
		</div>
		<!--
		<div class="col-md-3"><h5 style="font-size:20px;font-weight:200">My Login ID: <?=$memberid?></h5></div>
		-->
		<div class="col-md-5">
			<h5 style="font-size:15px;font-weight:200">
				<b>Help Desk:</b> <i class="fa fa-phone"></i> 07032440565.
				<br>
				<i class="fa fa-envelope"></i> help@generators.com.ng
			</h5>
		</div>
		
	  </div>
	  <?=$this->utilities->get_bread_crumbs($crumb)?>
    </section>

    <!-- Main content -->
    <section class="content">
	
		<div class="row" style="background-color:#fff">
			
			<div class="col-md-1"></div>
			
			<div class="col-md-10">
				
				<div class="box">
					<hr style="margin-top:0px;margin-bottom:0px;border-top:2px solid #eee">
			
					<?php

						echo $this->utilities->
							show_notification(
							$this->session->flashdata('flag'),
							$this->session->flashdata('message')
							);
						
						$attributes = array(
						'name' => 'loginForm',
						'class' => 'form-signin',
						'enctype' => 'multipart/form-data',
						'data-parsley-validate' => ''
						);

						echo form_open('handlers/services/new_request/', $attributes);
						$account = $this->session->flashdata('accountpost');
					?>
							<table class="table table-striped" cellspacing="200" cellpadding="200" style="font-size:16px">
								
								<tr>
									<td align="center" colspan="2">
										Please fill the form below to submit a New Service/Repair Request<br>
										PLEASE NOTE:
										All Asterisk <span style="color:#A00">*</span> Fields are Required
										<br>
										<?=$customer_caption?>
									</td>
								</tr>
								
								
								<tr>
									<td align="left"><span style="color:#A00">*</span> Service Type:</td>
									<td align="left" width="80%">
										<select name="service_type" class="form-control" data-parsley-required="true">
											<option value="">Select Service Type</option>
											<option value="MAINTENANCE" <?=$account['service_type']=="MAINTENANCE"?"selected":""?>>MAINTENANCE</option>
											<option value="REPAIR" <?=$account['service_type']=="REPAIR"?"selected":""?>>REPAIR</option>
										</select>
									</td>
								</tr>
								<tr>
									<td align="left"><span style="color:#A00">*</span> Desired Date:</td>
									<td align="left">
										
										<div class="input-group date">
										  <div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										  </div>
										  <input type="text" class="form-control pull-right datepicker" name="desired_date" value="<?php echo $account['desired_date'];?>">
										</div>
										
									</td>
								</tr>
								<tr>
									<td align="left"><span style="color:#A00">*</span> Generator Make:</td>
									<td align="left">
										<input type="text" class="form-control" name="generator_type" data-parsley-required="true" value="<?php echo $account['generator_type'];?>">
									</td>
								</tr>
								<tr>
									<td align="left"><span style="color:#A00">*</span> Generator KVA:</td>
									<td align="left">
										<input type="text" class="form-control" name="generator_kva" data-parsley-required="true" value="<?php echo $account['generator_kva'];?>">
									</td>
								</tr>
								<tr>
									<td align="left"><span style="color:#A00">*</span> Description of Issue:</td>
									<td align="left">
										<textarea name="description" class="form-control" data-parsley-required="true" style="resize:none"><?php echo $account['description'];?></textarea>
									</td>
								</tr>
								<?	
									$get_states = $this->entity->get_all_states();
									$cur_state = $stateid;
									if($account['state']!=""){
										$cur_state = $account['state'];
									}
								?>
								<tr>
									<td align="left"><span style="color:#A00">*</span> State of Location:</td>
									<td align="left">
										<select name="state" class="form-control" data-parsley-required="true">
											<option value="">Select State of Residence</option>
											<?	foreach($get_states as $row){?>
													<option value="<?=$row['id']?>" <?=$cur_state==$row['id']?"selected":""?>><?=$row['name']?></option>
											<?	}?>
										</select>
									</td>
								</tr>
								<tr>
									<td align="left"><span style="color:#A00">*</span> Address of Location:</td>
									<td align="left">
										<textarea name="address" class="form-control" data-parsley-required="true" placeholder="please enter a descriptive address" style="resize:none"><?php echo $account['address'];?></textarea>
									</td>
								</tr>
								<tr>
									<td align="left"></td>
									<td align="left">
										<button type="submit" class="btn btn-primary  btn-flat">Submit Request <i class="fa fa-check"></i></button>
										<a href="<?=$closeurl?>" class="btn  btn-danger ">Cancel <i class="fa fa-remove"></i></a>
									</td>
								</tr>
							</table>
							<input type="hidden" name="userid" value="<?=$userid?>" />
							<input type="hidden" name="usermode" value="<?=$usermode?>" />
							
					<?php echo form_close(); ?>
				
				</div>
			   
			  <!-- /.box -->

			  
			  <!-- /.box -->
			</div>
			
			<div class="col-md-1"></div>
		
<link href="<?php echo base_url()?>assets/user/plugins/parsley/parsley.css" rel="stylesheet">
<script src="<?php echo base_url()?>assets/user/plugins/parsley/parsley.min.js"></script>
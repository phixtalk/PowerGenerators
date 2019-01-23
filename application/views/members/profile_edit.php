<?
$userid = $this->session->userdata('id');
$memberid = $this->session->userdata('email');
$usernames = $this->session->userdata('usernames');
$registeredon = $this->session->userdata('registeredon');

$nexturl=base_url("profile/edit");
$closeurl=base_url("profile");
if($this->session->userdata('isadmin')==1){
	if($this->input->get('mid')){
		$memberid = $this->input->get('mid');
		$nexturl=base_url("cpanel/member_edit/?mid=".$memberid);
		$closeurl=base_url("cpanel/member_view/?mid=".$memberid);
	}
}

$member = $this->entity->get_member_by_id($memberid);
$passport="user/dist/img/avatarr.png";
if(count($member)>0){
	//$passport=$member['picture'];
}

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->	
    <section class="content-header">
	  <div class="row">
		<div class="col-md-5"><h5 class="text-primary" style="font-size:24px;font-weight:500">Edit Profile</h5></div>
		<!--<div class="col-md-3"><h5 style="font-size:20px;font-weight:200">My Login ID: <?=$memberid?></h5></div>-->
		<div class="col-md-3">
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
	
		<div class="row">
<?php
		/**
		echo $this->utilities->
			show_notification(
			$this->session->flashdata('flag'),
			$this->session->flashdata('message')
			);**/
	?>			
					
			<div class="col-md-3">
				
				<div class="box">
            <!-- /.box-header -->
					<!--<div class="box-header with-border">
					  <div class="alert alert-info"><h3>STEP 1:</h3></div>
					</div>-->
					<div class="box-body no-padding longText">
					  <table class="table " style="font-size:20px">                
						<tr>
						  <td colspan="2">
							<img src="<?=base_url("assets/".$passport)?>" width="100%" class="user-image" alt="User Image">							 
						  </td>
						</tr>
						<!--
						<tr>
						  <td>
								<a href="<?=base_url("profile")?>" class="btn pull-left btn-default "><i class="fa fa-user"></i> My Profile</a>
						  </td>
						  <td>
							 <a href="<?=base_url("profile/edit")?>" class="btn pull-right btn-default "><i class="fa fa-edit"></i> Edit Profile</a>
						  </td>
						</tr>
						
						<tr>  
						  <td colspan="2">
							<a href="<?=base_url("handlers/handle/logout")?>" class="btn btn-block btn-danger"><i class="fa fa-power-off"></i> Sign Out</a>
						  </td>
						</tr>
						-->
					  </table>
					</div>
					<!-- /.box-body -->
					<div class="box-footer clearfix">
					  
					</div>
				  </div>
				 
			</div>
			
			
      
			<div class="col-md-9">
					
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

						echo form_open('handlers/members/edit_profile/', $attributes);
						$account = $this->session->flashdata('accountpost');
						
						if(count($member)>0){
					?>
							<table class="table table-striped" cellspacing="200" cellpadding="200" style="font-size:16px">
								
								<tr>
									<td align="left">
										<h4 style="color:#f67721;font-weight:bold;">BIO DATA</h4>
									</td>
									<td align="right" width="80%">
										<a href="<?=base_url("profile")?>" class="btn  btn-danger ">Close <i class="fa fa-remove"></i></a>
									</td>
								</tr>
								
								
								<tr>
									<td align="left"><b>Full Names:</b></td>
									<td align="left" width="80%"><?=$member['usernames']?></td>
								</tr>
								<tr>
									<td align="left"><b>Email:</b></td>
									<td align="left"><?=$member['email']?></td>
								</tr>
								<tr>
									<td align="left"><b>Phone:</b></td>
									<td align="left"><?=$member['mobile']?></td>
								</tr>
								<tr>
									<td align="left"><b>City:</b></td>
									<td align="left">
										<input type="text" class="form-control" name="city" placeholder="City" data-parsley-required="true" value="<?php echo $member['city'];?>">
									</td>
								</tr>
								<?	$get_states = $this->entity->get_all_states();?>
								<tr>
									<td align="left"><b>State:</b></td>
									<td align="left">
										<select name="state" class="form-control" data-parsley-required="true">
											<option value="">Select State of Residence</option>
											<?	foreach($get_states as $row){?>
													<option value="<?=$row['id']?>" <?=$member['state']==$row['id']?"selected":""?>><?=$row['name']?></option>
											<?	}?>
										</select>
									</td>
								</tr>
								<tr>
									<td align="left"><b>Address:<b></td>
									<td align="left">
										<textarea name="address" class="form-control" placeholder="Contact Address" data-parsley-required="true"><?php echo $member['address'];?></textarea>
									</td>
								</tr>
								<tr>
									<td align="left"></td>
									<td align="left">
										<button type="submit" class="btn btn-primary  btn-flat">Update Profile<i class="fa fa-check"></i></button>
									</td>
								</tr>
							</table>
							<input type="hidden" name="memberid" value="<?=$memberid?>" />
							<input type="hidden" name="nexturl" value="<?=$nexturl?>" />
					<?	}else{?>
							<div class="alert alert-info">Sorry, no record was found with this ID</div>
					<?	}?>
					
					<?php echo form_close(); ?>
				
				</div>
			   
			  <!-- /.box -->

			  
			  <!-- /.box -->
			</div>
		
<link href="<?php echo base_url()?>assets/user/plugins/parsley/parsley.css" rel="stylesheet">
<script src="<?php echo base_url()?>assets/user/plugins/parsley/parsley.min.js"></script>
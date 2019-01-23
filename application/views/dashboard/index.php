<?
$userid = $this->session->userdata('id');
$memberid = $this->session->userdata('email');
$usernames = $this->session->userdata('usernames');
$registeredon = $this->session->userdata('registeredon');
$passport = $this->session->userdata('passport');
if($passport==""){
	$passport="user/dist/img/avatarr.png";
}
//$stats = $this->entity->get_member_dashboard_stats($userid);
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->	
    <section class="content-header">
	  <div class="col-md-12">
		<div class="col-md-3"><h5 style="font-size:24px;font-weight:500">MY DASHBOARD</h5></div>
		<div class="col-md-3"><h5 style="font-size:20px;font-weight:200">My Login ID: <?=$memberid?></h5></div>
		<div class="col-md-4">
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
					  </table>
					</div>
					<!-- /.box-body -->
					<div class="box-footer clearfix">
					  
					</div>
				  </div>
				 
			</div>
			
			
      
			<div class="col-md-9">
			  <div class="box">
			  
				<?php
					echo $this->utilities->
						show_notification(
						$this->session->flashdata('flag'),
						$this->session->flashdata('message')
						);
				?>
			<hr style="margin-top:0px;margin-bottom:0px;border-top:2px solid #eee">
			
				<?php
					
					$attributes = array(
					'name' => 'loginForm',
					'class' => 'form-signin',
					'enctype' => 'multipart/form-data',
					'data-parsley-validate' => ''
					);

					echo form_open('handlers/upgrade/new_payment/', $attributes);
					$account = $this->session->flashdata('accountpost');
				?>
				
				<br><br>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="col-md-4">
						<a href="<?=base_url("services/new_request")?>" class="btn btn-block btn-success btn-lg"><i class="fa fa-wrench fa-3x"></i><br>Request New Service</a>
					</div>
					<div class="col-md-4">
						<a href="<?=base_url("services")?>" class="btn btn-block btn-primary btn-lg"><i class="fa fa-external-link fa-3x"></i><br>My Service History</a>
					</div>
					<div class="col-md-4">
						<a href="<?=base_url("services/bills")?>" class="btn btn-block btn-warning btn-lg"><i class="fa fa-money fa-3x"></i><br>My Bills</a>
					</div>
				</div>
				
				<div class="box-body">
					<div class="col-md-4">
						<a href="<?=base_url("profile")?>" class="btn btn-block btn-primary btn-lg"><i class="fa fa-user fa-3x"></i><br>My Profile</a>
					</div>
					<div class="col-md-4">
						<a href="<?=base_url("profile/edit")?>" class="btn btn-block btn-warning btn-lg"><i class="fa fa-pencil fa-3x"></i><br>Edit Profile</a>
					</div>
					<div class="col-md-4">
						<a href="#" class="btn btn-block btn-danger btn-lg"><i class="fa fa-power-off fa-3x"></i><br>Signout</a>
					</div>
				</div>
				
				
				<!-- /.box-body -->
				
				<?php echo form_close(); ?>
			  </div>
			   
			  <!-- /.box -->

			  
			  <!-- /.box -->
			</div>
		
<link href="<?php echo base_url()?>assets/user/plugins/parsley/parsley.css" rel="stylesheet">
<script src="<?php echo base_url()?>assets/user/plugins/parsley/parsley.min.js"></script>
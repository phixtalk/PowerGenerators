<style>
	.parsley-required{
		color:#A00;
	}
</style>
<!-- MAIN WRAPPER -->
<!--<div class="body-wrap">-->
<br>
<section class="wide-50 services-section division">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-5">
				<div class="card form-card form-card--style-2">
					<div class="form-header text-center">
						<div class="form-header-icon">
							<i class="icon ion-log-in"></i>
						</div>
					</div>
					<div class="form-body">
						<div class="text-center px-2">
							<h4 class="heading heading-4 strong-400 mb-4" style="font-size:25px">Sign in to your account</h4>
						</div>
						
						<?
							echo $this->utilities->
							show_notification(
							$this->session->flashdata('flag'),
							$this->session->flashdata('message')
							);
							$attributes = array(
							'name' => 'loginForm',
							'class' => 'form-default',
							'id' => 'frmLogin',
							'role' => 'form',
							'data-parsley-validate' => ''
							);
							echo form_open('handlers/handle/login', $attributes);
							$valuser="";
							$valpass="";
							$postdata = $this->session->flashdata('loginpost'); 		
							if($postdata['loginid']!=""){
								$valuser=$postdata['loginid'];
								$valpass=$postdata['password'];
							}elseif($this->input->cookie('gnuser')!=""){
								$valuser=$this->input->cookie('gnuser');
								$valpass=$this->input->cookie('gnpass');
							}
						?>
							
							<div class="row">
								<div class="col-12">
									<div class="form-group">
										<label>Email or Phone Number</label>
										<input type="phone" class="form-control form-control-lg" name="loginid" value="<?php echo $valuser?>" data-parsley-required="true">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-12">
									<div class="form-group has-feedback">
										<label>Password</label>
										<input type="password" class="form-control form-control-lg" name="password" value="<?php echo $valpass?>" data-parsley-required="true">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-6">
									<div class="checkbox" style="cursor:pointer">
										<input type="checkbox" name="remember" id="chkRemember" style="cursor:pointer">
										<label style="cursor:pointer" for="chkRemember">Remember me</label>
									</div>
								</div>
								<div class="col-6 text-right">
									<i class="fa fa-lock"></i>
									<a href="<?=base_url("forgot")?>" class="" style="color:#00a;text-decoration:underline">Forgot Password</a>
								</div>
							</div>
							<button type="submit" class="btn btn-blue btn-lg btn-block btn-arrow submit">
								<span>Login <i class="fa fa-play" aria-hidden="true"></i></span>	
							</button>
											
						<?php if($this->input->get('redir')!=""&&$this->input->get('nxturl')!=""){?>
							<input type="hidden" name="redir" value="true"/>
							<input type="hidden" name="nxturl" value="<?php echo $this->input->get('nxturl')?>"/>
						<? }?>
									
					<?php echo form_close(); ?>
					</div>
				</div>
				<br>
				<!-- Form auxiliary links -->
				<div class="form-user-footer-links pt-2">
					<div class="row">
						
						<div class="col-12">
							Don't have an Account? <i class="fa fa-user"></i>
							<a href="<?=base_url("signup")?>" class="" style="color:#00a;text-decoration:underline"> Register Now</a>
						</div>
						
						
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- </div>END: body-wrap -->

<!-- SCRIPTS -->
<a href="#" class="back-to-top btn-back-to-top"></a>
<link href="<?php echo base_url()?>assets/parsley/parsley.css" rel="stylesheet">
<script src="<?php echo base_url()?>assets/parsley/parsley.min.js"></script>
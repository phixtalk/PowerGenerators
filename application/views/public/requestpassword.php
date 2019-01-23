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
							<p class="login-box-msg text-left"><b class="" style="font-weight:bold;color:#008800;font-size:16px">Forgot username or password ?</b><br><b style="">Enter your email address and we'll send you a link to reset your password.</b></p>
							<br><b>If you do not have an email account, Please contact the Administrator with your Member ID to reset it.</b>
						</div><br/><br/>
						
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
							echo form_open('handlers/handle/request_password', $attributes);
							$account = $this->session->flashdata('accountpost'); 		
						?>
							
							<div class="row">
								<div class="col-12">
									<div class="form-group">
										<label>Email</label>
										<input type="email" class="form-control form-control-lg" name="rstemail" data-parsley-required="true">
									</div>
								</div>
							</div>

							<button type="submit" class="btn btn-green btn-lg btn-block btn-arrow submit">
								<span>Submit <i class="fa fa-play" aria-hidden="true"></i></span>	
							</button>
									
					<?php echo form_close(); ?>
					</div>
				</div>
				<br>
				<!-- Form auxiliary links -->
				<div class="form-user-footer-links pt-2">
					<div class="row">
						<div class="col-6">
							<a href="<?=base_url("login")?>" class="" style="color:#00a;text-decoration:underline">Login to your account</a>
						</div>
						<div class="col-6 text-right">
							<a href="<?=base_url("signup")?>" class="" style="color:#00a;text-decoration:underline">Create new account</a>
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
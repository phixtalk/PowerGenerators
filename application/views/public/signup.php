<style>
	.parsley-required{
		color:#A00;
	}
</style>
<!-- MAIN WRAPPER -->
<br>
<section class="wide-50 services-section division">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-7">
				<div class="card form-card form-card--style-2">
					<div class="form-header text-center">
						<div class="form-header-icon">
							<i class="icon icon-3x ion-ios-personadd-outline"></i>
						</div>
					</div>
					<div class="form-body">
						<div class="text-center px-2">
							<h4 class="heading heading-4 strong-400 mb-0" style="font-size:25px">Get Started Today - Register to Create a New Account</h4>
							<small>Please, all fields in <span style="color:#A00">*</span> are required</small>
						</div>
						
						<?
							echo $this->utilities->
								show_notification(
								$this->session->flashdata('flag'),
								$this->session->flashdata('message')
								);
								
							$attributes = array(
							'name' => 'loginForm',
							'id' => 'frmRegister',
							'class' => 'form-default mt-4',
							'role' => 'form',
							'data-toggle' => 'validator',
							'data-parsley-validate' => ''
							);

							echo form_open('handlers/handle/new_signup/', $attributes);			
										
							$account = $this->session->flashdata('accountpost');
						?>
										
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label"><span style="color:#A00">*</span>  First Name</label>
										<input type="text" data-parsley-required="true" class="form-control form-control-lg" name="firstname" value="<?php echo $account['firstname'];?>">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label"><span style="color:#A00">*</span>  Surname</label>
										<input type="text" name="lastname" data-parsley-required="true" class="form-control form-control-lg" value="<?php echo $account['lastname'];?>">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label">&nbsp;&nbsp; Organization</label>
										<input type="text" name="organization" class="form-control form-control-lg">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label"><span style="color:#A00">*</span> Telephone</label>
										<input type="text" name="mobile" data-parsley-required="true" class="form-control form-control-lg" value="<?php echo $account['mobile'];?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">Email</label>
										<input type="email" name="email" class="form-control form-control-lg" value="<?php echo $account['email'];?>">
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<?	$get_states = $this->entity->get_all_states();?>
										<label class="control-label"><span style="color:#A00">*</span> State of Location</label>
										<select name="state" class="form-control form-control-lg">
											<option value="">Select a State</option>
											<?	foreach($get_states as $row){?>
													<option value="<?=$row['id']?>" <?=$account['state']==$row['id']?"selected":""?>><?=$row['name']?></option>
											<?	}?>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label"><span style="color:#A00">*</span> City</label>
										<input type="text" name="city" class="form-control form-control-lg" data-parsley-required="true" value="<?php echo $account['city'];?>" value="<?php echo $account['city'];?>">
									</div>
								</div>
							</div>
							
							<!--
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label">Contact Address</label>
										<textarea name="address" class="form-control form-control-lg"><?php echo $account['address'];?></textarea>
									</div>
								</div>
							</div>
							-->
							
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label"><span style="color:#A00">*</span> Password</label>
										<input type="password" name="pasword" id="pasword" value="<?php echo $account['pasword'];?>" data-parsley-required="true" class="form-control form-control-lg">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group has-feedback">
										<label class="control-label"><span style="color:#A00">*</span> Confirm Password</label>
										<input type="password" name="confirmpass" value="<?php echo $account['confirmpass'];?>" data-parsley-equalto="#pasword" data-parsley-required="true" class="form-control form-control-lg">
									</div>
								</div>
							</div>

							
							<div class="mt-1 ">
								<small class="">By clicking "Register" you agree to our terms and conditions</small>
							</div>

							<div style="float:right">
								<button type="submit" class="btn-blue btn btn-styled btn-arrow btn-base-1 mt-4">
									<span>Register <i class="fa fa-play" aria-hidden="true"></i></span>	
								</button>
								<a href="<?=base_url()?>" class="btn-red btn btn-styled btn-arrow btn-base-1 mt-4" style="color:#fff">
									<span><i class="fa fa-close" aria-hidden="true"></i> Cancel</span>	
								</a>
							</div>
							
							
							<div class="modal-footer" style="width:100%;margin-top:100px;">
								<div class="row" style=''>
									<div class="col-12">
										Already have an Account? <i class="fa fa-lock"></i>
										<a href="<?=base_url("login")?>" class="" style="color:#00a;text-decoration:underline"> Sign in</a>
									</div>
								</div>
							</div>
				
							
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


<!-- SCRIPTS -->
<a href="#" class="back-to-top btn-back-to-top"></a>
<link href="<?php echo base_url()?>assets/parsley/parsley.css" rel="stylesheet">
<script src="<?php echo base_url()?>assets/parsley/parsley.min.js"></script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->	
    <section class="content-header">
      <h1>
        <?=($this->session->userdata('isadmin')==1?"ADMIN":"MEMBERS")?> DASHBOARD<br>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
	<?php
		echo $this->utilities->
			show_notification(
			$this->session->flashdata('flag'),
			$this->session->flashdata('message')
			);
	?>
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
						  <td>
							<img src="<?=base_url("assets/user/dist/img/avatarr.png")?>" width="100%" class="user-image" alt="User Image"><br>
							 <a href="<?=base_url("profile")?>" class="btn btn-block btn-success btn-lg"><i class="fa fa-user"></i> View Profile</a>
							<a href="<?=base_url("profile")?>" class="btn btn-block btn-primary btn-lg"><i class="fa fa-edit"></i> Edit Profile</a>
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
					
					$attributes = array(
					'name' => 'loginForm',
					'class' => 'form-signin',
					'enctype' => 'multipart/form-data',
					'data-parsley-validate' => ''
					);

					echo form_open('handlers/upgrade/new_payment/', $attributes);
					$account = $this->session->flashdata('accountpost');
				?>
				
				
				<!-- /.box-header -->
				
				<?	if($this->session->userdata('isadmin')==1){?>
						<div class="box-body">
							<div class="col-md-4 col-sm-6 col-xs-12">
							  <div class="info-box">
								<span class="info-box-icon bg-green"><i class="fa fa-flag-o"></i></span>
								<div class="info-box-content">
								  <span class="info-box-text">Active Members</span>
								  <span class="info-box-number">410</span>
								</div>
							  </div>
							</div>
							
							<div class="col-md-4 col-sm-6 col-xs-12">
							  <div class="info-box">
								<span class="info-box-icon bg-green"><i class="fa fa-flag-o"></i></span>
								<div class="info-box-content">
								  <span class="info-box-text">Non Withdrawable Contributions</span>
								  <span class="info-box-number">N550,000.00</span>
								</div>
							  </div>
							</div>
							
							<div class="col-md-4 col-sm-6 col-xs-12">
							  <div class="info-box">
								<span class="info-box-icon bg-green"><i class="fa fa-flag-o"></i></span>
								<div class="info-box-content">
								  <span class="info-box-text">Member Withdrawals</span>
								  <span class="info-box-number">N58,000.00</span>
								</div>
							  </div>
							</div>
							
							<div class="col-md-4 col-sm-6 col-xs-12">
							  <div class="info-box">
								<span class="info-box-icon bg-green"><i class="fa fa-flag-o"></i></span>
								<div class="info-box-content">
								  <span class="info-box-text">Registration Fee Income</span>
								  <span class="info-box-number">N48,000.00</span>
								</div>
							  </div>
							</div>
							
							<div class="col-md-4 col-sm-6 col-xs-12">
							  <div class="info-box">
								<span class="info-box-icon bg-green"><i class="fa fa-flag-o"></i></span>
								<div class="info-box-content">
								  <span class="info-box-text">Departed Members</span>
								  <span class="info-box-number">14</span>
								</div>
							  </div>
							</div>
							
							<div class="col-md-4 col-sm-6 col-xs-12">
							  <div class="info-box">
								<span class="info-box-icon bg-green"><i class="fa fa-flag-o"></i></span>
								<div class="info-box-content">
								  <span class="info-box-text">Withdrawable Contributions</span>
								  <span class="info-box-number">145,000.00</span>
								</div>
							  </div>
							</div>
							
							<div class="col-md-4 col-sm-6 col-xs-12">
							  <div class="info-box">
								<span class="info-box-icon bg-green"><i class="fa fa-flag-o"></i></span>
								<div class="info-box-content">
								  <span class="info-box-text">Gross Balance</span>
								  <span class="info-box-number">N584,000.00</span>
								</div>
							  </div>
							</div>
							
							<div class="col-md-4 col-sm-6 col-xs-12">
							  <div class="info-box">
								<span class="info-box-icon bg-green"><i class="fa fa-flag-o"></i></span>
								<div class="info-box-content">
								  <span class="info-box-text">Loan Balance</span>
								  <span class="info-box-number">N0.00</span>
								</div>
							  </div>
							</div>
							
						</div><br><br>
				<?	}?>
				<div class="">
				  <div class="alert alert-info"><h4>MY MENU</h4></div>
				</div>
				<?	if($this->session->userdata('isadmin')==1){?>
						<div class="box-body">
							<div class="col-md-3">
								<a href="<?=base_url("members")?>" class="btn btn-block btn-warning btn-lg"><i class="fa fa-users fa-3x"></i><br>Manage Members<br>Applications</a>
							</div>
							<div class="col-md-3">
								<a href="#" class="btn btn-block btn-success btn-lg"><i class="fa fa-money fa-3x"></i><br>Manage Contributions<br>(Withdrawable)</a>
							</div>
							<div class="col-md-3">
								<a href="#" class="btn btn-block btn-primary btn-lg"><i class="fa fa-bank fa-3x"></i><br>Manage Contributions<br>Non Withdrawable</a>
							</div>
							<div class="col-md-3">
								<a href="#" class="btn btn-block btn-success btn-lg"><i class="fa fa-list-alt fa-3x"></i><br>Members <br>Withdrawable</a>
							</div>
						</div>
						<div class="box-body">
							
							<div class="col-md-3">
								<a href="#" class="btn btn-block btn-success btn-lg"><i class="fa fa-external-link fa-3x"></i><br>Loan Management</a>
							</div>
							<div class="col-md-3">
								<a href="<?=base_url("members")?>" class="btn btn-block btn-warning btn-lg"><i class="fa fa-qrcode fa-3x"></i><br>Registration Fee Log</a>
							</div>
							<div class="col-md-3">
								<a href="#" class="btn btn-block btn-primary btn-lg"><i class="fa fa-list-alt fa-3x"></i><br>Reports <br></a>
							</div>
							<div class="col-md-3">
								<a href="#" class="btn btn-block btn-warning btn-lg"><i class="fa fa-power-off fa-3x"></i><br>Signout<br></a>
							</div>
							
						</div>
				<?	}else{?>
						<div class="box-body">
							<div class="col-md-4">
								<a href="#" class="btn btn-block btn-success btn-lg"><i class="fa fa-money fa-3x"></i><br>Withdrawable Contributions</a>
							</div>
							<div class="col-md-4">
								<a href="#" class="btn btn-block btn-primary btn-lg"><i class="fa fa-bank fa-3x"></i><br>Non Withdrawable</a>
							</div>
							<div class="col-md-4">
								<a href="#" class="btn btn-block btn-warning btn-lg"><i class="fa fa-external-link fa-3x"></i><br>Loan Applications</a>
							</div>
						</div>
						
						<div class="box-body">
							<div class="col-md-4">
								<a href="#" class="btn btn-block btn-primary btn-lg"><i class="fa fa-user fa-3x"></i><br>Suggestions/Complaints</a>
							</div>
							<div class="col-md-4">
								<a href="#" class="btn btn-block btn-warning btn-lg"><i class="fa fa-file-pdf-o fa-3x"></i><br>Download Bylaws</a>
							</div>
							<div class="col-md-4">
								<a href="<?=base_url("handlers/handle/download_member_form")?>" class="btn btn-block btn-success btn-lg"><i class="fa fa-file-pdf-o fa-3x"></i><br>Download Member Form</a>
							</div>
						</div>
				<?	}?>
				
				<!-- /.box-body -->
				
				<?php echo form_close(); ?>
			  </div>
			   
			  <!-- /.box -->

			  
			  <!-- /.box -->
			</div>
		
<link href="<?php echo base_url()?>assets/user/plugins/parsley/parsley.css" rel="stylesheet">
<script src="<?php echo base_url()?>assets/user/plugins/parsley/parsley.min.js"></script>

<script type="text/javascript">
	$("#submit_reply").click(function(){
		if($("#replymsg").val()!=""){
			$('#submit_reply').prop("disabled",true);//disable submit button
			$('#loadingimg').show();//indicate to user loading img
			
			var replymsg = $("#replymsg").val();
			var loadUrl="<?=base_url("handlers/profile/new_message/?receiverid=".($sponsor>0?$sponsor['id']:""))?>&replymsg="+encodeURIComponent(replymsg);
			//start the ajax
			$.ajax({
				url: loadUrl,
				type: "POST",
				success: function (html) {
					$('#submit_reply').prop("disabled",false);
					$('#loadingimg').hide();
					$("#replymsg").val("");//clear textarea content
					if(html==1){
						alert("Your message was sent successfully.");
					}else{
						alert("Something went wrong. Please try again later.");
					}
				},
				error: function(xhr, textStatus, errorThrown) {
					alert('An error occurred! ' + errorThrown);
					$('#loadingimg').hide();
				}
			});//end of ajax	
		}else{
			alert("Please enter your message and send it");
		}
	});
</script>
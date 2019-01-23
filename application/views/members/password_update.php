<?
$passport = $this->session->userdata('passport');
if($passport==""){
	$passport="user/dist/img/sponsor.png";
}
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->	
    <section class="content-header">
      <h1>
        UPDATE YOUR PASSWORD
      </h1>      
    </section>
	<br>
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
	
		<?php
			$attributes = array(
			'name' => 'loginForm',
			'class' => 'form-signin',
			'data-parsley-validate' => ''
			);
			echo form_open('handlers/profile/reset_password/', $attributes);
		?>
	
		<div class="col-md-6">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table" style="font-size:18px">
                <tr>
				  <td colspan="2" align="center" class="alert alert-info"><b><i class="fa fa-lock"></i> <b>Change Password:</b></b></td>
				</tr>
				<tr>
                  <td rowspan="2" width="40%"><img src="<?=base_url("assets/".$passport)?>" class="img-circle"></td>
                  <td><b>Full Names:</b>: <?=$this->session->userdata('usernames')?></td>
                </tr>
				<tr>
                  <td><b>Member ID:</b>: <?=$this->session->userdata('memberid')?></td>
                </tr>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-body" style="font-size:18px">
				
                <div class="form-group">
                  <label for="pasword">Enter New Password:</label>
                  <input type="password" class="form-control" placeholder="Password" title="enter your password" data-parsley-required="true" name="pasword" id="pasword" parsley-equalto="#pasword">
                </div>
                <div class="form-group">
                  <label for="passsecond">Confirm Password</label>
                  <input type="password" class="form-control" placeholder="Retype password" title="enter your password again" data-parsley-required="true" name="passsecond" id="passsecond"  data-parsley-equalto="#pasword">
                </div>                
            </div>
			  
			<div class="box-footer clearfix">
				<button type="submit" class="btn btn-success btn-block btn-flat">Save</button>
            </div>
          </div>
		  
		  
          <!-- /.box -->
			
		</div>
		
		<?php echo form_close(); ?>
		  
		  
        
		      

	  
<link href="<?php echo base_url()?>assets/user/plugins/parsley/parsley.css" rel="stylesheet">
<script src="<?php echo base_url()?>assets/user/plugins/parsley/parsley.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$("#apicontents").focus(function() {
			var $this = $(this);
			$this.select();

			// Work around Chrome's little problem
			$this.mouseup(function() {
				// Prevent further mouseup intervention
				$this.unbind("mouseup");
				return false;
			});
		});
	});	//end of document ready function
	function askEditDetails(){
		if(window.confirm('An Email Confirmation Link Will be sent to your email inbox')){
			parent.location = '<?=base_url("handlers/profile/send_edit_link")?>';
		}
	}
	
	$("#showExampleModal").click(function(){
		$(".example-modal").modal("show");
	});
</script>
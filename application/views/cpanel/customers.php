<?php
$userid = $this->session->userdata('id');
$usernames = $this->session->userdata('usernames');
$userid = $this->session->userdata('id');

$type="";
if($this->input->get('s_type')){
	$type=$this->input->get('s_type');
}
$status="";
if($this->input->get('status')){
	$status=$this->input->get('status');
}
$phone="";
if($this->input->get('phone')){
	$phone=$this->input->get('phone');
}
//01-01-2018 to 31-12-2018
$date1=date("Y")."-01-01";
$date2=date("Y-m-d");
if($this->input->get('date1')){
	$date1=$this->input->get('date1');
}
if($this->input->get('date2')){
	$date2=$this->input->get('date2');
}
$date11=$date1." 00:00:00";
$date22=$date2." 23:59:59";

$services = $this->users->get_customers($date11,$date22);
?>
<!--<link rel="stylesheet" href="<?php echo base_url()?>assets/public/datepicker/datepicker.css">-->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      
	  
<?php
	
		$attributes = array(
			'name' => 'loginForm',
			'id' => 'frmNewRegister',
			'class' => 'sky-form',
			'enctype' => 'multipart/form-data',
			'data-parsley-validate' => ''
		);
		echo form_open('handlers/cpanel/new_customer/', $attributes);
		$account = $this->session->flashdata('accountpost');
?>

<!-- Modal -->
<div class="modal fade bs-example-modal-lg-1" role="dialog" tabindex=-1 aria-labelledby="myLargeModalLabel"> 
	<div class="modal-dialog modal-lg" role="document"> 
		<div class="modal-content"> 
			<div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> 
				<h4 class="modal-title text-primary" style="font-size:24px;font-weight:500" id="myLargeModalLabel">Create New Customer</h4> 
			</div> 
			<?php
				echo $this->utilities->
					show_notification(
					$this->session->flashdata('flag'),
					$this->session->flashdata('message')
					);
			?>
			<div class="modal-body">

				<div class="box-body text-center">
					<span style="font-size:18px;color:#a00">Please fill the form and submit to create a new customer record</span>
				</div>
				
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
				
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label"><span style="color:#A00">*</span> Password</label>
							<input type="text" name="pasword" id="pasword" value="welcome123" data-parsley-required="true" class="form-control form-control-lg">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group has-feedback">
							<label class="control-label"><span style="color:#A00">*</span> Confirm Password</label>
							<input type="text" name="confirmpass" value="welcome123" data-parsley-equalto="#pasword" data-parsley-required="true" class="form-control form-control-lg">
						</div>
					</div>
				</div>
							
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Submit <i class="fa fa-check"></i></button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close <i class="fa fa-remove"></i></button>
			</div>
		</div>
	</div> 
</div>
<?php echo form_close(); ?>
	  
	  <div class="row">
		<div class="col-md-5"><h5 class="text-primary" style="font-size:24px;font-weight:500">Manage Customer Records</h5></div>
				
		<div class="col-md-3">
			<a style="cursor:pointer" class="btn bg-info margin" data-toggle="modal" data-target=".bs-example-modal-lg-1" id="showNewExampleModal" title="create new customer record"><i class="fa fa-plus"></i> Create New Customer</a>
			
		</div>
		
	  </div>
	  
	  <?=$this->utilities->get_bread_crumbs($crumb)?>
	  
	  
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


<?php
	$attributes = array(
	'name' => 'loginForm',
	'class' => 'form-signin',
	'data-parsley-validate' => ''
	);
	echo form_open('#', $attributes);
?>
<!-- Modal -->

<div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-primary" id="myModalLabel" style="font-size:24px;font-weight:500"></h4>
      </div>
	
		<table class="table table-striped table-hover table-bordered rwd-table">
			<tr>
				<td align="left" width="30%"><b>Surname:</b></td>
				<td align="left"><span id="last_name"></span></td>
			</tr>
			<tr>
				<td align="left"><b>First Name:</b></td>
				<td align="left"><span id="first_name"></span></td>
			</tr>
			<tr>
				<td align="left"><b>Phone:</b></td>
				<td align="left"><span id="mobile"></span></td>
			</tr>
			<tr>
				<td align="left"><b>Email:</b></td>
				<td align="left"><span id="email"></span></td>
			</tr>
			<tr>
				<td align="left"><b>State:</b></td>
				<td align="left"><span id="state"></span></td>
			</tr>
			<tr>
				<td align="left"><b>City:</b></td>
				<td align="left"><span id="city"></span></td>
			</tr>
			<tr>
				<td align="left"><b>Address:</b></td>
				<td align="left"><span id="address"></span></td>
			</tr>
			<tr>
				<td align="left"><b>Organization:</b></td>
				<td align="left"><span id="organization"></span></td>
			</tr>
			<tr>
				<td align="left"><b>Status:</b></td>
				<td align="left"><span id="status"></span></td>
			</tr>
			<tr>
				<td align="left"><b>Created On:</b></td>
				<td align="left"><span id="createdon"></span></td>
			</tr>
		</table>
		
      <div class="modal-footer">
		<input type="hidden" name="customerid" id="customerid" />
		<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php echo form_close(); ?>	  
	
      <!-- Default box -->
	  
      <div class="box">
        <div class="box-body">
					
			<!--
			<div class="box-body">
				<div class="col-md-3 col-sm-6 col-xs-12">
				  <div class="info-box">
					<span class="info-box-icon bg-green"><i class="fa fa-clock-o"></i></span>
					<div class="info-box-content">
					  <span class="info-box-text">This Month<br/><?=date("F")?></span>
					  <span class="info-box-number">N</span>
					</div>
				  </div>
				</div>
				
				<div class="col-md-3 col-sm-6 col-xs-12">
				  <div class="info-box">
					<span class="info-box-icon bg-aqua"><i class="fa fa-clock-o"></i></span>
					<div class="info-box-content">
					  <span class="info-box-text">This Year<br/><?=date("Y")?></span>
					  <span class="info-box-number">N</span>
					</div>
				  </div>
				</div>
				
				<div class="col-md-3 col-sm-6 col-xs-12">
				  <div class="info-box">
					<span class="info-box-icon bg-red"><i class="fa fa-calendar"></i></span>
					<div class="info-box-content">
					  <span class="info-box-text">All <br>Time</span>
					  <span class="info-box-number">N</span>
					</div>
				  </div>
				</div>
				
				<div class="col-md-3 col-sm-6 col-xs-12">
				  <div class="info-box">
					<span class="info-box-icon bg-yellow"><i class="fa fa-calendar-check-o"></i></span>
					<div class="info-box-content">
					  <span class="info-box-text">All Time<br/>Transaction</span>
					  <span class="info-box-number"></span>
					</div>
				  </div>
				</div>
			</div>
			-->
			
			<hr style="margin-top:0px;margin-bottom:0px;border-top:2px solid #eee">
			<?php
				$attributes = array(
					'name' => 'loginForm',
					'id' => 'frmRegister',
					'class' => 'sky-form',
					'method' => 'GET',
					'enctype' => 'multipart/form-data',
					'data-parsley-validate' => ''
				);
				echo form_open('cpanel/customers/', $attributes);
			?>
			
			<div class="box-body text-center">
				<span style="font-size:22px;" class="text-primary">Displaying Records from <?=date("d-M-Y", strtotime($date1))?> to <?=date("d-M-Y", strtotime($date2))?></span>
			</div>
			<div class="box-body" style="">
				<div class="col-md-3 col-sm-6 col-xs-12"></div>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<b>From:</b>
					<div class="input-group date">
						<div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						</div>
						<input type="text" readonly placeholder="select from date" value="<?=$date1?>" style="cursor:pointer" name="date1" class="form-control pull-right datepicker">
					</div>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<b>To:</b>
					<div class="input-group date">
						<div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						</div>
						<input type="text" readonly placeholder="select to date" style="cursor:pointer" value="<?=$date2?>" name="date2" class="form-control pull-right datepicker">
					</div>
				</div>
				<div class="col-md-2 col-sm-6 col-xs-12">
					<div class="input-group date"><br>
						<button type="submit" class="btn btn-primary"><i class="fa fa-refresh"></i> Refresh</button>
					</div>
				</div>
			</div>
			
			<?php echo form_close(); ?>
			
			<hr style="margin-top:0px;margin-bottom:15px;border-top:2px solid #eee">
					<table class="table table-striped table-hover table-bordered rwd-table" id="dataTableId">
						<thead>
							<tr>
								<th style="width: 10px">SN</th>
								<th>Customers</th>
								<th>Phone</th>
								<th>State</th>
								<th>City</th>
								<th>Status</th>
								<th>Added On</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
			<?
					$i=1;
					if(count($services)>0){
						foreach($services as $rowz){
			?>
							<span style="display:none" id="first_name<?=$rowz['id']?>"><?=$rowz['firstname']?></span>
							<span style="display:none" id="last_name<?=$rowz['id']?>"><?=$rowz['lastname']?></span>
							<span style="display:none" id="email<?=$rowz['id']?>"><?=$rowz['email']?></span>
							<span style="display:none" id="address<?=$rowz['id']?>"><?=$rowz['address']?></span>
							<span style="display:none" id="organization<?=$rowz['id']?>"><?=$rowz['organization']?></span>
							<tr id="rholder<?=$rowz['id']?>">
								<td data-th="#"><?=$i?></td>
								<td data-th="Customers" id="customer<?=$rowz['id']?>"><?=$rowz['firstname']." ".$rowz['lastname']?></td>
								<td data-th="mobile" id="mobile<?=$rowz['id']?>"><?=$rowz['mobile']?></td>
								<td data-th="State" id="state<?=$rowz['id']?>"><?=$rowz['state']?></td>
								<td data-th="city" id="city<?=$rowz['id']?>"><?=$rowz['city']?></td>
								<td data-th="Status"id="status<?=$rowz['id']?>"><?=$this->utilities->get_account_status($rowz['memberstatus'],2)?></td>
								<td data-th="Created On" id="createdon<?=$rowz['id']?>"><?=$this->utilities->system_date($rowz['createdon'])?></td>
								<td>
									<div class="btn-group pull-right">
									  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">Action
										<span class="caret"></span>
										<span class="sr-only">Toggle Dropdown</span>
									  </button>
									  <ul class="dropdown-menu" role="menu">
										<li>
											<a style="cursor:pointer" data-toggle="modal" data-target="#myModal" title="click to view details" onclick="showPaymentModal('<?=$rowz['id']?>')">View Customer Details</a>
										</li>
										<li>
											<a href="<?=base_url("services/new_request/?customerid=".$rowz['id'])?>" title="create new service request for this customer" >New Service Request</a>
										</li>
									  </ul>
									</div>
								</td>
							</tr>
			<?
						$i++;
						}
					}
			?>
					</tbody></table><br/><br/><br/>
				
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
<script type="text/javascript">
	function showPaymentModal(id){
		$("#employeeid").val(id);
		$("#myModalLabel").html("Customer Details (ID: 0000"+id+")");
		$("#city").html("");	$("#city").html($("#city"+id).html());
		$("#address").html("");	$("#address").html($("#address"+id).html());
		$("#organization").html("");	$("#organization").html($("#organization"+id).html());
		$("#email").html("");	$("#email").html($("#email"+id).html());
		$("#first_name").html("");	$("#first_name").html($("#first_name"+id).html());
		$("#last_name").html("");	$("#last_name").html($("#last_name"+id).html());
		$("#state").html("");	$("#state").html($("#state"+id).html());
		$("#createdon").html("");	$("#createdon").html($("#createdon"+id).html());
		$("#mobile").html("");	$("#mobile").html($("#mobile"+id).html());
		$("#status").html("");	$("#status").html($("#status"+id).html());
	}
	$('#btnnotify').click(function(e){
		//e.preventDefault();
		$('#notify').val(1);
		$("#frmRegister").submit();
	});
	
	//$('#myModal').modal('show');
	<?	if($account['firstname']!=""){?>
			$('.bs-example-modal-lg-1').modal({show:true});
	<?	}?>
	
</script>
	  
<link href="<?php echo base_url()?>assets/user/plugins/parsley/parsley.css" rel="stylesheet">
<script src="<?php echo base_url()?>assets/user/plugins/parsley/parsley.min.js"></script>
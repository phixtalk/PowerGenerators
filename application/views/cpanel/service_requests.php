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

$services = $this->entity->get_services($date11,$date22,$type,$status,$phone,"");
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
		echo form_open('handlers/cpanel/new_service_schedule/?mode=1', $attributes);
		$account = $this->session->flashdata('accountpost');
?>

<!-- Modal -->
<div class="modal fade bs-example-modal-lg-1" role="dialog" tabindex=-1 aria-labelledby="myLargeModalLabel"> 
	<div class="modal-dialog modal-lg" role="document"> 
		<div class="modal-content"> 
			<div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> 
				<h4 class="modal-title" id="myLargeModalLabel"></h4> 
			</div> 
			<div class="modal-body">

			<div class="box-body text-center">
				<span style="font-size:18px;color:#a00">Please fill the form and submit to create a new service schedule</span>
			</div>
			<div class="box-body">
				
				<div class="form-group"  style="margin-top:40px;margin-bottom:80px;">
					<label for="inputEmail3" class="col-sm-2 control-label"><span style="color:#a00">*</span> State Date</label>
					<div class="col-sm-10">
						<input type="text" readonly data-parsley-required="true" placeholder="select payment date" style="cursor:pointer" name="start_date" class="form-control pull-right datepicker">
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-2 control-label"><span style="color:#a00">*</span> Technician</label>
					<div class="col-sm-10">
						<?	$get_tech = $this->users->get_employee_by_type("TECHNICIAN");?>
						<select name="technician" style="cursor:pointer" class="form-control" data-parsley-required="true">
							<option value="">Select A Technician</option>
							<?	foreach($get_tech as $row){?>
									<option value="<?=$row['id']?>"><?=$row['last_name']." ".$row['first_name']?></option>
							<?	}?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-2 control-label"><span style="color:#a00">*</span> Issue</label>
					<div class="col-sm-10">
						<textarea name="issue" class="form-control" data-parsley-required="true" style = "resize:none" placeholder="enter issue"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-2 control-label"><span style="color:#a00">*</span> Cause</label>
					<div class="col-sm-10">
						<textarea name="cause" class="form-control" data-parsley-required="true" style = "resize:none" placeholder="enter cause"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-2 control-label"><span style="color:#a00">*</span> Parts Used</label>
					<div class="col-sm-10">
						<textarea name="parts_used" class="form-control" data-parsley-required="true" style = "resize:none" placeholder="enter parts used"></textarea>
					</div>
				</div>
				
				
			</div>
							
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Submit <i class="fa fa-check"></i></button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close <i class="fa fa-remove"></i></button>
				<input type="hidden" name="requestid" id="requestid" />
			</div>
		</div>
	</div> 
</div>
<?php echo form_close(); ?>


<?php
	
		$attributes = array(
			'name' => 'loginForm',
			'id' => 'frmNewRegister',
			'class' => 'sky-form',
			'enctype' => 'multipart/form-data',
			'data-parsley-validate' => ''
		);
		echo form_open('handlers/cpanel/new_invoice', $attributes);
		$account = $this->session->flashdata('accountpost');
?>

<!-- Modal -->
<div class="modal fade bs-example-modal-lg-2" role="dialog" tabindex=-1 aria-labelledby="myLargeModalLabel2"> 
	<div class="modal-dialog modal-lg" role="document"> 
		<div class="modal-content"> 
			<div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> 
				<h4 class="modal-title" id="myLargeModalLabel2"></h4> 
			</div> 
			<div class="modal-body">

			<div class="box-body text-center">
				<span style="font-size:18px;color:#a00">Please fill the form and submit to create a new invoice</span>
			</div>
			<div class="box-body">
				
				<div class="form-group">
					<label for="" class="col-sm-2 control-label"><span style="color:#a00">*</span> Total Amount</label>
					<div class="col-sm-10">
						<input type="text" name="total_amount" class="form-control" data-parsley-required="true" placeholder="enter total amount" data-parsley-min='0' onKeyPress='return numbersonly(event);' autocomplete='off'>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-2 control-label"><span style="color:#a00">*</span> Amount Paid</label>
					<div class="col-sm-10">
						<input type="text" name="paid_amount" class="form-control" data-parsley-required="true" placeholder="enter amount paid" data-parsley-min='0' onKeyPress='return numbersonly(event);' autocomplete='off'>
					</div>
				</div>
				<div class="form-group"  style="margin-top:40px;margin-bottom:80px;">
					<label for="inputEmail3" class="col-sm-2 control-label"><span style="color:#a00">*</span> Record Date</label>
					<div class="col-sm-10">
						<input type="text" readonly data-parsley-required="true" placeholder="select record date" style="cursor:pointer" name="record_date" class="form-control pull-right datepicker">
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-2 control-label"><span style="color:#a00">*</span> Description</label>
					<div class="col-sm-10">
						<textarea name="description" class="form-control" data-parsley-required="true" style = "resize:none" placeholder="enter description"></textarea>
					</div>
				</div>
				
			</div>
							
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Submit <i class="fa fa-check"></i></button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close <i class="fa fa-remove"></i></button>
				<input type="hidden" name="rid" id="rid" />
			</div>
		</div>
	</div> 
</div>
<?php echo form_close(); ?>

	  
	  <div class="row">
		<div class="col-md-5"><h5 class="text-primary" style="font-size:24px;font-weight:500">Manage Service Requests</h5></div>
		<!--
		<div class="col-md-3">
			<h5 style="font-size:15px;font-weight:200">
				<b>Help Desk:</b> <i class="fa fa-phone"></i> 07032440565.
				<br>
				<i class="fa fa-envelope"></i> help@generators.com.ng
			</h5>
		</div>
		
		<div class="col-md-3">
			<a class="btn bg-info margin" title="click here to request a new service" href="<?=base_url("services/new_request")?>"><i class="fa fa-plus"></i> Request For A New Service</a>
		</div>
		-->
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
				<td align="left"><b>Service Type:</b></td>
				<td align="left"><span id="service_type"></span></td>
				<td align="left"><b>Submitted On:<b></td>
				<td align="left"><span id="submitted_on"></span></td>
			</tr>
			<tr>
				<td align="left"><b>Status:</b></td>
				<td align="left"><span id="s_status"></span></td>
				<td align="left"><b>Desired Date:<b></td>
				<td align="left"><span id="desired_date"></span></td>
			</tr>
			<tr>
				<td align="left"><b>Generator Make:</b></td>
				<td align="left"><span id="generator_type"></span></td>
				<td align="left"><b>Generator KVA:</b></td>
				<td align="left"><span id="generator_kva"></span></td>
			</tr>
			<tr>
				<td align="left"><b>State:</b></td>
				<td align="left"><span id="state"></span></td>
				<td align="left"><b>Address:<b></td>
				<td align="left"><span id="address"></span></td>
			</tr>
			<tr>
				<td align="left"><b>Description:</b></td>
				<td align="left"><span id="description"></span></td>
				<td align="left"><b>Completion Date:<b></td>
				<td align="left"><span id="completion_date"></span></td>
			</tr>
			
		</table>
		
      <div class="modal-footer">
		<input type="hidden" name="appid" id="appid" />
		<input type="hidden" name="emailval" id="emailval" />
		<input type="hidden" name="pass" id="pass" />
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
				echo form_open('cpanel/service_requests/', $attributes);
			?>
			
			<div class="box-body text-center">
				<span style="font-size:22px;" class="text-primary">Displaying Records from <?=date("d-M-Y", strtotime($date1))?> to <?=date("d-M-Y", strtotime($date2))?></span>
			</div>
			<div class="box-body" style="">
				<div class="col-md-2 col-sm-6 col-xs-12">
					<b>From:</b>
					<div class="input-group date">
						<div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						</div>
						<input type="text" readonly placeholder="select from date" value="<?=$date1?>" style="cursor:pointer" name="date1" class="form-control pull-right datepicker">
					</div>
				</div>
				<div class="col-md-2 col-sm-6 col-xs-12">
					<b>To:</b>
					<div class="input-group date">
						<div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						</div>
						<input type="text" readonly placeholder="select to date" style="cursor:pointer" value="<?=$date2?>" name="date2" class="form-control pull-right datepicker">
					</div>
				</div>
				<div class="col-md-2 col-sm-6 col-xs-12">
					<b>Filter By Phone:</b>
					<div class="input-group date">
						<input type="text" placeholder="customer phone" value="<?=$phone?>" name="phone" class="form-control">
					</div>
				</div>
				<div class="col-md-2 col-sm-6 col-xs-12">
					<b>Filter By Service Type:</b>
					<div class="input-group date">
						<select name="s_type" class="form-control">
							<option value="">ALL SERVICE TYPES</option>
							<option value="MAINTENANCE" <?=$type=="MAINTENANCE"?"selected":""?>>MAINTENANCE</option>
							<option value="REPAIR" <?=$type=="REPAIR"?"selected":""?>>REPAIR</option>
						</select>
					</div>
				</div>
				<div class="col-md-2 col-sm-6 col-xs-12">
					<b>Filter By Status:</b>
					<div class="input-group date">
						<select name="status" class="form-control">
							<option value="">ALL STATUSES</option>
							<option value="PENDING" <?=$status=="PENDING"?"selected":""?>>PENDING</option>
							<option value="ON-GOING" <?=$status=="ON-GOING"?"selected":""?>>ON-GOING</option>
							<option value="COMPLETED" <?=$status=="COMPLETED"?"selected":""?>>COMPLETED</option>
						</select>
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
								<th>Request ID</th>
								<th>Customers</th>
								<th>Date Submitted</th>
								<th>Status</th>
								<th>Service Type</th>
								<th>Generator Make</th>
								<th>Generator KVA</th>
								<th>State of Location</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
			<?
					$i=1;
					if(count($services)>0){
						foreach($services as $rowz){
			?>
							<span style="display:none" id="desired_date<?=$rowz['id']?>"><?=$this->utilities->system_date($rowz['desired_date'])?></span>
							<span style="display:none" id="completion_date<?=$rowz['id']?>"><?=$this->utilities->system_date($rowz['completion_date'])?></span>
							<span style="display:none" id="s_status<?=$rowz['id']?>"><?=$rowz['s_status']?></span>
							<span style="display:none" id="address<?=$rowz['id']?>"><?=$rowz['address']?></span>
							<span style="display:none" id="description<?=$rowz['id']?>"><?=$rowz['description']?></span>
							<tr id="rholder<?=$rowz['id']?>">
								<td data-th="#"><?=$i?></td>
								<td data-th="Request ID">000<?=$rowz['id']?></td>
								<td data-th="Service Type" id="customer<?=$rowz['id']?>"><?=$rowz['usernames']?></td>
								<td data-th="Submitted On" id="submitted_on<?=$rowz['id']?>"><?=$this->utilities->system_date($rowz['submitted_on'],2)?></td>
								<td data-th="Status"><?=$this->utilities->get_status_style($rowz['s_status'])?></td>
								<td data-th="Service Type" id="service_type<?=$rowz['id']?>"><?=$rowz['service_type']?></td>
								<td data-th="Generator make" id="generator_type<?=$rowz['id']?>"><?=$rowz['generator_type']?></td>
								<td data-th="Generator KVA" id="generator_kva<?=$rowz['id']?>"><?=$rowz['generator_kva']?></td>
								<td data-th="State" id="state<?=$rowz['id']?>"><?=$rowz['user_state']?></td>
								<td>
									<a class="btn btn-xs btn-info" href="<?=base_url("cpanel/request_details/".$rowz['id'])?>" title="view service request" ><i class="fa fa-eye"></i> View Details</a>
									<!--
									<a style="cursor:pointer" class="btn btn-xs btn-info" data-toggle="modal" data-target="#myModal" id="showExampleModal" title="click to edit" onclick="showPaymentModal('<?=$rowz['id']?>')"><i class="fa fa-eye"></i> Details</a>
									<a style="cursor:pointer" class="btn btn-xs btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg-1" onclick="showScheduleModal('<?=$rowz['id']?>')" id="showNewExampleModal" title="create new service schedule" ><i class="fa fa-plus"></i> New Schedule</a>
									<a style="cursor:pointer" class="btn btn-xs btn-warning" data-toggle="modal" data-target=".bs-example-modal-lg-2" onclick="showScheduleModal2('<?=$rowz['id']?>')" title="generate new invoice" ><i class="fa fa-plus"></i> New Invoice</a>
									-->
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
	function showScheduleModal(id){
		$("#myLargeModalLabel").html("New Service Schedule: "+$("#customer"+id).html() + " (ID: 0000"+id+")");
		//requestid
		$("#requestid").val(id);
	}
	function showScheduleModal2(id){
		$("#myLargeModalLabel2").html("New Invoice: "+$("#customer"+id).html() + " (ID: 0000"+id+")");
		//requestid
		$("#rid").val(id);
	}
	
	function showPaymentModal(id){		
		$("#myModalLabel").html($("#customer"+id).html() + " Request Details (ID: 0000"+id+")");
		
		$("#service_type").html("");	$("#service_type").html($("#service_type"+id).html());
		$("#submitted_on").html("");	$("#submitted_on").html($("#submitted_on"+id).html());
		$("#desired_date").html("");	$("#desired_date").html($("#desired_date"+id).html());
		$("#completion_date").html("");	$("#completion_date").html($("#completion_date"+id).html());
		
		$("#s_status").html("");	$("#s_status").html($("#s_status"+id).html());
		$("#generator_type").html("");	$("#generator_type").html($("#generator_type"+id).html());
		$("#generator_kva").html("");	$("#generator_kva").html($("#generator_kva"+id).html());
		
		$("#state").html("");	$("#state").html($("#state"+id).html());
		$("#address").html("");	$("#address").html($("#address"+id).html());
		$("#description").html("");	$("#description").html($("#description"+id).html());
		
	}
	$('#btnnotify').click(function(e){
		//e.preventDefault();
		$('#notify').val(1);
		$("#frmRegister").submit();
	});
	
	function numbersonly(e) {
		var unicode = e.charCode ? e.charCode : e.keyCode
		if (unicode != 8 && unicode != 46 && unicode != 37 && unicode != 27 && unicode != 38 && unicode != 39 && unicode != 40 && unicode != 9 && unicode != 13) { //if the key isn't the backspace key or the enter key (which we should allow)
			if (unicode < 48 || unicode > 57)
				return false
		}
	}
</script>
	  
<link href="<?php echo base_url()?>assets/user/plugins/parsley/parsley.css" rel="stylesheet">
<script src="<?php echo base_url()?>assets/user/plugins/parsley/parsley.min.js"></script>
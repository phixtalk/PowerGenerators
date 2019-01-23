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
$state="";
if($this->input->get('state')){
	$state=$this->input->get('state');
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

$services = $this->entity->get_services($date11,$date22,$type,$status,$state,$userid);
?>
<!--<link rel="stylesheet" href="<?php echo base_url()?>assets/public/datepicker/datepicker.css">-->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      
	  
	  <div class="row">
		<div class="col-md-5"><h5 class="text-primary" style="font-size:24px;font-weight:500">My Service History</h5></div>
		<!--
		<a class="btn bg-info margin" title="click here to request a new service" href="<?=base_url("services/new_request")?>"><i class="fa fa-plus"></i> Request For A New Service</a>
		-->
		<!--<div class="col-md-3"><h5 style="font-size:20px;font-weight:200">My Login ID: <?=$memberid?></h5></div>-->
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
				echo form_open('services/index/', $attributes);
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
				<!--
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
				<?	$get_states = $this->entity->get_all_states();?>
				<div class="col-md-2 col-sm-6 col-xs-12">
					<b>Filter By State:</b>
					<div class="input-group date">
						<select name="state" class="form-control">
							<option value="">ALL STATES</option>
							<?	foreach($get_states as $row){?>
									<option value="<?=$row['id']?>" <?=$state==$row['id']?"selected":""?>><?=$row['name']?></option>
							<?	}?>
						</select>
					</div>
				</div>
				-->
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
								<td data-th="Submitted On" id="submitted_on<?=$rowz['id']?>"><?=$this->utilities->system_date($rowz['submitted_on'],2)?></td>
								<td data-th="Status"><?=$this->utilities->get_status_style($rowz['s_status'])?></td>
								<td data-th="Service Type" id="service_type<?=$rowz['id']?>"><?=$rowz['service_type']?></td>
								<td data-th="Generator make" id="generator_type<?=$rowz['id']?>"><?=$rowz['generator_type']?></td>
								<td data-th="Generator KVA" id="generator_kva<?=$rowz['id']?>"><?=$rowz['generator_kva']?></td>
								<td data-th="State" id="state<?=$rowz['id']?>"><?=$rowz['user_state']?></td>
								
								<td>
									<a style="cursor:pointer" class="btn btn-xs btn-info" data-toggle="modal" data-target="#myModal" id="showExampleModal" title="click to edit" onclick="showPaymentModal('<?=$rowz['id']?>')"><i class="fa fa-eye"></i> Details</a>
									<!--<a style="cursor:pointer" target="_blank" href="<?=base_url("cpanel/receipt_view/?rtype=withdraw&id=".$rowz['id'])?>" class="btn btn-xs btn-default">Receipt</a>-->
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

		/*
		id, user_id, service_type, source_type, submitted_on, desired_date, completion_date, s_status, generator_type, generator_kva, state, address, description
		*/
		
		$("#myModalLabel").html("Service Request Details (ID: 0000"+id+")");
		
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
</script>
	  
<link href="<?php echo base_url()?>assets/user/plugins/parsley/parsley.css" rel="stylesheet">
<script src="<?php echo base_url()?>assets/user/plugins/parsley/parsley.min.js"></script>
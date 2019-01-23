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

$services = $this->users->get_employees($date11,$date22);
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
		echo form_open('handlers/cpanel/new_employee/', $attributes);
		$account = $this->session->flashdata('accountpost');
?>

<!-- Modal -->
<div class="modal fade bs-example-modal-lg-1" role="dialog" tabindex=-1 aria-labelledby="myLargeModalLabel"> 
	<div class="modal-dialog modal-lg" role="document"> 
		<div class="modal-content"> 
			<div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> 
				<h4 class="modal-title text-primary" style="font-size:24px;font-weight:500" id="myLargeModalLabel">Create New Employee Record</h4> 
			</div> 
			<div class="modal-body">

			<div class="box-body text-center">
				<span style="font-size:18px;color:#a00">Please fill the form and submit to create a new employee record</span>
			</div>
			<div class="box-body">
				
				<div class="form-group">
					<label for="" class="col-sm-2 control-label">
						&nbsp;&nbsp;<b>Upload Picture</b>
					</label>
					<div class="col-sm-10">
						<input type="file" name="userfile" style="cursor:pointer">
						<span style="color:#a00">&nbsp;&nbsp;jpeg, png and gif only. 2MB Max</span>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-2 control-label"><span style="color:#a00">*</span> Surname</label>
					<div class="col-sm-10">
						<input type="text" name="last_name" class="form-control" data-parsley-required="true" placeholder="enter surname">
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-2 control-label"><span style="color:#a00">*</span> First Name</label>
					<div class="col-sm-10">
						<input type="text" name="first_name" class="form-control" data-parsley-required="true" placeholder="enter first name">
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-2 control-label"><span style="color:#a00">*</span> Gender</label>
					<div class="col-sm-10">
						<select name="gender" style="cursor:pointer" class="form-control" data-parsley-required="true">
							<option value="">Select Gender</option>
							<option value="MALE">MALE</option>
							<option value="FEMALE">FEMALE</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-2 control-label"><span style="color:#a00">*</span> Role</label>
					<div class="col-sm-10">
						<select name="role" style="cursor:pointer" class="form-control" data-parsley-required="true">
							<option value="">Select Role</option>
							<option value="DIRECTOR">DIRECTOR</option>
							<option value="TECHNICIAN">TECHNICIAN</option>
							<option value="ADMIN">ADMIN</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-2 control-label"><span style="color:#a00">*</span> State</label>
					<div class="col-sm-10">
						<?	$get_states = $this->entity->get_all_states();?>
						<select name="state" style="cursor:pointer" class="form-control" data-parsley-required="true">
							<option value="">Select State of Location</option>
							<?	foreach($get_states as $row){?>
									<option value="<?=$row['id']?>"><?=$row['name']?></option>
							<?	}?>
						</select>
					</div>
				</div>
				<div class="form-group"  style="margin-top:40px;margin-bottom:80px;">
					<label for="inputEmail3" class="col-sm-2 control-label"><span style="color:#a00">*</span> Employment Date</label>
					<div class="col-sm-10">
						<input type="text" readonly data-parsley-required="true" placeholder="select employment date" style="cursor:pointer" name="employment_date" class="form-control pull-right datepicker">
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
		<div class="col-md-5"><h5 class="text-primary" style="font-size:24px;font-weight:500">Manage Employee Records</h5></div>
				
		<div class="col-md-3">
			<a style="cursor:pointer" class="btn bg-info margin" data-toggle="modal" data-target=".bs-example-modal-lg-1" id="showNewExampleModal" title="create new employee record"><i class="fa fa-plus"></i> Create New Employee</a>
			
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
				<!--<td align="left" width="30%"><b>Surname:</b></td>-->
				<td align="left" colspan="2"><span id="picture"></span></td>
			</tr>
			<tr>
				<td align="left" width="30%"><b>Surname:</b></td>
				<td align="left"><span id="last_name"></span></td>
			</tr>
			<tr>
				<td align="left"><b>First Name:</b></td>
				<td align="left"><span id="first_name"></span></td>
			</tr>
			<tr>
				<td align="left"><b>Gender:</b></td>
				<td align="left"><span id="gender"></span></td>
			</tr>
			<tr>
				<td align="left"><b>State:</b></td>
				<td align="left"><span id="state"></span></td>
			</tr>
			<tr>
				<td align="left"><b>Role:</b></td>
				<td align="left"><span id="role"></span></td>
			</tr>
			<tr>
				<td align="left"><b>Employment Date:</b></td>
				<td align="left"><span id="employment_date"></span></td>
			</tr>
		</table>
		
      <div class="modal-footer">
		<input type="hidden" name="employeeid" id="employeeid" />
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
				echo form_open('cpanel/employees/', $attributes);
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
								<th>Employees</th>
								<th>Gender</th>
								<th>State</th>
								<th>Role</th>
								<th>Employed On</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
			<?
					$i=1;
					if(count($services)>0){
						foreach($services as $rowz){
			?>
							<span style="display:none" id="first_name<?=$rowz['id']?>"><?=$rowz['first_name']?></span>
							<span style="display:none" id="last_name<?=$rowz['id']?>"><?=$rowz['last_name']?></span>
							<span style="display:none" id="picture<?=$rowz['id']?>"><?=$rowz['picture']?></span>
							<tr id="rholder<?=$rowz['id']?>">
								<td data-th="#"><?=$i?></td>
								<td data-th="Employees" id="customer<?=$rowz['id']?>"><?=$rowz['first_name']." ".$rowz['last_name']?></td>
								<td data-th="Gender" id="gender<?=$rowz['id']?>"><?=$rowz['gender']?></td>
								<td data-th="State" id="state<?=$rowz['id']?>"><?=$rowz['state']?></td>
								<td data-th="Role" id="role<?=$rowz['id']?>"><?=$rowz['role']?></td>
								<td data-th="Employment Date" id="employment_date<?=$rowz['id']?>"><?=$this->utilities->system_date($rowz['employment_date'])?></td>
								<td>
									<a style="cursor:pointer" class="btn btn-xs btn-info" data-toggle="modal" data-target="#myModal" id="showExampleModal" title="click to edit" onclick="showPaymentModal('<?=$rowz['id']?>')"><i class="fa fa-eye"></i> Details</a>
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
		$("#myModalLabel").html("Employee Details (ID: 0000"+id+")");
		$("#gender").html("");	$("#gender").html($("#gender"+id).html());
		$("#first_name").html("");	$("#first_name").html($("#first_name"+id).html());
		$("#last_name").html("");	$("#last_name").html($("#last_name"+id).html());
		$("#state").html("");	$("#state").html($("#state"+id).html());
		$("#employment_date").html("");	$("#employment_date").html($("#employment_date"+id).html());
		$("#role").html("");	$("#role").html($("#role"+id).html());
		
		$('#picture').html("");
		var mediap = $("#picture"+id).html();
		if(mediap != ""){
			imgsrcp = "<?=base_url("assets")?>/"+mediap;
			attchp = "<img id='imgholder' width='80px' src='"+imgsrcp+"' />";
			$('#picture').html(attchp);
		}
	}
	$('#btnnotify').click(function(e){
		//e.preventDefault();
		$('#notify').val(1);
		$("#frmRegister").submit();
	});
</script>
	  
<link href="<?php echo base_url()?>assets/user/plugins/parsley/parsley.css" rel="stylesheet">
<script src="<?php echo base_url()?>assets/user/plugins/parsley/parsley.min.js"></script>
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

$details = $this->entity->get_service_details($rid);
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
		echo form_open('handlers/cpanel/new_service_schedule', $attributes);
		$account = $this->session->flashdata('accountpost');
?>

<!-- Modal -->
<div class="modal fade bs-example-modal-lg-1" role="dialog" tabindex=-1 aria-labelledby="myLargeModalLabel"> 
	<div class="modal-dialog modal-lg" role="document"> 
		<div class="modal-content"> 
			<div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> 
				<h4 class="modal-title text-primary" id="myLargeModalLabel" style="font-size:24px;font-weight:500"></h4>
			</div> 
			<div class="modal-body">

			<div class="box-body text-center">
				<span style="font-size:18px;color:#a00">Please fill the form and submit to create a new service schedule</span><br>
				All fields in <span style="color:#A00">*</span> are required
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
					<label for="" class="col-sm-2 control-label">&nbsp;&nbsp;&nbsp;Issue</label>
					<div class="col-sm-10">
						<textarea name="issue" class="form-control" style = "resize:none" placeholder="enter issue"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-2 control-label">&nbsp;&nbsp;&nbsp;Cause</label>
					<div class="col-sm-10">
						<textarea name="cause" class="form-control" style = "resize:none" placeholder="enter cause"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-2 control-label">&nbsp;&nbsp;&nbsp;Parts Used</label>
					<div class="col-sm-10">
						<textarea name="parts_used" class="form-control" style = "resize:none" placeholder="enter parts used"></textarea>
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
				<h4 class="modal-title text-primary" id="myLargeModalLabel2" style="font-size:24px;font-weight:500"></h4> 
			</div> 
			<div class="modal-body">

			<div class="box-body text-center">
				<span style="font-size:18px;color:#a00">Please fill the form and submit to create a new invoice</span>
			</div>
			<div class="box-body">
				
				<div class="form-group">
					<label for="" class="col-sm-2 control-label"><span style="color:#a00">*</span> Total Amount &#8358;</label>
					<div class="col-sm-10">
						<input type="text" name="total_amount" class="form-control" data-parsley-required="true" placeholder="enter total amount" data-parsley-min='0' onKeyPress='return numbersonly(event);' autocomplete='off'>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-2 control-label"><span style="color:#a00">*</span> Discount &#8358;</label>
					<div class="col-sm-10">
						<input type="text" name="discount_amount" class="form-control" data-parsley-required="true" placeholder="enter discount amount" data-parsley-min='0' onKeyPress='return numbersonly(event);' value="0">
					</div>
				</div>
				<!--<div class="form-group">
					<label for="" class="col-sm-2 control-label"><span style="color:#a00">*</span> Amount Paid &#8358;</label>
					<div class="col-sm-10">
						<input type="text" name="paid_amount" class="form-control" data-parsley-required="true" placeholder="enter amount paid" data-parsley-min='0' onKeyPress='return numbersonly(event);' autocomplete='off'>
					</div>
				</div>-->
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



<?php
	
		$attributes = array(
			'name' => 'loginForm',
			'id' => 'frmNewRegister',
			'class' => 'sky-form',
			'enctype' => 'multipart/form-data',
			'data-parsley-validate' => ''
		);
		echo form_open('handlers/cpanel/new_payment', $attributes);
		$account = $this->session->flashdata('accountpost');
?>

<!-- Modal -->
<div class="modal fade bs-example-modal-lg-3" role="dialog" tabindex=-1 aria-labelledby="myLargeModalLabel3"> 
	<div class="modal-dialog modal-lg" role="document"> 
		<div class="modal-content"> 
			<div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> 
				<h4 class="modal-title text-primary" id="myLargeModalLabel3" style="font-size:24px;font-weight:500"></h4> 
			</div> 
			<div class="modal-body">

			<div class="box-body text-center">
				<span style="font-size:18px;color:#a00">Please fill the form and submit to register a new payment</span><br>
				<span style="font-size:18px;color:#a00" id="max_payment"></span>
			</div>
			<div class="box-body">
				<div class="form-group">
					<label for="" class="col-sm-3 control-label"><span style="color:#a00">*</span> Amount Paid &#8358;</label>
					<div class="col-sm-9">
						<input type="text" name="amount" id="amt_owe" class="form-control" data-parsley-required="true" placeholder="enter amount paid" data-parsley-min='0' onKeyPress='return numbersonly(event);' autocomplete='off'>
					</div>
				</div>
				<div class="form-group"  style="margin-top:40px;margin-bottom:80px;">
					<label for="inputEmail3" class="col-sm-3 control-label"><span style="color:#a00">*</span> Payment Date</label>
					<div class="col-sm-9">
						<input type="text" readonly data-parsley-required="true" placeholder="select payment date" style="cursor:pointer" name="payment_date" class="form-control pull-right datepicker">
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-3 control-label"><span style="color:#a00">*</span> Payment Method</label>
					<div class="col-sm-9">
						<select name="payment_method" style="cursor:pointer" class="form-control" data-parsley-required="true">
							<option value="">Select Payment Method</option>
							<option value="CASH">CASH</option>
							<option value="POS">POS</option>
							<option value="CHEQUE">CHEQUE</option>
							<option value="TRANSFER">TRANSFER</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-3 control-label">&nbsp;&nbsp;&nbsp;&nbsp;Description</label>
					<div class="col-sm-9">
						<textarea name="description" class="form-control" data-parsley-required="true" style = "resize:none" placeholder="enter description"></textarea>
					</div>
				</div>
				
			</div>
							
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Post Payment <i class="fa fa-check"></i></button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close <i class="fa fa-remove"></i></button>
				<input type="hidden" name="customer_id" id="cid" />
				<input type="hidden" name="invoice_id" id="invid" />
				<input type="hidden" name="request_id" id="rqstid" />
				<input type="hidden" name="balance" id="balance" />
			</div>
		</div>
	</div> 
</div>
<?php echo form_close(); ?>	  
	  <div class="row">
		<div class="col-md-5"><h5 class="text-primary" style="font-size:24px;font-weight:500">Service Request Details</h5></div>
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
				<td align="left" width="30%"><b>Service Request ID:</b></td>
				<td align="left"><span id="service_request_id"></span></td>
			</tr>
			<tr>
				<td align="left"><b>Total Amount:</b></td>
				<td align="left"><span id="total_amount"></span></td>
			</tr>
			<tr>
				<td align="left"><b>Discount Amount:</b></td>
				<td align="left"><span id="discount_amount"></span></td>
			</tr>
			<tr>
				<td align="left"><b>Invoice Amount:</b></td>
				<td align="left"><span id="invoice_amount"></span></td>
			</tr>
			<tr>
				<td align="left"><b>Paid Amount:</b></td>
				<td align="left"><span id="paid_amount"></span></td>
			</tr>
			<tr>
				<td align="left"><b>Balance Amount:</b></td>
				<td align="left"><span id="balance_amount"></span></td>
			</tr>
			<tr>
				<td align="left"><b>Description:</b></td>
				<td align="left"><span id="description"></span></td>
			</tr>
			<tr>
				<td align="left"><b>Invoice Status:</b></td>
				<td align="left"><span id="i_status"></span></td>
			</tr>
			<tr>
				<td align="left"><b>Record Date:</b></td>
				<td align="left"><span id="record_date"></span></td>
			</tr>
			<tr>
				<td align="left"><b>Generated On:</b></td>
				<td align="left"><span id="createdon"></span></td>
			</tr>
			<tr>
				<td align="left"><b>Generated By:</b></td>
				<td align="left"><span id="createdby"></span></td>
			</tr>
		</table>
		
      <div class="modal-footer">
		<a target="_blank" id="btn_print" class="btn btn-primary">Print Invoice</a>
		<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php echo form_close(); ?>	  
	
<?php
	$attributes = array(
	'name' => 'loginForm',
	'class' => 'form-signin',
	'data-parsley-validate' => ''
	);
	echo form_open('#', $attributes);
?>
<!-- Modal -->

<div class="modal fade bs-example-modal-lg2" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-primary" id="myModalLabel2" style="font-size:24px;font-weight:500"></h4>
      </div>
		
		<img id="loadingimg" style="display:none;" src="<?=base_url("assets/user/img/spinner.gif")?>" alt='please wait...' />
		
		<div id="display_payments"></div>
		
      <div class="modal-footer">
		<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php echo form_close(); ?>	

      <!-- Default box -->
	  
      <div class="box">
        <div class="box-body">
					
			<? if(count($details)>0){?>
			
			<!--FIRST SECTION OF DETAILS-->
			<h4 style="font-weight:bold" class="text-left text-info">Service Request Summary: <span style="color:#000">#000<?=$rid?></span></h4>
			
			<div class="box-body no-padding">
              <table class="table table-striped table-hover">
                <tr>
                  <td><b>Customer Name:</b> <?=$details['usernames']?></td>
                  <td><b>Contacts Info:</b> <?=$details['mobile']?></td>
                </tr>
				<tr>
                  <td><b>State of Location:</b> <?=$details['user_state']?></td>
                  <td><b>Address:</b> <?=$details['address']?></td>
                </tr>
				<tr>
                  <td><b>Service Type:</b> <?=$details['service_type']?></td>
                  <td><b>Desired Date:</b> <?=date("Y-m-d",strtotime($details['desired_date']))?></td>
                </tr>
				<tr>
                  <td><b>Generator Make:</b> <?=$details['generator_type']?></td>
                  <td><b>Generator KVA:</b> <?=$details['generator_kva']?></td>
                </tr>
				<tr>
                  <td><b>Description:</b> <?=$details['description']?></td>
                  <td><b>Submitted On:</b> <?=$this->utilities->system_date($details['submitted_on'],2)?></td>
                </tr>
				
				<tr>
                  <td><b>Total Pending Services:</b> <?=$details['total_pending']?></td>
                  <td><b>Total Amount Owed:</b> &#8358;<?=$this->utilities->format_number($details['total_amt_owed'],2)?></td>
                </tr>
              </table>
            </div>
			
			<!--SECOND SECTION OF DETAILS-->
			<hr style="margin-top:0px;margin-bottom:15px;border-top:2px solid #eee">
				
			<h4 style="font-weight:bold" class="text-left text-success">
				Service Schedule History (<?=$details['schedule_count']?>)
				<a style="cursor:pointer;float:right" class="btn btn-xm btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg-1" onclick="showScheduleModal('<?=$rid?>')" id="showNewExampleModal" title="create new service schedule" ><i class="fa fa-plus"></i> Add New Schedule</a>
			</h4>
			
			<table class="table table-striped table-hover">
				<tr>
				  <th style="width: 10px">SN</th>
					<th>Technician</th>
					<th>Start Date</th>
					<th>Issue</th>
					<th>Cause</th>
					<th>Parts Used</th>
					<th>Status</th>
				</tr>
				<?	
					
					$schedule = $this->entity->get_service_schedule("","",$rid,"","");
					if (count($schedule) > 0){
						$i=1;
						foreach($schedule as $row){
				?>
							<tr>
								<td data-th="#"><?=$i?></td>
								<td data-th="Technician" id="technician<?=$row['id']?>"><?=$row['last_name']." ".$row['first_name']?></td>
								<td data-th="start date" id="start_date<?=$row['id']?>"><?=$this->utilities->system_date($row['start_date'],2)?></td>
								<td data-th="Issue"><?=$row['issue']?></td>
								<td data-th="cause"><?=$row['cause']?></td>
								<td data-th="Parts Used"><?=$row['parts_used']?></td>
								<td data-th="Status"><?=$this->utilities->get_status_style($row['service_status'])?></td>
							</tr>
				<?
							$i++;
						}
					}else{
						echo '<tr><td colspan="7"><div class="alert alert-info">Sorry, no schedule record is available.</div></td></tr>';
					}
				?>
			</table>
						
					
			<!--THIRD SECTION OF DETAILS-->
			<hr style="margin-top:0px;margin-bottom:15px;border-top:2px solid #eee">
				
			<h4 style="font-weight:bold" class="text-left text-danger">
				Invoice & Payments History (<?=$details['invoice_count']?>)
				<a style="cursor:pointer;float:right" class="btn btn-xm btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg-2" onclick="showScheduleModal2('<?=$rid?>')" title="generate new invoice" ><i class="fa fa-plus"></i> Add New Invoice</a>
			</h4>
			
			<table class="table table-striped table-hover">
				<tr>
					<th style="width: 10px">SN</th>
					<th>Invoice ID #</th>
					<th style="text-align:right">Total Amount &#8358;</th>
					<th style="text-align:right">Discount Amount &#8358;</th>
					<th style="text-align:right">Invoice Amount &#8358;</th>
					<th style="text-align:right">Paid Amount &#8358;</th>
					<th style="text-align:right">Balance Amount &#8358;</th>
					<th>Payment Status</th>
					<th>Invoice Date</th>
					<th>Action</th>
				</tr>
				<?	
					
					$invoices = $this->entity->get_invoices("","",$rid,"","");
					if (count($invoices) > 0){
						$i=1;
						foreach($invoices as $rowz){
				?>
							<span style="display:none" id="createdby<?=$rowz['id']?>"><?=$rowz['generatedby']?></span>
							<span style="display:none" id="record_date<?=$rowz['id']?>"><?=$this->utilities->system_date($rowz['record_date'])?></span>
							<span style="display:none" id="service_request_id<?=$rowz['id']?>">000<?=$rowz['service_request_id']?></span>
							<span style="display:none" id="customers<?=$rowz['id']?>"><?=$rowz['usernames']?></span>
							<span style="display:none" id="description<?=$rowz['id']?>"><?=$rowz['description']?></span>
							
							<tr>
								<td data-th="#"><?=$i?></td>
								<td data-th="Invoice ID"><a style="cursor:pointer;text-decoration:underline" data-toggle="modal" data-target="#myModal" title="click to view detail" onclick="showPaymentModal('<?=$rowz['id']?>')">000<?=$rowz['id']?></a></td>
								<td data-th="Total Amount" id="total_amount<?=$rowz['id']?>" style="text-align:right"><?=$this->utilities->format_number($rowz['total_amount'])?></td>
								<td data-th="Discount Amount" id="discount_amount<?=$rowz['id']?>" style="text-align:right"><?=$this->utilities->format_number($rowz['discount_amount'])?></td>
								<td data-th="Invoice Amount" id="invoice_amount<?=$rowz['id']?>" style="text-align:right"><?=$this->utilities->format_number($rowz['invoice_amount'])?></td>
								<td data-th="Paid Amount" id="paid_amount<?=$rowz['id']?>" style="text-align:right"><?=$this->utilities->format_number($rowz['paid_amount'])?></td>
								<td data-th="Balance Amount" id="balance_amount<?=$rowz['id']?>" style="text-align:right"><?=$this->utilities->format_number($rowz['amount_owed'])?></td>
								<td data-th="Status" id="i_status<?=$rowz['id']?>"><?=$this->utilities->get_status_style($rowz['i_status'])?></td>
								<td data-th="start date" id="createdon<?=$rowz['id']?>"><?=$this->utilities->system_date($rowz['createdon'],2)?></td>
								<td>
									
									<div class="btn-group pull-right">
									  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">Action
										<span class="caret"></span>
										<span class="sr-only">Toggle Dropdown</span>
									  </button>
									  <ul class="dropdown-menu" role="menu">
										<li>
											<a style="cursor:pointer" data-toggle="modal" data-target="#myModal" title="click to edit" onclick="showPaymentModal('<?=$rowz['id']?>')">View Details</a>
										</li>
										<?	if($rowz['amount_owed']>0){?>
												<li>
													<a style="cursor:pointer" data-toggle="modal" data-target=".bs-example-modal-lg-3" title="click to add new payment" onclick="showPaymentModal3('<?=$rowz['service_request_id']?>','<?=$details['user_id']?>','<?=$rowz['id']?>','<?=$rowz['amount_owed']?>')">Add New Payment</a>
												</li>
										<?	}?>
										<li>
											<a style="cursor:pointer" data-toggle="modal" data-target="#myModal2" onclick="showPaymentModal2('<?=$rowz['id']?>')" title="click to view payment history">Payment History</a>
										</li>
										<li class="divider"></li>
										<li><a href="<?=base_url("cpanel/print_invoice/?id=".$rowz['id'])?>" target="_blank">Print Invoice</a></li>
									  </ul>
									</div>
								</td>
							</tr>
				<?
							$i++;
						}
					}else{
						echo '<tr><td colspan="10"><div class="alert alert-info">Sorry, no invoice record is available.</div></td></tr>';
					}
				?>
			</table>
			<br><br><br><br><br><br>
				
				
			<? 	}else{
					echo '<div class="alert alert-info">Sorry, no record was found for the specified service request ID.</div>';
				}
			?>
			
				
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
<script type="text/javascript">
	function showScheduleModal(id){
		<? if(count($details)>0){?>
				$("#myLargeModalLabel").html("New Service Schedule: <?=$details['usernames']?> (ID: 0000"+id+")");
				$("#requestid").val(id);
		<?	}?>
		
	}
	function showScheduleModal2(id){
		$("#myLargeModalLabel2").html("New Invoice: <?=$details['usernames']?> (ID: 0000"+id+")");
		$("#rid").val(id);
	}
	function showPaymentModal3(id,cid,invid,amt_owe){
		$("#myLargeModalLabel3").html("New Payment: <?=$details['usernames']?> (ID: 0000"+id+")");
		$("#max_payment").html("<b>Total Amount Owing:</b> &#8358;"+parseFloat(amt_owe).toFixed(2).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
		$("#amt_owe").attr("data-parsley-max",amt_owe);
		$("#rqstid").val(id);
		$("#cid").val(cid);
		$("#invid").val(invid);
		$("#balance").val(amt_owe);
	}
	function showPaymentModal2(id){
		$("#myModalLabel2").html("Payments History For Invoice #0000"+id);
		$('#loadingimg').show();//indicate to user loading img
		var loadUrl="<?=base_url("cpanel/get_payments_history/?invoiceid=")?>"+id;
		//start the ajax
		$.ajax({
			url: loadUrl,
			type: "POST",
			success: function (html) {
				$('#loadingimg').hide();
				$('#display_payments').html(html);
			},
			error: function(xhr, textStatus, errorThrown) {
				alert('An error occurred! ' + errorThrown);
				$('#loadingimg').hide();
			}									
		});//end of ajax
	}
	function showPaymentModal(id){
		$("#myModalLabel").html("Invoice Details (ID: 0000"+id+")");
		$("#total_amount").html("");	$("#total_amount").html("&#8358;"+$("#total_amount"+id).html());
		$("#submitted_on").html("");	$("#submitted_on").html("&#8358;"+$("#submitted_on"+id).html());
		$("#paid_amount").html("");	$("#paid_amount").html("&#8358;"+$("#paid_amount"+id).html());
		$("#discount_amount").html("");	$("#discount_amount").html("&#8358;"+$("#discount_amount"+id).html());
		$("#invoice_amount").html("");	$("#invoice_amount").html("&#8358;"+$("#invoice_amount"+id).html());
		$("#balance_amount").html("");	$("#balance_amount").html("&#8358;"+$("#balance_amount"+id).html());
		$("#i_status").html("");	$("#i_status").html($("#i_status"+id).html());
		$("#service_request_id").html("");	$("#service_request_id").html($("#service_request_id"+id).html());
		$("#record_date").html("");	$("#record_date").html($("#record_date"+id).html());
		$("#generator_kva").html("");	$("#generator_kva").html($("#generator_kva"+id).html());
		$("#createdon").html("");	$("#createdon").html($("#createdon"+id).html());
		$("#createdby").html("");	$("#createdby").html($("#createdby"+id).html());
		$("#description").html("");	$("#description").html($("#description"+id).html());
		$("#btn_print").attr("href","<?=base_url('cpanel/print_invoice/?id=')?>"+id);
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
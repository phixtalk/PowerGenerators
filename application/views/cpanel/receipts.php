<?	$left="30px"?>
<style>
	@media screen and (min-width: 650px){
		body{
			
		}
	}
</style>
<div class="wrapper">
  <!-- Main content -->
  
	<table width="70%" align="center" style="background: #fff;border: 1px solid #f4f4f4;padding: 20px;padding-left:20px;margin-top: 10px">
		<tr>
			<td align="center">
				<table width="100%">
					<tr>
						<td align="left" width="50%"><img src="<?=base_url("assets/images/logo/g_logo.png")?>" /></td>
						<td align="left">
							<address>
							  <strong style="font-size:14px" class="text-success">Generators.com.ng</strong><br>
							  57, Patnasonic Estate,<br>
							  Mbora District, Idu,<br>
							  Abuja, Nigeria<br>
							  Phone: 0703 760 7291, 0808 604 4229, 0817 067 9993, 0811 892 2935<br>
							  Email: help@generators.com.ng
							</address>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		
		<tr>
			<td align="center">
				<table width="100%">
					<tr>
						<td align="left" colspan="2"><h2 class="page-header text-center"><?=$page_title?></h2></td>
					</tr>
				</table>
			</td>
		</tr>		
		
		<tr>
			<td align="center">
				<table width="100%" style="margin-left: <?=$left?>;" cellspacing="10" cellpadding="10">
					<tr>
						<td align="left">
							<strong>Bill To:</strong>
							<address>
							  <?=@strtoupper($invoice['usernames'])?><br>
							  <?=@$invoice['mobile']?><br>
							  <?=@$invoice['email']?><br>
							</address>
						</td>
						<td align="center">
							<h2><?=$this->utilities->get_status_style($invoice['i_status'])?></h2>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		
		<tr>
			<td align="center">
				<table width="70%" class="table table-striped" cellspacing="10" cellpadding="10">
				  <thead>
				  <tr>
					<th>SN</th>
					<th>ITEM DESCRIPTION</th>
					<th>QTY</th>
					<th class="text-right">UNIT PRICE (&#8358;)</th>
					<th class="text-right">TOTAL PRICE &#8358;</th>
				  </tr>
				  </thead>
				  <tbody>
				  <tr>
					<td>1</td>
					<td><?=$invoice['description']?></td>
					<td>1</td>
					<td class="text-right"><?=@$this->utilities->format_number($invoice['total_amount'])?></td>
					<td class="text-right"><?=@$this->utilities->format_number($invoice['total_amount'])?></td>
				  </tr>
				  <tr>
					<td colspan="4" align="right">Sub Total:</td>
					<td class="text-right"><b>&#8358;<?=@$this->utilities->format_number($invoice['total_amount'])?></b></td>
				  </tr>
				  <tr>
					<td colspan="4" align="right">Discount:</td>
					<td class="text-right"><b>&#8358;<?=@$this->utilities->format_number($invoice['discount_amount'])?></b></td>
				  </tr>
				  <tr>
					<td style="border-top:1px solid black" colspan="4" align="right">Invoice Amount:</td>
					<td style="border-top:1px solid black" class="text-right"><b>&#8358;<?=@$this->utilities->format_number($invoice['invoice_amount'])?></b></td>
				  </tr>
				  <tr>
					<td colspan="4" align="right">Amount Paid:</td>
					<td class="text-right text-green"><b>&#8358;<?=@$this->utilities->format_number($invoice['paid_amount'])?></b></td>
				  </tr>
				  <tr>
					<td style="border-top:1px solid black" colspan="4" align="right">Balance:</td>
					<td style="border-top:1px solid black" class="text-right text-red"><b>&#8358;<?=@$this->utilities->format_number($invoice['amount_owed'])?></b></td>
				  </tr>
				  </tbody>
				</table>
			</td>
		</tr>
		
		<tr>
			<td align="center">
				<table width="100%"  cellspacing="10" cellpadding="10">
					<tr>
						<td align="left" colspan="3">
							<hr style="margin-top:0px;margin-bottom:20px;border-top:2px solid #eee">
						</td>
					</tr>
					<tr>
						<td align="center" colspan="3">
							<b>Bank Account Name:</b>Longjohn Technical Services Ltd.&nbsp;&nbsp;
							<b>Bank Account Number:</b> 2163416013.&nbsp;&nbsp;
							<b>Bank:</b> FCMB.
						</td>
					</tr>
					<tr>
						<td align="left"><br>
							<p class="text-left" style="margin-left: <?=$left?>">Generated From Generators.com.ng Online Portal</p>
						</td>
						<td align="center"><br>
							<a onclick="print()" style="margin-left: <?=$left?>;margin-bottom: 15px" class="btn btn-primary noprint"><i class="fa fa-print"></i> Print</a>
						</td>
						<td align="left"><br>
							<p class="text-right" style="margin-right: <?=$left?>">Generated On: <?=date("l jS-M-Y h:i:s A", strtotime(date("Y-m-d H:i:s")))?></p>
						</td>
					</tr>
				</table>
			</td>
		</tr>

	</table>
  

  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
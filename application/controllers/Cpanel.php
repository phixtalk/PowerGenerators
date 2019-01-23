<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cpanel extends CI_Controller {
	
	public function index(){
		$this->utilities->check_login_status();
		$this->utilities->check_user_admin();
		$this->load->model(array('entity'));
		$data['title'] = 'Dashboard';
		$data['current'] = '1';
		$this->load->view('templates/appheader',$data);
		$this->load->model('users');
		$crumb[0][0] = current_url();
		$crumb[0][1] = 'admin dashboard';
		$crumb[0][2] = 'Admin Dashboard';
		$data['crumb']=$crumb;
		$callstyles['direct_css'] = array(
            'assets/user/dist/css/skins/_all-skins.min.css'
        );
		$this->load->view('templates/plugins/loadstyles',$callstyles);
		/*END LOAD CSS SCRIPTS*/
		$filedirect['filedirect']='assets/user/plugins/jQuery/jquery-2.2.3.min.js';
		$this->load->view('templates/plugins/loaddirect',$filedirect);
		$data['bodyclass'] = '';
		$this->load->view('templates/closeheader',$data);
		$this->load->view('templates/menusidelink',$data);		
		$this->load->view('cpanel/index',$data);
		$this->load->view('templates/closecontent',$data);//google ads

		$callscripts['direct_js'] = array(
			'assets/user/bootstrap/js/bootstrap.min.js',			
			'assets/user/dist/js/app.min.js',			
		);
		$this->load->view('templates/plugins/loadscripts',$callscripts);
		$this->load->view('templates/appfooter');
	}
	public function service_requests(){
		$this->utilities->check_login_status();
		$this->utilities->check_user_admin();
		$this->load->model(array('entity','users'));
		$data['title'] = 'Service Requests';
		$data['current'] = '10';
		$crumb[0][0] = base_url("dashboard");
		$crumb[0][1] = 'member dashboard';
		$crumb[0][2] = 'My Dashboard';
		$crumb[1][0] = current_url();
		$crumb[1][1] = 'service requests';
		$crumb[1][2] = 'Service Requests';
		
		$data['crumb']=$crumb;
		$this->load->view('templates/appheader',$data);
		$this->load->model('users');
		$callstyles['direct_css'] = array(
			'assets/user/plugins/datatables/dataTables.bootstrap.css',
			'assets/user/plugins/datepicker/datepicker3.css',
            'assets/user/dist/css/skins/_all-skins.min.css'
        );
		$this->load->view('templates/plugins/loadstyles',$callstyles);
		/*END LOAD CSS SCRIPTS*/
		$filedirect['filedirect']='assets/user/plugins/jQuery/jquery-2.2.3.min.js';
		$this->load->view('templates/plugins/loaddirect',$filedirect);
		$data['bodyclass'] = '';
		$this->load->view('templates/closeheader',$data);
		$this->load->view('templates/menusidelink',$data);		
		$this->load->view('cpanel/service_requests',$data);
		$this->load->view('templates/closecontent',$data);//google ads

		$callscripts['direct_js'] = array(
			'assets/user/bootstrap/js/bootstrap.min.js',
			'assets/user/plugins/datatables/jquery.dataTables.min.js',
			'assets/user/plugins/datatables/dataTables.bootstrap.min.js',
			'assets/user/plugins/datepicker/bootstrap-datepicker.js',
			'assets/user/dist/js/app.min.js'
		);
		
		$doptions['doptions']='{autoclose: true,format: "yyyy-mm-dd",endDate: "'.date("Y-m-d").'"}';
		$options['options']='{"iDisplayLength": 50,"aLengthMenu": [ 25, 50, 75, 100 ],"paging": true,"lengthChange": true,"searching": true,"ordering": true,"info": true,"autoWidth": true}';
		$this->load->view('templates/plugins/loadscripts',$callscripts);
		$this->load->view('templates/plugins/datatables',$options);
		$this->load->view('templates/plugins/datepicker',$doptions);
		$this->load->view('templates/appfooter');
	}
	public function service_schedule(){
		$this->utilities->check_login_status();
		$this->utilities->check_user_admin();
		$this->load->model(array('entity','users'));
		$data['title'] = 'Service Schedule';
		$data['current'] = '12';
		$crumb[0][0] = base_url("dashboard");
		$crumb[0][1] = 'member dashboard';
		$crumb[0][2] = 'My Dashboard';
		$crumb[1][0] = current_url();
		$crumb[1][1] = 'service schedule';
		$crumb[1][2] = 'Service Schedule';
		
		$data['crumb']=$crumb;
		$this->load->view('templates/appheader',$data);
		$this->load->model('users');
		$callstyles['direct_css'] = array(
			'assets/user/plugins/datatables/dataTables.bootstrap.css',
			'assets/user/plugins/datepicker/datepicker3.css',
            'assets/user/dist/css/skins/_all-skins.min.css'
        );
		$this->load->view('templates/plugins/loadstyles',$callstyles);
		/*END LOAD CSS SCRIPTS*/
		$filedirect['filedirect']='assets/user/plugins/jQuery/jquery-2.2.3.min.js';
		$this->load->view('templates/plugins/loaddirect',$filedirect);
		$data['bodyclass'] = '';
		$this->load->view('templates/closeheader',$data);
		$this->load->view('templates/menusidelink',$data);		
		$this->load->view('cpanel/service_schedule',$data);
		$this->load->view('templates/closecontent',$data);//google ads

		$callscripts['direct_js'] = array(
			'assets/user/bootstrap/js/bootstrap.min.js',
			'assets/user/plugins/datatables/jquery.dataTables.min.js',
			'assets/user/plugins/datatables/dataTables.bootstrap.min.js',
			'assets/user/plugins/datepicker/bootstrap-datepicker.js',
			'assets/user/dist/js/app.min.js'
		);
		
		$doptions['doptions']='{autoclose: true,format: "yyyy-mm-dd",startDate: "'.date("Y-m-d").'"}';
		$options['options']='{"iDisplayLength": 50,"aLengthMenu": [ 25, 50, 75, 100 ],"paging": true,"lengthChange": true,"searching": true,"ordering": true,"info": true,"autoWidth": true}';
		$this->load->view('templates/plugins/loadscripts',$callscripts);
		$this->load->view('templates/plugins/datatables',$options);
		$this->load->view('templates/plugins/datepicker',$doptions);
		$this->load->view('templates/appfooter');
	}
	public function employees(){
		$this->utilities->check_login_status();
		$this->utilities->check_user_admin();
		$this->load->model(array('entity','users'));
		$data['title'] = 'Employees';
		$data['current'] = '11';
		$crumb[0][0] = base_url("dashboard");
		$crumb[0][1] = 'member dashboard';
		$crumb[0][2] = 'My Dashboard';
		$crumb[1][0] = current_url();
		$crumb[1][1] = 'employees';
		$crumb[1][2] = 'Employees';
		
		$data['crumb']=$crumb;
		$this->load->view('templates/appheader',$data);
		$this->load->model('users');
		$callstyles['direct_css'] = array(
			'assets/user/plugins/datatables/dataTables.bootstrap.css',
			'assets/user/plugins/datepicker/datepicker3.css',
            'assets/user/dist/css/skins/_all-skins.min.css'
        );
		$this->load->view('templates/plugins/loadstyles',$callstyles);
		/*END LOAD CSS SCRIPTS*/
		$filedirect['filedirect']='assets/user/plugins/jQuery/jquery-2.2.3.min.js';
		$this->load->view('templates/plugins/loaddirect',$filedirect);
		$data['bodyclass'] = '';
		$this->load->view('templates/closeheader',$data);
		$this->load->view('templates/menusidelink',$data);		
		$this->load->view('cpanel/employees',$data);
		$this->load->view('templates/closecontent',$data);//google ads

		$callscripts['direct_js'] = array(
			'assets/user/bootstrap/js/bootstrap.min.js',
			'assets/user/plugins/datatables/jquery.dataTables.min.js',
			'assets/user/plugins/datatables/dataTables.bootstrap.min.js',
			'assets/user/plugins/datepicker/bootstrap-datepicker.js',
			'assets/user/dist/js/app.min.js'
		);
		
		$doptions['doptions']='{autoclose: true,format: "yyyy-mm-dd",endDate: "'.date("Y-m-d").'"}';
		$options['options']='{"iDisplayLength": 50,"aLengthMenu": [ 25, 50, 75, 100 ],"paging": true,"lengthChange": true,"searching": true,"ordering": true,"info": true,"autoWidth": true}';
		$this->load->view('templates/plugins/loadscripts',$callscripts);
		$this->load->view('templates/plugins/datatables',$options);
		$this->load->view('templates/plugins/datepicker',$doptions);
		$this->load->view('templates/appfooter');
	}
	public function customers(){
		$this->utilities->check_login_status();
		$this->utilities->check_user_admin();
		$this->load->model(array('entity','users'));
		$data['title'] = 'Customers';
		$data['current'] = '16';
		$crumb[0][0] = base_url("dashboard");
		$crumb[0][1] = 'member dashboard';
		$crumb[0][2] = 'My Dashboard';
		$crumb[1][0] = current_url();
		$crumb[1][1] = 'customers';
		$crumb[1][2] = 'Customers';
		
		$data['crumb']=$crumb;
		$this->load->view('templates/appheader',$data);
		$this->load->model('users');
		$callstyles['direct_css'] = array(
			'assets/user/plugins/datatables/dataTables.bootstrap.css',
			'assets/user/plugins/datepicker/datepicker3.css',
            'assets/user/dist/css/skins/_all-skins.min.css'
        );
		$this->load->view('templates/plugins/loadstyles',$callstyles);
		/*END LOAD CSS SCRIPTS*/
		$filedirect['filedirect']='assets/user/plugins/jQuery/jquery-2.2.3.min.js';
		$this->load->view('templates/plugins/loaddirect',$filedirect);
		$data['bodyclass'] = '';
		$this->load->view('templates/closeheader',$data);
		$this->load->view('templates/menusidelink',$data);		
		
		
		/************ WAS PUT HERE SO MODAL CAN LOAD FIRST IF VALIDATION FAILS**/
		$callscripts['direct_js'] = array(
			'assets/user/bootstrap/js/bootstrap.min.js',
			'assets/user/plugins/datatables/jquery.dataTables.min.js',
			'assets/user/plugins/datatables/dataTables.bootstrap.min.js',
			'assets/user/plugins/datepicker/bootstrap-datepicker.js',
			'assets/user/dist/js/app.min.js'
		);
		$this->load->view('templates/plugins/loadscripts',$callscripts);
		/************ WAS PUT HERE SO MODAL CAN LOAD FIRST IF VALIDATION FAILS**/
		
		
		$this->load->view('cpanel/customers',$data);
		$this->load->view('templates/closecontent',$data);//google ads

		
		
		$doptions['doptions']='{autoclose: true,format: "yyyy-mm-dd",endDate: "'.date("Y-m-d").'"}';
		$options['options']='{"iDisplayLength": 50,"aLengthMenu": [ 25, 50, 75, 100 ],"paging": true,"lengthChange": true,"searching": true,"ordering": true,"info": true,"autoWidth": true}';
		
		$this->load->view('templates/plugins/datatables',$options);
		$this->load->view('templates/plugins/datepicker',$doptions);
		$this->load->view('templates/appfooter');
	}
	public function invoices(){
		$this->utilities->check_login_status();
		$this->utilities->check_user_admin();
		$this->load->model(array('entity','users'));
		$data['title'] = 'Invoices';
		$data['current'] = '14';
		$crumb[0][0] = base_url("dashboard");
		$crumb[0][1] = 'member dashboard';
		$crumb[0][2] = 'My Dashboard';
		$crumb[1][0] = current_url();
		$crumb[1][1] = 'invoices';
		$crumb[1][2] = 'Invoices';
		
		$data['crumb']=$crumb;
		$this->load->view('templates/appheader',$data);
		$this->load->model('users');
		$callstyles['direct_css'] = array(
			'assets/user/plugins/datatables/dataTables.bootstrap.css',
			'assets/user/plugins/datepicker/datepicker3.css',
            'assets/user/dist/css/skins/_all-skins.min.css'
        );
		$this->load->view('templates/plugins/loadstyles',$callstyles);
		/*END LOAD CSS SCRIPTS*/
		$filedirect['filedirect']='assets/user/plugins/jQuery/jquery-2.2.3.min.js';
		$this->load->view('templates/plugins/loaddirect',$filedirect);
		$data['bodyclass'] = '';
		$this->load->view('templates/closeheader',$data);
		$this->load->view('templates/menusidelink',$data);		
		$this->load->view('cpanel/invoices',$data);
		$this->load->view('templates/closecontent',$data);//google ads

		$callscripts['direct_js'] = array(
			'assets/user/bootstrap/js/bootstrap.min.js',
			'assets/user/plugins/datatables/jquery.dataTables.min.js',
			'assets/user/plugins/datatables/dataTables.bootstrap.min.js',
			'assets/user/plugins/datepicker/bootstrap-datepicker.js',
			'assets/user/dist/js/app.min.js'
		);
		
		$doptions['doptions']='{autoclose: true,format: "yyyy-mm-dd",endDate: "'.date("Y-m-d").'"}';
		$options['options']='{"iDisplayLength": 50,"aLengthMenu": [ 25, 50, 75, 100 ],"paging": true,"lengthChange": true,"searching": true,"ordering": true,"info": true,"autoWidth": true}';
		$this->load->view('templates/plugins/loadscripts',$callscripts);
		$this->load->view('templates/plugins/datatables',$options);
		$this->load->view('templates/plugins/datepicker',$doptions);
		$this->load->view('templates/appfooter');
	}
	public function request_details($id=""){
		$this->utilities->check_login_status();
		$this->utilities->check_user_admin();
		$this->load->model(array('entity','users'));
		$data['title'] = 'Service Requests';
		$data['current'] = '10';
		if(is_numeric($id)&&$id>0){
			$data['rid'] = $id;
		}else{
			$data['rid'] = "";
		}
		$crumb[0][0] = base_url("dashboard");
		$crumb[0][1] = 'member dashboard';
		$crumb[0][2] = 'My Dashboard';
		$crumb[1][0] = base_url("cpanel/service_requests");
		$crumb[1][1] = 'service requests';
		$crumb[1][2] = 'Service Requests';
		$crumb[2][0] = base_url("cpanel/request_details/".$id);
		$crumb[2][1] = 'service requests details';
		$crumb[2][2] = 'Request Details';
		
		$data['crumb']=$crumb;
		$this->load->view('templates/appheader',$data);
		$this->load->model('users');
		$callstyles['direct_css'] = array(
			'assets/user/plugins/datatables/dataTables.bootstrap.css',
			'assets/user/plugins/datepicker/datepicker3.css',
            'assets/user/dist/css/skins/_all-skins.min.css'
        );
		$this->load->view('templates/plugins/loadstyles',$callstyles);
		/*END LOAD CSS SCRIPTS*/
		$filedirect['filedirect']='assets/user/plugins/jQuery/jquery-2.2.3.min.js';
		$this->load->view('templates/plugins/loaddirect',$filedirect);
		$data['bodyclass'] = '';
		$this->load->view('templates/closeheader',$data);
		$this->load->view('templates/menusidelink',$data);		
		$this->load->view('cpanel/request_details',$data);
		$this->load->view('templates/closecontent',$data);//google ads

		$callscripts['direct_js'] = array(
			'assets/user/bootstrap/js/bootstrap.min.js',
			'assets/user/plugins/datatables/jquery.dataTables.min.js',
			'assets/user/plugins/datatables/dataTables.bootstrap.min.js',
			'assets/user/plugins/datepicker/bootstrap-datepicker.js',
			'assets/user/dist/js/app.min.js'
		);
		
		$doptions['doptions']='{autoclose: true,format: "yyyy-mm-dd",endDate: "'.date("Y-m-d").'"}';
		$options['options']='{"iDisplayLength": 50,"aLengthMenu": [ 25, 50, 75, 100 ],"paging": true,"lengthChange": true,"searching": true,"ordering": true,"info": true,"autoWidth": true}';
		$this->load->view('templates/plugins/loadscripts',$callscripts);
		$this->load->view('templates/plugins/datatables',$options);
		$this->load->view('templates/plugins/datepicker',$doptions);
		$this->load->view('templates/appfooter');
	}
	public function print_invoice(){
		$this->utilities->check_login_status();
		$this->utilities->check_user_admin();
		if(!$this->input->get('id')){
			redirect(base_url("cpanel/feelog"));
			exit;
		}
		$this->load->model(array('entity','users'));
		$rid=$this->input->get('id');
		$chkmemid = $this->session->userdata('memberid');
		if($this->session->userdata('isadmin')==1){
			$chkmemid=0;
		}
		$data['title'] = 'Invoice';
		$data['invoice'] = $this->entity->get_invoice_by_id($rid);
		$data['page_title'] = "INVOICE #000".$rid." (".@$this->utilities->system_date($data['invoice']['record_date']).")";
		$data['page_describe'] = "INVOICE";
		$this->load->view('templates/appheader',$data);
		$callstyles['direct_css'] = array(
			'assets/user/plugins/datatables/dataTables.bootstrap.css',
            'assets/user/dist/css/skins/_all-skins.min.css'
        );
		$this->load->view('templates/plugins/loadstyles',$callstyles);
		$data['bodyclass'] = 'noclass';
		$this->load->view('templates/closeheader',$data);
		$this->load->view('cpanel/receipts',$data);
	}
	public function get_payments_history(){
		$invoiceid = $this->input->get('invoiceid');
		$sql = "SELECT a.*, b.usernames as 'addedby' FROM payments a, userbase b WHERE a.added_by=b.id AND a.invoice_id = ?";
		$query = $this->db->query($sql,array($invoiceid)); 
		//echo $sql;
		if($query->num_rows()>0){
			echo '<table class="table table-striped table-hover table-bordered rwd-table">';
			echo '
					<tr>
					  <th style="width: 10px">SN</th>
						<th>Payment Date</th>
						<th>Payment Method</th>
						<th>Posted On</th>
						<th>Posted By</th>
						<th style="text-align:right">Amount &#8358;</th>
					</tr>
				';
			$d=1;
			$totalpay = 0;
			foreach($query->result_array() as $row){
				$totalpay+=$row['amount'];
				echo '
					<tr>
						<td align="left" width="10px">'.$d.'</td>
						<td align="left">'.$this->utilities->system_date($row['payment_date']).'</td>
						<td align="left">'.$row['payment_method'].'</td>
						<td align="left">'.$this->utilities->system_date($row['added_on'],2).'</td>
						<td align="left">'.$row['addedby'].'</td>
						<td style="text-align:right">'.$this->utilities->format_number($row['amount']).'</td>
					</tr>';
				$d++;
			}
			echo '
				<tr>
					<td style="text-align:right;font-weight:bold" colspan="5">Total:</td>
					<td style="text-align:right;font-weight:bold">'.$this->utilities->format_number($totalpay).'</td>
				</tr>';
			echo '</table>';
		}else{
			echo '<div class="alert alert-info">Sorry, no record was found</div>';
		}
	}
}
	
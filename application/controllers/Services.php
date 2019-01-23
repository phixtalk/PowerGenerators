<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Services extends CI_Controller {
	
	public function index(){
		$this->utilities->check_login_status();
		$this->load->model(array('entity','users'));
		$data['title'] = 'My Service History';
		$data['current'] = '7';
		$crumb[0][0] = base_url("dashboard");
		$crumb[0][1] = 'member dashboard';
		$crumb[0][2] = 'My Dashboard';
		$crumb[1][0] = current_url();
		$crumb[1][1] = 'my service history';
		$crumb[1][2] = 'My Service History';
		
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
		$this->load->view('services/index',$data);
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
	public function new_request(){
		$this->utilities->check_login_status();
		$this->load->model(array('entity'));
		$data['title'] = 'New Service Request';
		$data['current'] = '2';
		$this->load->view('templates/appheader',$data);
		$this->load->model('users');
		$crumb[0][0] = base_url("dashboard");
		$crumb[0][1] = 'my dashboard';
		$crumb[0][2] = 'My Dashboard';
		$crumb[1][0] = current_url();
		$crumb[1][1] = 'new service request';
		$crumb[1][2] = 'New Service Request';
		$data['crumb']=$crumb;
		$callstyles['direct_css'] = array(
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
		$this->load->view('services/new_request',$data);
		$this->load->view('templates/closecontent',$data);//google ads

		$callscripts['direct_js'] = array(
			'assets/user/bootstrap/js/bootstrap.min.js',
			'assets/user/plugins/datepicker/bootstrap-datepicker.js',
			'assets/user/dist/js/app.min.js',
		);
		$doptions['doptions']='{autoclose: true,format: "yyyy-mm-dd",startDate: "'.date("Y-m-d").'"}';
		$this->load->view('templates/plugins/loadscripts',$callscripts);
		$this->load->view('templates/plugins/datepicker',$doptions);
		$this->load->view('templates/appfooter');
	}
}
	
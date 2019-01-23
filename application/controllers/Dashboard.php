<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends CI_Controller {
	public function index(){
		$this->utilities->check_login_status();
		$this->load->model(array('entity'));
		$data['title'] = 'Dashboard';
		$data['current'] = '1';
		$this->load->view('templates/appheader',$data);
		$this->load->model('users');
		$crumb[0][0] = current_url();
		$crumb[0][1] = 'my dashboard';
		$crumb[0][2] = 'My Dashboard';
		$data['crumb']=$crumb;
		/*LOAD CSS SCRIPTS
        $callstyles['page_css'] = array(
            'fontawesome/css/font-awesome.min.css','animate.css/animate.min.css','chosen_v1.2.0/chosen.min.css'
        );
        $callstyles['theme_css'] = array(
            'reset.css','layout.css','components.css','plugins.css'
        );*/
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
		$this->load->view('dashboard/index',$data);
		$this->load->view('templates/closecontent',$data);//google ads

		$callscripts['direct_js'] = array(
			'assets/user/bootstrap/js/bootstrap.min.js',			
			'assets/user/dist/js/app.min.js',			
		);
		$this->load->view('templates/plugins/loadscripts',$callscripts);
		$this->load->view('templates/appfooter');
	}
}
	
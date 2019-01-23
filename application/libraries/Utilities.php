<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Utilities {
	public function __construct(){
		//parent::__construct();	
		@session_start();	
		date_default_timezone_set('Africa/Lagos');
	}
	
	private $classdiv = NULL;
	private $msg = NULL;
	
	public function check_login_status(){
		$CI =& get_instance();
		$CI->load->library('session');
		if($CI->session->userdata('logged_in')!=TRUE){
			$array_items = array('logged_in'=>'',''=>'');			
			$CI->session->set_userdata($array_items);
			//$CI->session->sess_destroy();
			$CI->session->set_flashdata('flag','failure');
			$CI->session->set_flashdata('message','Please login to continue.');				
			redirect(base_url('/login?redir=true&nxturl='.urlencode(current_url())));
			exit;
		}elseif($CI->session->userdata('memberstatus')!="1"){
			$CI->session->set_flashdata('flag','failure');
			$CI->session->set_flashdata('message','Your account is Inactive.<br>Please Contact System Administrator.');				
			redirect(base_url("login"));
			exit;
		}
		
	}
	public function check_user_admin(){
		$CI =& get_instance();
		$CI->load->library('session');
		if($CI->session->userdata('isadmin')!=1){
			$CI->session->set_flashdata('flag','info');
			$CI->session->set_flashdata('message','You need Admin Privileges to access last requested page.');redirect(base_url('dashboard'));
		}
	}
	public function get_post_status($status){
		$color="";
		$caption="";
		if($status=="2"){
			$color = "Red";
			$caption = "CANCELLED";
		}elseif($status=="1"){
			$color = "Green";
			$caption = "POSTED";
		}
		$result = "<font color='".$color."'><b>".$caption."</b></font>";
		return $result;
	}
	public function get_status_style($status){
		$color="";
		if($status=="DEPARTED"||$status=="REJECTED"){
			$color = "Red";
		}elseif($status=="ACTIVE"||$status=="COMPLETED"||$status=="VERIFIED"||$status=="PAID"){
			$color = "Green";
		}elseif($status=="PROCESSING"){
			$color = "Blue";
		}elseif($status=="PENDING"){
			$color = "Orange";			
		}
		$result = "<font color='".$color."'><b>".$status."</b></font>";
		return $result;
	}
	public function get_bread_crumbs($crumb){
		?>
			<ol class="breadcrumb">
		<?
			$i = 0;
			if(is_array($crumb)){
				for($i=0;$i<sizeof($crumb);$i++){?>
					<li><a href="<?=$crumb[$i][0]?>" class="<?=(sizeof($crumb)-$i>1?"":"active")?> noprint" title="<?=$crumb[$i][1]?>"><?=($i==0?"<i class='fa fa-dashboard'></i>":"")?> <?=$crumb[$i][2]?></a></li>
		<? 
			}
		?>
			</ol>
		<?
		} 
	}
	
	public function get_account_status($status,$mode=1){
		$color="";$result="";
		if($mode==1){
			if($status==0){
				$caption = "PENDING";
				$color = "Orange";
			}elseif($status==1){
				$caption = "POSTED";
				$color = "Green";
			}elseif($status==2){
				$caption = "REVERSED";
				$color = "Red";
			}
			$result = "<font color='".$color."'><b>".$caption."</b></font>";
		}elseif($mode==2){	
			if($status==0){
				$caption = "INACTIVE";
				$color = "Red";
			}elseif($status==1){
				$caption = "ACTIVE";
				$color = "Green";
			}
			$result = "<font color='".$color."'><b>".$caption."</b></font>";
		}elseif($mode==3){
			if($status==0){
				$result = "INACTIVE";
			}elseif($status==1){
				$result = "ACTIVE";
			}	
		}
		return $result;
	}
	public function get_img_url($mode,$file){
		$return="";
		if($mode==1||$mode==2){//for pdf downloads or email attachments
			$return=$_SERVER["DOCUMENT_ROOT"]."/assets/".$file;
		}else{
			$return=base_url("assets/".$file);
		}
		return $return;	
	}
	public function get_report_header($width,$watermark=""){
		$CI =& get_instance();		
		$CI->load->library('session');
		$school = $_SESSION['userDetails'];
		$compLogo="";
		if($school->logo!=""){
			$compLogo=$school->logo;
		}
		$html = "";
		$hyphn="";
		if($school->schoolwebsite!=""){
			$hyphn=" - ";
		}
		//'.$_SERVER["DOCUMENT_ROOT"].'/assets/companylogos/'.$compLogo.'
		//<link id="base-style" href="'.base_url().'assets/css/pdf-style.css" rel="stylesheet">
		$html .= '
		<table width="'.$width.'" class="table table-default table-middle table-striped table-bordered table-condensed mytable">
		  <tr>
			<td align="center">
				<img src="assets/'.$compLogo.'" alt="Logo" />
			</td>
		  </tr>
		  <tr>
			<td>
				'.$school->headercaption.'
				'.$hyphn.'
				'.$school->schoolwebsite.'</b><br />
				'.$school->schoolemail.'<br />
				'.$school->schoolphone.'<br />
				'.$school->schooladdress.'<br />
			</td>';
			
			$html .= '
		  </tr>
		</table><br>';
		return $html;
	}
	public function select_another_module(){		
		$html = '<div class="col-md-5 col-sm-9 col-xs-12">
		<select name="gonext" onChange="if(this.value==\'\'){}else{parent.location=this.form.gonext.value}" class="form-control" >                    
			<option value="">Select Another Category</option>
			<option value="'.base_url("accounting/income").'">Income Manager</option>
			<option value="'.base_url("accounting/expenditure").'">Expense Manager</option>
			<option value="'.base_url("accounting/liabilities").'">Liabilities Manager</option>
			<option value="'.base_url("accounting/receivables").'">Receivables Manager</option>
			<option value="'.base_url("accounting/assets").'">Assets Manager</option>
			<option value="'.base_url("accounting/equity").'">Equity Manager</option>
		</select></div>';
		return $html;
	}
	public function get_report_footer($width){
		$CI =& get_instance();		
		$CI->load->library('session');
		return "";
	}
    public function generate_form_key(){
        //Get the IP-address of the user
        $ip = $_SERVER['REMOTE_ADDR'];
         
        //We use mt_rand() instead of rand() because it is better for generating random numbers.
        //We use 'true' to get a longer string.
        //See http://www.php.net/mt_rand for a precise description of the function and more examples.
        $uniqid = uniqid(mt_rand(), true);
         
        //Return the hash
        return md5($ip . $uniqid);
    }	
	public function generate_token($mode="new"){
		$u = $_SESSION['userDetails'];
		if($mode=="new"){
			$token = md5(date("Y-m-d H:i:s"));
		}elseif($mode="check"){
			if($u->acctType=="ADMIN"){
				$token = md5(date("Y-m-d H:i:s"));
			}else{
				$token = $u->token;
			}
		}elseif($mode="session"){
			$token = $u->token;
		}else{
			$token = $u->token;
		}
		return($token);	
	}
	public function show_notification($flag,$message){
		$display="";
    	if($flag=="success"){
			$this->classdiv = "alert-success";
		}elseif($flag=="failure"){
			$this->classdiv = "alert-danger";
		}elseif($flag=="alert"){
			$this->classdiv = "alert-warning";
		}elseif($flag=="warning"){
			$this->classdiv = "alert-warning";
		}elseif($flag=="info"){
			$this->classdiv = "alert-info";
		}
		if($flag!=""&&$message!=""){
			$display.='<div class="alert '.$this->classdiv.' noprint"><button type="button" class="close" data-dismiss="alert">&times;</button>';
			if(is_array($message)){
				foreach ($message as $notice)  {
					$display.=$notice['messagestore']."<br>";
				}
			}else{
				$display.=$message;
			}
			$display.='</div>';
		}
		return($display);
	}
	public function show_login_device($loggedin,$device,$mode){
		if($loggedin=="1"){
			if($device=="Desktop"){
				$dclass="fa-globe";
				$dtitle="login via desktop";
			}else{
				$dclass="fa-mobile";
				$dtitle="login via ".$device;
			}
		}else{
			$dclass="";
			$dtitle="";
		}
		$display="<i class='fa ".$dclass." fa-fw' title=".$dtitle."></i>";
        return $display;
	
	}
	public function login_error($message){    	
		if($message!=""){
			$this->msg = '<div>'.$message.'</div>';
		}
		
		return($this->msg);	
	}
	public function get_date_time(){
		$format = "Y-m-d H:i:s";
		$today =  date($format);
		return ($today);
	}
	public function limit_words($string, $word_limit){
		$words = explode(" ",$string);
		return implode(" ", array_splice($words, 0, $word_limit
		));
	}
	public function array_keys_multi($array,$value,$mode="s"){
		$allkeys = array();
		$h=0;
		foreach($array as $keyy => $valuee){
			if($mode=="s"){
				if(in_array($value,$valuee)){
					$allkeys[$h] = $keyy;
					$h++;
				}
			}elseif($mode=="i"){
				if(in_array(strtolower($value), array_map('strtolower', $valuee))){
					$allkeys[$h] = $keyy;
					$h++;
				}		
			}
		}
		return $allkeys;	
	}
	public function array_search_multi_dimension($array,$value,$mode="s"){	
		foreach($array as $keyy => $valuee){
			if($mode=="s"){
				if(in_array($value,$valuee)){
					return $keyy;
				}
			}elseif($mode=="i"){
				if(in_array(strtolower($value), array_map('strtolower', $valuee))){
					return $keyy;
				}		
			}
		}
		return NULL;
	}
	public function find_links($text){
		$text = html_entity_decode($text);
		$text = " ".$text;
		$text = preg_replace('%(((f|ht){1}tp://)[-a-zA-^Z0-9@:\%_\+.~#?&//=]+)%i',
				'<a href="\\1" target=_blank>\\1</a>', $text);
		$text = preg_replace('%(((f|ht){1}tps://)[-a-zA-^Z0-9@:\%_\+.~#?&//=]+)%i',
				'<a href="\\1" target=_blank>\\1</a>', $text);
		
		$text = preg_replace('%([[:space:]()[{}])(www.[-a-zA-Z0-9@:\%_\+.~#?&//=]+)%i',
				'\\1<a href="http://\\2" target=_blank>\\2</a>', $text);
		
		$text = preg_replace('%([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3})%i',
		'<a href="mailto:\\1" target=_blank>\\1</a>', $text);
		return $text;
	}		
	public function time_ago($date){
		if(empty($date)) {
			return "No date provided";
		}
	 
		$periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
		$lengths = array("60","60","24","7","4.35","12","10");
	 
		$now = time();
		$unix_date = strtotime($date);
	 
	   // check validity of date
		if(empty($unix_date)) {    
			return "Bad date";
		}
	 
		// is it future date or past date
		if($now > $unix_date) {    
			$difference = $now - $unix_date;
			$tense = "ago";
	 
		} else {
			$difference = $unix_date - $now;
			$tense = "from now";
		}
	 
		for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
			$difference /= $lengths[$j];
		}
	 
		$difference = round($difference);
	 
		if($difference != 1) {
			$periods[$j].= "s";
		}
	 
		return "$difference $periods[$j] {$tense}";
	}
	public function get_day($name,$class,$title,$select,$validate="true"){
		$num="";
		$day = "<select name='".$name."' id='".$name."' class='".$class."' title='".$title."' ".($validate=="true"?"data-parsley-required='true'":"")."><option value=''>".ucwords($title)."</option>";
		for ($i=1; $i<=32; $i++){
			if($i<10){$num="0".$i;}else{$num=$i;}
			$day .= "<option ".($select==$num?"selected ":"")."value='".$num."'>". $num ."</option>";
			if ($i == 31){break;}
		}
		$day .= "</select>";
		return($day);
	}
	public function get_month($name,$class,$title,$select,$validate="true"){
	
    	$month = "<select name='".$name."' class='".$class."' title='".$title."' ".($validate=="true"?"data-parsley-required='true'":"")."><option value=''>".ucwords($title)."</option>";
		$month .= "<option ".($select=='JANUARY'?" selected ":"")." value='JANUARY'>JANUARY</option>";
		$month .= "<option ".($select=='FEBRUARY'?" selected ":"")." value='FEBRUARY'>FEBRUARY</option>";
		$month .= "<option ".($select=='MARCH'?" selected ":"")." value='MARCH'>MARCH</option>";
		$month .= "<option ".($select=='APRIL'?" selected ":"")." value='APRIL'>APRIL</option>";
		$month .= "<option ".($select=='MAY'?" selected ":"")." value='MAY'>MAY</option>";
		$month .= "<option ".($select=='JUNE'?" selected ":"")." value='JUNE'>JUNE</option>";
		$month .= "<option ".($select=='JULY'?" selected ":"")." value='JULY'>JULY</option>";
		$month .= "<option ".($select=='AUGUST'?" selected ":"")." value='AUGUST'>AUGUST</option>";
		$month .= "<option ".($select=='SEPTEMBER'?" selected ":"")." value='SEPTEMBER'>SEPTEMBER</option>";
		$month .= "<option ".($select=='OCTOBER'?" selected ":"")." value='OCTOBER'>OCTOBER</option>";
		$month .= "<option ".($select=='NOVEMBER'?" selected ":"")." value='NOVEMBER'>NOVEMBER</option>";
		$month .= "<option ".($select=='DECEMBER'?" selected ":"")." value='DECEMBER'>DECEMBER</option>";
		
		$month .= "</select>";

		return($month);
	}
	public function get_year($name,$class,$title,$select,$validate="true"){
		$num="";
		$year = "<select name='".$name."' id='".$name."' class='".$class."' title='".$title."' ".($validate=="true"?"data-parsley-required='true'":"")." style='cursor:pointer'><option value=''>".ucwords($title)."</option>";
		$current = date('Y')+1;
		$enddate = 1905;
		for ($i=1; $i<=500; $i++){ 
			$year .= "<option ".($select==$current?" selected ":"")." value='".$current."' >". $current ."</option>";
			if ($current == $enddate)
				break;
			$current = $current - 1; 
		}
		$year .= "</select>";
		return($year);
	}
	public function get_month_value($name,$class,$title,$select,$validate="true"){
	
    	$month = "<select name='".$name."' id='".$name."'  class='".$class."' title='".$title."' ".($validate=="true"?"data-parsley-required='true'":"")."><option value=''>".ucwords($title)."</option>";
		$month .= "<option ".($select=='01'?" selected ":"")." value='01'>JANUARY</option>";
		$month .= "<option ".($select=='02'?" selected ":"")." value='02'>FEBRUARY</option>";
		$month .= "<option ".($select=='03'?" selected ":"")." value='03'>MARCH</option>";
		$month .= "<option ".($select=='04'?" selected ":"")." value='04'>APRIL</option>";
		$month .= "<option ".($select=='05'?" selected ":"")." value='05'>MAY</option>";
		$month .= "<option ".($select=='06'?" selected ":"")." value='06'>JUNE</option>";
		$month .= "<option ".($select=='07'?" selected ":"")." value='07'>JULY</option>";
		$month .= "<option ".($select=='08'?" selected ":"")." value='08'>AUGUST</option>";
		$month .= "<option ".($select=='09'?" selected ":"")." value='09'>SEPTEMBER</option>";
		$month .= "<option ".($select=='10'?" selected ":"")." value='10'>OCTOBER</option>";
		$month .= "<option ".($select=='11'?" selected ":"")." value='11'>NOVEMBER</option>";
		$month .= "<option ".($select=='12'?" selected ":"")." value='12'>DECEMBER</option>";
		
		$month .= "</select>";

		return($month);
	}
	public function get_last_letter($word,$count){
		$cnt = (int) $count;
		return (int)substr($word,$cnt);
	}
	public function get_date_diff($date1,$date2,$mode){
		$d1 = new DateTime($date1);
		$d2 = new DateTime($date2);
		$yrbtw = $d1->diff($d2)->y;
		return $yrbtw;
	
	}
	public function format_number($number,$default=2){
		if($default==2){
			return number_format($number,2);
		}else{
			return number_format($number);
		}
	}
	public function system_date($date,$mode=1){
		if(trim($date)!=""){
			if($mode==1){
				return date("jS-M-Y", strtotime($date));
			}else{
				return date("jS-M-Y h:i:s A", strtotime($date));
			}
		}
	}
	public function get_format_date($date,$mode='default'){
		$fdt = explode(' ',$date);
		$dt = explode('-',$fdt[0]);
		$newdt="";
		if($mode=="default"){
		$newdt = $dt[2]."-".@$this->convert_month($dt[1])."-".$dt[0];
		}else{
			$newdt = $dt[2]."-".substr(@$this->convert_month($dt[1]),0,3)."-".$dt[0];
		}
		
		return $newdt;
	
	}
	public function format_date($date,$mode="default"){
		$fdt = explode(' ',$date);
		$dt = explode('-',$fdt[0]);
		$tm = explode(':',$fdt[1]);
		if($mode=="default"){
			
		$newdt = $dt[2]."-".substr($this->convert_month($dt[1]),0,3)."-".$dt[0];
		}elseif($mode=="word"){
			if($dt[1]>9){
				$month=$dt[1];
			}else{
				$month=$this->get_last_letter($dt[1],-1);
			}
			if($dt[2]>9){
				$day=$dt[2];
			}else{
				$day=$this->get_last_letter($dt[2],-1);
			}
			$newdt=date("l M d, Y",mktime($tm[0],$tm[1],$tm[2],$month,$day,$this->get_last_letter($dt[0],-4)));
		}else{
			$newdt = $dt[2]."-".substr($this->convert_month($dt[1]),0,3)."-".$dt[0];
		}
		
		return $newdt;
		
	}
	public function get_alert_message($notice,$type,$storyid,$senderid,$id){
		if($notice==1){//comment
			$message="commented on your story";
			$link="stories/".$storyid."/?nid=".$id."&clear=true";
		}elseif($notice==2){//hype
			$message="hyped your ".($type==1?"huztle story":"page")."";
			if($type==1){
				$link="stories/".$storyid."/?nid=".$id."&clear=true";
			}else{
				$link="page/".$senderid."/?nid=".$id."&clear=true";
			}			
		}elseif($notice==3){//follow
			$message="is now following you";
			$link="page/".$senderid."/?nid=".$id."&clear=true";
		}elseif($notice==4){//share
			$message="shared your huztle story";
			$link="story";
		}elseif($notice==5){//new message
			$message="sent you a private message";
			$link="message";
		}
		$alert['message']=$message;
		$alert['link']=$link;
		return($alert);
	}
	public function get_extension($str) {
	
		 $i = strrpos($str,".");
		 if (!$i) { return ""; } 
	
		 $l = strlen($str) - $i;
		 $ext = substr($str,$i+1,$l);
		 return $ext;
	}			
	public function convert_month_back($mymonth){
		$month=array('','JANUARY','FEBRUARY','MARCH','APRIL','MAY','JUNE','JULY','AUGUST','SEPTEMBER','OCTOBER','NOVEMBER','DECEMBER',);
		foreach($month as $key => $value){
			if($value==$mymonth){
				if($key<10){
					$key="0".$key;
					return($key);
				}else{
					return($key);
				}
				
			}
		}
	}
	public function convert_month($month){
		if($month == '01'){
			$mymonth = 'JANUARY';
		}elseif($month == '02'){
			$mymonth = 'FEBRUARY';		
		}elseif($month == '03'){
			$mymonth = 'MARCH';		
		}elseif($month == '04'){
			$mymonth = 'APRIL';		
		}elseif($month == '05'){
			$mymonth = 'MAY';		
		}elseif($month == '06'){
			$mymonth = 'JUNE';		
		}elseif($month == '07'){
			$mymonth = 'JULY';		
		}elseif($month == '08'){
			$mymonth = "AUGUST";		
		}elseif($month == '09'){
			$mymonth = 'SEPTEMBER';		
		}elseif($month == '10'){
			$mymonth = 'OCTOBER';		
		}elseif($month == '11'){
			$mymonth = 'NOVEMBER';		
		}elseif($month == '12'){
			$mymonth = 'DECEMBER';		
		}
		
		return $mymonth;
	
	}
	public function get_position_array($end){
		$position = array();//create an array variable
		for($i = 1; $i <= $end; $i++){//start loop from 1 to specified end
			$ch = substr($i,-1);//get the last digit of the current iteration
			$c2 = substr($i,-2);//get the last 2 digits of the current iteration
			if($c2==11 || $c2==12 || $c2==13){// if there is a last 2 digit, check to see if it is 11, 12 or 13
				$position[$i] = $i."th";//if true, append 'th' to the digit and store in array variable
			}else{//if it is are no last 2 digits, or there is but there are not 11, 12 or 13
				if($ch==1){//now if last digit ends with 1, append 'st'
					$position[$i] = $i."st";//
				}elseif($ch==2){//if last digit ends with 2, append 'nd'
					$position[$i] = $i."nd";
				}elseif($ch==3){//if last digit ends with 1, append 'srd'
					$position[$i] = $i."rd";
				}else{//else, append 'th'
					$position[$i] = $i."th";
				}	
			}
		}
		return $position;
	
	}
	public function custom_email_template($body,$to,$company="default"){
		$CI =& get_instance();		
		$CI->load->library('session');
		
		//$u = $_SESSION['userDetails'];

		$companyname=$CI->session->userdata('global_company');
		
		$companyname=$CI->session->userdata('global_company');
		$usernames=$CI->session->userdata('global_company');
		$useremail=$CI->session->userdata('global_email');
		$website=$CI->session->userdata('global_website');
		$imgsrc="<img src='".base_url("assets/images/logo/g_logo.png")."' title='logo' />";
		$signature="";
		if($company!="default"){
			
				$signature.="
						<tr>
						  <td align='left'><hr></hr></td>
						</tr>
						<tr>
							<td align='left' style='font-family:Tahoma, Geneva, sans-serif;font-size:11px;color:grey'>
	  	This email was sent to ".$to." by ".$usernames." of ".$companyname." via the <a style='color:#4c7cbd' href='".$website."'>".$companyname."</a>
		<br>
		<b>Please do not reply this email directly</b>
		<br>
		<b>If you wish to reply the sender of this mail</b>
		<a style='color:#4c7cbd' href='mailto:".$useremail."' title='click to reply ".$usernames."'><b>Click Here</b></a>
							</td>
						</tr>
				";
	
		}//end of if email was sent via a user
		
		$custombody = "
<table align='center' style='width:100%;' cellpadding='5' cellspacing='5'>
   <tr>
	  <td style='background: #3c8dbc;background: -moz-linear-gradient(top, #3c8dbc 0%, #3c8dbc 100%);background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#3c8dbc), color-stop(100%,#3c8dbc));background: -webkit-linear-gradient(top, #3c8dbc 0%,#3c8dbc 100%);background: -o-linear-gradient(top, #3c8dbc 0%,#3c8dbc 100%);background: -ms-linear-gradient(top, #3c8dbc 0%,#3c8dbc 100%);background: linear-gradient(top, #3c8dbc 0%,#3c8dbc 100%);filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#3c8dbc', endColorstr='#3c8dbc',GradientType=0 );color:#FFFFFF;'><strong style='color:white'>".$companyname."</strong>
	  </td>
	</tr>
	<tr>
      <td align='center'>
      ".$imgsrc."
      </td>
	</tr>
	<tr>
      <td align='left'>
      ".nl2br($body)."
      </td>
	</tr>
	".$signature."
	<tr>
	  <td align='left' style='font-family:Tahoma, Geneva, sans-serif;font-size:11px;color:grey'>
	  	This email was sent to ".$to." 
		<br>
		Courtesy of <a style='color:#4c7cbd' href='".$website."'>".$companyname."</a> &copy; ".date('Y')."
		
	  </td>
	</tr>
</table>
	";
	//echo $custombody; exit;
	return($custombody);
	}
	public function highlight_words($text, $words){
	/*** loop of the array of words ***/
		foreach ($words as $word){
			/*** quote the text for regex ***/
			$word = preg_quote($word);
			/*** highlight the words ***/
			$text = preg_replace("/\b($word)\b/i", '<span class="highlight_word">\1</span>', $text);
		}
		/*** return the text ***/
		return $text;
	}
	public function Pagination($total, $per_page = 10,$page = 1, $url){
		//$query = "SELECT COUNT(*) as `num` FROM {$query}";
		//$row = mysql_fetch_array(getQueryResult($query));
		//$total = $row['num'];
		$adjacents = "2"; 
	
		$page = ($page == 0 ? 1 : $page);  
		$start = ($page - 1) * $per_page;								
		
		$prev = $page - 1;							
		$next = $page + 1;
		$lastpage = ceil($total/$per_page);
		$lpm1 = $lastpage - 1;
		
		$pagination = "";
		if($lastpage > 1)
		{	
			$pagination .= "<ul class='pagination' style='width:100%'>";
					$pagination .= "<li class='details'>Page $page of $lastpage</li>";
			if ($lastpage < 7 + ($adjacents * 2))
			{	
				for ($counter = 1; $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<li><a class='current'>$counter</a></li>";
					else
						$pagination.= "<li><a href='{$url}page=$counter'>$counter</a></li>";					
				}
			}
			elseif($lastpage > 5 + ($adjacents * 2))
			{
				if($page < 1 + ($adjacents * 2))		
				{
					for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
					{
						if ($counter == $page)
							$pagination.= "<li><a class='current'>$counter</a></li>";
						else
							$pagination.= "<li><a href='{$url}page=$counter'>$counter</a></li>";					
					}
					$pagination.= "<li class='dot'>...</li>";
					$pagination.= "<li><a href='{$url}page=$lpm1'>$lpm1</a></li>";
					$pagination.= "<li><a href='{$url}page=$lastpage'>$lastpage</a></li>";		
				}
				elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
				{
					$pagination.= "<li><a href='{$url}page=1'>1</a></li>";
					$pagination.= "<li><a href='{$url}page=2'>2</a></li>";
					$pagination.= "<li class='dot'>...</li>";
					for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
					{
						if ($counter == $page)
							$pagination.= "<li><a class='current'>$counter</a></li>";
						else
							$pagination.= "<li><a href='{$url}page=$counter'>$counter</a></li>";					
					}
					$pagination.= "<li class='dot'>..</li>";
					$pagination.= "<li><a href='{$url}page=$lpm1'>$lpm1</a></li>";
					$pagination.= "<li><a href='{$url}page=$lastpage'>$lastpage</a></li>";		
				}
				else
				{
					$pagination.= "<li><a href='{$url}page=1'>1</a></li>";
					$pagination.= "<li><a href='{$url}page=2'>2</a></li>";
					$pagination.= "<li class='dot'>..</li>";
					for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
					{
						if ($counter == $page)
							$pagination.= "<li><a class='current'>$counter</a></li>";
						else
							$pagination.= "<li><a href='{$url}page=$counter'>$counter</a></li>";					
					}
				}
			}
			
			if ($page < $counter - 1){ 
				$pagination.= "<li><a href='{$url}page=$next'>Next</a></li>";
				$pagination.= "<li><a href='{$url}page=$lastpage'>Last</a></li>";
			}else{
				$pagination.= "<li><a class='current'>Next</a></li>";
				$pagination.= "<li><a class='current'>Last</a></li>";
			}
			$pagination.= "</ul>\n";		
		}
	
		return $pagination;

	}
		
}

/* End of file Utilities.php */
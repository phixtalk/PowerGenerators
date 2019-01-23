<?php

class Entity extends CI_Model {

    function __construct(){
        parent::__construct();
    }
	public function get_entity_by_id($id,$table,$memberid){
		$sql = "SELECT a.*, a.amount as 'amountpaid', a.paymentDate as 'registeredon', a.paymentMethod as 'paymentmode',
				b.usernames, b.mobile, b.email, b.loginid 
				FROM ".$this->db->escape_str($table)." a, userbase b 
				WHERE a.memberId=b.loginid AND a.id=? 
				".($memberid!=""&&$memberid>0?" AND a.memberId = '".$this->db->escape_str($memberid)."'":"")."
				LIMIT 1";
		$query = $this->db->query($sql,array($id));
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return array();
		}
	}
	public function get_bank_by_id($id){
		$sql = "SELECT a.* FROM bank a WHERE a.id=?";
		$query = $this->db->query($sql,array($id));
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return array();
		}
	}
	public function get_all_banks(){
		$sql = "SELECT a.* FROM bank a ORDER BY a.caption";
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result_array();
		}else{
			return array();
		}	
	}
	public function get_all_states(){
		$sql = "SELECT a.* FROM states a ORDER BY a.name";
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result_array();
		}else{
			return array();
		}	
	}
	public function get_member_by_id($memberid){
		$sql = "SELECT a.*, b.name as 'userstate'
				FROM userbase a, states b 
				WHERE a.state = b.id AND a.email = ? LIMIT 1";
		$query = $this->db->query($sql,array($memberid));
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return array();
		}
	}
	public function get_service_details($id){
		$sql = "SELECT a.*, b.usernames, b.mobile, c.name as 'user_state',
		(SELECT COUNT(d.id) FROM servicerequest d WHERE d.s_status = 'PENDING') AS 'total_pending',
		(SELECT SUM(e.amount_owed) FROM invoices e WHERE e.service_request_id = ?) AS 'total_amt_owed',
		
		(SELECT COUNT(f.id) FROM service_schedule f WHERE f.service_request_id = ?) AS 'schedule_count',
		(SELECT COUNT(g.id) FROM invoices g WHERE g.service_request_id = ?) AS 'invoice_count'
		
		FROM servicerequest a, userbase b, states c
		WHERE a.user_id = b.id AND a.state=c.id AND a.id = ?
		
		ORDER BY a.id DESC";
		$query = $this->db->query($sql,array($id,$id,$id,$id));
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return array();
		}
	}
	public function get_services($date1,$date2,$type,$status,$phone,$userid=""){
		$sql = "SELECT a.*, b.usernames, c.name as 'user_state'
		FROM servicerequest a, userbase b, states c
		WHERE a.user_id = b.id AND a.state=c.id
		
		".($userid!=""?" AND a.user_id = '".$this->db->escape_str($userid)."'":"")."
		".($type!=""?" AND a.service_type = '".$this->db->escape_str($type)."'":"")."
		".($status!=""?" AND a.s_status = '".$this->db->escape_str($status)."'":"")."
		".($phone!=""?" AND b.mobile = '".$this->db->escape_str($phone)."'":"")."
		
		".($date1!=""&&$date2!=""?" AND ( a.submitted_on >= '".$this->db->escape_str($date1)."' AND a.submitted_on <= '".$this->db->escape_str($date2)."' )":"")."
		
		ORDER BY a.id DESC";
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result_array();
		}else{
			return array();
		}
	}
	public function get_service_schedule($date1,$date2,$requestid,$status,$technician){
		$sql = "SELECT a.*, b.last_name, b.first_name, c.service_type, d.usernames
		FROM service_schedule a, employee b, servicerequest c, userbase d
		WHERE a.technician = b.id AND a.service_request_id = c.id AND c.user_id = d.id
		
		".($requestid!=""?" AND a.service_request_id = '".$this->db->escape_str($requestid)."'":"")."
		".($technician!=""?" AND a.technician = '".$this->db->escape_str($technician)."'":"")."
		".($status!=""?" AND a.service_status = '".$this->db->escape_str($status)."'":"")."
		
		".($date1!=""&&$date2!=""?" AND ( a.createdon >= '".$this->db->escape_str($date1)."' 
		AND a.createdon <= '".$this->db->escape_str($date2)."' )":"")."
		
		ORDER BY a.id DESC";
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result_array();
		}else{
			return array();
		}
	}
	public function get_invoices($date1,$date2,$requestid,$status,$technician){
		$sql = "SELECT a.*, c.service_type, d.usernames, e.usernames as 'generatedby'
		FROM invoices a, servicerequest c, userbase d, userbase e
		WHERE a.createdby = e.id AND a.service_request_id = c.id AND c.user_id = d.id
		
		".($requestid!=""?" AND a.service_request_id = '".$this->db->escape_str($requestid)."'":"")."
		".($status!=""?" AND a.i_status = '".$this->db->escape_str($status)."'":"")."
		
		".($date1!=""&&$date2!=""?" AND ( a.createdon >= '".$this->db->escape_str($date1)."' 
		AND a.createdon <= '".$this->db->escape_str($date2)."' )":"")."
		
		ORDER BY a.id DESC";
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result_array();
		}else{
			return array();
		}
	}
	public function get_invoice_by_id($id){
		$sql = "SELECT a.*, c.service_type, d.usernames, d.mobile, d.email, e.usernames as 'generatedby'
		FROM invoices a, servicerequest c, userbase d, userbase e
		WHERE a.createdby = e.id AND a.service_request_id = c.id AND c.user_id = d.id
		AND a.id=? ORDER BY a.id DESC";
		$query = $this->db->query($sql,array($id));
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return array();
		}
	}
	public function check_user_application($appid,$phone){
		$sql = "SELECT a.*, 
				(SELECT b.globalvalue FROM settings b WHERE b.caption='APPLICATION_PRICE') as 'formprice'
				FROM userbase a WHERE a.loginid=? AND a.mobile=? AND a.appicationstate='PENDING' LIMIT 1";
		$query = $this->db->query($sql,array($appid,$phone));
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return array();
		}
	}
	public function get_notifications($date1,$date2,$memberid,$mode){
		$sql = "SELECT a.*, b.usernames, b.gender, b.mobile, b.email, b.picture, b.loginid, b.withdrawAmount
		FROM notifications a, userbase b
		WHERE a.memberId = b.loginid AND a.noticeType = ?
		".($memberid!=""?" AND a.memberId = '".$this->db->escape_str($memberid)."'":"")."
		".($date1!=""&&$date2!=""?" AND ( a.paymentDate >= '".$this->db->escape_str($date1)."' AND a.paymentDate <= '".$this->db->escape_str($date2)."' )":"")."
		ORDER BY a.id DESC";
		$query = $this->db->query($sql,array($mode));
		if($query->num_rows()>0){
			return $query->result_array();
		}else{
			return array();
		}
	}
	
	public function get_admin_dashboard_stats(){
		$contri=date("Y-m");
		$sql = "SELECT COUNT(a.id) AS 'total_members',
				(SELECT COUNT(b.id) FROM userbase b WHERE b.memberstatus='ACTIVE') AS 'active_members',
				(SELECT COUNT(c.id) FROM userbase c WHERE c.memberstatus='DEPARTED') AS 'departed_members',
				(SELECT SUM(d.withdrawAmount) FROM userbase d) AS 'total_withdraw',
				(SELECT SUM(e.nonWithdrawAmount) FROM userbase e) AS 'total_nonwithdraw',
				(SELECT SUM(f.amountpaid) FROM userbase f WHERE (f.memberstatus='ACTIVE' OR f.memberstatus='DEPARTED') 
				AND f.registeredon LIKE '%".$this->db->escape_like_str($contri)."%' ) AS 'total_fee',
				(SELECT SUM(g.amount) FROM withdrawals g WHERE g.monthPeriodId=?) AS 'total_month_cash'
				FROM userbase a";
		$query = $this->db->query($sql,array(date("m")));
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return array();
		}
	}
	public function get_member_dashboard_stats($userid){
		$contri=date("Y-m");
		$sql = "SELECT SUM(a.withdrawAmount) as 'total_withdraw', SUM(a.nonWithdrawAmount) as 'total_nonwithdraw',
				(SELECT SUM(b.amount) FROM withdrawals b WHERE b.monthPeriodId=? AND b.id = ?) AS 'total_month_cash'
				FROM userbase a WHERE a.id = ?";
		$query = $this->db->query($sql,array(date("m"),$userid,$userid,));
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return array();
		}
	}
}
<?php

class Users extends CI_Model {

    function __construct(){
        parent::__construct();
    }

	public function get_user_by_field($field,$id){
		$sql = "SELECT a.*, b.caption as 'userbank' FROM userbase a, bank b
				WHERE a.bank = b.id AND a.".$this->db->escape_str($field)." = ? LIMIT 1";
		$query = $this->db->query($sql,array($id)); 
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return array();
		}
	}

	public function get_users_by_field($field,$id){
		$sql = "SELECT a.* FROM userbase a
				WHERE a.".$this->db->escape_str($field)." = ? ";
		$query = $this->db->query($sql,array($id)); 
		if($query->num_rows()>0){
			return $query->result_array();
		}else{
			return array();
		}
	}
	public function get_employees($date1,$date2){
		$sql = "SELECT a.*, b.name as 'state' FROM employee a, states b
		WHERE a.stateid = b.id
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
	public function get_employee_by_type($type){
		$sql = "SELECT a.* FROM employee a WHERE a.role = ? ";
		$query = $this->db->query($sql,array($type)); 
		if($query->num_rows()>0){
			return $query->result_array();
		}else{
			return array();
		}
	}
	public function get_customers($date1,$date2){
		$sql = "SELECT a.*, b.name as 'state' FROM userbase a, states b
		WHERE a.state = b.id AND a.isadmin = '0' 
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
	public function get_registration_log($date1,$date2){
		$sql = "SELECT a.*, b.usernames as 'addedby', c.name as 'userstate',
				(SELECT SUM(d.amountpaid) FROM userbase d WHERE (b.memberstatus='ACTIVE' OR b.memberstatus='DEPARTED') AND ( a.registeredon >= ? AND a.registeredon <= ?) ) AS 'total_amount'
				FROM userbase a, userbase b, states c
				WHERE a.createdby = b.id AND a.state = c.id AND (b.memberstatus='ACTIVE' OR b.memberstatus='DEPARTED') 
				AND ( a.registeredon >= ? AND a.registeredon <= ?) ORDER BY a.id DESC";
		$query = $this->db->query($sql,array($date1,$date2,$date1,$date2));
		if($query->num_rows()>0){
			return $query->result_array();
		}else{
			return array();
		}	
	}
	public function get_users($mode=1){
		$mem_status=" AND (b.memberstatus='ACTIVE' OR b.memberstatus='DEPARTED')";
		if($mode==2){
			$mem_status=" AND b.memberstatus='PENDING'";
		}
		$sql = "SELECT a.*, b.usernames as 'addedby', c.name as 'userstate'
				FROM userbase a, userbase b, states c
				WHERE a.createdby = b.id AND a.state = c.id ".$mem_status." 
				ORDER BY a.id DESC";
		$query = $this->db->query($sql); 
		if($query->num_rows()>0){
			return $query->result_array();
		}else{
			return array();
		}
	}
	public function get_members_stats(){
		$sql = "SELECT COUNT(a.id) AS 'total_members',
				(SELECT COUNT(b.id) FROM userbase b WHERE b.memberstatus='ACTIVE') AS 'active_members',
				(SELECT COUNT(c.id) FROM userbase c WHERE c.memberstatus='DEPARTED') AS 'departed_members',
				(SELECT COUNT(d.id) FROM userbase d WHERE d.memberstatus='PENDING') AS 'pending_members'
				FROM userbase a";
		$query = $this->db->query($sql); 
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return array();
		}
	}
	public function get_subaccounts($memberid){
		$sql = "SELECT a.* FROM userbase a WHERE a.custodianfk = ? AND a.memberstatus='ACTIVE'";
		$query = $this->db->query($sql,array($memberid)); 
		if($query->num_rows()>0){
			return $query->result_array();
		}else{
			return array();
		}
	}
	public function get_login_user($username,$password){
		$field = "email";
		if(is_numeric($username)){
			$field = "mobile";
		}
		$sql = "SELECT a.* FROM userbase a
				WHERE a.".$field." = ? AND a.loginpass = ? LIMIT 1";
		$query = $this->db->query($sql,array($username,$password)); 
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return array();
		}
	}
	public function check_user_upgrade_status($userid,$levelid){
		$sql = "SELECT a.id FROM upgrades a
				WHERE a.userid = ? AND a.levelid = ? 
				AND a.astatus = 1 LIMIT 1";
		$query = $this->db->query($sql,array($userid,$levelid)); 
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return array();
		}
	}
	public function check_upgrades($userid,$limit=""){
		$more="";
		if($limit!=""){
			$more=" LIMIT 0, ".$limit;
		}
		$sql = "SELECT a.*, b.fullnames, b.email, b.phone, b.username, c.caption as 'levelcaption'
				FROM upgrades a, userbase b, stagelevel c
				WHERE a.userid = b.id AND a.uplinkid = ? AND a.astatus = '0' AND a.levelid=c.id
				ORDER BY a.id DESC".$more;
		$query = $this->db->query($sql,array($userid)); 
		if($query->num_rows()>0){
			return $query->result_array();
		}else{
			return array();
		}	
	}
	public function get_user_donations_total($userid){
		$sql = "SELECT 
				(SELECT SUM(a.amount) FROM upgrades a WHERE a.userid = ? AND a.astatus = 1) AS 'cashout',
				(SELECT SUM(b.amount) FROM upgrades b WHERE b.uplinkid = ? AND b.astatus = 1) AS 'cashin'";
		$query = $this->db->query($sql,array($userid,$userid)); 
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return array();
		}	
	}
	public function get_messages($userid,$mode=""){
		$addmore="";
		if($mode==1){
			$addmore=" AND a.seen = 1";
		}elseif($mode==0){
			$addmore=" AND a.seen = 0";
		}
		$sql = "SELECT a.*, b.fullnames, b.email, b.username, b.currentlevel, b.phone
				FROM messages a, userbase b WHERE a.senderid = b.id AND a.receiverid = ? AND a.rdelete = '0' " .$addmore . " ORDER BY a.id DESC";
		$query = $this->db->query($sql,array($userid));
		if($query->num_rows()>0){
			return $query->result_array();
		}else{
			return array();
		}
	}
}
/* End of file users.php */
?>
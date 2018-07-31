<?php
//testing
class DB_Model extends CI_Model {

	/*

	This model is for all the basic common DB stuff. 

	*/

	public function __construct() {
	}


	public function getUserName($userid){
		if(is_numeric($userid)){
			$sql = "SELECT Username from users where ID='$userid'";
			$query = $this->db->query($sql);
			return $query->row()->Username;
		}
	}

	public function getNews(){
		$sql = "SELECT * from news ORDER by TimeStamp DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
}

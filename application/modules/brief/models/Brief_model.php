<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Brief_model extends CI_Model {
	function getClient($user_id){

		// $sql = 'SELECT `client_id`, `name` FROM `client` WHERE `status` = "Active" AND `is_deleted` = "No" AND client_id in (SELECT `client_id` FROM `user_client` WHERE `user_id` = "'. $user_id .'")';
		// $query = $this->db->query($sql);
		// return $query->result();

		//print query
		// $query = $this->db->query($sql);
		// $query->result();
		$query = $this->db->select('client.client_id,name')
                 		  ->from('client')
						  ->where(array('status' => 'Active','is_deleted'=>'No'))
						  ->join('user_client','user_client.user_id = "'.$user_id.'" and client.client_id = user_client.client_id')
						  ->get();

		return $query->result();
	}
		//Get Brief ID
		function get($id){
		return $this->db->get_where("Brief",array("Brief_ID" => $id))->result_array();
	}
	
	// Get Brand of the client
  function getClientBrand($postData){
    $response = array();
 
    // Select record
    $query = $this->db->select('Brand_Name')
					->from('client')	
					->where('Client_ID', $postData)
					->get();
    $response = $query->result_array();

    return $response;
  }

 function save($data, $Brief_ID = null)
 {

 	if(empty($Brief_ID))
 	{
 		return $this->db->insert('Brief',$data);
 	}
 	else{
 		return $this->db->update('Brief',$data,array("Brief_ID" => $Brief_ID));
 	}
 	
 }

 function getLastRow($table,$column)
 {
 	$query = $this->db->select($column)
 					->from($table)
 					->Order_by('Brief_ID','desc')
 					->limit(1)
 					->get();
 	if($query->num_rows() == 1){
 		$brief = $query->row();
 		return $brief->$column;
 	}
 	else{
 		return 1;
 	}
 }

 function DisplayList($user_id)		
 {
 	$query = $this->db->select('Brief_ID,Brief_no,Year, client.name,Brief.Brand_Name,Brief_Status, DATE_FORMAT(Brief_Date, "%m/%d/%Y %h:%i %p")as Brief_Date, users.name as creator')
					->from('Brief')
					->order_by('Brief_ID','desc')
					->where('Brief.is_deleted','No')	
					->join('client','client.client_id = Brief.Client_ID')
					->join('users','users.id = Brief.created_by')
					->join('user_client','user_client.user_id = "'.$user_id.'" and client.client_id = user_client.client_id')
					->get();

    $response = $query->result_array();
    return $response;

  //   $sql = "SELECT `Brief_ID`, `Brief_no`, `Year`, `client`.`name`, `Brief`.`Brand_Name`, `Brief_Status`, DATE_FORMAT(`Brief_Date`, "%m/%d/%Y %h:%i %p")as `Brief_Date`, `users`.`name` as `creator` FROM `Brief` JOIN `client` ON `client`.`client_id` = `Brief`.`Client_ID` JOIN `users` ON `users`.`id` = `Brief`.`created_by` WHERE `Brief`.`is_deleted` = 'No' AND `client`.`client_id` in (SELECT `client_id` FROM `user_client` WHERE `user_id` = '"'. $user_id .'"')";

		// $query = $this->db->query($sql);
		// return $query->result();
 }



}
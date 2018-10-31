<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Client_model extends CI_Model {
	
	
	function get($id){
		return $this->db->get_where("client",array("client_id" => $id))->result_array();
	}
	
	public function all_clients(){
		$query = $this->db->select('client_id, client.name, client.brand_name, client.address, client.status,client.created_at, users.name as creator')
						->join('users','users.id = client.created_by')
		                ->from('client')
						->order_by('client_id','desc')		                
						->where('client.is_deleted', 'No')
						->get();
						
		return $query->result();
	}
	function getFormdata($ID) {
		 $query = $this->db->select('*')
						->from('client')
						->where('client_id', $ID)
						->where('is_deleted', 'No')
						->get();
		 if ($query->num_rows() >= 1) {
			return $query->result();
		 } else {
			return false;
		 }
    }
	
	function updateRecord($tableName, $data, $column, $value) {
		 $this->db->where("$column", $value);
		 $this->db->update($tableName, $data);
		 //print_r($this->db->last_query());
		 //exit;
		 if ($this->db->affected_rows() > 0) {
		   return true;
		 } else {
		   return true;
		 }
   }
	
	public function add_client($data)
	{
		$response="";
		
				if($this->db->insert("client",$data))
				{
					/* Send Mail to Dealer */ 
					return true;
					
				}else{
					return false;
				}
			
		
		return $response;
		
	}
	public function save($data,$id=''){
		if(empty($id)){
			if($this->db->insert("client",$data)){
			/* Send Mail to Dealer */ 
				$insert_id = $this->db->insert_id();
				$this->addClientToUser($insert_id);
				return true;
			}
		}
		else{
			if($this->db->update("client",$data,array("client_id" => $id))){
				
				return true;
			}
		}
		return false;
	}
	public function addClientToUser($id){
		$query = $this->db->select('id')
		                  ->from('users')
						  ->where('role', 1)
						  ->get();
		$users = $query->result_array();
		$clients_data = array();
		foreach ($users as $user) {
			$clients_data['user_id'] = $user['id'];
			$clients_data['client_id'] = $id;
			$this->db->insert("user_client",$clients_data);
		}
	}
}
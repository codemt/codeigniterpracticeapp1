<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
	
	public function roles()
	{
		$query = $this->db->select('role_id, name')
		                  ->get('role');
		return $query->result();
	}
	
	public function all_users(){
		$query = $this->db->select('id, users.name, username, status, role.name as role')
		                  ->from('users')
						  ->order_by('id','desc')
						  ->join('role', 'role_id = role')
						  ->where('is_deleted', 'No')
						  ->order_by('id', 'asc')
						  ->get();

		return $query->result();
	}
	
	public function get_user($user_id){
		$query = $this->db->select('users.id, users.name, username, status , role')
		                  ->from('users')
						  ->where('users.id', $user_id)
						  ->get();

		return $query->result_array();
	}
	
	public function get_user_client($user_id){
		$query = $this->db->select('client_id')
		                  ->from('user_client')
						  ->where('user_id', $user_id)
						  ->get();

		$clients = $query->result_array();
		$i=0;
		$clients_data = array();
		foreach ($clients as $client) {
			$clients_data[$i++] = $client['client_id'];
		}
		return $clients_data;
	}

	public function clients(){
		$query = $this->db->select('client_id, 	name')
						  ->get('client');

		//$all_clients = $this->db->select				  

	//	print_r($query->result());				  
		return $query->result();
	}

	public function save($data, $id = null, $clients = null){
		if(empty($id)){
			if($this->db->insert("users",$data)){
				$insert_id = $this->db->insert_id();
				$clients_data = array();
				foreach ($clients as $client) {
					$clients_data['user_id'] = $insert_id;
					$clients_data['client_id'] = $client;
					$this->db->insert("user_client",$clients_data);
				}
				return true;
			}
		}
		else{
			if($this->db->update("users",$data,array("id" => $id))){
				$this->db->where('user_id', $id)
						 ->delete('user_client');
				$clients_data = array();
				foreach ($clients as $client) {
					$clients_data['user_id'] = $id;
					$clients_data['client_id'] = $client;
					$this->db->insert("user_client",$clients_data);
				}
				return true;
			}
		}
		return false;
	}
	public function update($data, $id){
		if($this->db->update("users",$data,array("id" => $id))){
			return true;
		}
		return false;
	}
}
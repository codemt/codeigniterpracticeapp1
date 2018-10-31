<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Roles_model extends CI_Model {
	
	public function all_roles(){
		$query = $this->db->select('role_id, name')
						  ->order_by('role_id', 'asc')
						  ->get('role');

		return $query->result();
	}
	
	public function get_role($role_id){
		$query = $this->db->select('role_id, name')
		                  ->from('role')
						  ->where('role_id', $role_id)
						  ->get();

		return $query->result_array();
	}

	public function save($data, $id = null, $permissions){
		if(empty($id)){
			if($this->db->insert("role",$data)){
			/* Send Mail to Dealer */ 
				$insert_id = $this->db->insert_id();
				$permissions_data = array();
				foreach ($permissions as $permission) {
					$permissions_data['role_id'] = $insert_id;
					$permissions_data['permissions_id'] = $permission;
					$this->db->insert("role_permissions",$permissions_data);
				}
				return true;
			}

		}
		else{
			if($this->db->update("role",$data,array("role_id" => $id))){
				$this->db->where('role_id', $id)
						 ->delete('role_permissions');

				$permissions_data = array();
				foreach ($permissions as $permission) {
					$permissions_data['role_id'] = $id;
					$permissions_data['permissions_id'] = $permission;
					$this->db->insert("role_permissions",$permissions_data);
				}
				return true;
			}
		}
		return false;
	}

	public function all_permissions(){
		$query = $this->db->select('permissions_id, name, module')
						  ->order_by('permissions_id', 'asc')
						  ->get('permissions');
		return $query->result();
	}

	public function all_modules(){
		$query = $this->db->select('module')
						  ->order_by('permissions_id', 'asc')
						  ->group_by('module')
						  ->get('permissions');
		return $query->result();
	}
	
	public function get_permissions($role_id){
		$query = $this->db->select('permissions_id')
		                  ->from('role_permissions')
						  ->where('role_id', $role_id)
						  ->get();
		
		$permissions = $query->result_array();
		$i=0;
		$permissions_data = array();
		foreach ($permissions as $permission) {
			$permissions_data[$i++] = $permission['permissions_id'];
		}
		return $permissions_data;
	}
}
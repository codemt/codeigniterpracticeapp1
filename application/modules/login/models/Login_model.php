<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model
{
	public function login($username, $password){
		$query = $this->db->select('name, username, id, password, status')
						  ->where('username', $username)
						  ->limit(1)
						  ->order_by('id', 'desc')
						  ->get('users');
		
		if ($query->num_rows() === 1){
			$user = $query->row();
			if($user->status == "Inactive"){
				return false;
			}

			if(password_verify($password , $user->password)){
				return false;
			}
			$this->set_session($user);
			return true;
		} else {
			return false;
		}
	}

	private function set_session($user)
	{
		$session_data = array(
		    'name'					=> $user->name,
		    'username'				=> $user->username
		);	
		$this->session->set_userdata($session_data);
		return true;
	}
	public function get_user_id(){
		$username = $this->session->userdata('username');
		$query = $this->db->select('id')
						  ->where(array('username' => $username, 'status' => 'Active'))
						  ->limit(1)
						  ->order_by('id', 'desc')
						  ->get('users');
		if ($query->num_rows() == 1){
			$user = $query->row();
			return $user->id;
		}
		return NULL;
	}
	public function logged_in(){
		$username = $this->session->userdata('username');

		$query = $this->db->select('id')
						  ->where(array('username' => $username, 'status' => 'Active'))
						  ->limit(1)
						  ->order_by('id', 'desc')
						  ->get('users');
		
		if ($query->num_rows() != 1){
			return false;
		}
		return (bool)$this->session->userdata('username');
	}

	public function firstLogin($username) {
		$query = $this->db->select('first_login')
						  ->where('username', $username)
						  ->get('users');
		$result = $query->result();
		if ($query->num_rows() == 1){
			$user = $query->row();
			$first_login = $user->first_login;
			if($first_login == "Yes"){
				return true;
			} else {
				return false;
			}
		}
		return false;
	}

	public function logout()
	{		
		$this->session->unset_userdata(array('name', 'username'));
		$this->session->sess_destroy();
	}

	public function canAccess($permission)
	{
		$username = $this->session->userdata('username');
		$query = $this->db->select('role')
						  ->where('username', $username)
						  ->get('users');
		$result = $query->result();
		if ($query->num_rows() == 1){
			$user = $query->row();
			$role_id = $user->role;
			$query1 = $this->db->select('permissions_id')
						  ->where('code', $permission)
						  ->get('permissions');
			$result1 = $query1->result();
			if ($query1->num_rows() == 1){
				$permissions = $query1->row();
				$permissions_id = $permissions->permissions_id;
				$query2 = $this->db->select('permissions_id')
                  				  ->from('role_permissions')
								  ->where(array('role_id'=> $role_id, 'permissions_id'=> $permissions_id))
								  ->get();
				$result2 = $query2->result();
				if ($query2->num_rows() >= 1){
					return true;
				}
			}
		}
		return false;
	}
	public function getPermissions()
	{
		$username = $this->session->userdata('username');
		$query = $this->db->select('role')
						  ->where('username', $username)
						  ->get('users');
		$result = $query->result();
		if ($query->num_rows() == 1){
			$user = $query->row();
			$role_id = $user->role;
			$query2 = $this->db->select('code')
               				   ->from('permissions as p')
                  			   ->join('role_permissions as rp', 'rp.permissions_id = p.permissions_id')
							   ->where('role_id', $role_id)
							   ->get();
			$permissions = $query2->result();
			$i=0;
			$permissions_data = array();
			foreach ($permissions as $permission) {
				$permissions_data[$i++] = $permission->code;
			}
			return $permissions_data;
		}
	}
}

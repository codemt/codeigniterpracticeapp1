<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roles extends MX_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation'));
		$this->load->model('roles_model');
		$this->load->model('login/login_model');
	}
	public function index()
	{
		if (!$this->login_model->logged_in())
		{
			redirect('');
		}
		$data['title'] = "Roles";
		$data['roles'] = $this->roles_model->all_roles();
		$this->load->view('template/header', $data);
		$this->load->view('list', $data);
		$this->load->view('template/footer');
	}	
	
	
	
	public function addEdit($id = null)
	{	
		if (!$this->login_model->logged_in())
		{
			redirect('');
		}
		if(!empty($id)){
			$role = $this->roles_model->get_role($id);
			$permissions = $this->roles_model->get_permissions($id);
			$data['data'] = $role[0];
			$data['data']['permissions'] = $permissions;
			$data['title'] = "Edit Role";
		} else {
			$data['title'] = "Add Role";
		}
		$data['permissions'] = $this->roles_model->all_permissions();
		$data['modules'] = $this->roles_model->all_modules();
		$this->load->view('template/header', $data);
		$this->load->view('addEdit', $data);
		$this->load->view('template/footer');
	}
	public function storeRole()
	{
		if (!$this->login_model->logged_in())
		{
			redirect('');
		}

		$this->form_validation->set_rules('name', 'Name', 'required|trim|max_length[150]');
		$this->form_validation->set_rules('permissions[]', 'Permissions', 'required');
		$role_data['role_id'] = $this->input->post('role_id');
		$role_data['name'] = $this->input->post('name');
		$permissions = $this->input->post('permissions');
		if ($this->form_validation->run() === TRUE  && $this->roles_model->save($role_data,$this->input->post('role_id'),$permissions))
		{
			if(empty($this->input->post('id'))) {
				$this->session->set_flashdata('message', 'Role created successfully');
			} else {
				$this->session->set_flashdata('message', 'Role updated successfully');
			}
			redirect('roles');
		}
		else{
			$data['data'] = $this->input->post();
			if(empty($this->input->post('role_id'))){
				$data['title'] = "Add Role";
			} else {
				$data['title'] = "Edit Role";
			}
			$data['permissions'] = $this->roles_model->all_permissions();
			$data['modules'] = $this->roles_model->all_modules();
			$this->load->view('template/header', $data);
			$this->load->view('addEdit', $data);
			$this->load->view('template/footer');
		}
	}
}

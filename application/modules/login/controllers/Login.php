<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation'));
		$this->load->model('login_model');
	}
	public function index()
	{
		if (!$this->login_model->logged_in())
		{
			$this->load->view('login');	
		}
		else
		{
			$data['title'] = "Dashboard";
			$data['username'] = $this->session->userdata('username');
			$data['permissions'] = $this->login_model->getPermissions();
			$this->load->view('template/header', $data);
			$this->load->view('home');
			$this->load->view('template/footer');
		}
	}
	public function loginvalidate()
	{		
		
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if ($this->form_validation->run() === TRUE && $this->login_model->login($this->input->post('username'), $this->input->post('password')))
		{
			$changePassword = $this->login_model->firstLogin($this->session->userdata('username'));
			if($changePassword){
				$url = "user/changePassword";
			} else{
				$url ="";
			}
			echo json_encode(array("success"=>"1","url"=>"$url","msg"=>"You are successfully logged In."));
			exit;
		}
		else
		{
			echo json_encode(array("success"=>"0","msg"=>"Invalid Username or Password"));
			exit;
		}
	}
	public function logout()
	{		
		$this->login_model->logout();
		redirect('', 'refresh');
	}
}

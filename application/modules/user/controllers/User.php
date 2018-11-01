<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MX_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation'));
		$this->load->model('user_model');
		$this->load->model('login/login_model');
		$this->load->library('email');
	}
	public function index()
	{
		if (!$this->login_model->logged_in())
		{
			redirect('');
		}
		if(!$this->login_model->canAccess('user_list')){
			redirect('');
		}
		$data['permissions'] = $this->login_model->getPermissions();
		$data['title'] = "Users";
		$data['users'] = $this->user_model->all_users();
		$this->load->view('template/header', $data);
		$this->load->view('list');
		$this->load->view('template/footer');
	}	
	
	public function changePassword()
	{
		if (!$this->login_model->logged_in())
		{
			redirect('');
		}
		else{
			$changePassword = $this->login_model->firstLogin($this->session->userdata('username'));
			if(!$changePassword){
				redirect('');
			}
			else{
				$this->load->view('changePassword');
			}
		}
	}	
	public function updatePassword()
	{
		if (!$this->login_model->logged_in())
		{
			redirect('');
		}
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|max_length[16]|regex_match[/[0-9]/]|regex_match[/[!@#$%^&*()\-_=+{};:,<.>§~]/]',array('regex_match' => 'Password Should include 1 Number and 1 Special Character'));
		$this->form_validation->set_rules('comfirmPassword', 'comfirmPassword', 'required|matches[password]');
		if ($this->form_validation->run())
		{
			$data['password'] =  password_hash($this->input->post('password'),PASSWORD_DEFAULT);
			$data['first_login'] = "No";
			$this->user_model->update($data,$this->login_model->get_user_id());
			echo json_encode(array("success"=>"1","url"=>"","msg"=>"Password Changed Successfully"));
			exit;
		}
		else
		{
			$msg = (validation_errors() ? validation_errors() : "Password Not changed Try Again.");
			echo json_encode(array("success"=>"0","msg"=>"$msg"));
			exit;
		}
	}	
	
	public function addEdit($id = null)
	{	
		if (!$this->login_model->logged_in())
		{
			redirect('');
		}
		if(!empty($id)){
			if(!$this->login_model->canAccess('user_edit')){
				redirect('');
			}
			$user = $this->user_model->get_user($id);
			$data['data'] = $user[0];
			$data['data']['clients'] = $this->user_model->get_user_client($id);

		
			$data['title'] = "Edit User";
			$data['edit'] = 1;
		} else {
			if(!$this->login_model->canAccess('user_add')){
				redirect('');
			}
			$data['title'] = "Add User";
			$data['edit'] = 0;
		}
		$data['permissions'] = $this->login_model->getPermissions();
		$data['roles'] = $this->user_model->roles();
		$data['clients'] = $this->user_model->clients();

		// get all Clients Option.
		// $all = "all";
		// array_push($data['clients'],$all);
		// print_r($data['clients']);
		// exit();
		$this->load->view('template/header', $data);
		$this->load->view('addEdit', $data);
		$this->load->view('template/footer');
	}
	public function storeUser()
	{
		if (!$this->login_model->logged_in())
		{
			redirect('');
		}
		if(!$this->login_model->canAccess('user_edit') || !$this->login_model->canAccess('user_add')){
			redirect('');
		}
		$this->form_validation->set_rules('name', 'Name', 'required|trim|max_length[150]');
		$this->form_validation->set_rules('role', 'Role', 'trim|required');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');
		$this->form_validation->set_rules('clients[]', 'Client', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		$user_data =  $this->input->post();
		//print_r($user_data);
		//exit();



		
		

	
		
		if(empty($this->input->post('id'))){
			$this->form_validation->set_rules('username', 'Username', 'trim|required|valid_email|is_unique[users.username]');
			$user_data['created_at'] = date("Y-m-d");
			$user_data['first_login'] = "Yes";
			$password = $this->random_password();
			$user_data['password'] =  password_hash($this->random_password(),PASSWORD_DEFAULT);
		} else {
			if($this->input->post('resetPassword') == "on"){
				$user_data['first_login'] = "Yes";
				$password = $this->random_password();
				$user_data['password'] =  password_hash($this->random_password(),PASSWORD_DEFAULT);
				unset($user_data['resetPassword']);
			}
		}
		unset($user_data['clients']);
		$email = $user_data['username'];	

		//print_r($all_client_data);
	//	print_r($this->input->post('clients'));

		foreach($this->input->post('clients') as $client_names)
		{

			if( $client_names == "All"){


				echo "Yes";
			
				$query = $this->db->select('client_id')->get('client');

				$all_client_data = json_encode($query->result(), true);

				$all_client_data = json_decode($all_client_data,true);

				$all_clients = array();

				foreach($all_client_data as $value){

						array_push($all_clients,$value['client_id']);

				}
					
				print_r($all_clients);
				print_r($this->input->post('clients'));
				$this->user_model->save($user_data,$this->input->post('id'),$all_clients);

				// redirect clients
				$login_link = base_url();

			if(empty($this->input->post('id')))
			{
					$message = "<h2>Welcome to MX Software</h2> <br/>";
					$message .= "<p>Login Link: $login_link</p><br/>";
					$message .= "<p>Username: $email</p><br/>";
					$message .= "<p>Password: $password</p><br/>";
					$this->sendEmail($email, 'Welcome to MX Software', $message);
					$this->session->set_flashdata('message', 'User created successfully');
			} 
			else
			 {
						if($this->input->post('resetPassword') == "on"){
							$message = "<h2>New Password for MX software </h2> <br/>";
							$message .= "<p>Login Link: $login_link</p><br/>";
							$message .= "<p>Username: $email</p><br/>";
							$message .= "<p>Password: $password</p><br/>";
							$this->sendEmail($email, 'New Password for MX Software', $message);
						}
						$this->session->set_flashdata('message', 'User updated successfully');
			}

			redirect('user');
				//exit();
			}


		}

			//exit();

		if ($this->form_validation->run() === TRUE  && $this->user_model->save($user_data,$this->input->post('id'),$this->input->post('clients')))
		{
			$login_link = base_url();
			if(empty($this->input->post('id'))){
				$message = "<h2>Welcome to MX Software</h2> <br/>";
				$message .= "<p>Login Link: $login_link</p><br/>";
				$message .= "<p>Username: $email</p><br/>";
				$message .= "<p>Password: $password</p><br/>";
				$this->sendEmail($email, 'Welcome to MX Software', $message);
				$this->session->set_flashdata('message', 'User created successfully');
			} else {
				if($this->input->post('resetPassword') == "on"){
					$message = "<h2>New Password for MX software </h2> <br/>";
					$message .= "<p>Login Link: $login_link</p><br/>";
					$message .= "<p>Username: $email</p><br/>";
					$message .= "<p>Password: $password</p><br/>";
					$this->sendEmail($email, 'New Password for MX Software', $message);
				}
				$this->session->set_flashdata('message', 'User updated successfully');
			}
			redirect('user');
		}
		else{
			$data['permissions'] = $this->login_model->getPermissions();
			$data['roles'] = $this->user_model->roles();
			$data['clients'] = $this->user_model->clients();
			$data['data'] = $this->input->post();
			if(empty($this->input->post('id'))){
				$data['title'] = "Add User";
				$data['edit'] = 0;
			} else {
				$data['title'] = "Edit User";
				$data['edit'] = 1;
			}
			$this->load->view('template/header', $data);
			$this->load->view('addEdit', $data);
			$this->load->view('template/footer');
		}
	}
	
	private function sendEmail($to, $subject, $message)
	{
		$this->email->from('hiral.s@itransparity.com', 'MX');
		$this->email->to($to);
		$this->email->subject($subject);
		$this->email->message($message);
		$this->email->set_mailtype("html");
		$this->email->send();
	}
	private function random_password( $length = 8 ) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
		$password = substr( str_shuffle( $chars ), 0, $length );
		return $password;
	}

	public function delete($id)
	{
		if (!$this->login_model->logged_in())
		{
			redirect('');
		}
		if(!$this->login_model->canAccess('user_edit')){
			redirect('');
		}

		$this->user_model->update(array('is_deleted'=>'Yes'),$id);
		$this->session->set_flashdata('message', 'User is deleted successfully');
		redirect('user');
	}
}

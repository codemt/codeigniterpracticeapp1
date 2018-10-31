<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends MX_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation'));
		$this->load->model('client_model');
		$this->load->model('login/login_model');
	}
	public function index()
	{
		if (!$this->login_model->logged_in())
		{
			redirect('');
		}
		if(!$this->login_model->canAccess('client_list')){
			redirect('');
		}
		$data['permissions'] = $this->login_model->getPermissions();
		$data['title'] = "Clients";
		$data['client'] = $this->client_model->all_clients();
		$this->load->view('template/header', $data);
		$this->load->view('list');
		$this->load->view('template/footer');
	}
	
	public function addEdit($id = NULL)
	{
		if (!$this->login_model->logged_in())
		{
			redirect('');
		}
		if(!$this->login_model->canAccess('client_list')){
			redirect('');
		}
		$data['permissions'] = $this->login_model->getPermissions();
		if(!empty($id)){
			$result = $this->client_model->get($id);
			$data['title'] = "Edit Client";
			$data['data'] = $result[0];
			$data['edit'] = 1;
		}
		else{
			$data['title'] = "Add Client";
			$data['data'] = NULL;
			$data['edit'] = 0;
		}
		$this->load->view('template/header', $data);
		$this->load->view('addEdit',$data);
		$this->load->view('template/footer');
	}
	
	public function store() {
		if (!$this->login_model->logged_in())
		{
			redirect('');
		}
		if(!$this->login_model->canAccess('client_add')){
			redirect('');
		}
		$data['permissions'] = $this->login_model->getPermissions();
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('address', 'Address', 'required|max_length[500]');
		$this->form_validation->set_rules('brand_name[]', 'Brand Name', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');
		$this->form_validation->set_rules('state_code', 'State Code', 'numeric|required|max_length[2]|min_length[2]');
		$this->form_validation->set_rules('pan_no', 'PAN', 'required|max_length[10]|min_length[10]|regex_match[/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/]',array('regex_match' => 'PAN should have 1-5 character Alphabet, 6-9 character Numeric and  10th character Alphabet'));
		$this->form_validation->set_rules('tan_no', 'TAN', 'required|max_length[10]|min_length[10]|regex_match[/^[A-Z]{4}[0-9]{5}[A-Z]{1}$/]',array('regex_match' => 'PAN should have 1-4 character Alphabet, 5-9 character Numeric and  10th character Alphabet'));
		$this->form_validation->set_rules('gstin', 'GSTIN', 'required|max_length[15]|min_length[15]|regex_match[/^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/]',array('regex_match' => 'GSTIN should include 1-2 character State Code, 3-12 character PAN and 13-15 character ALPHANUMERIC'));
        $this->form_validation->set_error_delimiters('<p class="error">', '</p>');
		if ($this->form_validation->run() == FALSE)
		{     
			if(empty($this->input->post('client_id'))){
				$data['title'] = "Add Client";
			} else{
				$data['title'] = "Edit Client";
			}
			$data['data'] = $this->input->post();
			$data['data']['brand_name'] = implode(",", $this->input->post('brand_name'));
			$this->load->view('template/header.php', $data);
			$this->load->view('addEdit');
			$this->load->view('template/footer.php');
		} else {
			$brand_name = implode(",", $this->input->post('brand_name'));
			$clientData = $this->input->post();
			$clientData['brand_name'] = $brand_name;
			if(empty($this->input->post('client_id'))){
				$clientData['created_by'] = $this->login_model->get_user_id();
			}
			$clientData['updated_by'] = $this->login_model->get_user_id();

			$inserted = $this->client_model->save($clientData,$this->input->post('client_id'));
			if($inserted){
				if(empty($this->input->post('client_id'))){
					$this->session->set_flashdata('message', 'Client added successfully');
				} else{
					$this->session->set_flashdata('message', 'Client updated successfully');
				}
				redirect('client');
			}
		}
	}
	function getChangestatus($id){
		if (!$this->login_model->logged_in())
		{
			redirect('');
		}
		if(!$this->login_model->canAccess('client_list')){
			redirect('');
		}
		$data['permissions'] = $this->login_model->getPermissions();
		$data = $this->client_model->getFormdata($id);
		$get_status= '';
		if(is_array($data)){
		  $get_status = $data[0]->is_deleted;
		  if($get_status == 'No'){
			$update_data = array('is_deleted'=>'Yes');
			$this->client_model->updateRecord('client',$update_data,'client_id', $id);
		  }else{
			$update_data = array('is_deleted'=>'No');
			$this->client_model->updateRecord('client',$update_data,'client_id', $id);
		  }
		}
			redirect('client');
   }
}

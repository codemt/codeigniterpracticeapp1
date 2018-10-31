<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brief extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation'));
		$this->load->model('client/client_model');
		$this->load->model('brief_model');
		$this->load->model('login/login_model');
	}
	public function index()
	{
     if (!$this->login_model->logged_in())
    {
      redirect('');
    }

    $data['permissions'] = $this->login_model->getPermissions();
		$data['title'] = "Briefs";
    $user_id = $this->login_model->get_user_id();
		$data['briefs'] = $this->brief_model->DisplayList($user_id);
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
    if(!empty($id)){
      if(!$this->login_model->canAccess('brief_edit')){
        redirect('');
      }
      $result = $this->brief_model->get($id);
      $data['title'] = "Edit Brief";
      $data['data'] = $result[0];
    }
    else{
      if(!$this->login_model->canAccess('brief_add')){
        redirect('');
      }
      $data['title'] = "Add Brief";
      $data['data'] = NULL;
    }

    $data['permissions'] = $this->login_model->getPermissions();
    $user_id = $this->login_model->get_user_id();
		$data['client'] = $this->brief_model->getClient($user_id);
		$this->load->view('template/header', $data);
		$this->load->view('addEdit', $data);
		$this->load->view('template/footer');
	}

	
	public function getClientBrand(){ 
    // POST data 
    $postData = $this->input->post('clientID');
    
    // get data 
    $data = $this->brief_model->getClientBrand($postData);
	$data = explode(',',$data[0]['Brand_Name']);
    echo json_encode($data);
  }

  public function yearcal()
  {
  	$year=date("y");
  	$year = (int)$year;
  	$aYear = $year+1;
  	$year = $year."-".$aYear;
  	return $year;
  }


  public function savedata(){
    if (!$this->login_model->logged_in())
    {
      redirect('');
    }
    if(!$this->login_model->canAccess('brief_add') || !$this->login_model->canAccess('brief_edit') ){
        redirect('');
      }
    if(empty($this->input->post('Brief_ID'))) {
      $this->form_validation->set_rules('Client_ID', 'Client Name', 'required');
      $this->form_validation->set_rules('Brand_Name', 'Brand Name', 'required');
    }
    $this->form_validation->set_rules('Brief_Status', 'Brief Status', 'required');
    $this->form_validation->set_rules('Brief_Text', 'Brief Text', 'required');
    $this->form_validation->set_error_delimiters('<p class="error">', '</p>');
    if ($this->form_validation->run() == FALSE)
    {     

      $user_id = $this->login_model->get_user_id();
      $data['client'] = $this->brief_model->getClient($user_id);
      $data['permissions'] = $this->login_model->getPermissions();
      $data['data'] = $this->input->post();
      if(empty($this->input->post('Brief_ID'))) {
        $data['title'] = "Add Brief";
      } else{
        $result = $this->brief_model->get($this->input->post('Brief_ID'));
        $data['title'] = "Edit Brief";
        $brief_details = $result[0];
        $data['data']['Brief_NO'] = $brief_details['Brief_NO'];
        $data['data']['Year'] = $brief_details['Year'];
        $data['data']['Brand_Name'] = $brief_details['Brand_Name'];
        $data['data']['Client_ID'] = $brief_details['Client_ID'];
      }
      $this->load->view('template/header.php', $data);
      $this->load->view('addEdit',$data);
      $this->load->view('template/footer.php');
    }
    else{
  	    $data = $this->input->post();
  	if(empty($this->input->post('Brief_ID'))){
      //Increment Brief No based on financial year
      $briefno = $this->brief_model->getLastRow('Brief','Brief_NO');
      $yeardate = $this->brief_model->getLastRow('Brief', 'Year');
      $data['Year'] = $this->yearcal();
     	if(strcmp($data['Year'],$yeardate)==0){
     		$briefno = $briefno+1;
     		$data['Brief_NO'] = $briefno;
     	}
     	else{
     		$data['Brief_NO'] = 1;
     	}

     	$data['created_by'] = $this->login_model->get_user_id();	
    }
   	
    $data['updated_by'] = $this->login_model->get_user_id();
  	unset($data['_wysihtml5_mode']);

    $d = date('Y-m-d',strtotime($data['Brief_Date']));
    $data['Brief_Date'] = $d;


  	$result=$this->brief_model->save($data,$this->input->post('Brief_ID'));
   	if($result){
      if(empty($this->input->post('Brief_ID')))
        {
          $breifNum = str_pad($data['Brief_NO'],5, "0", STR_PAD_LEFT)."/".$data['Year'];
          $this->session->set_flashdata('message', 'Brief added Successfully<br> Brief No: '.$breifNum);
          redirect('brief');
        }
      else{
          $this->session->set_flashdata('message', 'Brief updated Successfully');
          redirect('brief');
      }
   		
   	}
    }
  }
	
  public function getChangestatus($id)
  {
    if (!$this->login_model->logged_in())
    {
      redirect('');
    }
    if(!$this->login_model->canAccess('brief_edit')){
      redirect('');
    }
    $data = array('is_deleted'=>'Yes');
    $result=$this->brief_model->save($data,$id);
    $this->session->set_flashdata('message', 'Brief deleted Successfully');
        redirect('brief');
  }
	
}

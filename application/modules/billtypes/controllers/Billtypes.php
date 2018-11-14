<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BillTypes extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->library(array('form_validation'));
		$this->load->model('login/login_model');
		$this->load->model('brief/brief_model');
		$this->load->model('billtypes/types_model');	
		$this->load->model('job/job_model');	
	}

	public function index()
	{

	     if (!$this->login_model->logged_in()) {
	    	redirect('');
	    }
		if(!$this->login_model->canAccess('job_list')){
			redirect('');
		}
		$data['permissions'] = $this->login_model->getPermissions();
		$data['title'] = "Bill Types List";
    	$user_id = $this->login_model->get_user_id();
		$data['jobs'] = $this->job_model->DisplayList($user_id);
		
		// print_r($data['jobs']);
		// exit();
		$this->load->view('template/header', $data);
		$this->load->view('list');
		$this->load->view('template/footer');
	}
	
	public function addEdit($id=NULL)
	{

		if (!$this->login_model->logged_in())
	    {
	      redirect('');
	    }
		if(!$this->login_model->canAccess('job_list')){
			redirect('');
		}

    	if(!empty($id))
    	{
    		$result = $this->job_model->get($id);
    		$data['data'] = $result[0];
    		$data['title'] = "Edit Job";
            $out = $this->job_model->get_brief_no_detail($data['data']['brief_id']);
            $data['briefnumber'] = $out[0]['briefnumber'];
            $data['briefdate'] = $out[0]['Brief_Date'];
    	}
    	else
    	{
    		$data['title'] = "Add Bill Type";
    		$data['data'] = NULL;
    	}

		$data['permissions'] = $this->login_model->getPermissions();
    	$user_id = $this->login_model->get_user_id();
		$data['client'] = $this->brief_model->getClient($user_id);
		$this->load->view('template/header', $data);
		$this->load->view('addEdit',$data);
		$this->load->view('template/footer');

	}

	public function getBriefNumber(){ 
    // POST data 
	$postData = $this->input->post();
	// print_r($postData);
	//exit();
    // get data 
    $data = $this->job_model->getBriefNumber($postData);
	//	echo $data;
    if($data == NULL){
    	echo json_encode(array("success"=>"0","msg"=>"No records found"));
    }
    else{
    	
    	echo json_encode(array("success"=>"1","data"=>json_encode($data)));
    }
  }

     public function yearcal()
	  {
	  	$year=date("y");
	  	$year = (int)$year;
	  	$aYear = $year+1;
	  	$year = $year."-".$aYear;
	  	return $year;
	  }	

	  public function savedata()
	  {
	    if (!$this->login_model->logged_in())
	    {
	      redirect('');
	    }
		if(!$this->login_model->canAccess('job_add')){
			redirect('');
		}

	    if(empty($this->input->post('job_id'))) {
			$this->form_validation->set_rules('client_id', 'Client Name', 'required');
			$this->form_validation->set_rules('brand_name', 'Brand Name', 'required');
	    } else{
			$this->form_validation->set_rules('stages', 'Stages', 'required');
	    }
	    $this->form_validation->set_rules('job_title', 'Job Title', 'required');
	    $this->form_validation->set_rules('bill_type', 'Bill Type', 'required');
	    $this->form_validation->set_rules('subactivity', 'Subactivity', 'required');
	    $this->form_validation->set_rules('job_text', 'Job Text', 'required');
        $this->form_validation->set_error_delimiters('<p class="error">', '</p>');

	    if ($this->form_validation->run() == FALSE)
	    {
	     
	        $data['permissions'] = $this->login_model->getPermissions();
    		$user_id = $this->login_model->get_user_id();
	        $data['client'] = $this->brief_model->getClient($user_id);
	        $data['data'] = $this->input->post();
			if(empty($this->input->post('job_id'))) 
			{
				$data['title'] = "Add Job";
			} 
			else
			{
				$data['title'] = "Edit Job";
				$result = $this->job_model->get($this->input->post('job_id'));
				$out = $this->job_model->get_brief_no_detail($data['data']['brief_id']);
				$data['briefnumber'] = $out[0]['briefnumber'];
				$data['briefdate'] = $out[0]['Brief_Date'];
				$data['data']['brand_name'] = $result[0]['brand_name'];
				$data['data']['client_id'] = $result[0]['client_id'];
				$data['data']['job_no'] = $result[0]['job_no'];
				$data['data']['year'] = $result[0]['year'];
			}
	        $this->load->view('template/header', $data);
	        $this->load->view('addEdit',$data);
	        $this->load->view('template/footer');
	    }
	    else
	    {
    		$data = $this->input->post();

			if(empty($this->input->post('job_id')))
			{
				//Increment job No based on financial year
				$jobnum1 = $this->job_model->getLastRow('job','job_no');
				$yeardate = $this->job_model->getLastRow('job', 'year');

				$data['year'] = $this->yearcal();
				if(strcmp($data['year'],$yeardate)==0){
					$jobnum1 = $jobnum1+1;
					$data['job_no'] = str_pad($jobnum1,5, "0", STR_PAD_LEFT);
				}
				else{
					$data['job_no'] = str_pad($jobnum1,5, "0", STR_PAD_LEFT);
				}
				$data['created_by'] = $this->login_model->get_user_id();
				$billTypes = array('AW','IM','CF','DF','IT','WD','AV','PN','FB','EV','PH','DN');
				if(in_array($data['bill_type'], $billTypes)){
					$data['stages'] = "Artwork";
					$data['billable'] = "Yes";
					$data['artwork'] = "Billing";
				}
			} else{

				if($data['bill_date'] == "" ){
					$data['bill_date'] = NULL;
				} else {
					$data['bill_date'] = date("Y-m-d",strtotime($data['bill_date']));
				}
			}
			if(!empty($data['bill_amount'])){
				if($data['stages'] == "Layout"){
					$data['job_status'] = 'Closed Layouts';
				}
				elseif ($data['stages'] == "Artwork" && $data['billable'] == "Yes" && !empty($data['bill_no']) && !empty($data['bill_date'])) {
					$data['job_status'] = 'Billed';
				}
				elseif ($data['stages'] == "Artwork" && $data['billable'] == "Yes") {
					$data['job_status'] = 'Pending for billing';
				}
				elseif ($data['stages'] == "Artwork" && $data['billable'] == "No") {
					$data['job_status'] = 'Finished Jobs';
				}else {
					$data['job_status'] = "";
				}

			} else {
				$data['job_status'] = "";
			}
			unset($data['_wysihtml5_mode']);
			$data['updated_by'] = $this->login_model->get_user_id();

			$d = date("Y-m-d",strtotime($data['job_date']));
			$data['job_date'] = $d;
			$result=$this->job_model->save($data,$this->input->post('job_id'));
			
			if(empty($this->input->post('job_id')))
			{
				$jobnum = $data['bill_type']."/".$data['job_no']."/".$data['year'];
				$this->session->set_flashdata('message', 'Job added Successfully<br> Job No: '.$jobnum);
				redirect('job');
			}
			else
			{
				$this->session->set_flashdata('message', 'Job updated Successfully');
				redirect('job');
			}
		}       	  
    	  
	  }

	public function getChangestatus($id)
  {

	if(!$this->login_model->canAccess('job_list')){
		redirect('');
	}
    $data = array('is_deleted'=>'Yes');
    $result=$this->job_model->save($data,$id);
    $this->session->set_flashdata('message', 'Job deleted Successfully');
        redirect('job');
  }

  public function getTypes(){


		$bill_types = 	$this->types_model->getBillTypes();

		
		//print_r($bill_types);

		// 	$bills = json_encode($bill_types, true);

		// 		$all_billtypes_data = json_decode($bills,true);


		//  print_r($all_billtypes_data);
		$data['permissions'] = $this->login_model->getPermissions();
		$data['title'] = "Bill Types List";
    	$user_id = $this->login_model->get_user_id();
		//$data['jobs'] = $this->types_model->getBillTypes();
		$data['jobs'] = $this->types_model->getCodeTypes();
		// print_r($data['jobs']);
		//  exit();
		$this->load->view('template/header', $data);
		$this->load->view('types_list');
		$this->load->view('template/footer');




  }

  public function addTypes(){





		$data['permissions'] = $this->login_model->getPermissions();
		$data['title'] = "Add Bill Type ";
    	$user_id = $this->login_model->get_user_id();
		$data['client'] = $this->brief_model->getClient($user_id);
		$this->load->view('template/header', $data);
		$this->load->view('newEdit',$data);
		$this->load->view('template/footer');




  }

  public function saveTypes(){

	


				$data = $this->input->post();

				$this->form_validation->set_rules('bill_type', 'Bill Type', 'required');
				$this->form_validation->set_error_delimiters('<p class="error">', '</p>');

				if($this->form_validation->run() == FALSE){
			
			
					$data['permissions'] = $this->login_model->getPermissions();
					$data['title'] = "Add Bill Type ";
					$user_id = $this->login_model->get_user_id();
					$data['client'] = $this->brief_model->getClient($user_id);
					$this->load->view('template/header', $data);
					$this->load->view('newEdit',$data);
					$this->load->view('template/footer');
			
			
					
				  }
				  else{



							// print_r($data);
							// exit();
						$save_data = $this->types_model->saveTypesData($data);


						$this->session->set_flashdata('message', 'Bill Type Added Succesfully');
						redirect('billtypes/getTypes');
						// print_r($save_data);
							//print_r($save_data);







				  }





  }


  public function addActivity(){



		
	$data['permissions'] = $this->login_model->getPermissions();
		$data['title'] = "Bill Types List";
    	$user_id = $this->login_model->get_user_id();
		$data['jobs'] = $this->types_model->getBillTypes();
		
		// print_r($data['jobs']);
		//  exit();
		$this->load->view('template/header', $data);
		$this->load->view('addActivity');
		$this->load->view('template/footer');

  }

  public function getBillTypesJSON(){


	$bill_types = 	$this->types_model->getBillTypes();


	echo json_encode($bill_types);
	//echo json_encode($bill_types);


  }

  public function saveActivity(){


	$data = $this->input->post();
	//print_r($data);


	$this->form_validation->set_rules('activity_name', 'Activity Name', 'required');
	$this->form_validation->set_error_delimiters('<p class="error">', '</p>');

	if($this->form_validation->run() == FALSE){ 



		$data['permissions'] = $this->login_model->getPermissions();
		$data['title'] = "Bill Types List";
    	$user_id = $this->login_model->get_user_id();
		$data['jobs'] = $this->types_model->getBillTypes();
		
		// print_r($data['jobs']);
		//  exit();
		$this->load->view('template/header', $data);
		$this->load->view('addActivity');
		$this->load->view('template/footer');





	 }
	 else{

			$get_bill_name = $this->types_model->getBillName($data['bill_type_id']);


			$bill_name_json =  json_encode($get_bill_name,true);
			$bill_name = json_decode($bill_name_json,true);
			
			// print_r($bill_name);

			$data['abbreviation_name'] = $bill_name[0]['bill_type'];
			// echo " Hello";
			// echo $bill_name[0]['bill_type'];
			$save_activity_data = $this->types_model->saveActivityData($data);

			$this->session->set_flashdata('message', 'Sub Activity Added Successfully');
			redirect('billtypes/getSubTypes');
			//echo $save_activity_data;



	 }

	


  }

  public function getAbbreviationsJSON(){


	$abbrevation_types = $this->types_model->getAbbreviations();


	echo json_encode($abbrevation_types);

  }

  public function deleteType($id){


		$delete_type = $this->types_model->deleteType($id);

		$this->session->set_flashdata('message', 'Bill Type Deleted Successfully');
		redirect('billtypes/getTypes');

		

	
  }

  public function deleteActivity($id){



		$delete_type = $this->types_model->deleteActivity($id);

		$this->session->set_flashdata('message','Sub Activity Deleted Successfully');
		redirect('billtypes/getSubTypes');


  }

  public function getSubTypes(){


	$bill_types = 	$this->types_model->getBillTypes();

	
	//print_r($bill_types);

	// 	$bills = json_encode($bill_types, true);

	// 		$all_billtypes_data = json_decode($bills,true);


	//  print_r($all_billtypes_data);
	$data['permissions'] = $this->login_model->getPermissions();
	$data['title'] = "Bill Types List";
	$user_id = $this->login_model->get_user_id();
	//$data['jobs'] = $this->types_model->getBillTypes();
	$data['jobs'] = $this->types_model->getSubTypes();

	//$data['jobs'] = $this->types_model->getBillTypes();
	// print_r($data['jobs']);
	//  exit();
	$this->load->view('template/header', $data);
	$this->load->view('subactivities_list');
	$this->load->view('template/footer');




}
public function getTypesJSON(){



	$bill_types = 	$this->types_model->getTypes();


	echo json_encode($bill_types);




}

public function getSubTypesJSON(){



	$bill_types = 	$this->types_model->getSubTypes();


	echo json_encode($bill_types);




}

public function getAWTypes(){


$bill_types = 	$this->types_model->getAWTypes();


	echo json_encode($bill_types);
	//echo json_encode($bill_types);


  }

  public function getCFTypes(){


	$bill_types = 	$this->types_model->getCFTypes();
	
	
		echo json_encode($bill_types);
		//echo json_encode($bill_types);
	
	
	  }
	  public function getRFTypes(){


		$bill_types = 	$this->types_model->getRFTypes();
		
		
			echo json_encode($bill_types);
			//echo json_encode($bill_types);
		
		
		  }

		  public function getIMTypes(){


			$bill_types = 	$this->types_model->getIMTypes();
			
			
				echo json_encode($bill_types);
				//echo json_encode($bill_types);
			
			
		}

		public function getCRTypes(){


			$bill_types = 	$this->types_model->getCRTypes();
			
			
				echo json_encode($bill_types);
				//echo json_encode($bill_types);
			
			
			  }

			  public function getFITypes(){


				$bill_types = 	$this->types_model->getCRTypes();
				
				
					echo json_encode($bill_types);
					//echo json_encode($bill_types);
				
				
				  }

				  public function getDFTypes(){


					$bill_types = 	$this->types_model->getDFTypes();
					
					
						echo json_encode($bill_types);
						//echo json_encode($bill_types);
					
					
					  }

					  public function getITTypes(){


						$bill_types = 	$this->types_model->getITTypes();
						
						
							echo json_encode($bill_types);
							//echo json_encode($bill_types);
						
						
						  }

						  public function getWDTypes(){


							$bill_types = 	$this->types_model->getWDTypes();
							
							
								echo json_encode($bill_types);
								//echo json_encode($bill_types);
							
							
							  }

							  public function getAVTypes(){


								$bill_types = 	$this->types_model->getAVTypes();
								
								
									echo json_encode($bill_types);
									//echo json_encode($bill_types);
								
								
								  }
								  
								  public function getPNTypes(){


									$bill_types = 	$this->types_model->getPNTypes();
									
									
										echo json_encode($bill_types);
										//echo json_encode($bill_types);
									
									
									  }

									   
								  public function getFBTypes(){


									$bill_types = 	$this->types_model->getFBTypes();
									
									
										echo json_encode($bill_types);
										//echo json_encode($bill_types);
									
									
									  }

									  public function getEVTypes(){


										$bill_types = 	$this->types_model->getEVTypes();
										
										
											echo json_encode($bill_types);
											//echo json_encode($bill_types);
										
										
										  }

										  public function getPHTypes(){


											$bill_types = 	$this->types_model->getPHTypes();
											
											
												echo json_encode($bill_types);
												//echo json_encode($bill_types);
											
											
											  }

											  public function getDNTypes(){


												$bill_types = 	$this->types_model->getDNTypes();
												
												
													echo json_encode($bill_types);
													//echo json_encode($bill_types);
												
												
												  }

			  

 


}

<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Types_model extends CI_Model {

function getLastRow($table,$column)
 {
 	$query = $this->db->select($column)
 					->from($table)
 					->Order_by('job_id','desc')
 					->limit(1)
 					->get();
 	if($query->num_rows() == 1){
 		$job = $query->row();
 		return $job->$column;
 	}
 	else{
 		return 1;
 	}
 }

 	//Get Job ID
	function get($id)
	{
		return $this->db->get_where("job",array("job_id" => $id))->result_array();
	}


   function get_brief_no_detail($id)
	{
		$query= $this->db->select('CONCAT(LPAD(Brief_NO,5,"0"),"/",Year) as briefnumber,Brief_Date')
						->from('Brief')
						->where('Brief_ID',$id)
						->get();
		$response = $query->result_array();
		return $response;

	}

  function save($data,$jobID=NULL)
 {		

 		if(empty($jobID)){
 			return $this->db->insert('job',$data);
 		}
 		else
 		{
 			return $this->db->update('job',$data,array("job_id" => $jobID));
 		}
 		
 		
 	
 }

	 function getBriefNumber($postData)
	{
		$query = $this->db->select('Brief_ID,CONCAT(LPAD(Brief_NO,5,"0"),"/",Year) as briefnum ,Brief_Date,Brief_Status,Brief_Text')
					->from('Brief')	
					->where(array('Client_ID'=> $postData['clientID'], 'Brand_Name'=> $postData['brandname'] ) )
					->get();
    	$response = $query->result_array();

    	return($response);

	}

	 function DisplayList($user_id)		
	 {
	 	$query = $this->db->select('CONCAT(bill_type,"/",job_no,"/",job.year) as jobnumber,client.name,job.brand_name,job.bill_amount,job.bill_no,job.bill_date, DATE_FORMAT(Brief.Brief_Date, "%m/%d/%Y %h:%i %p")as Brief_Date ,job_title, DATE_FORMAT(job_date, "%m/%d/%Y %h:%i %p")as job_date,job_status,job_id, users.name as creator')
						->from('job')	
						->order_by('job_id','desc')
						->where('job.is_deleted','No')
						->join('client','client.client_id = job.client_id')
						->join('Brief','Brief.Brief_ID = job.brief_id')
						->join('users','users.id = job.created_by')
						->join('user_client','user_client.user_id = "'.$user_id.'" and client.client_id = user_client.client_id')
						->get();

	    $response = $query->result_array();
	    // print_r($response);
		 return $query->result_array();
	 }

	 function getBillTypes(){


		$query = $this->db->select('*')
				->from('billtypes')
				->get();

			return $query->result_array();


	 }

	 function saveTypesData($data){


			$types_data = $data;


			if($this->db->insert('billtypes',$data) === TRUE){
				
				
			
					return "Success";

			}
			

		//	return $types_data;



	 }
	 function getAbbreviations(){


		$query = $this->db->select('*')
				->from('bill_abbreviation')
				->get();

			return $query->result_array();


	 }

	 function saveActivityData($data){



			//$bill_type_id = $data['bill_type'];

			//$activity_name = $data['activity_name'];

			//unset($data['abbreviation_name']);

			$query= $this->db->insert('sub_activities',$data);


			return "Success";





	 }

	 function deleteType($id){


		// $this->db->where('billtypes.id=sub_activities.bill_type_id');
		// $this->db->where('billtypes.id',$id);
		// $this->db->delete(array('billtypes','sub_activities'));

		// return "success";

		$sql = "DELETE billtypes,sub_activities,bill_abbreviation
        FROM billtypes,sub_activities,bill_abbreviation
        WHERE billtypes.id=sub_activities.bill_type_id 
		AND billtypes.id=bill_abbreviation.bill_id
        ";

    $this->db->query($sql, array($id));


			 return "success";

	 }


	 public function getCodeTypes(){


			$query = $this->db->select('*')
			->from('bill_abbreviation')
			->get();

			return $query->result_array();



	 }

	 public function getSubTypes(){


		$query = $this->db->select('*')
		->from('sub_activities')
		->get();

		return $query->result_array();



 }

 function getAWTypes(){


	$query_name='AW';
	$query = $this->db->select('*')
			->from('sub_activities')
			->where('abbreviation_name',$query_name)
			->get();	

	// $query = $this->db->select('*')
	// 		->from('sub_activities')
	// 		->join('bill_abbreviation','bill_abbreviation.bill_id = sub_activities.bill_type_id')
	// 		->get();

		return $query->result_array();


 }
 function getCFTypes(){


	$query_name='CF';
	$query = $this->db->select('*')
			->from('sub_activities')
			->where('abbreviation_name',$query_name)
			->get();

		return $query->result_array();


 }

 public function getRFTypes(){


	$query_name='RF';
	$query = $this->db->select('*')
			->from('sub_activities')
			->where('abbreviation_name',$query_name)
			->get();

		return $query->result_array();
	
	
	  }

	  public function getIMTypes(){


		$query_name='IM';
	$query = $this->db->select('*')
			->from('sub_activities')
			->where('abbreviation_name',$query_name)
			->get();

		return $query->result_array();
		
		
	}

	public function getCRTypes(){



		$query_name='CR';
		$query = $this->db->select('*')
				->from('sub_activities')
				->where('abbreviation_name',$query_name)
				->get();

		return $query->result_array();
		
		
		  }

		  public function getFITypes(){


			$query_name='FI';
			$query = $this->db->select('*')
					->from('sub_activities')
					->where('abbreviation_name',$query_name)
					->get();

		return $query->result_array();
			
			
			  }

			  public function getDFTypes(){


				$query_name='DF';
			$query = $this->db->select('*')
			->from('sub_activities')
			->where('abbreviation_name',$query_name)
			->get();

		return $query->result_array();
				
				
				  }

				  public function getITTypes(){


					$query_name='IT';
					$query = $this->db->select('*')
			->from('sub_activities')
			->where('abbreviation_name',$query_name)
			->get();
		return $query->result_array();
					
					
					  }

					  public function getWDTypes(){


						$query_name='WD';
	$query = $this->db->select('*')
			->from('sub_activities')
			->where('abbreviation_name',$query_name)
			->get();
		return $query->result_array();
						
						  }

						  public function getAVTypes(){


							$query_name='AV';
	$query = $this->db->select('*')
			->from('sub_activities')
			->where('abbreviation_name',$query_name)
			->get();

		return $query->result_array();
							
							  }
							  
							  public function getPNTypes(){


								$query_name='PN';
	$query = $this->db->select('*')
			->from('sub_activities')
			->where('abbreviation_name',$query_name)
			->get();
		return $query->result_array();
								
								  }

								   
							  public function getFBTypes(){


								$query_name='FB';
	$query = $this->db->select('*')
			->from('sub_activities')
			->where('abbreviation_name',$query_name)
			->get();

		return $query->result_array();
								
								  }

								  public function getEVTypes(){


									$query_name='EV';
	$query = $this->db->select('*')
			->from('sub_activities')
			->where('abbreviation_name',$query_name)
			->get();
		return $query->result_array();
									
									
									  }

									  public function getPHTypes(){


										$query_name='PH';
										$query = $this->db->select('*')
												->from('sub_activities')
												->where('abbreviation_name',$query_name)
												->get();

		return $query->result_array();
										
										
										  }

										  public function getDNTypes(){


											$query_name='DN';
	$query = $this->db->select('*')
			->from('sub_activities')
			->where('abbreviation_name',$query_name)
			->get();
								
										return $query->result_array();
											
											
											  }


}
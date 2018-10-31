<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports_model extends CI_Model {

	function getReport($data,$userid)
	{	
		$wher = array();
		if(isset($data['name']))
		{
			$wher['client.client_id'] = $data['name'];
		}
		if (isset($data['brand_name'])) {
			$wher['job.brand_name'] = $data['brand_name'];
		}
		if (isset($data['bill_type'])) {
			$wher['job.bill_type'] = $data['bill_type'];
		}
		if (isset($data['billable'])) {
			$wher['job.billable'] = $data['billable'];
		}
		if (isset($data['stages'])) {
			$wher['job.stages'] = $data['stages'];
		}
		if (isset($data['job_status'])) {
			$wher['job.job_status'] = $data['job_status'];
		}


		$this->db->select('DATE_FORMAT(job.job_date, "%d-%m-%Y"),client.name,job.brand_name,job.bill_type,CONCAT(bill_type,"/",job_no,"/",job.year) as jobnumber,job_status,DATE_FORMAT(job.updated_at, "%d-%m-%Y"),bill_date,bill_no,bill_amount')
						  ->from('job')
						  ->where($wher)
						  ->join('client','client.client_id = job.client_id')
						  ->join('user_client','user_client.user_id = "'.$userid.'" and client.client_id = user_client.client_id');
		if ($data['from_date']!= "") {	
			$this->db->where('job_date >=', date('Y-m-d', strtotime($data['from_date'])));
		}
		if($data['to_date']!= ""){
			$this->db->where('job_date <=', date('Y-m-d', strtotime($data['to_date'])));
		}
			$this->db->Order_by('client.name','asc');
			$this->db->Order_by('job.brand_name','asc');
			$this->db->Order_by('job.bill_type','asc');
			$this->db->Order_by('job.job_date','asc');
				 
		$query = $this->db->get();		  
		$response = $query->result_array();

   		 return $response;
	}
	
}

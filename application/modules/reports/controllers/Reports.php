<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(FCPATH."vendor/autoload.php");

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Reports extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('login/login_model');
		$this->load->model('brief/brief_model');
		$this->load->library(array('form_validation'));
		$this->load->model('job/job_model');
		$this->load->model('reports_model');
	}
	
	public function index()
	{
	     if (!$this->login_model->logged_in()) {
	    	redirect('');
	    }
		if(!$this->login_model->canAccess('get_reports')){
			redirect('');
		}

	
		

			$userid = $this->login_model->get_user_id();
			$data['client'] = $this->brief_model->getClient($userid);
			$data['permissions'] = $this->login_model->getPermissions();
			$data['title'] = "Reports";
			$data['username'] = $this->session->userdata('username');
			$this->load->view('template/header', $data);
			$this->load->view('reports-view',$data);
			$this->load->view('template/footer');


		

		
	}

	 public function download()
    {
	     if (!$this->login_model->logged_in()) {
	    	redirect('');
	    }
		if(!$this->login_model->canAccess('get_reports')){
			redirect('');
		}


		

		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('from_date', 'From ', 'required');
		$this->form_validation->set_rules('to_date', 'To ', 'required');
		$this->form_validation->set_rules('brand_name','Brand','required');

		if($this->form_validation->run() == FALSE){ 




			$userid = $this->login_model->get_user_id();
			$data['client'] = $this->brief_model->getClient($userid);
			$data['permissions'] = $this->login_model->getPermissions();
			$data['title'] = "Reports";
			$data['username'] = $this->session->userdata('username');
			$this->load->view('template/header', $data);
			$this->load->view('reports-view',$data);
			$this->load->view('template/footer');
			
		}
		else{


			$postdata = $this->input->post();
			// /print_r($data);
			$data = $this->reports_model->getReport($postdata,$this->login_model->get_user_id());
			$rownum = sizeof($data)+5;
			$spreadsheet = new Spreadsheet();
			$spreadsheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(18);
			$spreadsheet->getActiveSheet()->getStyle('J1:J4')
						->getAlignment()
						->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
			$spreadsheet->getActiveSheet()->getStyle('J1')
						->getFont()->setBold(true);
			$spreadsheet->getActiveSheet()->getStyle('A1:C4')->getFont()->setBold(true);		
			$spreadsheet->getActiveSheet()->getStyle('J4')->getFont()->setBold(true);	
			$spreadsheet->getActiveSheet()->getRowDimension('5')->setRowHeight(40);
	
			//setting table cells height
			for($i=6;$i<=$rownum;$i++){
				$spreadsheet->getActiveSheet()->getRowDimension($i)->setRowHeight(20);
			}
	
	// STYLING FOR HEADERS
			$styleArray = [
				'font' => [
					'bold' => true,
					'color'=>[
							'argb' => 'ffffff',
					],
				],
				'alignment' => [
					'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
					'vertical' =>	\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
					'wrapText' => TRUE
				],
				'fill' => [
					'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
					'startColor' => [
							'argb' => 'ed1c24',
					],
				],
			];
	
			$filltable1 = [
				'fill' => [
					'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
					'startColor' => [
							'argb' => 'fde9d9',
					],
				],
			];
			$filltable2 = [
				'fill' => [
					'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
					'startColor' => [
							'argb' => 'fac090',
					],
				],
			];
	
			for($i=6;$i<=$rownum;$i++){
				if($i%2==0){
					$spreadsheet->getActiveSheet()->getStyle('A'.$i.':J'.$i)->applyFromArray($filltable1);
				}
				else{
					$spreadsheet->getActiveSheet()->getStyle('A'.$i.':J'.$i)->applyFromArray($filltable2);
				}
			}		
			$borderarray = [
				'borders' => [
					'outline' => [
						'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
						'color' => ['argb' => 'ffffff'],
					],
				],
			];
		//	$spreadsheet->getActiveSheet()->getStyle('A1:J4')->applyFromArray($borderarray);
			$spreadsheet->getActiveSheet()->getStyle('A5:J5')->applyFromArray($styleArray);
	
			$spreadsheet->getActiveSheet()->getStyle('A1:J4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
			$spreadsheet->getActiveSheet()->getStyle('A1:J4')->getFill()->getStartColor()->setARGB('ffffff');
	
			$arrayData = [ ['Job Date','Client Name','Brand Name','Bill Type', 'Job Number', 'Job Status', 'Status Updated On','Billing Date','Billing Number','Bill Amount']];
			$sheet = $spreadsheet->getActiveSheet()
						->fromArray(
							$arrayData,  // The data to set
							NULL,        // Array values with this value will not be set
							'A5'         // Top left coordinate of the worksheet range where
										//    we want to set these values (default is A1)
									)	;
			$sheet1 = $spreadsheet->getActiveSheet()
						->fromArray(
							$data,  // The data to set
							NULL,        // Array values with this value will not be set
							'A6'         // Top left coordinate of the worksheet range where
										//    we want to set these values (default is A1)
									);
			$sheet->setCellValue('A1', 'Job Register - (Detailed) of All (selected status) jobs');
			$sheet->setCellValue('J1', 'MX ADVERTISING PVT. LTD.');
			$sheet->setCellValue('J2', 'MX ADVERTISING PRIVATE LIMITED');
			$sheet->setCellValue('J3', 'UNIT NO.5,AMAR INDUSTRIAL ESTATE, 159 C.S.T. ROAD, KALINA, SANTACRUZ (E), MUMBAI');
			$sheet->setCellValue('J4', 'Report Date: '.date('d-m-Y'));
	
			if ($postdata['from_date']!= "") {
	
				$sheet->setCellValue('A4','From: '.date('d-m-Y',strtotime($postdata['from_date'])));	
			}
			if ($postdata['to_date']!= "") {
	
				$sheet->setCellValue('B4','To: '.date('d-m-Y',strtotime($postdata['to_date'])));	
			}  
	
	
	
	
	
			$writer = new Xlsx($spreadsheet);
	
			$filename = 'name-of-the-generated-file';
	
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
			header('Cache-Control: max-age=0');
			
			$writer->save('php://output'); // download file 







		}

	


    
 
    }



	public function getClientBrand(){ 
    // POST data 
    $postData = $this->input->post('clientID');
    
    // get data 
    $data = $this->brief_model->getClientBrand($postData);
	$data = explode(',',$data[0]['Brand_Name']);
    echo json_encode($data);


  }
}

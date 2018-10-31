<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MX_Controller {

	public function index()
	{
		$data['title'] = "Dashboard";
		$this->load->view('template/header', $data);
		$this->load->view('home');
		$this->load->view('template/footer');
	}
}

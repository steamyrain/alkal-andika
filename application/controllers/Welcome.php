<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$data['title'] = "Form Login";
		$this->load->view('template_administrator/header');
		$this->load->view('formlogin');

	}
}

<?php

class Dashboard extends CI_Controller{
    
    public function __construct(){
        parent:: __construct();
        $this->load->model('mekanik_model');
    }

    private function is_loggedIn() {
        if (!isset($this->session->userdata['username'])){
            $this->session->set_flashdata('pesan','<div class="alert alert-warning alert-danger dismissible fade show" role="alert">
                Anda Belum Login!
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
                 </button>
                </div>');
            redirect('auth');
        }
    }

    private function is_mekanik() {
        if($this->session->userdata['level'] !== 'mekanik'){
            $this->session->set_flashdata('pesan','<div class="alert alert-warning alert-danger dismissible fade show" role="alert">
                Anda tidak terdaftar sebagai user!
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
                 </button>
                </div>');
            redirect('auth');
        }
    }

	public function index()
	{
        $this->is_loggedIn();
        $this->is_mekanik();
		$data['title'] = "Ceklist";
		$data = $this->mekanik_model->ambil_data($this->session->userdata['username']);
		$data = array(
			'username'  => $data->username,
			'level'		=> $data->level,
		);
		$this->load->view('template_mekanik/header');
		$this->load->view('template_mekanik/sidebar');
		$this->load->view('mekanik/dashboard',$data);
		$this->load->view('template_mekanik/footer');
	}
}

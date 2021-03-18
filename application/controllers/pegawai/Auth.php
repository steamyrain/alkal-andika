<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends CI_Controller{

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

    private function is_user() {
        if($this->session->userdata['level'] !== 'user'){
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
        $this->is_user();
        $this->redirect(base_url('auth'));
	}
}

<?php

use Fpdf\Fpdf;

class Esign extends CI_Controller {

    private function is_loggedIn() {
        if (!isset($this->session->userdata['username'])){
            $this->session->set_flashdata('pesan','<div class="alert alert-warning alert-danger dismissible fade show" role="alert">
                Anda Belum Login!
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
                 </button>
                </div>');
            redirect('administrator/auth');
        }
    }

    public function index() {
        $this->is_loggedIn();
        $ekReq = $this->ESignModel->getEKReqToOp($this->session->userdata['user_id'])->result();
        $data['eKinerja']=$ekReq;
        $this->load->view('template_pegawai/header');
        $this->load->view('template_pegawai/sidebar');
        $this->load->view('pegawai/kinerja_req_esign',$data);
        $this->load->view('template_pegawai/footer');
    }

    public function confirm() {
        $this->is_loggedIn();
    }

    public function _req_confirm_rules() {
		$this->form_validation->set_rules('id','id','required',['required' => 'Id wajib ada']);
    }

}

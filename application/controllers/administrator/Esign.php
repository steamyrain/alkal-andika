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

    private function is_admin() {
        if($this->session->userdata['level'] !== 'admin'){
            $this->session->set_flashdata('pesan','<div class="alert alert-warning alert-danger dismissible fade show" role="alert">
                Anda Belum Login!
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
                 </button>
                </div>');
            redirect('administrator/auth');
        }
    }

    private function is_verificator() {
        if(
            !isset($this->session->userdata['nip']) and 
            empty($this->session->userdata['nip'])
        ){
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
        $this->is_admin();
        $this->is_verificator();
        $stReq = $this->ESignModel->getSTReqSpecific($this->session->userdata['nip'])->result();
        $data['suratTugas']=$stReq;
        $this->load->view('template_administrator/header');
        $this->load->view('template_administrator/sidebar');
        $this->load->view('administrator/st_req_esign',$data);
        $this->load->view('template_administrator/footer');
    }

    public function confirm() {
        $this->is_loggedIn();
        $this->is_admin();
        $this->is_verificator();
        $this->_req_confirm_rules();
        if($this->form_validation->run() === TRUE){
            $stId = $this->input->post('id');
            $nip = $this->session->userdata['nip'];
            $signedDate = date("Y-m-d H:i:s");
            $status = 'signed';
            $data = [
                'status'=>$status,
                'signedDate'=>$signedDate
            ];
            $this->ESignModel->updateSTReq($stId,$nip,$data);
            $message = 'ESign Surat Tugas Berhasil';
            $this->session->set_flashdata('pesan',
                '<div 
                    class=" alert 
                            alert-success 
                            dismissible 
                            fade 
                            show
                            " 
                    role="alert">'.
                $message.
                '
                <button 
                    type="button" 
                    class="close" 
                    data-dismiss="alert" 
                    aria-label="Close">
                <span 
                    aria-hidden="true">
                &times;
                </span>
                </button>
                </div>');
            $this->index();
        }
    }

    public function _req_confirm_rules() {
		$this->form_validation->set_rules('id','id','required',['required' => 'Id wajib ada']);
    }

}

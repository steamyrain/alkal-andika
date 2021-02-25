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
            redirect('pegawai/auth');
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
       $this->_req_confirm_rules();
       if ($this->form_validation->run() === FALSE){
           $this->index();
       } else {
           $uId = $this->input->post('id');
           $ekin_start = $this->input->post('date_start');
           $ekin_end = $this->input->post('date_end');
           $signedDate = date("Y-m-d H:i:s");
           $data = [
               'status'=>'signed',
               'signedDate'=>$signedDate
           ];
           $this->ESignModel->updateEKReq($uId,$ekin_start,$ekin_end,$data);
           $message = 'ESign Surat Tugas Berhasil';
           $this->session->set_flashdata('pesan',
               '<div 
               class=" alert alert-success dismissible fade show" 
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
		$this->form_validation->set_rules('id','id','required',['required' => 'Id wajib ada!']);
		$this->form_validation->set_rules('date_start','date_start','required',['required' => 'tanggal awal wajib ada!']);
		$this->form_validation->set_rules('date_end','date_end','required',['required' => 'tanggal akhir wajib ada!']);
    }

    public function print_dinas() {
        $this->is_loggedIn();
        $this->_rules_print(); 
        if($this->form_validation->run() == FALSE){
            $this->print_index();
        } else {
            $this->load->library('Pdf');

            $name = $this->input->post('username');
            $startDate = $this->input->post('date_start');
            $endDate = $this->input->post('date_end');
            $job_id = $this->input->post('job_id');
            if ($job_id == 1) {
                $data = $this->kinerja_model->getSpecificKinerja($name,$startDate,$endDate)->result();
            }

            $pdf = new Pdf();
            $pdf->AddPage("L");

            $pdf->SetFont('Times','BU',14);
            $pdf->Cell(0,0,'Kinerja PJLP Bidang Pengemudi Alat Berat',0,1,'C');
            $pdf->ln(5);
            
            $pdf->Nama($this->input->post('username'));
            $pdf->Jabatan('pengemudi alat berat');
            $pdf->Tanggal($this->input->post('starting_date'),$this->input->post('end_date'));
            $header = ['Tanggal','Waktu','Kegiatan','Lokasi'];
            // total width = 205
            $pdf->TabelKinerja($header,$data,[30,15,100,60]);

            $pdf->Output();
        }
    }

    public function _rules_print(){
		$this->form_validation->set_rules('username','username','required',['required' => 'Nama Wajib Diisi!']);
		$this->form_validation->set_rules('date_start','date_start','required',['required' => 'Tanggal Awal Wajib Diisi!']);
		$this->form_validation->set_rules('date_end','date_end','required',['required' => 'Tanggal Akhir Wajib Diisi!']);
		$this->form_validation->set_rules('job_id','job_id','required',['required' => 'Job ID Wajib Diisi!']);
    }
}

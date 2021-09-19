<?php

class Kinerja extends CI_Controller{

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

    public function api() {
        /* check if truly admin and a verificator */
        $this->is_loggedIn();
        $this->is_admin();
        /*-----------------*/

        switch($_SERVER["REQUEST_METHOD"]) {
            case 'GET':
                $kinerja = $this->kinerja_model->getAllNewKinerja()->result();
                header('Content-Type: application/json');
                echo json_encode($kinerja);
                break;
            case 'POST':
                //do something
                break;
            default:
                $this->output->set_status_header(405);
                break;
        }
    }

    public function printapi(){
        /* check if truly admin and a verificator */
        $this->is_loggedIn();
        $this->is_admin();
        /*-----------------*/

        switch($_SERVER["REQUEST_METHOD"]) {
            case 'POST':
                $uid = $this->input->post('uid');
                $job_date_start = $this->input->post('job_date_start');
                $job_date_end = $this->input->post('job_date_end');
                if(!isset($uid) or empty($uid)){
                    $this->output->set_status_header(404);
                } else if (!isset($job_date_start) or empty($job_date_start)){
                    $this->output->set_status_header(404);
                } else if (!isset($job_date_end) or empty($job_date_end)){
                    $this->output->set_status_header(404);
                } else {
                    $pdf=$this->print($uid,$job_date_start,$job_date_end);
                    $this->output->set_status_header(200);
                    $this->output->set_content_type('application/pdf');
                    $this->output->set_output(base64_encode($pdf));
                }
                break;
            default:
                $this->output->set_status_header(405);
                break;
        }
    }

    private function print($uid,$job_date_start,$job_date_end){
        $this->load->library('Pdf');

        $data = $this->kinerja_model->getNewKinerjaForPrint($uid,$job_date_start,$job_date_end)->result();
        $verificators = $this->kinerja_model->getPJLPVerificatorsForPrint($uid)->result();

        $pdf = new Pdf('','',date("d-m-Y"),$verificators);

        $pdf->AddPage("L");

        $pdf->SetFont('Times','BU',14);
        $pdf->Cell(0,0,'Kinerja PJLP',0,1,'C');
        $pdf->ln(5);
        
        $pdf->Nama($data[0]->username);
        $pdf->Jabatan($data[0]->job_rolename);
        $pdf->Tanggal($job_date_start,$job_date_end);

        $header = ['Tanggal','Awal','Akhir','Kegiatan','Deskripsi Kegiatan'];

        // total width = 205
        $pdf->TabelKinerja($header,$data,[30,20,20,75,60]);

        return $pdf->Output("kinerja.pdf","S");
    }

    public function index(){
        $this->is_loggedIn();
        $this->is_admin();
		$this->load->view('template_administrator/header');
		$this->load->view('template_administrator/sidebar');
		$this->load->view('administrator/kinerja');
		$this->load->view('template_administrator/footer');
    }

}

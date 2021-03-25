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
                    $this->output->set_status_header(200);
                }
                break;
            default:
                $this->output->set_status_header(405);
                break;
        }
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

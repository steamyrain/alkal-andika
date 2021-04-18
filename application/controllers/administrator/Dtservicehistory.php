<?php 
    
class Dtservicehistory extends CI_Controller {
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

    public function index() {
        $this->is_loggedIn();
        $this->is_admin();
		$this->load->view('template_administrator/header');
		$this->load->view('template_administrator/sidebar');
        $this->load->view('administrator/dt_service_history');
		$this->load->view('template_administrator/footer');
    }

    public function api() {
        /* check if truly admin and a verificator */
        $this->is_loggedIn();
        $this->is_admin();
        /*-----------------*/

        switch($_SERVER["REQUEST_METHOD"]) {
            case 'GET':
                $service = $this->ServiceHistoryModel->getDTServiceHistories()->result();
                header('Content-Type: application/json');
                echo json_encode($service);
                break;
            case 'POST':
                //do something
                break;
            default:
                $this->output->set_status_header(405);
                break;
        }
    }

    public function servicelistapi() {
        /* check if truly admin and a verificator */
        $this->is_loggedIn();
        $this->is_admin();
        /*-----------------*/

        switch($_SERVER["REQUEST_METHOD"]) {
            case 'GET':
                $dt_id = $this->input->get('dt_id',TRUE);
                $service = $this->ServiceHistoryModel->getDTServiceList($dt_id)->result();
                header('Content-Type: application/json');
                echo json_encode($service);
                break;
            case 'POST':
                //do something
                break;
            default:
                $this->output->set_status_header(405);
                break;
        }
    }

    public function input() {
        $dt = $this->DumpTruckModel->getDT("id,plate_number")->result();
        $data = [
            "dt"=>$dt
        ];
        $this->load->view('template_administrator/header');
        $this->load->view('template_administrator/sidebar');
        $this->load->view('administrator/dt_service_history_form',$data);
        $this->load->view('template_administrator/footer');
    }

    public function input_aksi() {
        $this->is_loggedIn();
        $this->is_admin();
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->input();
        }
        else {
            $dt_id=$this->input->post('dt_id');
            $service_id = $this->input->post('service_id');
            $service_date = $this->input->post('service_date');
            $serviced_by = $this->input->post('serviced_by');
            $data = [
                'dt_id'=>$dt_id,
                'service_id'=>$service_id,
                'service_date'=>$service_date,
                'serviced_by'=>$serviced_by
            ];
            $this->ServiceHistoryModel->setDTServiceHistory($data);
            $this->session->set_flashdata('pesan',
                '<div 
                    class=" alert 
                            alert-success 
                            dismissible 
                            fade 
                            show
                            " 
                    role="alert">
                Data Berhasil Ditambahkan!
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
            redirect(base_URL('administrator/dtservicehistory'));
        }
    }

    public function _rules() {
		$this->form_validation->set_rules('dt_id','Nomer Polisi','required',['required' => '%s Wajib Diisi']);
		$this->form_validation->set_rules('service_id','Jenis Servis','required',['required' => '%s Wajib Diisi']);
		$this->form_validation->set_rules('service_date','Tanggal Servis','required',['required' => '%s Wajib Diisi']);
    }
}

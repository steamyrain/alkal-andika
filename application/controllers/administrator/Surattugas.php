<?php 

class Surattugas extends CI_Controller {

    private $suratTugas;

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
        $this->load->view('administrator/surat_tugas_form');
        $this->load->view('template_administrator/footer');
    }

    public function subject_operator() {
        $this->is_loggedIn();
        $this->is_admin();
        $subject = $this->user_model->getOperatorOnly()->result();
        $data = [
            "subject_operator"=>$subject
        ];
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function subject_driver() {
        $this->is_loggedIn();
        $this->is_admin();
        $subject = $this->user_model->getDriver()->result();
        $data = [
            "subject_driver"=>$subject
        ];
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function subject_labour() {
        $this->is_loggedIn();
        $this->is_admin();
        $subject = $this->user_model->getLabour()->result();
        $data = [
            "subject_labour"=>$subject
        ];
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function vehicle_ab() {
        $this->is_loggedIn();
        $this->is_admin();
        $vehicle = $this->AlatBeratModel->getVINCategoryAndType()->result();
        $data = [
            "vehicle_heavy"=>$vehicle
        ];
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function input_aksi() {
        $this->is_loggedIn();
        $this->is_admin();
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        $insertSurat;
        $this->suratTugas = $data;

        $insertSurat['location'] = $data->location;
        $insertSurat['date'] = $data->date;

        // insert surat tugas to corresponding table & get the last id inserted
        $last_id = $this->SuratTugasModel->insertSuratTugas($insertSurat);

        // insert surat tugas subject to correspoding table with its data;
        $insertSubject = Array();
        foreach ($data->subject as $subject) {
            array_push($insertSubject,Array("subject_id"=>$subject,"surat_id"=>$last_id));
        }
        $this->SuratTugasModel->insertSTSubject($insertSubject);
                
        // insert surat tugas heavy to correspoding table with its data;
        $insertHeavy = Array();
        $dataHeavy;
        foreach ($data->heavy as $heavy) {
            $dataHeavy = Array();
            foreach ($heavy as $key => $value){
                array_push($dataHeavy,$value);
            }
            array_push($insertHeavy,Array("heavy_id"=>$dataHeavy[0],"surat_id"=>$last_id,"heavy_fuel"=>$dataHeavy[1]));
        }
        $this->SuratTugasModel->insertSTHeavy($insertHeavy);
        
        // insert surat tugas dt to correspoding table with its data;
        $insertDT = Array();
        $dataDT;
        foreach ($data->dt as $dt) {
            $dataDT = Array();
            foreach ($dt as $key => $value){
                array_push($dataDT,$value);
            }
            array_push($insertDT,Array("dt_id"=>$dataDT[0],"surat_id"=>$last_id,"dt_fuel"=>$dataDT[1]));
        }
        $this->SuratTugasModel->insertSTDT($insertDT);
        

        $result['status']='success';
        $result['redirect_url']=base_URL('administrator/surattugas/show');
        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($result));
    }

    public function show() {
        $this->is_loggedIn();
        $this->is_admin();
        $this->load->view('template_administrator/header');
        $this->load->view('template_administrator/sidebar');
        $this->load->view('administrator/show');
        $this->load->view('template_administrator/footer');
    }

    public function vehicle_dt() {
        $this->is_loggedIn();
        $this->is_admin();
        $vehicle = $this->DumpTruckModel->getPNCategory()->result();
        $data = [
            "vehicle_dt"=>$vehicle
        ];
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
}

<?php

use Fpdf\Fpdf;

class Surattugas extends CI_Controller {

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
        $suratTugas = $this->SuratTugasModel->getSuratTugas()->result();
        $data['suratTugas']=$suratTugas;
        $this->load->view('template_administrator/header');
        $this->load->view('template_administrator/sidebar');
        $this->load->view('administrator/surat_tugas',$data);
        $this->load->view('template_administrator/footer');
    }

    public function input() {
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

        // initialized support variables
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        $_POST = json_decode($json,true);

        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $result['message']= [
               'date'=>form_error('date'),
               'location'=>form_error('location'),
               'subject'=>form_error('subject'),
               'heavy'=>form_error('heavy'),
               'dt'=>form_error('dt')
            ];
            $this->output->set_header('HTTP/1.1 400 Bad Request');
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode($result));
        } else {
            $insertSurat;
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
            $result['redirect_url']=base_URL('administrator/surattugas/');
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode($result));
        }
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

    public function _rules() {
        $this->form_validation->set_rules('date','date','callback_post_date_check');
        $this->form_validation->set_rules('location','location','callback_post_location_check');
        $this->form_validation->set_rules('subject','subject','callback_post_subject_check');
        $this->form_validation->set_rules('heavy','heavy','callback_post_heavy_check');
        $this->form_validation->set_rules('dt','dt','callback_post_dt_check');
    }

    public function post_location_check() {
        if($this->input->post('location')=='') {
            $this->form_validation->set_message('post_location_check',"Lokasi Wajib Diisi");
            return false;
        }
            return true;
    }

    public function post_date_check() {
        if($this->input->post('date')=='') {
            $this->form_validation->set_message('post_date_check',"Tanggal Wajib Diisi");
            return false;
        }
            return true;
    }
    
    public function post_subject_check() {
        $subjectBuffer = array_unique($this->input->post('subject'));
        if(sizeof($this->input->post('subject')) != sizeof($subjectBuffer)){
            $this->form_validation->set_message('post_subject_check',"Subjek Tidak Boleh Sama");
            return false;
        }
            return true;
    }

    public function post_heavy_check() {
        $heavyId = Array();
        $emptyFuel = false;
        foreach ($this->input->post('heavy') as $heavy) {
            $i=0;
            foreach ($heavy as $key => $value){
                if ($i == 0){
                    array_push($heavyId,$value);
                } else {
                    (($value == "") or ($value == "0"))?$emptyFuel=true:$emptyFuel=$emptyFuel;
                }
                $i++;
            }
        }
        $heavyIdBuffer = array_unique($heavyId);
        if((sizeof($heavyId) != sizeof($heavyIdBuffer)) or ($emptyFuel)){
            $this->form_validation->set_message('post_heavy_check',"Alat Berat Tidak Boleh Sama / BBM Tidak Boleh Kosong");
            return false;
        }
            return true;
    }

    public function post_dt_check() {
        $dtId = Array();
        $emptyFuel = false;
        foreach ($this->input->post('dt') as $dt) {
            $i=0;
            foreach ($dt as $key => $value){
                if ($i == 0){
                    array_push($dtId,$value);
                } else {
                    (($value == "") or ($value == "0"))?$emptyFuel=true:$emptyFuel=$emptyFuel;
                }
                $i++;
            }
        }
        $dtIdBuffer = array_unique($dtId);
        if((sizeof($dtId) != sizeof($dtIdBuffer)) or ($emptyFuel)){
            $this->form_validation->set_message('post_dt_check',"DumpTruck Tidak Boleh Sama / BBM Tidak Boleh Kosong");
            return false;
        }
            return true;
    }

    public function print_surat() {
        $this->is_loggedIn();
        $this->is_admin();
        $id = $this->input->post('id');
        $st = $this->SuratTugasModel->getSpecificSuratTugasSubject($id)->result();
        $pdf = new Fpdf();
        $pdf->AddPage();
        $this->set_header($pdf);
        $pdf->SetFont('Times','BU',14);
        $pdf->Cell(0,0,'SURAT TUGAS',0,1,'C');
        $pdf->ln(5);
        $pdf->SetFont('Times','',12);
        $pdf->Cell(40,10,'Lokasi Kerja',0);
        $pdf->Cell(10,10,': '.$st[0]->location,0);
        $pdf->ln(10);
        $pdf->Cell(40,10,'Tanggal',0);
        $pdf->Cell(10,10,': '.$st[0]->date,0);
        $pdf->ln(10);
        $pdf->Cell(40,10,'Subjek',0);
        $i=0;
        foreach($st as $surat){
            if($i == 0){
                $pdf->Cell(10,10,': '.$surat->username,0);
                $pdf->ln(10);
            } else {
                $pdf->Cell(40,10,'',0);
                $pdf->Cell(10,10,': '.$surat->username,0);
                $pdf->ln(10);
            }
            $i++;
        }
        $pdf->Cell(40,10,'Alat Berat',0);
        $st = $this->SuratTugasModel->getSpecificSuratTugasHeavy($id)->result();
        $i=0;
        foreach($st as $surat){
            if($i == 0){
                $pdf->Cell(10,10,': '.$this->vinChecker($surat->plate_number,$surat->serial_number),0);
                $pdf->ln(10);
            } else {
                $pdf->Cell(40,10,'',0);
                $pdf->Cell(10,10,': '.$this->vinChecker($surat->plate_number,$surat->serial_number),0);
                $pdf->ln(10);
            }
            $i++;
        }
        $pdf->Output();
    }

    private function vinChecker($sn,$pn){
        return ($sn=='')?$pn:$sn;
    }

    private function set_header($pdf) {
        $pdf->Image('assets/img/logo-dki.png',10,8,20);
        $pdf->SetFont('Times','B',13);
        $pdf->Cell(0,0,'PEMERINTAH PROVINSI DAERAH KHUSUS IBUKOTA JAKARTA',0,1,'C');
        $pdf->Cell(0,10,'DINAS BINA MARGA',0,1,'C');
        $pdf->Cell(0,0,'UNIT PERALATAN DAN PERBEKALAN BINA MARGA',0,1,'C');
        $pdf->SetFont('Times','',12);
        $pdf->Cell(0,10,'Jl. D.I. Panjaitan Kav.583 Cipinang Besar Selatan Jakarta Timur',0,1,'C');
        $pdf->Cell(0,0,'Telp dan Fax. (021) 8564509, email. alkaldbm@gmail.com',0,1,'C');
        $pdf->Cell(0,10,'Kode Pos 13410',0,1,'R');
        $pdf->Cell(0,0,'',0,1);
        $pdf->Cell(0,0,'',1,1,'C');
        $pdf->ln(5);
    }

    public function detail_subjek() {
        $this->is_loggedIn();
        $this->is_admin();
        $id = $this->input->post('id');
        $operator = $this->SuratTugasModel->getAllSTOperator($id)->result();
        $driver = $this->SuratTugasModel->getAllSTDriver($id)->result();
        $labour = $this->SuratTugasModel->getAllSTLabour($id)->result();
        $data = [
            'st_id'=>$id,
            'st_operator_og'=>json_encode($operator),
            'st_driver_og'=>json_encode($driver),
            'st_labour_og'=>json_encode($labour)
        ];
        $this->load->view('template_administrator/header');
        $this->load->view('template_administrator/sidebar');
        $this->load->view('administrator/st_detail_subjek',$data);
        $this->load->view('template_administrator/footer');
    }

    public function edit_subject(){
    }

    public function detail_heavy() {
        $this->is_loggedIn();
        $this->is_admin();
        $id = $this->input->post('id');
        $heavy = $this->SuratTugasModel->getAllSTHeavy($id)->result();
        $data = [
            'st_id'=>$id,
            'st_heavy_og'=>json_encode($heavy)
        ];
        $this->load->view('template_administrator/header');
        $this->load->view('template_administrator/sidebar');
        $this->load->view('administrator/st_detail_heavy',$data);
        $this->load->view('template_administrator/footer');
    }

    public function detail_dt() {
        $this->is_loggedIn();
        $this->is_admin();
        $id = $this->input->post('id');
        $dt = $this->SuratTugasModel->getAllSTDT($id)->result();
        $data = [
            'st_id'=>$id,
            'st_dt_og'=>json_encode($dt)
        ];
        $this->load->view('template_administrator/header');
        $this->load->view('template_administrator/sidebar');
        $this->load->view('administrator/st_detail_dt',$data);
        $this->load->view('template_administrator/footer');
    }
}

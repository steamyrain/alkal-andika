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
        $subject = $this->user_model->getDriverPlusMechanic()->result();
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
               'job'=>form_error('job'),
               'subject'=>form_error('subject'),
               'heavy'=>form_error('heavy'),
               'dt'=>form_error('dt'),
               'kdo'=>form_error('kdo')
            ];
            $this->output->set_header('HTTP/1.1 400 Bad Request');
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode($result));
        } else {
            $insertSurat;
            $insertSurat['location'] = $data->location;
            $insertSurat['date'] = $data->date;
            $insertSurat['job_desc']=$data->job_desc;

            // insert surat tugas to corresponding table & get the last id inserted
            $last_id = $this->SuratTugasModel->insertSuratTugas($insertSurat);

            // insert surat tugas subject to correspoding table with its data;
            $insertSubject = Array();
            foreach ($data->subject as $subject) {
                array_push($insertSubject,Array("subject_id"=>$subject,"surat_id"=>$last_id));
            }
            if (sizeof($insertSubject) != 0){
                $this->SuratTugasModel->insertSTSubject($insertSubject);
            }
                    
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
            if (sizeof($insertHeavy) != 0){
                $this->SuratTugasModel->insertSTHeavy($insertHeavy);
            }
            
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
            if (sizeof($insertDT) != 0){
                $this->SuratTugasModel->insertSTDT($insertDT);
            }

            // insert surat tugas kdo to correspoding table with its data;
            $insertKDO = Array();
            $dataKDO;
            foreach ($data->kdo as $kdo) {
                $dataKDO = Array();
                foreach ($kdo as $key => $value){
                    array_push($dataKDO,$value);
                }
                array_push($insertKDO,Array("kdo_id"=>$dataKDO[0],"surat_id"=>$last_id,"kdo_fuel"=>$dataKDO[1]));
            }
            if (sizeof($insertKDO) != 0){
                $this->SuratTugasModel->insertSTKDO($insertKDO);
            }
            

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

    public function vehicle_kdo() {
        $this->is_loggedIn();
        $this->is_admin();
        $vehicle = $this->KdoModel->getPNCategory()->result();
        $data = [
            "vehicle_kdo"=>$vehicle
        ];
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function _rules() {
        $this->form_validation->set_rules('date','date','callback_post_date_check');
        $this->form_validation->set_rules('job','job','callback_post_job_check');
        $this->form_validation->set_rules('location','location','callback_post_location_check');
        $this->form_validation->set_rules('subject','subject','callback_post_subject_check');
        $this->form_validation->set_rules('heavy','heavy','callback_post_heavy_check');
        $this->form_validation->set_rules('dt','dt','callback_post_dt_check');
        $this->form_validation->set_rules('kdo','kdo','callback_post_kdo_check');
    }

    public function post_job_check() {
        if($this->input->post('job_desc')=='') {
            $this->form_validation->set_message('post_job_check',"Deskripsi Pekerjaan Wajib Diisi");
            return false;
        }
            return true;
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
                    ((int)$value<0)?$emptyFuel=true:$emptyFuel=$emptyFuel;
                }
                $i++;
            }
        }
        $heavyIdBuffer = array_unique($heavyId);
        if((sizeof($heavyId) != sizeof($heavyIdBuffer)) or ($emptyFuel)){
            $this->form_validation->set_message('post_heavy_check',"Alat Berat Tidak Boleh Sama / BBM Tidak Boleh Minus");
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
                    ((int)$value<0)?$emptyFuel=true:$emptyFuel=$emptyFuel;
                }
                $i++;
            }
        }
        $dtIdBuffer = array_unique($dtId);
        if((sizeof($dtId) != sizeof($dtIdBuffer)) or ($emptyFuel)){
            $this->form_validation->set_message('post_dt_check',"DumpTruck Tidak Boleh Sama / BBM Tidak Boleh Minus");
            return false;
        }
            return true;
    }

    public function post_kdo_check() {
        $kdoId = Array();
        $emptyFuel = false;
        foreach ($this->input->post('kdo') as $kdo) {
            $i=0;
            foreach ($kdo as $key => $value){
                if ($i == 0){
                    array_push($kdoId,$value);
                } else {
                    ((int)$value<0)?$emptyFuel=true:$emptyFuel=$emptyFuel;
                }
                $i++;
            }
        }
        $kdoIdBuffer = array_unique($kdoId);
        if((sizeof($kdoId) != sizeof($kdoIdBuffer)) or ($emptyFuel)){
            $this->form_validation->set_message('post_kdo_check',"KDO Tidak Boleh Sama / BBM Tidak Boleh Minus");
            return false;
        }
            return true;
    }

    public function print_surat() {
        $this->is_loggedIn();
        $this->is_admin();
        if (($this->input->post('id')!==null) && !empty($this->input->post('id'))){
            $id = $this->input->post('id');
            $st = $this->SuratTugasModel->getSpecificSuratTugas($id)->result();
            $this->load->library('STPdf');

            $pdf = new STPdf();
            $pdf->AddPage();

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

            $pdf->Cell(40,10,'Deskripsi Pekerjaan',0);
            $pdf->Cell(10,10,': '.$st[0]->job_desc,0);
            $pdf->ln(10);

            $pdf->Cell(40,10,'Operator',0);
            $i=0;
            $st = $this->SuratTugasModel->getSpecificSuratTugasOperator($id)->result();
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
            if($st == null){
                    $pdf->Cell(10,10,': -',0);
                    $pdf->ln(10);
            }

            $pdf->Cell(40,10,'Pengemudi',0);
            $i=0;
            $st = $this->SuratTugasModel->getSpecificSuratTugasDriverPlusMechanic($id)->result();
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
            if($st == null){
                    $pdf->Cell(10,10,': -',0);
                    $pdf->ln(10);
            }

            $pdf->Cell(40,10,'Tenaga Kerja',0);
            $i=0;
            $st = $this->SuratTugasModel->getSpecificSuratTugasLabour($id)->result();
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
            if($st == null){
                    $pdf->Cell(10,10,': -',0);
                    $pdf->ln(10);
            }

            $pdf->Cell(40,10,'Alat Berat & BBM',0);
            $st = $this->SuratTugasModel->getSpecificSuratTugasHeavy($id)->result();
            $i=0;
            foreach($st as $surat){
                if($i == 0){
                    $pdf->Cell(10,10,': '.$this->vinChecker($surat->plate_number,$surat->serial_number).'/'.$surat->category.'/'.$surat->sub_category.' ('.$surat->heavy_fuel.' liter)',0);
                    $pdf->ln(10);
                } else {
                    $pdf->Cell(40,10,'',0);
                    $pdf->Cell(10,10,': '.$this->vinChecker($surat->plate_number,$surat->serial_number).'/'.$surat->category.'/'.$surat->sub_category.' ('.$surat->heavy_fuel.' liter)',0);
                    $pdf->ln(10);
                }
                $i++;
            }
            if($st == null){
                    $pdf->Cell(10,10,': -',0);
                    $pdf->ln(10);
            }

            $pdf->Cell(40,10,'Dump Truck & BBM',0);
            $st = $this->SuratTugasModel->getSpecificSuratTugasDT($id)->result();
            $i=0;
            foreach($st as $surat){
                if($i == 0){
                    $pdf->Cell(10,10,': '.$surat->plate_number.'/'.$surat->category.' ('.$surat->dt_fuel.' liter)',0);
                    $pdf->ln(10);
                } else {
                    $pdf->Cell(40,10,'',0);
                    $pdf->Cell(10,10,': '.$surat->plate_number.'/'.$surat->category.' ('.$surat->dt_fuel.' liter)',0);
                    $pdf->ln(10);
                }
                $i++;
            }
            if($st == null){
                    $pdf->Cell(10,10,': -',0);
                    $pdf->ln(10);
            }

            $pdf->Cell(40,10,'KDO & BBM',0);
            $st = $this->SuratTugasModel->getSpecificSuratTugasKDO($id)->result();
            $i=0;
            foreach($st as $surat){
                if($i == 0){
                    $pdf->Cell(10,10,': '.$surat->plate_number.'/'.$surat->category.' ('.$surat->kdo_fuel.' liter)',0);
                    $pdf->ln(10);
                } else {
                    $pdf->Cell(40,10,'',0);
                    $pdf->Cell(10,10,': '.$surat->plate_number.'/'.$surat->category.' ('.$surat->kdo_fuel.' liter)',0);
                    $pdf->ln(10);
                }
                $i++;
            }
            if($st == null){
                    $pdf->Cell(10,10,': -',0);
                    $pdf->ln(10);
            }

            $pdf->Output();
        } else {
            redirect(base_URL('administrator/surattugas'));
        }
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
        $driver = $this->SuratTugasModel->getAllSTDriverPlusMechanic($id)->result();
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
        $this->is_loggedIn();
        $this->is_admin();

        // initialized support variables
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        $_POST = json_decode($json,true);
        $result = [];

        $this->_rules_edit_subject();

        if ($this->form_validation->run() == FALSE) {
            $result['message']= [
               'operator'=>form_error('operator'),
               'driver'=>form_error('driver'),
               'labour'=>form_error('labour')
            ];
            $this->output->set_header('HTTP/1.1 400 Bad Request');
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode($result));
        } else {

            if (isset($data->og_keys) && !empty($data->og_keys)){
                for($i=0;$i<sizeof($data->og_keys);$i++){
                    $this->SuratTugasModel->updateSTSubject($data->og_keys[$i],$data->og_uId[$i]);
                }
                $result = [
                    "message"=>"Sukses, Data Berhasil Diubah!",
                    "redirect_url"=> base_URL('administrator/surattugas')
                ]; 
            } 
            if (isset($data->og_dKeys) && !empty($data->og_dKeys)){
                for($i=0;$i<sizeof($data->og_dKeys);$i++) {
                    $this->SuratTugasModel->deleteSTSubject($data->og_dKeys[$i]);
                }
                $result = [
                    "message"=>"Sukses, Data Berhasil Dihapus!",
                    "redirect_url"=> base_URL('administrator/surattugas')
                ]; 
            } 
            if (isset($data->new_uId) && !empty($data->new_uId)){
                    // insert surat tugas subject to correspoding table with its data;
                    $insertSubject = Array();
                    foreach ($data->new_uId as $subject) {
                        array_push($insertSubject,Array("subject_id"=>$subject,"surat_id"=>$data->og_sId));
                    }
                    $this->SuratTugasModel->insertSTSubject($insertSubject);
                    $result = [
                        "message"=>"Sukses, Data Berhasil Ditambah!",
                        "redirect_url"=> base_URL('administrator/surattugas')
                    ]; 
            }
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode($result)); 
        }
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

    public function edit_heavy() {
        $this->is_loggedIn();
        $this->is_admin();

        // initialized support variables
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        $_POST = json_decode($json,true);
        $result = [];

        $this->_rules_edit_heavy();

        if ($this->form_validation->run() == false){
            $result['message']= [
               'heavy'=>form_error('heavy')
            ];
            $this->output->set_header('HTTP/1.1 400 Bad Request');
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode($result));
        } else {
            if (isset($data->og_keys) && !empty($data->og_keys)) {
                $i = 0;
                foreach($data->og_keys as $key) {
                    $this->SuratTugasModel->updateSTHeavy($key,$data->og_dat[$i]);
                    $i++;
                }
                $result['redirect_url'] = base_URL('administrator/surattugas');
            }
            if (isset($data->og_dKeys) && !empty($data->og_dKeys)){
                foreach($data->og_dKeys as $key) {
                    $this->SuratTugasModel->deleteSTHeavy($key);
                }
                $result['redirect_url'] = base_URL('administrator/surattugas');
            }
            if (isset($data->new_dat) && !empty($data->new_dat)){
                $this->SuratTugasModel->insertSTHeavy($data->new_dat);
                $result = [
                    "redirect_url"=> base_URL('administrator/surattugas')
                ]; 
            }
            $this->session->set_flashdata('pesan',
                '<div 
                    class=" alert 
                            alert-success 
                            dismissible 
                            fade 
                            show
                            " 
                    role="alert">
                Data Berhasil Diubah!
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
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode($result)); 
        }
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
    public function edit_dt() {
        $this->is_loggedIn();
        $this->is_admin();

        // initialized support variables
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        $_POST = json_decode($json,true);
        $result = [];

        $this->_rules_edit_dt();

        if ($this->form_validation->run() == false){
            $result['message']= [
               'dt'=>form_error('dt')
            ];
            $this->output->set_header('HTTP/1.1 400 Bad Request');
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode($result));
        } else {
            if (isset($data->og_keys) && !empty($data->og_keys)) {
                $i = 0;
                foreach($data->og_keys as $key) {
                    $this->SuratTugasModel->updateSTDT($key,$data->og_dat[$i]);
                    $i++;
                }
                $result['redirect_url'] = base_URL('administrator/surattugas');
            }
            if (isset($data->og_dKeys) && !empty($data->og_dKeys)){
                foreach($data->og_dKeys as $key) {
                    $this->SuratTugasModel->deleteSTDT($key);
                }
                $result['redirect_url'] = base_URL('administrator/surattugas');
            }
            if (isset($data->new_dat) && !empty($data->new_dat)){
                $this->SuratTugasModel->insertSTDT($data->new_dat);
                $result = [
                    "redirect_url"=> base_URL('administrator/surattugas')
                ]; 
            }
            $this->session->set_flashdata('pesan',
                '<div 
                    class=" alert 
                            alert-success 
                            dismissible 
                            fade 
                            show
                            " 
                    role="alert">
                Data Berhasil Diubah!
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
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode($result)); 
        }
    }

    public function detail_kdo() {
        $this->is_loggedIn();
        $this->is_admin();
        $id = $this->input->post('id');
        $kdo = $this->SuratTugasModel->getAllSTKDO($id)->result();
        $data = [
            'st_id'=>$id,
            'st_kdo_og'=>json_encode($kdo)
        ];
        $this->load->view('template_administrator/header');
        $this->load->view('template_administrator/sidebar');
        $this->load->view('administrator/st_detail_kdo',$data);
        $this->load->view('template_administrator/footer');
    }

    public function edit_kdo() {
        $this->is_loggedIn();
        $this->is_admin();

        // initialized support variables
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        $_POST = json_decode($json,true);
        $result = [];

        $this->_rules_edit_kdo();

        if ($this->form_validation->run() == false){
            $result['message']= [
               'kdo'=>form_error('kdo')
            ];
            $this->output->set_header('HTTP/1.1 400 Bad Request');
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode($result));
        } else {
            if (isset($data->og_keys) && !empty($data->og_keys)) {
                $i = 0;
                foreach($data->og_keys as $key) {
                    $this->SuratTugasModel->updateSTKDO($key,$data->og_dat[$i]);
                    $i++;
                }
                $result['redirect_url'] = base_URL('administrator/surattugas');
            }
            if (isset($data->og_dKeys) && !empty($data->og_dKeys)){
                foreach($data->og_dKeys as $key) {
                    $this->SuratTugasModel->deleteSTKDO($key);
                }
                $result['redirect_url'] = base_URL('administrator/surattugas');
            }
            if (isset($data->new_dat) && !empty($data->new_dat)){
                $this->SuratTugasModel->insertSTKDO($data->new_dat);
                $result = [
                    "redirect_url"=> base_URL('administrator/surattugas')
                ]; 
            }
            $this->session->set_flashdata('pesan',
                '<div 
                    class=" alert 
                            alert-success 
                            dismissible 
                            fade 
                            show
                            " 
                    role="alert">
                Data Berhasil Diubah!
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
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode($result)); 
        }
    }

    public function detail_surat($id) {
        $this->is_loggedIn();
        $this->is_admin();
        $surat = $this->SuratTugasModel->getSpecificSTDetail($id)->row();
        $data = [
            'st_id'=>$id,
            'st_surat_og'=>$surat
        ];
        $this->load->view('template_administrator/header');
        $this->load->view('template_administrator/sidebar');
        $this->load->view('administrator/st_detail_surat',$data);
        $this->load->view('template_administrator/footer');
    }

    public function edit_surat() {
        $this->is_loggedIn();
        $this->is_admin();
        $this->_rules_edit_surat();
        if($this->form_validation->run() === FALSE) {
            $id = $this->input->post('id');
            $this->detail_surat($id);
        } else {
            $id = $this->input->post('id');
            $data = [
                "location"=>$this->input->post('location'),
                "job_desc"=>$this->input->post('job_desc'),
                "date"=>$this->input->post('date')
            ];
            $this->SuratTugasModel->updateST($id,$data);
            $this->session->set_flashdata('pesan',
                '<div 
                    class=" alert 
                            alert-success 
                            dismissible 
                            fade 
                            show
                            " 
                    role="alert">
                Data Berhasil Diubah!
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
            redirect(base_URL('administrator/surattugas'));
        }
        
    }

    public function hapus_surat(){
        $this->is_loggedIn();
        $this->is_admin();
        $id = $this->input->post('id');
        $this->SuratTugasModel->deleteST($id);
        $this->session->set_flashdata('pesan',
            '<div 
                class=" alert 
                        alert-success 
                        dismissible 
                        fade 
                        show
                        " 
                role="alert">
            Data Berhasil Dihapus!
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
        redirect(base_URL('administrator/surattugas'),'refresh');
    }

    public function _rules_edit_surat(){
		$this->form_validation->set_rules('location','location','required',['required' => 'Lokasi Wajib Diisi']);
		$this->form_validation->set_rules('date','date','required',['required' => 'Tanggal Wajib Diisi']);
		$this->form_validation->set_rules('job_desc','job','required',['required' => 'Deskripsi Pekerjaan Wajib Diisi']);
    }

    public function _rules_edit_subject() {
        $this->form_validation->set_rules('operator','operator','callback_post_edit_operator_check');
        $this->form_validation->set_rules('driver','driver','callback_post_edit_driver_check');
        $this->form_validation->set_rules('labour','labour','callback_post_edit_labour_check');
    }

    public function post_edit_operator_check() {
        $opBuffer = array_unique($this->input->post('st_op_buffer'));
        if(sizeof($this->input->post('st_op_buffer')) != sizeof($opBuffer)){
            $this->form_validation->set_message('post_edit_operator_check',"Operator Tidak Boleh Sama");
            return false;
        }
            return true;
    }
    
    public function post_edit_driver_check() {
        $drBuffer = array_unique($this->input->post('st_dr_buffer'));
        if(sizeof($this->input->post('st_dr_buffer')) != sizeof($drBuffer)){
            $this->form_validation->set_message('post_edit_driver_check',"Driver Tidak Boleh Sama");
            return false;
        }
            return true;
    }

    public function post_edit_labour_check() {
        $laBuffer = array_unique($this->input->post('st_la_buffer'));
        if(sizeof($this->input->post('st_la_buffer')) != sizeof($laBuffer)){
            $this->form_validation->set_message('post_edit_labour_check',"TK Tidak Boleh Sama");
            return false;
        }
            return true;
    }

    public function _rules_edit_heavy() {
        $this->form_validation->set_rules('heavy','heavy','callback_post_edit_heavy_check');
    }

    public function post_edit_heavy_check() {
        $heBuffer = array_unique($this->input->post('st_he_buffer'));
        if(sizeof($this->input->post('st_he_buffer')) != sizeof($heBuffer)) {
            $this->form_validation->set_message('post_edit_heavy_check',"Alat Berat Tidak Boleh Sama");
            return false;
        }
            return true;
    }

    public function _rules_edit_dt() {
        $this->form_validation->set_rules('dt','dt','callback_post_edit_dt_check');
    }

    public function post_edit_dt_check() {
        $dtBuffer = array_unique($this->input->post('st_dt_buffer'));
        if(sizeof($this->input->post('st_dt_buffer')) != sizeof($dtBuffer)) {
            $this->form_validation->set_message('post_edit_dt_check',"Dump Truck Tidak Boleh Sama");
            return false;
        }
            return true;
    }

    public function _rules_edit_kdo() {
        $this->form_validation->set_rules('kdo','kdo','callback_post_edit_kdo_check');
    }

    public function post_edit_kdo_check() {
        $kdoBuffer = array_unique($this->input->post('st_kdo_buffer'));
        if(sizeof($this->input->post('st_kdo_buffer')) != sizeof($kdoBuffer)) {
            $this->form_validation->set_message('post_edit_kdo_check',"KDO Tidak Boleh Sama");
            return false;
        }
            return true;
    }
}

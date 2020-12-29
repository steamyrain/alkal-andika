<?php 
    // Controller for laporan kerja
    class Laporan extends CI_Controller {

        function __construct(){
            parent::__construct();
        }

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

        private function is_operator() {
            if(($this->session->userdata['job_id'] != 2) and ($this->session->userdata['job_id'] != 1)) {
               redirect('pegawai/dashboard'); 
            }
        }

        // index function will be called as soon as laporan controller
        // called
        public function index() {
            $this->is_loggedIn();
            $this->is_operator();
            $data['laporan'] = $this->LapKerjaModel->getOperatorsDatalaporan($this->session->userdata['user_id'])->result();
            $data['username'] = $this->session->userdata['username'];
            $this->load->view('template_pegawai/header');
            $this->load->view('template_pegawai/sidebar');
            $this->load->view('pegawai/laporan_kerja',$data);
            $this->load->view('template_pegawai/footer');
        }

        // input function will be called when user press
        // the add button 
        public function input() { 
            $this->is_loggedIn();
            $this->is_operator();
            
            //populate vin
            $vin = $this->AlatBeratModel->getPlateSerialType()->result();
            $plate_number = array();
            $serial_number = array();
            $type_p = array();
            $type_s = array();
            
            foreach ($vin as $v):
                if($v->plate_number != NULL) {
                    array_push($plate_number,$v->plate_number);
                    array_push($type_p,$v->plate_number);
                }
                if($v->serial_number != NULL) {
                    array_push($serial_number,$v->serial_number);
                    array_push($type_s,$v->serial_number);
                }
            endforeach;
            $data = [
                'plate_number'=>$plate_number,
                'serial_number'=>$serial_number,
                'type_p'=>$type_p,
                'type_s'=>$type_s
            ];
            $this->load->view('template_pegawai/header');
            $this->load->view('template_pegawai/sidebar');
            $this->load->view('pegawai/laporan_form',$data);
            $this->load->view('template_pegawai/footer');
        }

        // input_aksi function will be called when user press
        // the add button 
        public function input_aksi() {

            $this->_rules();

            if($this->form_validation->run()==FALSE) {
                $this->input();
            }
            else {
                $userId = $this->session->userdata['user_id'] ;
                if ($this->input->post('lk__jenis_vin') === "serial_number") {
                    $plate_number = NULL;
                    $serial_number = $this->input->post('serial_number');
                } else if ($this->input->post('lk__jenis_vin') === "plate_number") {
                    $serial_number = NULL;
                    $plate_number = $this->input->post('plate_number');
                }
                $project_location = $this->input->post('project_location');
                $km_onStart = $this->input->post('lk__km_onStart');
                $km_onFinish = $this->input->post('lk__km_onFinish');
                $km_total = $this->input->post('km_total');
                $gasoline = 0;

                $data = array(
                    'userId' => $userId,
                    'plate_number' => $plate_number,
                    'serial_number' => $serial_number,
                    'project_location' => $project_location,
                    'km_onStart' => $km_onStart,
                    'km_onFinish' => $km_onFinish,
                    'km_total' => $km_total,
                    'gasoline' => $gasoline
                );
                $this->LapKerjaModel->setDataLaporan($data);
                redirect('pegawai/laporan');
            }
        }

        public function _rules() {
            $this->form_validation->set_rules('plate_number','plate_number','callback_vin_check');
            $this->form_validation->set_rules('serial_number','serial_number','callback_vin_check');
            $this->form_validation->set_rules('project_location','Lokasi kerja','required',['required'=>'%s  wajib diisi']);
            $this->form_validation->set_rules('lk__km_onStart','KM awal','required',['required'=>'%s wajib diisi']);
            $this->form_validation->set_rules('lk__km_onFinish','KM akhir','required',['required'=>'%s wajib diisi']);
        }

        public function vin_check() {
            if (($this->input->post('plate_number') == 'NULL') && ($this->input->post('serial_number') == 'NULL')) {
                $this->form_validation->set_message('vin_check',"Salah Satu Nomor Wajib diisi");
                return false;
            }
            else {
                return true;
            }
        }
  
    }
?>

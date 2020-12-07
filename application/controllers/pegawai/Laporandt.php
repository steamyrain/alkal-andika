<?php 
    // Controller for laporan kerja
    class Laporandt extends CI_Controller {

        function __construct(){
            parent::__construct();

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

        // index function will be called as soon as laporan controller
        // called
        public function index() {
            $data['laporan'] = $this->LKDTModel->getOperatorsDatalaporan($this->session->userdata['user_id'])->result();
            $this->load->view('template_pegawai/header');
            $this->load->view('template_pegawai/sidebar');
            $this->load->view('pegawai/lk_dt',$data);
            $this->load->view('template_pegawai/footer');
        }

        // input function will be called when user press
        // the add button 
        public function input() {
            // Populate vin for form field plate_number and serial_number
            $plate_number = $this->populateVin();
            $data = [
                'uId'=>$this->session->userdata['user_id'],
                'uName'=>$this->session->userdata['username'],
                'plate_number'=>$plate_number
            ];
            $this->load->view('template_pegawai/header');
            $this->load->view('template_pegawai/sidebar');
            $this->load->view('pegawai/lk_dt_form',$data);
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
                $userId = $this->input->post('userid');
                $plate_number = $this->input->post('plate_number');
                $project_location = $this->input->post('project_location');
                $km_onStart = $this->input->post('lk__km_onStart');
                $km_onFinish = $this->input->post('lk__km_onFinish');
                $km_total = $this->input->post('km_total');
                $gasoline = 0;

                $data = array(
                    'userId' => $userId,
                    'plate_number' => $plate_number,
                    'project_location' => $project_location,
                    'km_onStart' => $km_onStart,
                    'km_onFinish' => $km_onFinish,
                    'km_total' => $km_total,
                    'gasoline' => $gasoline
                );
                $this->LKDTModel->setDataLaporan($data);
                redirect('pegawai/laporandt');
            }
        }

        public function _rules() {
            $this->form_validation->set_rules('plate_number','Nomor Polisi','required',['required'=>'%s wajib diisi']);
            $this->form_validation->set_rules('project_location','Lokasi kerja','required',['required'=>'%s  wajib diisi']);
            $this->form_validation->set_rules('lk__km_onStart','KM awal','required',['required'=>'%s wajib diisi']);
            $this->form_validation->set_rules('lk__km_onFinish','KM akhir','required',['required'=>'%s wajib diisi']);
        }

        private function populateVin() {
            $plate_number = array();
            $vin = $this->DumpTruckModel->getDTPN()->result();
            foreach ($vin as $v):
                if($v->plate_number != NULL) {
                    array_push($plate_number,$v->plate_number);
                }
            endforeach;
            return $plate_number;
        }
  
    }
?>

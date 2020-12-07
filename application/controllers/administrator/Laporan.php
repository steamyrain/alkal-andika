<?php 
    // Controller for laporan kerja
    class Laporan extends CI_Controller {

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
            $data['laporan'] = $this->LapKerjaModel->getDatalaporanWithName()->result();
            $this->load->view('template_administrator/header');
            $this->load->view('template_administrator/sidebar');
            $this->load->view('administrator/laporan_kerja',$data);
            $this->load->view('template_administrator/footer');
        }

        // input function will be called when user press
        // the add button 
        public function input() {
            // Populate username for form field username
            $operators = $this->populateOperator();
            // Populate vin for form field plate_number and serial_number
            $vin = $this->populateVin();
            $data = [
                'username'=>$operators['username'],
                'oId'=>$operators['oId'],
                'plate_number'=>$vin['plate_number'],
                'serial_number'=>$vin['serial_number']
            ];
            $this->load->view('template_administrator/header');
            $this->load->view('template_administrator/sidebar');
            $this->load->view('administrator/laporan_form',$data);
            $this->load->view('template_administrator/footer');
        }

        // input_aksi function will be called when user press
        // the add button 
        public function input_aksi() {
            $this->_rules();

            if($this->form_validation->run()==FALSE) {
                $this->input();
            }
            else {
                $userId = $this->input->post('uId');
                if ($this->input->post('plate_number') == 'NULL') {
                    $plate_number = NULL;
                } else {
                    $plate_number = $this->input->post('plate_number');
                }
                if ($this->input->post('serial_number') == 'NULL') {
                    $serial_number = NULL;
                } else {
                    $serial_number = $this->input->post('serial_number');
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
                redirect('administrator/laporan');
            }
        }

        public function _rules() {
            $this->form_validation->set_rules('uId','Username','required',['required'=>'%s wajib diisi']);
            $this->form_validation->set_rules('lk__jenis_alat','jenis alat','required',['required'=>'%s wajib diisi']);
            //$this->form_validation->set_rules('plate_number','plate_number','callback_vin_check');
            //$this->form_validation->set_rules('serial_number','serial_number','callback_vin_check');
            $this->form_validation->set_rules('project_location','Lokasi kerja','required',['required'=>'%s  wajib diisi']);
            $this->form_validation->set_rules('lk__km_onStart','KM awal','required',['required'=>'%s wajib diisi']);
            $this->form_validation->set_rules('lk__km_onFinish','KM akhir','required',['required'=>'%s wajib diisi']);
        }

        public function vin_check() {
            if (($this->input->post('plate_number') == 'NULL') && ($this->input->post('serial_number') == 'NULL')) {
                $this->form_validation->set_message('vin_check',"Nomor Wajib diisi");
                return false;
            }
            else {
                return true;
            }
        }

        private function populateOperator() {
            $username = array();
            $id = array();
            $operator = $this->user_model->getUserOperator()->result();
            foreach ($operator as $o):
                array_push($username,$o->username);
                array_push($id,$o->id);
            endforeach;
            $data = ['username'=>$username,'oId'=>$id];
            return $data;
        }

        private function populateVin() {
            $plate_number = array();
            $serial_number = array();
            $data = array();
            $vin = $this->AlatBeratModel->getPlateAndSerial()->result();
            foreach ($vin as $v):
                if($v->plate_number != NULL) {
                    array_push($plate_number,$v->plate_number);
                }
                if($v->serial_number != NULL) {
                    array_push($serial_number,$v->serial_number);
                }
            endforeach;
            $data['plate_number'] = $plate_number;
            $data ['serial_number']=$serial_number;
            return $data;
        }
  
    }
?>

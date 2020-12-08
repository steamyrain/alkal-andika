<?php 
    // Controller for laporan kerja
    class Laporan extends CI_Controller {

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

        // index function will be called as soon as laporan controller
        // called
        public function index() {
            $this->is_loggedIn();
            $this->is_admin();
            $data['laporan'] = $this->LapKerjaModel->getDatalaporanWithName()->result();
            $this->load->view('template_administrator/header');
            $this->load->view('template_administrator/sidebar');
            $this->load->view('administrator/laporan_kerja',$data);
            $this->load->view('template_administrator/footer');
        }

        // input function will be called when user press
        // the add button 
        public function input() {
            $this->is_loggedIn();
            $this->is_admin();
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

        public function edit($lapId) {
            $this->is_loggedIn();
            $this->is_admin();
            // Populate username for form field username
            $operators = $this->populateOperator();
            // Populate vin for form field plate_number and serial_number
            $vin = $this->populateVin();
            $record = $this->LapKerjaModel->getDataLaporanSpecific($lapId)->row();
            $data = [
                'username'=>$operators['username'],
                'oId'=>$operators['oId'],
                'plate_number'=>$vin['plate_number'],
                'serial_number'=>$vin['serial_number'],
                'record'=>$record
            ];
            $this->load->view('template_administrator/header');
            $this->load->view('template_administrator/sidebar');
            $this->load->view('administrator/laporan_kerja_edit',$data);
            $this->load->view('template_administrator/footer');
        }

        // input_aksi function will be called when user press
        // the add button 
        public function input_aksi() {
            $this->is_loggedIn();
            $this->is_admin();
            $this->_rules();

            if($this->form_validation->run()==FALSE) {
                $this->input();
            }
            else {
                $userId = $this->input->post('uId');
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
                redirect('administrator/laporan');
            }
        }

        public function hapus_aksi() {
            $this->is_loggedIn();
            $this->is_admin();
            $id = $this->input->post('id');
            $this->LapKerjaModel->deleteLaporan($id);
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
            redirect(base_URL('administrator/laporan'),'refresh');
        }

        public function edit_aksi(){
            $this->is_loggedIn();
            $this->is_admin();
            $this->_rules();
            if($this->form_validation->run() === FALSE) {
                $lId = $this->input->post('id');
                $this->edit($lId);
            }
            else {
                // assign form input values to variables
                $id = $this->input->post('id');    
                $userId = $this->input->post('uId');
                $created_at = $this->input->post('created_at');    
                if ($this->input->post('lk__jenis_vin') === "serial_number") {
                    $plate_number = NULL;
                    $serial_number = $this->input->post('serial_number');
                } else if ($this->input->post('lk__jenis_vin') === "plate_number") {
                    $serial_number = NULL;
                    $plate_number = $this->input->post('plate_number');
                }
                $project_location = ($this->input->post('project_location')=="")?NULL:$this->input->post('project_location');
                $km_onStart = $this->input->post('lk__km_onStart');
                $km_onFinish = $this->input->post('lk__km_onFinish');
                $km_total = $this->input->post('km_total');
                $gasoline = $this->input->post('gasoline');
                $data = array(
                    'userId' => $userId,
                    'created_at' => $created_at,
                    'plate_number' => $plate_number,
                    'serial_number' => $serial_number,
                    'project_location' => $project_location,
                    'km_onStart' => $km_onStart,
                    'km_onFinish' => $km_onFinish,
                    'km_total' => $km_total,
                    'gasoline' => $gasoline
                );
                $this->LapKerjaModel->editLaporan($data,$id);
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
                redirect(base_URL('administrator/laporan'));
            }
        }

        public function _rules() {
            $this->form_validation->set_rules('uId','Username','required',['required'=>'%s wajib diisi']);
            $this->form_validation->set_rules('created_at','Tanggal Waktu','required',['required'=>'%s wajib diisi']);
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
            $operator = $this->user_model->getOperatorOnly()->result();
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

<?php 
    // Controller for laporan kerja
    class Laporandt extends CI_Controller {

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
        //
        // index function will be called as soon as laporan controller
        // called
        public function index() {
            $this->is_loggedIn();
            $this->is_admin();
            $data['laporan'] = $this->LKDTModel->getDatalaporanWithName()->result();
            $this->load->view('template_administrator/header');
            $this->load->view('template_administrator/sidebar');
            $this->load->view('administrator/lk_dt',$data);
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
            $plate_number = $this->populateVin();
            $data = [
                'username'=>$operators['username'],
                'oId'=>$operators['oId'],
                'plate_number'=>$plate_number,
            ];
            $this->load->view('template_administrator/header');
            $this->load->view('template_administrator/sidebar');
            $this->load->view('administrator/lk_dt_form',$data);
            $this->load->view('template_administrator/footer');
        }

        public function hapus_aksi() { 
            $this->is_loggedIn();
            $this->is_admin();
            $id = $this->input->post('id');
            $this->LKDTModel->deleteLKDT($id);
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
            redirect(base_URL('administrator/laporandt'),'refresh');
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
                redirect('administrator/laporandt');
            }
        }

        public function _rules() {
            $this->form_validation->set_rules('uId','Username','required',['required'=>'%s wajib diisi']);
            $this->form_validation->set_rules('plate_number','Nomor Polisi','required',['required'=>'%s wajib diisi']);
            $this->form_validation->set_rules('project_location','Lokasi kerja','required',['required'=>'%s  wajib diisi']);
            $this->form_validation->set_rules('lk__km_onStart','KM awal','required',['required'=>'%s wajib diisi']);
            $this->form_validation->set_rules('lk__km_onFinish','KM akhir','required',['required'=>'%s wajib diisi']);
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

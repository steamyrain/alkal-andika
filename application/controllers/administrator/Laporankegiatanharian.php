<?php 
    // Controller for laporan kerja
    class Laporankegiatanharian extends CI_Controller {

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
        $this->load->view('template_administrator/header');
        $this->load->view('template_administrator/sidebar');
        $this->load->view('administrator/laporan_kegiatan_harian');
        $this->load->view('template_administrator/footer');
      }

      public function api() {
        /* check if truly admin and a verificator */
        $this->is_loggedIn();
        $this->is_admin();
        /*-----------------*/
        switch($_SERVER['REQUEST_METHOD']) {
          case 'GET':
            $kegiatanId=$this->input->get('kegiatanid',true);
            $kegiatans=$this->LaporanKegiatanHarianModel->getLaporanKegiatanHarian($kegiatanId)->result();
            header('Content-Type: application/json');
            echo json_encode($kegiatans);
            break;
          case 'POST':
            try{
                $data = json_decode($this->security->xss_clean($this->input->raw_input_stream),true);
                $this->LaporanKegiatanHarianModel->setLaporanKegiatanHarian($data);
            } catch (Exception $e) {
                $this->output->set_status_header(500);
            } finally {
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
                $this->output->set_status_header(200);
            }
            break;
          case 'PUT':
            break;
          case 'DELETE':
            break;
          default:
            break;
        }
      }

      public function jenistk() {
        /* check if truly admin and a verificator */
        $this->is_loggedIn();
        $this->is_admin();
        /*-----------------*/
        switch($_SERVER['REQUEST_METHOD']) {
          case 'GET':
            $ids = array(5,6,7);
            $jobs = $this->JobRoleModel->getAllJobRoleExcept($ids)->result();
            header('Content-Type: application/json');
            echo json_encode($jobs);
            break;
          default:
            break;
        }
      }

      public function jenisab() {
        /* check if truly admin and a verificator */
        $this->is_loggedIn();
        $this->is_admin();
        /*-----------------*/
        switch($_SERVER['REQUEST_METHOD']) {
          case 'GET':
            $jenis_ab = $this->AlatBeratModel->getJenisAB()->result();
            header('Content-Type: application/json');
            echo json_encode($jenis_ab);
            break;
        }
      }

      // input function will be called when user press
      // the add button 
      public function input() {
        $this->is_loggedIn();
        $this->is_admin();
        $this->load->view('template_administrator/header');
        $this->load->view('template_administrator/sidebar');
        $this->load->view('administrator/laporan_kegiatan_harian_form');
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
        $isPlateNumber = $this->isPlateNumber($record);
        $data = [
            'isPlateNumber'=>$isPlateNumber,
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

      public function print() {
        $this->is_loggedIn();
        $this->is_admin();
        $data['laporan'] = $this->LapKerjaModel->printAllFormat()->result();
        $this->load->view('administrator/print_lk_ab',$data);
      }
    }

?>

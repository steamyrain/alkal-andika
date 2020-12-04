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

        // index function will be called as soon as laporan controller
        // called
        public function index() {
            $this->is_loggedIn();
            if(($this->session->userdata['job_id'] != 2) and ($this->session->userdata['job_id'] != 1)) {
               redirect('pegawai/dashboard'); 
            }
            $data['laporan'] = $this->LapKerjaModel->getDatalaporanWithName()->result();
            $this->load->view('template_pegawai/header');
            $this->load->view('template_pegawai/sidebar');
            $this->load->view('pegawai/laporan_kerja',$data);
            $this->load->view('template_pegawai/footer');
        }

        // input function will be called when user press
        // the add button 
        public function input() { 
            $this->is_loggedIn();
            $this->load->view('template_pegawai/header');
            $this->load->view('template_pegawai/sidebar');
            $this->load->view('pegawai/laporan_form');
            $this->load->view('template_pegawai/footer');
        }

        // input_aksi function will be called when user press
        // the add button 
        public function input_aksi() {
            /*
            $this->_rules();

            if($this->form_validation->run()==FALSE) {
                $this->input();
            }
            else {
                $nama = $this->input->post('nama');
                $lokasi = $this->input->post('lokasi');
                $nopol = $this->input->post('nopol');
                $kmawal = $this->input->post('kmawal');
                $kmakhir = $this->input->post('kmakhir');
                $jarak = $this->input->post('jarak');
                $bbm = $this->input->post('bbm');

                $data = array(
                    'nama' => $nama,
                    'lokasiKerja' => $lokasi,
                    'npol' => $nopol,
                    'kmawal' => $kmawal,
                    'kmakhir' => $kmakhir,
                    'jarak' => $jarak,
                    'bbm' => $bbm
                );

                $this->laporankerja_model->setDataLaporan($data);
                redirect('administrator/laporan');
            }
             */
        }

        public function _rules() {
            /*
            $this->form_validation->set_rules('nama','Nama','required',['required'=>'%s wajib diisi']);
            $this->form_validation->set_rules('lokasi','Lokasi','required',['required'=>'%s wajib diisi']);
            $this->form_validation->set_rules('nopol','Nomer Polisi','required',['required'=>'%s wajib diisi']);
            $this->form_validation->set_rules('kmawal','KM Awal','required',['required'=>'%s wajib diisi']);
            $this->form_validation->set_rules('kmakhir','KM Akhir','required',['required'=>'%s wajib diisi']);
            $this->form_validation->set_rules('jarak','Jarak','required',['required'=>'%s wajib diisi']);
            $this->form_validation->set_rules('bbm','BBM','required',['required'=>'%s wajib diisi']);
             */
        }
  
    }
?>

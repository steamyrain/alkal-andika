<?php 
    // Controller for laporan kerja
    class Laporan extends CI_Controller {

        // index function will be called as soon as laporan controller
        // called
        public function index() {
            $data['laporan'] = $this->laporankerja_model->getDatalaporan()->result();
            $this->load->view('template_pegawai/header');
            $this->load->view('template_pegawai/sidebar');
            $this->load->view('pegawai/laporan_kerja',$data);
            $this->load->view('template_pegawai/footer');
        }

        // input function will be called when user press
        // the add button 
        public function input() {

            $this->load->view('template_pegawai/header');
            $this->load->view('template_pegawai/sidebar');
            $this->load->view('pegawai/laporan_form');
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
                redirect('pegawai/laporan');
            }
        }

        public function _rules() {
            $this->form_validation->set_rules('nama','Nama','required',['required'=>'%s wajib diisi']);
            $this->form_validation->set_rules('lokasi','Lokasi','required',['required'=>'%s wajib diisi']);
            $this->form_validation->set_rules('nopol','Nomer Polisi','required',['required'=>'%s wajib diisi']);
            $this->form_validation->set_rules('kmawal','KM Awal','required',['required'=>'%s wajib diisi']);
            $this->form_validation->set_rules('kmakhir','KM Akhir','required',['required'=>'%s wajib diisi']);
            $this->form_validation->set_rules('jarak','Jarak','required',['required'=>'%s wajib diisi']);
        }
  
    }
?>

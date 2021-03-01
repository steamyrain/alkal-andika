<?php

class Tu extends CI_Controller{

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

    private function is_user() {
        if($this->session->userdata['level'] !== 'user'){
            $this->session->set_flashdata('pesan','<div class="alert alert-warning alert-danger dismissible fade show" role="alert">
                Anda tidak terdaftar sebagai user!
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
                 </button>
                </div>');
            redirect('pegawai/auth');
        }
    }

	public function index()
	{
        $this->is_loggedIn();
        $this->is_user();
		$data['title'] = "data pmj";
		$data['pmj'] = $this->pmj_model->showSpecificPmj($this->session->userdata['username'])->result();
		$this->load->view('template_pegawai/header');
		$this->load->view('template_pegawai/sidebar');
		$this->load->view('pegawai/tu',$data);
		$this->load->view('template_pegawai/footer');
	}

	public function input()
	{
        $this->is_loggedIn();
        $this->is_user();
		$data = array(
			'no'  => set_value('no'),
			'tgl'  => set_value('tgl'),
            'waktu'  => set_value('waktu'),
            'pulang'  => set_value('pulang'),
			'nama'   => set_value('nama'),
			'bidang'   => set_value('bidang'),
			'kegiatan'   => set_value('kegiatan'),
            'lokasi'   => set_value('lokasi'),
			'dokumentasi'   => set_value('dokumentasi'),
		);
		$this->load->view('template_pegawai/header');
		$this->load->view('template_pegawai/sidebar');
		$this->load->view('pegawai/tu_form',$data);
		$this->load->view('template_pegawai/footer');
	}

	public function input_aksi()
	{
        $this->is_loggedIn();
        $this->is_user();
        // rules loaded
		$this->_rules();

        // check if form not valid / return FALSE
		if($this->form_validation->run() == FALSE) {
            echo validation_errors();
			$this->input();
        }

        // form is valid
        else 
        {
            echo "form valid\n";
            // assign form input values to variables
			$waktu         = $this->input->post('waktu');
            $tgl         = $this->input->post('tgl');
            $pulang         = $this->input->post('pulang');
			$nama 			= $this->input->post('nama');
			$bidang 		= $this->input->post('bidang');
			$kegiatan 		= $this->input->post('kegiatan');
            $lokasi        = $this->input->post('lokasi');
            // codeigniter's upload config
            $config['upload_path'] = './assets/upload/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = 10000; 

            // initialize upload with predefined config
            $this->upload->initialize($config);

            // check if upload is successful
            if(!$this->upload->do_upload('dokumentasi')) {
                echo "upload gagal";
                $this->input();
            }
            else {
                $dokumentasi = $this->upload->data('file_name');
                $data = array(
                    'nama' => $nama,
                    'waktu' => $waktu,
                    'tgl' => $tgl,
                    'pulang' => $pulang,
                    'bidang' => $bidang,
                    'kegiatan' => $kegiatan,
                    'lokasi' => $lokasi,
                    'dokumentasi' => $dokumentasi,
                );
                $this->pmj_model->input_data($data);
                $this->session->set_flashdata('pesan',
                    '<div 
                        class=" alert 
                                alert-warning 
                                alert-danger 
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
                    redirect('pegawai/tu');
            }
		}
    }
	
	public function _rules()
	{
		$this->form_validation->set_rules('nama','nama','required',['required' => 'Nama Wajib Diisi']);
		$this->form_validation->set_rules('bidang','bidang','required',['required' => 'Bidang Wajib Diisi']);
		$this->form_validation->set_rules('kegiatan','kegiatan','required',['required' => 'Kegiatan Wajib Diisi']);
        $this->form_validation->set_rules('lokasi','lokasi','required',['required' => 'Lokasi Wajib Diisi']);
	}

}

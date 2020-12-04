<?php

class Operator extends CI_Controller{

function __construct(){
        parent::__construct();

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

	public function index()
	{
		$data['title'] = "data operator";
		$data['operator']	= $this->operator_model->tampil_data()->result();
		$this->load->view('template_pegawai/header');
		$this->load->view('template_pegawai/sidebar');
		$this->load->view('pegawai/operator',$data);
		$this->load->view('template_pegawai/footer');
	}

	public function input()
	{
		$data = array(
			'no'  => set_value('no'),
			'nama'   => set_value('nama'),
            'waktu'   => set_value('waktu'),
			'bidang'   => set_value('bidang'),
			'kegiatan'   => set_value('kegiatan'),
            'lokasi'   => set_value('lokasi'),
			'dokumentasi'   => set_value('dokumentasi'),
		);
		$this->load->view('template_pegawai/header');
		$this->load->view('template_pegawai/sidebar');
		$this->load->view('pegawai/operator_form',$data);
		$this->load->view('template_pegawai/footer');
	}
	public function input_aksi()
	{
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
			$nama 			= $this->input->post('nama');
            $waktu          = $this->input->post('waktu');
			$bidang 		= $this->input->post('bidang');
			$kegiatan 		= $this->input->post('kegiatan');
            $lokasi         = $this->input->post('lokasi');
            // codeigniter's upload config
            $config['upload_path'] = './assets/upload/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = 2000; 

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
                    'bidang' => $bidang,
                    'kegiatan' => $kegiatan,
                    'lokasi' => $lokasi,
                    'dokumentasi' => $dokumentasi,
                );
                $this->operator_model->input_data($data);
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
                    redirect('pegawai/operator');
            }
		}
    }
            /*
			$dokumentasi 	= $_FILES['dokumentasi'];
            if($dokumentasi['size'] == 0) { 
                echo "file empty\n";
            } 
            elseif($dokumentasi['error'] > 0) { 
                if ($dokumentasi['error'] == 1) {
                    echo "filesize exceeds php maxlimit\n";
                }
                elseif ($dokumentasi['error'] == 2) {
                    echo "filesize exceeds html form maxlimit\n";
                }
                elseif ($dokumentasi['error'] == 3) {
                    echo "file partially uploaded\n";
                }
                elseif ($dokumentasi['error'] == 4) {
                    echo "No file uploaded\n";
                }
                elseif ($dokumentasi['error'] == 6) {
                    echo "Missing temp folder\n";
                }
                elseif ($dokumentasi['error'] == 7) {
                    echo "failed write file to disk\n";
                }
                elseif ($dokumentasi['error'] == 8) {
                    echo "upload process stopped\n";
                }
            }
            else {
                echo "file not empty and uploaded with success\n";
                echo $_FILES['dokumentasi']['name']."\n";
                $config['upload_path'] = './assets/upload/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = 2000; 
                $this->load->library('upload', $config);
                if(!$this->upload->do_upload('dokumentasi'))
                {
                    echo "Upload Gagal\n"; 
                } 
                else {
                    echo "upload berhasil\n";
                    $dokumentasi = $this->upload->data('file_name');
                    $data = array(
                        'nama'			=> $nama,
                        'bidang'		=> $bidang,
                        'kegiatan'		=> $kegiatan,
                        'dokumentasi'	=> $dokumentasi
                    );
                    $this->kinerja_model->input_data($data);
                }
 			}	
             */
            /*$this->session->set_flashdata('pesan','<div class="alert alert-warning alert-danger dismissible fade show" role="alert">
                    Data Berhasil Ditambahkan!
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     </button>
                    </div>');
             */
            //redirect('administrator/kinerja');
	
	public function _rules()
	{
		$this->form_validation->set_rules('nama','nama','required',['required' => 'Nama Wajib Diisi']);
		$this->form_validation->set_rules('bidang','bidang','required',['required' => 'Bidang Wajib Diisi']);
		$this->form_validation->set_rules('kegiatan','kegiatan','required',['required' => 'Kegiatan Wajib Diisi']);
        $this->form_validation->set_rules('lokasi','lokasi','required',['required' => 'Lokasi Wajib Diisi']);
	}

}

<?php

class Atpm extends CI_Controller{

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


	public function index()
	{
		$data['atpm']	= $this->atpm_model->tampil_data('atpm')->result();
		$this->load->view('template_administrator/header');
		$this->load->view('template_administrator/sidebar');
		$this->load->view('administrator/atpm',$data);
		$this->load->view('template_administrator/footer');
	}

	public function tambah_atpm()
	{
		$data['atpm']	= $this->atpm_model->tampil_data('atpm')->result();
		$this->load->view('template_administrator/header');
		$this->load->view('template_administrator/sidebar');
		$this->load->view('administrator/atpm_form',$data);
		$this->load->view('template_administrator/footer');
	}

	public function tambah_atpm_aksi()
	{
		$this->_rules();

		if($this->form_validation->run() == FALSE)
	{
		$this->tambah_a();
	}else{
		$id_atpm			= $this->input->post('id_atpm');
		$nama_atpm			= $this->input->post('nama_atpm');
		$alamat_kantor		= $this->input->post('alamat_kantor');
		$jenis_pemeliharaan	= $this->input->post('jenis_pemeliharaan');
		$no_kontak			= $this->input->post('no_kontak');

		$data = array (
			'id_atpm'				=> $id_atpm,
			'nama_atpm'				=> $nama_atpm,
			'alamat_kantor'			=> $alamat_kantor,
			'jenis_pemeliharaan'	=> $jenis_pemeliharaan,
			'no_kontak'				=> $no_kontak,

		);

		$this->atpm_model->insert_data($data,'atpm');
		$this->session->set_flashdata('pesan','<div class="alert alert-success alert-danger dismissible fade show" role="alert">
  				Data Berhasil Ditambahkan!
 				 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
   				 <span aria-hidden="true">&times;</span>
 				 </button>
				</div>');
		redirect('administrator/atpm');
	}
	}
	public function _rules()
	{
		$this->form_validation->set_rules('nama_atpm','nama_atpm','required',['required' => 'Nama ATPM Wajib Diisi']);
		$this->form_validation->set_rules('alamat_kantor','alamat_kantor','required',['required' => 'Alamat Kantor Wajib Diisi']);
		$this->form_validation->set_rules('jenis_pemeliharaan','jenis_pemeliharaan','required',['required' => 'Jenis Pemeliharaan Wajib Diisi']);
		$this->form_validation->set_rules('no_kontak','no_kontak','required',['required' => 'Nomor Kontak Wajib Diisi']);
	}
}
<?php 

class Alatberat extends CI_Controller {
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
    public function index() {
        $alatBerat = $this->AlatBeratModel->tampilAlatDanMerek()->result();
        $data = [
            'alatBerat'=> $alatBerat
        ];
        $this->load->view('template_administrator/header');
        $this->load->view('template_administrator/sidebar');
        $this->load->view('administrator/alat_berat',$data);
        $this->load->view('template_administrator/footer');
    }
}

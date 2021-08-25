<?php


class Ceklist_harian extends CI_Controller{

    private function is_loggedIn() {
        if (!isset($this->session->userdata['username'])){
            $this->session->set_flashdata('pesan','<div class="alert alert-warning alert-danger dismissible fade show" role="alert">
                Anda Belum Login!
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
                 </button>
                </div>');
            redirect('auth');
        }
    }

    private function is_admin() {
        if($this->session->userdata['level'] !== 'admin'){
            $this->session->set_flashdata('pesan','<div class="alert alert-warning alert-danger dismissible fade show" role="alert">
                Anda Tidak Terdaftar Sebagai Admin!
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
                 </button>
                </div>');
            redirect('auth');
        }
    }

	public function index()
	{
        $this->is_loggedIn();
        $this->is_admin();
		$data['title'] = "Ceklist";
		$data = $this->ceklist_model->ambil_data($this->session->userdata
			['username']);
		$data = array(
			'username'  => $data->username,
			'level'		=> $data->level,
		);
        
        // $data['kendaraan'] = $this->ceklist_model->getAlat()->result();
        // $data['serial'] = $this->ceklist_model->get_data('alkal_alat_berat')->result();
        $data['kendaraan'] = $this->ceklist_model->getAlat()->result();
        $data['serial'] = $this->ceklist_model->get_data()->result();
        // $data['laphar'] = $this->ceklist_model->getdatalaporan();
        $data['laphar'] = $this->db->query("SELECT * FROM tbl_header a LEFT JOIN alkal_ceklist b ON b.id_header = a.id GROUP BY a.id")->result();
        
        
		$this->load->view('template_administrator/header');
		$this->load->view('template_administrator/sidebar');
		$this->load->view('administrator/ceklist_harian',$data);
		$this->load->view('template_administrator/footer');
	}

    function detail($id){

        $this->is_loggedIn();
        $this->is_admin();
        $data['title'] = "Detail Ceklist";
        $data = $this->ceklist_model->ambil_data($this->session->userdata
            ['username']);
        $data = array(
            'username'  => $data->username,
            'level'     => $data->level,
        );

        $data['kendaraan'] = $this->ceklist_model->getAlat()->result();
        $data['serial'] = $this->ceklist_model->get_data()->result();
        $data['laphar'] = $this->ceklist_model->getdatalaporan_by_id($id);
       

        $this->load->view('template_administrator/header');
        $this->load->view('template_administrator/sidebar');
        $this->load->view('administrator/detail_ceklist_harian',$data);
        $this->load->view('template_administrator/footer');
    }
     public function printpdfheader()
    {
        $tanggal    = $this->input->post('tanggal');
        $kendaraan  = $this->input->post('kendaraan');
        $serial     = $this->input->post('serial');
        // $tanggal    =
        // $kendaraan  =
        // $serial     =
        $this->load->library('pdfgenerator');
        $data['laphar'] = $this->db->query("SELECT * FROM tbl_header a LEFT JOIN alkal_ceklist b ON b.id_header = a.id GROUP BY a.id")->result();
        $file_pdf = 'report_harian';
        $paper = 'A4';
        $orientation = "portait";
        $html = $this->load->view('administrator/printlaporanharian',$data, true);        
        $this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
    }

    public function printpdf($id="")
    {
        $tanggal    = $this->input->post('tanggal');
        $kendaraan  = $this->input->post('kendaraan');
        $serial     = $this->input->post('serial');
        // $tanggal    =
        // $kendaraan  =
        // $serial     =
        $this->load->library('pdfgenerator');
        $data['laphar'] = $this->ceklist_model->getdatacetak($id,$tanggal,$kendaraan,$serial);
        $file_pdf = 'report_harian';
        $paper = 'A4';
        $orientation = "portait";
        $html = $this->load->view('administrator/printlaporanharian',$data, true);    
        // echo "<pre>";
        // print_r($html);
        $this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
    }


}

?>









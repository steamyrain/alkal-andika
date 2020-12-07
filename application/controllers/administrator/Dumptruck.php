<?php 

class Dumptruck extends CI_Controller {

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

    public function index() {
        $this->is_loggedIn();
        $this->is_admin();
        $dumpTruck = $this->DumpTruckModel->getDTBrandCategory()->result();
        $data = [
            'dumpTruck'=> $dumpTruck
        ];
        $this->load->view('template_administrator/header');
        $this->load->view('template_administrator/sidebar');
        $this->load->view('administrator/dump_truck',$data);
        $this->load->view('template_administrator/footer');
    }

    public function input() {
        $this->is_loggedIn();
        $this->is_admin();
        $brandQ = $this->db->get('alkal_brand');
        $brand = $brandQ->result();
        $data = [
            'brand'=>$brand
        ];
        $this->load->view('template_administrator/header');
        $this->load->view('template_administrator/sidebar');
        $this->load->view('administrator/dump_truck_form',$data);
        $this->load->view('template_administrator/footer');
    }

    public function input_aksi(){

        $this->is_loggedIn();
        $this->is_admin();
        $this->_rules();

        if($this->form_validation->run() === FALSE) {
            $this->input();
        }

        else {
            // assign form input values to variables
            $plate_number = $this->input->post('plate_number');    
            $type = $this->input->post('type');
            $size_cubic_meter = $this->input->post('capacity');
            $brandId = $this->input->post('brand');
            $year = $this->input->post('year');
            $chassis_number = $this->input->post('chassis_number');
            $engine_number = $this->input->post('engine_number');
            $active = $this->input->post('active');


            $data = [
                'plate_number'=>$plate_number,
                'type'=>$type,
                'size_cubic_meter'=>$size_cubic_meter,
                'brandId'=>$brandId,
                'year'=>$year,
                'chassis_number'=>$chassis_number,
                'engine_number'=>$engine_number,
                'active'=>$active
            ];

            $this->DumpTruckModel->insertDT($data);
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
            redirect(base_URL('dumptruck'));
        }

    }

    public function hapus_aksi($plate_number) {
        $this->is_loggedIn();
        $this->is_admin();
        $this->DumpTruckModel->deleteDT($plate_number);
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
        redirect(base_URL('dumptruck'));
    }
    
    // _rules function is a set of dt_form specific 
    // validation rules
	private function _rules()
	{
		$this->form_validation->set_rules('plate_number','plate_number','required',['required' => 'Plat Nomor Wajib Diisi']);
		$this->form_validation->set_rules('type','type','required',['required' => 'Tipe Wajib Diisi']);
		$this->form_validation->set_rules('capacity','capacity','required',['required' => 'Kapasitas Wajib Diisi']);
		$this->form_validation->set_rules('brand','brand','required',['required' => 'Merek Wajib Diisi']);
		$this->form_validation->set_rules('year','year','required',['required' => 'Tahun DT Wajib Diisi']);
		$this->form_validation->set_rules('chassis_number','chassis_number','required',['required' => 'Nomor Rangka Wajib Diisi']);
		$this->form_validation->set_rules('engine_number','engine_number','required',['required' => 'Nomor Mesin Wajib Diisi']);
		$this->form_validation->set_rules('active','active','required',['required' => 'Status Aktif Wajib Diisi']);
	}
}

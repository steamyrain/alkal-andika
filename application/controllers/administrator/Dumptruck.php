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
        $jenisQ = $this->db->get('alkal_category_dt');
        $jenis = $jenisQ->result();
        $data = [
            'brand'=>$brand,
            'jenis'=>$jenis
        ];
        $this->load->view('template_administrator/header');
        $this->load->view('template_administrator/sidebar');
        $this->load->view('administrator/dump_truck_form',$data);
        $this->load->view('template_administrator/footer');
    }

    public function edit($dtId) {
        $this->is_loggedIn();
        $this->is_admin();
        $brandQ = $this->db->get('alkal_brand');
        $brand = $brandQ->result();
        $jenisQ = $this->db->get('alkal_category_dt');
        $jenis = $jenisQ->result();
        $record = $this->DumpTruckModel->getDTBrandCategoryWhere($dtId)->row();
        $data = [
            'brand'=>$brand,
            'jenis'=>$jenis,
            'record'=>$record
        ];
        $this->load->view('template_administrator/header');
        $this->load->view('template_administrator/sidebar');
        $this->load->view('administrator/dump_truck_edit',$data);
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
            $door_number = ($this->input->post('door_number') == "")?NULL:$this->input->post('door_number');    
            $type = ($this->input->post('type')=="")?NULL:$this->input->post('type');
            $catId = $this->input->post('catId');
            $brandId = $this->input->post('brandId');
            $year = ($this->input->post('year')=="")?NULL:$this->input->post('year');
            $chassis_number = ($this->input->post('chassis_number')=="")?NULL:$this->input->post('chassis_number');
            $engine_number = ($this->input->post('engine_number')=="")?NULL:$this->input->post('engine_number');
            $active = $this->input->post('active');
            $condition_info = ($this->input->post('condition_info')=="")?NULL:$this->input->post('condition_info');
            $location = ($this->input->post('location')=="")?NULL:$this->input->post('location');


            $data = [
                'plate_number'=>$plate_number,
                'door_number'=>$door_number,
                'type'=>$type,
                'catId'=>$catId,
                'brandId'=>$brandId,
                'year'=>$year,
                'chassis_number'=>$chassis_number,
                'engine_number'=>$engine_number,
                'active'=>$active,
                'condition_info'=>$condition_info,
                'location'=>$location
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
            redirect(base_URL('administrator/dumptruck'));
        }

    }

    public function edit_aksi(){
        $this->is_loggedIn();
        $this->is_admin();
        $this->_rules();
        if($this->form_validation->run() === FALSE) {
            $dtId = $this->input->post('id');
            $this->edit($dtId);
        }
        else {
            // assign form input values to variables
            $id = $this->input->post('id');    
            $plate_number = $this->input->post('plate_number');    
            $door_number = ($this->input->post('door_number') == "")?NULL:$this->input->post('door_number');    
            $type = ($this->input->post('type')=="")?NULL:$this->input->post('type');
            $catId = $this->input->post('catId');
            $brandId = $this->input->post('brandId');
            $year = ($this->input->post('year')=="")?NULL:$this->input->post('year');
            $chassis_number = ($this->input->post('chassis_number')=="")?NULL:$this->input->post('chassis_number');
            $engine_number = ($this->input->post('engine_number')=="")?NULL:$this->input->post('engine_number');
            $active = $this->input->post('active');
            $condition_info = ($this->input->post('condition_info')=="")?NULL:$this->input->post('condition_info');
            $location = ($this->input->post('location')=="")?NULL:$this->input->post('location');

            $data = [
                'plate_number'=>$plate_number,
                'door_number'=>$door_number,
                'type'=>$type,
                'catId'=>$catId,
                'brandId'=>$brandId,
                'year'=>$year,
                'chassis_number'=>$chassis_number,
                'engine_number'=>$engine_number,
                'active'=>$active,
                'condition_info'=>$condition_info,
                'location'=>$location
            ];
            $this->DumpTruckModel->editDt($data,$id);
            $this->session->set_flashdata('pesan',
                '<div 
                    class=" alert 
                            alert-success 
                            dismissible 
                            fade 
                            show
                            " 
                    role="alert">
                Data Berhasil Diubah!
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
            redirect(base_URL('administrator/dumptruck'));
        }
    }

    public function hapus_aksi() {
        $this->is_loggedIn();
        $this->is_admin();
        $dtId = $this->input->post('id');
        $this->DumpTruckModel->deleteDT($dtId);
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
        redirect(base_URL('administrator/dumptruck'),'refresh');
    }

    public function api() {
        /* check if truly admin and a verificator */
        $this->is_loggedIn();
        $this->is_admin();
        /*-----------------*/

        switch($_SERVER["REQUEST_METHOD"]) {
            case 'GET':
                $dtList = $this->DumpTruckModel->getDTBrandCategory()->result();
                header('Content-Type: application/json');
                echo json_encode($dtList);
                break;
            case 'POST':
                //do something
                $this->output->set_status_header(405);
                break;
            default:
                $this->output->set_status_header(405);
                break;
        }
    }
    
    // _rules function is a set of dt_form specific 
    // validation rules
	private function _rules()
	{
		$this->form_validation->set_rules('plate_number','plate_number','required',['required' => 'Plat Nomor Wajib Diisi']);
		$this->form_validation->set_rules('catId','Kategori/Kapasitas','required',['required' => '%s Wajib Diisi']);
		$this->form_validation->set_rules('brandId','Merek','required',['required' => '%s Wajib Diisi']);
		$this->form_validation->set_rules('active','active','required',['required' => 'Status Aktif Wajib Diisi']);
	}
}

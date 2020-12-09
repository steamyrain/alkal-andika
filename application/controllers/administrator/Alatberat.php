<?php 

class Alatberat extends CI_Controller {
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
        $alatBerat = $this->AlatBeratModel->tampilAlatDanMerek()->result();
        $data = [
            'alatBerat'=> $alatBerat
        ];
        $this->load->view('template_administrator/header');
        $this->load->view('template_administrator/sidebar');
        $this->load->view('administrator/alat_berat',$data);
        $this->load->view('template_administrator/footer');
    }

    public function input() {
        $this->is_loggedIn();
        $this->is_admin();
        $brandQ = $this->db->get('alkal_brand');
        $brand = $brandQ->result();
        $jenisQ = $this->db->get('alkal_category_alat_berat');
        $jenis = $jenisQ->result();
        $data = [
            'brand'=>$brand,
            'jenis'=>$jenis
        ];
        $this->load->view('template_administrator/header');
        $this->load->view('template_administrator/sidebar');
        $this->load->view('administrator/alat_berat_form',$data);
        $this->load->view('template_administrator/footer');
    }

    public function edit($id) {
        $this->is_loggedIn();
        $this->is_admin();
        $record = $this->AlatBeratModel->getAlatBeratSpecific($id)->row();
        $isPlateNumber = $this->isPlateNumber($record->plate_number);
        $jenisQ = $this->db->get('alkal_category_alat_berat');
        $jenis = $jenisQ->result();
        $brandQ = $this->db->get('alkal_brand');
        $brand = $brandQ->result(); 
        $data = [
            'isPlateNumber'=>$isPlateNumber,
            'category'=>$jenis,
            'brand'=>$brand,
            'record'=>$record
        ];
        $this->load->view('template_administrator/header');
        $this->load->view('template_administrator/sidebar');
        $this->load->view('administrator/alat_berat_edit',$data);
        $this->load->view('template_administrator/footer');
    }

    public function edit_aksi() {
        $this->is_loggedIn();
        $this->is_admin();
        $this->_rules();

        if ($this->form_validation->run() == FALSE){
            $id = $this->input->post('id');
            $this->edit($id);
        } else { 
            $vin=$this->input->post('lk__jenis_vin');
            if ($vin=='plate_number') {
                $serial_number=NULL;
                $plate_number=$this->input->post('plate_number');
            } else if ($vin=='serial_number') {
                $plate_number=NULL;
                $serial_number=$this->input->post('serial_number');
            }
            $catId = $this->input->post('catId');
            $sub_category = $this->input->post('sub_category');
            $type = $this->input->post('type');
            $active = $this->input->post('active');
            $brandId = $this->input->post('brandId');
            $data = [
                'serial_number'=>$serial_number,
                'plate_number'=>$plate_number,
                'catId'=>$catId,
                'brandId'=>$brandId,
                'sub_category'=>$sub_category,
                'type'=>$type,
                'active'=>$active
            ];
            $this->AlatBeratModel->setAlatBerat($data);
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
            redirect(base_URL('administrator/alatberat'));
        }
    }

    public function isPlateNumber($plate_number){
        return ($plate_number==NULL)?FALSE:TRUE;
    }

    public function input_aksi() {
        $this->is_loggedIn();
        $this->is_admin();
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->input();
        }
        else {
            $vin=$this->input->post('lk__jenis_vin');
            if ($vin=='plate_number') {
                $serial_number=NULL;
                $plate_number=$this->input->post('plate_number');
            } else if ($vin=='serial_number') {
                $plate_number=NULL;
                $serial_number=$this->input->post('serial_number');
            }
            $catId = $this->input->post('catId');
            $sub_category = $this->input->post('sub_category');
            $type = $this->input->post('type');
            $active = $this->input->post('active');
            $brandId = $this->input->post('brandId');
            $data = [
                'serial_number'=>$serial_number,
                'plate_number'=>$plate_number,
                'catId'=>$catId,
                'brandId'=>$brandId,
                'sub_category'=>$sub_category,
                'type'=>$type,
                'active'=>$active
            ];
            $this->AlatBeratModel->setAlatBerat($data);
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
            redirect(base_URL('administrator/alatberat'));
        }
    }

    public function hapus_aksi() {
        $this->is_loggedIn();
        $this->is_admin();
        $vId = $this->input->post('id');
        $this->AlatBeratModel->deleteAlatBerat($vId);
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
       redirect(base_URL('administrator/alatberat'),'refresh');
    }

    public function _rules(){
		$this->form_validation->set_rules('sub_category','Sub Kategori','required',['required' => '%s Wajib Diisi']);
		$this->form_validation->set_rules('type','Tipe','required',['required' => '%s Wajib Diisi']);
		$this->form_validation->set_rules('catId','Kategori','required',['required' => '%s Wajib Diisi']);
		$this->form_validation->set_rules('brandId','Merek','required',['required' => '%s Wajib Diisi']);
		$this->form_validation->set_rules('active','active','required',['required' => 'Status Aktif Wajib Diisi']);
        $this->form_validation->set_rules('plate_number','plate_number','callback_vin_check');
        $this->form_validation->set_rules('serial_number','serial_number','callback_vin_check');
    }

    public function vin_check() {
        if (($this->input->post('plate_number') == '') && ($this->input->post('serial_number') == '')) {
            $this->form_validation->set_message('vin_check',"Salah Satu Nomor Pengenal Wajib diisi");
            return false;
        }
        else {
            return true;
        }
    }
}

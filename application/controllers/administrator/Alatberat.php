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

    public function hapus_aksi() {
        $this->is_loggedIn();
        $this->is_admin();
        $id = $this->input->post('id');
        $this->AlatBeratModel->deleteAlatBerat($id);
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
}

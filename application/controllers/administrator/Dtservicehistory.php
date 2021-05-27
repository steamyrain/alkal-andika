<?php 
    
class Dtservicehistory extends CI_Controller {
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
		$this->load->view('template_administrator/header');
		$this->load->view('template_administrator/sidebar');
        $this->load->view('administrator/dt_service_history_selections');
		$this->load->view('template_administrator/footer');
    }

    public function selectcategory(){
        $this->is_loggedIn();
        $this->is_admin();
        $dt_id = $this->input->get('dt_id',true);
        $serviceList= $this->ServiceHistoryModel->getDTServiceListSel($dt_id)->result();
        $data = [
            "service"=>$serviceList
        ];

        /* initialize data */
		$this->load->view('template_administrator/header');
		$this->load->view('template_administrator/sidebar');
		$this->load->view('administrator/dt_service_history_selections_cat',$data);
		$this->load->view('template_administrator/footer');
    }

    public function serviceunit(){
        $this->is_loggedIn();
        $this->is_admin();
        $dt_id = $this->input->get('dt_id',true);
        $service_id = $this->input->get('service_id',true);
        $data = [
            "dt_id"=>$dt_id,
            "service_id"=>$service_id
        ];

        /* initialize data */
		$this->load->view('template_administrator/header');
		$this->load->view('template_administrator/sidebar');
		$this->load->view('administrator/dt_service_history',$data);
		$this->load->view('template_administrator/footer');
    }

    public function api() {
        /* check if truly admin and a verificator */
        $this->is_loggedIn();
        $this->is_admin();
        /*-----------------*/

        switch($_SERVER["REQUEST_METHOD"]) {
            case 'GET':
                $dt_id = $this->input->get('dt_id',true);
                $service_id = $this->input->get('service_id',true);
                $service = $this->ServiceHistoryModel->getDTServiceHistories(true,$dt_id,$service_id)->result();
                header('Content-Type: application/json');
                echo json_encode($service);
                break;
            case 'POST':
                //do something
                break;
            default:
                $this->output->set_status_header(405);
                break;
        }
    }

    public function servicelistapi() {
        /* check if truly admin and a verificator */
        $this->is_loggedIn();
        $this->is_admin();
        /*-----------------*/

        switch($_SERVER["REQUEST_METHOD"]) {
            case 'GET':
                $dt_id = $this->input->get('dt_id',TRUE);
                $service = $this->ServiceHistoryModel->getDTServiceList($dt_id)->result();
                header('Content-Type: application/json');
                echo json_encode($service);
                break;
            case 'POST':
                $serviceInput = json_decode($this->security->xss_clean($this->input->raw_input_stream),true);
                $this->ServiceHistoryModel->setDTServiceHistory($serviceInput);
                break;
            default:
                $this->output->set_status_header(405);
                break;
        }
    } 

    public function input() {
        /* check if truly admin and a verificator */
        $this->is_loggedIn();
        $this->is_admin();
        /*-----------------*/
        $dt = $this->DumpTruckModel->getDT("id,plate_number")->result();
        $data = [
            "dt"=>$dt
        ];
        $this->load->view('template_administrator/header');
        $this->load->view('template_administrator/sidebar');
        $this->load->view('administrator/dt_service_history_form',$data);
        $this->load->view('template_administrator/footer');
    }

    /* to be deleted */
    /*
    public function input_aksi() {
        $this->is_loggedIn();
        $this->is_admin();
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->input();
        }
        else {
            $dt_id=$this->input->post('dt_id');
            $service_id = $this->input->post('service_id');
            $service_date = $this->input->post('service_date');
            $serviced_by = $this->input->post('serviced_by');
            $data = [
                'dt_id'=>$dt_id,
                'service_id'=>$service_id,
                'service_date'=>$service_date,
                'serviced_by'=>$serviced_by
            ];
            $this->ServiceHistoryModel->setDTServiceHistory($data);
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
            redirect(base_URL('administrator/dtservicehistory'));
        }
    }
     */

    public function rekap() {
        /* check if truly admin and a verificator */
        $this->is_loggedIn();
        $this->is_admin();
        /*-----------------*/
        $dt = $this->DumpTruckModel->getDT("id,plate_number")->result();
        $data = [
            "dt"=>$dt
        ];
        $this->load->view('template_administrator/header'); 
        $this->load->view('template_administrator/sidebar'); 
        $this->load->view('administrator/dt_service_history_rekap',$data);
        $this->load->view('template_administrator/footer');
    }

    public function rekapapi() {
        /* check if truly admin and a verificator */
        $this->is_loggedIn();
        $this->is_admin();
        /*-----------------*/
        switch($_SERVER["REQUEST_METHOD"]) {
            case 'GET':
                try{
                    $dt_id = $this->input->get('dt_id',true);
                    $rekap_start = $this->input->get('rekap_start',true);
                    $rekap_end = $this->input->get('rekap_end',true);
                    $rekapInput = [
                        "dt_id"=>$dt_id,
                        "rekap_start"=>$rekap_start,
                        "rekap_end"=>$rekap_end
                    ];
                    $res = $this->ServiceHistoryModel->getDTServiceHistoryRekap($rekapInput)->result();
                } catch(Exception $e) {
                    $this->output->set_status_header(500);
                } finally{
                    header('Content-Type: application/json');
                    echo json_encode($res);
                }
                break;
            case 'POST':
                // do nothing
                break;
            default:
                $this->output->set_status_header(405);
                break;
        }
    }

    public function _rules() {
		$this->form_validation->set_rules('dt_id','Nomer Polisi','required',['required' => '%s Wajib Diisi']);
		$this->form_validation->set_rules('service_id','Jenis Servis','required',['required' => '%s Wajib Diisi']);
		$this->form_validation->set_rules('service_date','Tanggal Servis','required',['required' => '%s Wajib Diisi']);
    }
}

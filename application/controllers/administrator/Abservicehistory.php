<?php 
    
class Abservicehistory extends CI_Controller {
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
        $this->load->view('administrator/ab_service_history_selections.php');
		$this->load->view('template_administrator/footer');
    }

    public function selectcategory(){
        $this->is_loggedIn();
        $this->is_admin();
        $ab_id = $this->input->get('ab_id',true);
        $serviceList= $this->AlatBeratServiceHistoryModel->getABServiceListSel($ab_id)->result();
        $data = [
            "service"=>$serviceList
        ];

        /* initialize data */
		$this->load->view('template_administrator/header');
		$this->load->view('template_administrator/sidebar');
		$this->load->view('administrator/ab_service_history_selections_cat',$data);
		$this->load->view('template_administrator/footer');
    }

    public function serviceunit(){
        $this->is_loggedIn();
        $this->is_admin();
        $ab_id = $this->input->get('ab_id',true);
        $service_id = $this->input->get('service_id',true);
        $data = [
            "ab_id"=>$ab_id,
            "service_id"=>$service_id
        ];

        /* initialize data */
		$this->load->view('template_administrator/header');
		$this->load->view('template_administrator/sidebar');
		$this->load->view('administrator/ab_service_history',$data);
		$this->load->view('template_administrator/footer');
    }

    public function api() {
        /* check if truly admin and a verificator */
        $this->is_loggedIn();
        $this->is_admin();
        /*-----------------*/

        switch($_SERVER["REQUEST_METHOD"]) {
            case 'GET':
                $ab_id = $this->input->get('ab_id',true);
                $service_id = $this->input->get('service_id',true);
                $service = $this->AlatBeratServiceHistoryModel->getServiceHistories($ab_id,$service_id)->result();
                header('Content-Type: application/json');
                echo json_encode($service);
                break;
            case 'POST':
                try{
                    $serviceInput = json_decode($this->security->xss_clean($this->input->raw_input_stream),true);
                    $this->AlatBeratServiceHistoryModel->setABServiceHistory($serviceInput);
                } catch (Exception $e) {
                    $this->output->set_status_header(500);
                } finally {
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
                    $this->output->set_status_header(200);
                }
                break;
            case 'DELETE':
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
                $sh_id = $this->input->get('sh_id',true);
                $this->AlatBeratServiceHistoryModel->deleteABServiceHistory($sh_id);
                break;
            case 'PUT':
                $serviceInput = json_decode($this->security->xss_clean($this->input->raw_input_stream),true);
                try{
                    $this->AlatBeratServiceHistoryModel->updateABServiceHistory($serviceInput);
                } catch(Exception $e){
                    $this->session->set_flashdata('pesan',
                        '<div 
                            class=" alert 
                                    alert-success 
                                    dismissible 
                                    fade 
                                    show
                                    " 
                            role="alert">
                        Data Gagal Diubah!
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
                    $this->output->set_status_header(500);
                } finally{
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
                    $this->output->set_status_header(200);
                }
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
                $ab_id = $this->input->get('ab_id',TRUE);
                try{
                    $service = $this->AlatBeratServiceHistoryModel->getServiceList($ab_id)->result();
                } catch(exception $e){
                    $this->output->set_status_header(500);
                }
                $this->output->set_status_header(200);
                $this->output->set_content_type('application/json');
                $this->output->set_output(json_encode($service));
                break;
            case 'POST':
                $serviceInput = json_decode($this->security->xss_clean($this->input->raw_input_stream),true);
                $this->AlatBeratServiceHistoryModel->setABServiceHistory($serviceInput);
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
        $ab = $this->AlatBeratModel->getAB("alkal_alat_berat.id id,alkal_alat_berat.plate_number plate_number, alkal_alat_berat.serial_number serial_number, alkal_category_alat_berat.category category, alkal_alat_berat.sub_category sub_category, alkal_alat_berat.type type")->result();
        $data = [
            "ab"=>$ab
        ];
        $this->load->view('template_administrator/header');
        $this->load->view('template_administrator/sidebar');
        $this->load->view('administrator/ab_service_history_form',$data);
        $this->load->view('template_administrator/footer');
    }

    public function rekap() {
        /* check if truly admin and a verificator */
        $this->is_loggedIn();
        $this->is_admin();
        /*-----------------*/
        $ab = $this->AlatBeratModel->getAB("alkal_alat_berat.id id,alkal_alat_berat.plate_number plate_number, alkal_alat_berat.serial_number serial_number, alkal_category_alat_berat.category category, alkal_alat_berat.sub_category sub_category, alkal_alat_berat.type type")->result();
        $data = [
            "ab"=>$ab
        ];
        $this->load->view('template_administrator/header'); 
        $this->load->view('template_administrator/sidebar'); 
        $this->load->view('administrator/ab_service_history_rekap',$data);
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
                    $ab_id = $this->input->get('ab_id',true);
                    $rekap_start = $this->input->get('rekap_start',true);
                    $rekap_end = $this->input->get('rekap_end',true);
                    $rekapInput = [
                        "ab_id"=>$ab_id,
                        "rekap_start"=>$rekap_start,
                        "rekap_end"=>$rekap_end
                    ];
                    $res = $this->AlatBeratServiceHistoryModel->getABServiceHistoryRekap($rekapInput)->result();
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

    public function printapi(){
        /* check if truly admin and a verificator */
        $this->is_loggedIn();
        $this->is_admin();
        /*-----------------*/
        switch ($_SERVER['REQUEST_METHOD']){
            case 'GET':
                    $ab_id = $this->input->get('ab_id',true);
                    $rekap_start = $this->input->get('rekap_start',true);
                    $rekap_end = $this->input->get('rekap_end',true);
                    $pdf = $this->printRekap($ab_id,$rekap_start,$rekap_end);
                    $this->output->set_content_type('application/pdf');
                    $this->output->set_output(base64_encode($pdf));
                    $this->output->set_status_header(200);
                break;
            Default:
                $this->output->set_status_header(500);
                break;
        }
    }

    private function printRekap($ab_id,$rekap_start,$rekap_end){
        $rekapInput = [
            "ab_id"=>$ab_id,
            "rekap_start"=>$rekap_start,
            "rekap_end"=>$rekap_end
        ];
        $rekapData = $this->AlatBeratServiceHistoryModel->getABServiceHistoryRekap($rekapInput)->result();
        $this->load->library('Pdf');

        $pdf = new Pdf('','',date("d-m-Y"),[]);

        $pdf->AddPage("");

        $pdf->SetFont('Times','BU',14);
        $pdf->Cell(0,0,'Rekap Data Servis Alat Berat',0,1,'C');
        $pdf->ln(5);
        
        if($rekapData[0]->plate_number){
            $pdf->IdentitasKendaraan($rekapData[0]->plate_number);
        } else {
            $pdf->IdentitasKendaraan($rekapData[0]->serial_number);
        }

        $pdf->Tanggal($rekap_start,$rekap_end);

        $header = ['Tanggal','Kategori','Unit','Total'];

        // total width = 205
        $pdf->TabelServis($header,$rekapData,[30,40,40,40]);

        return $pdf->Output("rekap.pdf","S");
    }
}

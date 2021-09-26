<?php 
  use Fpdf\Fpdf;
    // Controller for laporan kerja
  class Laporankegiatanharian extends CI_Controller {

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

      // index function will be called as soon as laporan controller
      // called
      public function index() {
        $this->is_loggedIn();
        $this->is_admin();
        $this->load->view('template_administrator/header');
        $this->load->view('template_administrator/sidebar');
        $this->load->view('administrator/laporan_kegiatan_harian');
        $this->load->view('template_administrator/footer');
      }

      public function api() {
        /* check if truly admin and a verificator */
        $this->is_loggedIn();
        $this->is_admin();
        /*-----------------*/
        switch($_SERVER['REQUEST_METHOD']) {
          case 'GET':
            $kegiatanId=$this->input->get('kegiatanid',true);
            $kegiatans=$this->LaporanKegiatanHarianModel->getLaporanKegiatanHarian($kegiatanId)->result();
            header('Content-Type: application/json');
            echo json_encode($kegiatans);
            break;
          case 'POST':
            try{
                $data = json_decode($this->security->xss_clean($this->input->raw_input_stream),true);
                $kegiatan_harian = array(
                  'Uraian'=>$data['Uraian'],
                  'Lokasi'=>$data['Lokasi'],
                  'Keterangan'=>$data['Keterangan'],
                  'TanggalWaktuAwal'=>$data['TanggalWaktuAwal'],
                  'TanggalWaktuAkhir'=>$data['TanggalWaktuAkhir']
                );
                $tenagakerjas = $data['TenagaKerjas'];
                $alatberats = $data['AlatBerats'];
                $status = $this->LaporanKegiatanHarianModel->setLaporanKegiatanHarian($kegiatan_harian,$tenagakerjas,$alatberats);
                if($status === FALSE){
                  $this->output->set_status_header(500);
                } else {
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
            } catch (Exception $e) {
                $this->output->set_status_header(500);
            }
            break;
          case 'PUT':
            break;
          case 'DELETE':
            break;
          default:
            break;
        }
      }

      public function jenistk() {
        /* check if truly admin and a verificator */
        $this->is_loggedIn();
        $this->is_admin();
        /*-----------------*/
        switch($_SERVER['REQUEST_METHOD']) {
          case 'GET':
            $ids = array(5,6,7);
            $jobs = $this->JobRoleModel->getAllJobRoleExcept($ids)->result();
            header('Content-Type: application/json');
            echo json_encode($jobs);
            break;
          default:
            break;
        }
      }

      public function jenisab() {
        /* check if truly admin and a verificator */
        $this->is_loggedIn();
        $this->is_admin();
        /*-----------------*/
        switch($_SERVER['REQUEST_METHOD']) {
          case 'GET':
            $jenis_ab = $this->AlatBeratModel->getJenisAB()->result();
            header('Content-Type: application/json');
            echo json_encode($jenis_ab);
            break;
        }
      }

      public function edit($lapId) {
        $this->is_loggedIn();
        $this->is_admin();
        // Populate username for form field username
        $operators = $this->populateOperator();
        // Populate vin for form field plate_number and serial_number
        $vin = $this->populateVin();
        $record = $this->LapKerjaModel->getDataLaporanSpecific($lapId)->row();
        $isPlateNumber = $this->isPlateNumber($record);
        $data = [
            'isPlateNumber'=>$isPlateNumber,
            'username'=>$operators['username'],
            'oId'=>$operators['oId'],
            'plate_number'=>$vin['plate_number'],
            'serial_number'=>$vin['serial_number'],
            'record'=>$record
        ];
        $this->load->view('template_administrator/header');
        $this->load->view('template_administrator/sidebar');
        $this->load->view('administrator/laporan_kerja_edit',$data);
        $this->load->view('template_administrator/footer');
      }

      public function printapi() {
        $this->is_loggedIn();
        $this->is_admin();
        switch ($_SERVER['REQUEST_METHOD']){
          case 'GET':
            if (($this->input->get('kegiatanid',true)!==null) && !empty($this->input->get('kegiatanid',true))){
              $lapKegiatan = $this->LaporanKegiatanHarianModel->getLaporanKegiatanHarian($this->input->get('kegiatanid',true))->result()[0];
              $lapKegiatan = array($lapKegiatan->Uraian,$lapKegiatan->Lokasi,$lapKegiatan->TanggalWaktuAwal.' S.D. '.$lapKegiatan->TanggalWaktuAkhir,$lapKegiatan->Keterangan);
              $lktk = $this->LaporanKegiatanHarianModel->getLKTK($this->input->get('kegiatanid',true))->result();
              $lkab = $this->LaporanKegiatanHarianModel->getLKAB($this->input->get('kegiatanid',true))->result();
              $this->load->library('LaporanKegiatanPdf');
              $pdf = new LaporanKegiatanPdf();
              $pdf->AddPage("");
              $pdf->KopSurat("Organisasi","1.03.0.00.0.00.01.0000 Dinas Bina Marga");
              $pdf->KopSurat("Program","1.03.01 Program Penunjang Urusan Pemerintahan Daerah Provinsi");
              $pdf->KopSurat("Kegiatan","1.03.01.1.08 Penyediaan Jasa Penunjang Urusan Pemerintahan Daerah");
              $pdf->KopSurat("Sub Kegiatan","1.03.01.1.08.04 Penyediaan Jasa Pelayanan Umum Kantor");
              $pdf->KopSurat("Lokasi Kegiatan","Provinsi DKI Jakarta");
              $pdf->KopSurat("Tahun Anggaran","2021");
              $pdf->SubHeader("ITEM KEGIATAN");
              $pdf->ItemTHead(array("URAIAN","LOKASI KEGIATAN","TANGGAL WAKTU","KETERANGAN"),190);
              $pdf->ItemKegiatanItems($lapKegiatan,190);
              $pdf->SubHeader("TENAGA KERJA");
              $pdf->ItemTHead(array("JENIS","JUMLAH"),190);
              $pdf->JenisTKItems($lktk,190);
              $pdf->SubHeader("PERALATAN");
              $pdf->ItemTHead(array("JENIS","JUMLAH"),190);
              $pdf->JenisABItems($lkab,190);
              $final = $pdf->Output("laporankegiatanharian.pdf","S");
              $this->output->set_content_type('application/pdf');
              $this->output->set_output(base64_encode($final));
              $this->output->set_status_header(200);
            }
            break;
          Default:
              $this->output->set_status_header(500);
              break;
        }
      }
    public function input(){
        $this->is_loggedIn();
        $this->is_admin();
      $this->load->view('template_administrator/header');
      $this->load->view('template_administrator/sidebar');
      $this->load->view('administrator/laporan_kegiatan_harian_form');
      $this->load->view('template_administrator/footer');
    }
  }

?>

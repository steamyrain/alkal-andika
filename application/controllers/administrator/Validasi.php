<?php

class Validasi extends CI_Controller{

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

    private function is_verificator() {
        if(
            !isset($this->session->userdata['nip']) and 
            empty($this->session->userdata['nip'])
        ){
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
        /* check if truly admin and a verificator */
        $this->is_loggedIn();
        $this->is_admin();
        $this->is_verificator();
        /*-----------------*/

        /* initialize data */
        $nip = $this->session->userdata['nip'];
		$data['kinerja'] = $this->kinerja_model->getNewKinerjaForVerificator($nip)->result();
        /*-----------------*/

		$this->load->view('template_administrator/header');
		$this->load->view('template_administrator/sidebar');
		$this->load->view('administrator/validasi_ekinerja',$data);
		$this->load->view('template_administrator/footer');
	}

	public function input()
	{

        $this->is_loggedIn();
        $this->is_admin();

		$data = array(
            'tanggal'  => set_value('tanggal'),
            'tgl'  => set_value('tgl'),
			'no'  => set_value('no'),
            'waktu'  => set_value('waktu'),
            'pulang'  => set_value('pulang'),
			'nama'   => set_value('nama'),
			'bidang'   => set_value('bidang'),
			'kegiatan'   => set_value('kegiatan'),
            'lokasi'   => set_value('lokasi'),
			'dokumentasi'   => set_value('dokumentasi'),
		);
		$this->load->view('template_administrator/header');
		$this->load->view('template_administrator/sidebar');
		$this->load->view('administrator/kinerja_form',$data);
		$this->load->view('template_administrator/footer');
	}

	public function input_aksi()
	{

        $this->is_loggedIn();
        $this->is_admin();

        // rules loaded
		$this->_rules();

        // check if form not valid / return FALSE
		if($this->form_validation->run() == FALSE) {
			$this->input();
        }

        // form is valid
        else 
        {
            // assign form input values to variables
			$nama 			= $this->input->post('nama');
			$tgl 			= $this->input->post('tgl');
            $lokasi         = $this->input->post('lokasi');
            $waktu          = $this->input->post('waktu');
            $pulang         = $this->input->post('pulang');
			$bidang 		= $this->input->post('bidang');
			$kegiatan 		= $this->input->post('kegiatan');

            // codeigniter's upload config
            $config['upload_path'] = './assets/upload/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = 2000; 

            // initialize upload with predefined config
            $this->upload->initialize($config);

            // check if upload is successful
            if(!$this->upload->do_upload('dokumentasi')) {
                $this->input();
            }
            else {
                $dokumentasi = $this->upload->data('file_name');
                $data = array(
                    'waktu' => $waktu,
                    'tgl' => $tgl,
                    'pulang' => $pulang,
                    'nama' => $nama,
                    'bidang' => $bidang,
                    'kegiatan' => $kegiatan,
                    'lokasi' => $lokasi,
                    'dokumentasi' => $dokumentasi,
                );
                $this->kinerja_model->input_data($data);
                $this->session->set_flashdata('pesan',
                    '<div 
                        class=" alert 
                                alert-warning 
                                alert-danger 
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
                    redirect('administrator/kinerja');
            }
		}
    }

	public function _rules()
	{
		$this->form_validation->set_rules('nama','nama','required',['required' => 'Nama Wajib Diisi']);
        $this->form_validation->set_rules('waktu','waktu','required',['required' => 'Nama Wajib Diisi']);
		$this->form_validation->set_rules('bidang','bidang','required',['required' => 'Bidang Wajib Diisi']);
        $this->form_validation->set_rules('lokasi','lokasi','required',['required' => 'Lokasi Wajib Diisi']);
	}

    public function print_form(){

        $this->is_loggedIn();
        $this->is_admin();

        $data['operator']= $this->user_model->getOperatorOnly()->result();
        $this->load->view('template_administrator/header.php');
        $this->load->view('template_administrator/sidebar.php');
        $this->load->view('administrator/kinerja_print_form',$data);
        $this->load->view('template_administrator/footer.php');
    }

    public function print_dinas() {
        $this->is_loggedIn();
        $this->is_admin();
        $this->_rules_print(); 
        if($this->form_validation->run() == FALSE){
            $this->print_form();
        } else {
            $this->load->library('Pdf');

            $name = $this->input->post('username');
            $startDate = $this->input->post('starting_date');
            $endDate = $this->input->post('end_date');
            $data = $this->kinerja_model->getSpecificKinerja($name,$startDate,$endDate)->result();

            $pdf = new Pdf();
            $pdf->AddPage("L");

            $pdf->SetFont('Times','BU',14);
            $pdf->Cell(0,0,'Kinerja PJLP Bidang Pengemudi Alat Berat',0,1,'C');
            $pdf->ln(5);
            
            $pdf->Nama($this->input->post('username'));
            $pdf->Jabatan('pengemudi alat berat');
            $pdf->Tanggal($this->input->post('starting_date'),$this->input->post('end_date'));
            $header = ['Tanggal','Waktu','Kegiatan','Lokasi'];
            // total width = 205
            $pdf->TabelKinerja($header,$data,[30,15,100,60]);

            $pdf->Output();
        }
    }

    // obsolete
    public function print(){

        $this->is_loggedIn();
        $this->is_admin();

        $data['kinerja']   = $this->kinerja_model->tampil_data("kinerja")->result();
        $this->load->view('administrator/print_kinerja',$data);
    }

    public function excel(){

        $this->is_loggedIn();
        $this->is_admin();

        $data['kinerja']   = $this->kinerja_model->tampil_data("kinerja")->result();

        require(APPPATH. 'PHPExcel-1.8/Classes/PHPExcel.php');
        require(APPPATH. 'PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

        $object = new PHPExcel();
        
        $object->getProperties()->setCreator("Alkal");
        $object->getProperties()->setLastModifiedBy("Alkal");
        $object->getProperties()->setTitle("Data Kinerja");

        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
    $style_col = array(
      'font' => array('bold' => true), // Set font nya jadi bold
      'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
      ),
      'borders' => array(
        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
        'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
      )
    );
    // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
    $style_row = array(
      'alignment' => array(
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
      ),
      'borders' => array(
        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
        'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
      )
    );
    $object->setActiveSheetIndex(0)->setCellValue('F1', "DAFTAR KEGIATAN HARIAN PJLP "); // Set kolom A1 dengan tulisan "DATA SISWA"
    $object->getActiveSheet()->getStyle('F1')->getFont()->setBold(TRUE); // Set bold kolom A1
    $object->getActiveSheet()->getStyle('F1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
    $object->getActiveSheet()->getStyle('F1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
     $object->setActiveSheetIndex(0)->setCellValue('F2', "UNIT ALKAL DINAS BINA MARGA PROVINSI DKI JAKARTA "); // Set kolom A1 dengan tulisan "DATA SISWA"
    $object->getActiveSheet()->getStyle('F2')->getFont()->setBold(TRUE); // Set bold kolom A1
    $object->getActiveSheet()->getStyle('F2')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
    $object->getActiveSheet()->getStyle('F2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
     $object->setActiveSheetIndex(0)->setCellValue('F3', "2021"); // Set kolom A1 dengan tulisan "DATA SISWA"
    $object->getActiveSheet()->getStyle('F3')->getFont()->setBold(TRUE); // Set bold kolom A1
    $object->getActiveSheet()->getStyle('F3')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
    $object->getActiveSheet()->getStyle('F3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
    $object->getActiveSheet()->setAutoFilter('A4:G4');
        $object->setActiveSheetIndex(0);
        $object->getActiveSheet()->setCellValue('A4', 'Tgl/Hari');
        $object->getActiveSheet()->setCellValue('B4', 'No');
        $object->getActiveSheet()->setCellValue('C4', 'Nama');
        $object->getActiveSheet()->setCellValue('D4', 'Waktu');
        $object->getActiveSheet()->setCellValue('E4', 'Bidang');
        $object->getActiveSheet()->setCellValue('F4', 'Kegiatan');
        $object->getActiveSheet()->setCellValue('G4', 'Lokasi');
	   $object->getActiveSheet()->setCellValue('H4', 'Keterangan');

        $baris = 5;
        $no = 1;

        foreach ($data['kinerja'] as $k) {
            $object->getActiveSheet()->setCellValue('B'.$baris, $no++);
            $object->getActiveSheet()->setCellValue('A'.$baris, $k->tgl);
            $object->getActiveSheet()->setCellValue('C'.$baris, $k->nama);
            $object->getActiveSheet()->setCellValue('D'.$baris, $k->waktu);
            $object->getActiveSheet()->setCellValue('E'.$baris, $k->bidang);
            $object->getActiveSheet()->setCellValue('F'.$baris, $k->kegiatan);
            $object->getActiveSheet()->setCellValue('G'.$baris, $k->lokasi);
            

            $baris++;
        }

        $filename="Data_Kinerja".'.xlsx';

        $object->getActiveSheet()->setTitle("Data Kinerja");

        header('Content-Type: application/vnd.openxmlformats-spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename. '"');
        header('Cache-Control: max-age=0');

        $writer=PHPExcel_IOFactory::createwriter($object, 'Excel2007');
        $writer->save('php://output');

        exit;
    }

    public function hapus($no)
    {

        $this->is_loggedIn();
        $this->is_admin();

        $data = array('no'=>$no);
        $this->kinerja_model->hapus_data($data, 'kinerja');
        redirect('administrator/kinerja');
    }
    public function update($no)
    {
        $where = array('no' => $no);
        $data['kinerja'] = $this->kinerja_model->edit_data($where,'kinerja')->result();
        $this->load->view('template_administrator/header');
        $this->load->view('template_administrator/sidebar');
        $this->load->view('administrator/kinerja_update',$data);
        $this->load->view('template_administrator/footer');
    }

    public function update_aksi()
    {
        $no = $this->input->post('no');
        $tgl = $this->input->post('tgl');
        $waktu = $this->input->post('waktu');
        $pulang = $this->input->post('pulang');
        $nama = $this->input->post('nama');
        $bidang = $this->input->post('bidang');
        $kegiatan = $this->input->post('kegiatan');
        $lokasi = $this->input->post('lokasi');

        
        $data = array(
        'nama' => $nama,
        'tgl' => $tgl,
        'waktu' => $waktu,
        'pulang' => $pulang,
        'bidang' => $bidang,
        'kegiatan' => $kegiatan,
        'lokasi'    => $lokasi,
        'dokumentasi' => $dokumentasi,
                );
        $where = array(
            'no'  => $no
        );

        $this->kinerja_model->update_data($where,$data,'kinerja');
        $this->session->set_flashdata('pesan','<div class="alert alert-warning alert-danger dismissible fade show" role="alert">
                    Data Berhasil Diupdate!
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     </button>
                    </div>');
        redirect('administrator/kinerja');
    }

    public function _rules_print(){
		$this->form_validation->set_rules('username','username','required',['required' => 'Nama Wajib Diisi']);
		$this->form_validation->set_rules('starting_date','starting_date','required',['required' => 'Tanggal Awal Wajib Diisi']);
		$this->form_validation->set_rules('end_date','end_date','required',['required' => 'Tanggal Akhir Wajib Diisi']);
    }

    public function request_esign_form() {
        $this->is_loggedIn();
        $this->is_admin();
        $data['operator']= $this->user_model->getOperatorOnly()->result();
        $data['signer'] = $this->ESignModel->getVerificator()->result();
        $this->load->view('template_administrator/header.php');
        $this->load->view('template_administrator/sidebar.php');
        $this->load->view('administrator/kinerja_req_esign_form',$data);
        $this->load->view('template_administrator/footer.php');
    }

    public function request_esign() {
        $this->is_loggedIn();
        $this->is_admin();
        $this->_rules_request_esign();
        if($this->form_validation->run() == FALSE) {
            $this->request_esign_form();
        } else {
            $postUsername = explode('|',$this->input->post('username'));
            $uId = $postUsername[0];
            $uName = $postUsername[1];
            $ekin_start = $this->input->post('starting_date');
            $ekin_end = $this->input->post('end_date');
            $verificators = $this->input->post('verificator');
            $reqBy = $this->session->userdata['uId'];
            $data = [
                'uId'=>$uId,
                'uName'=>$uName,
                'ekin_start'=>$ekin_start,
                'ekin_end'=>$ekin_end,
                'reqBy'=>$reqBy
            ];
            $this->ESignModel->SetEKReq($data);

            if(isset($verificators)){
                $signers = [];
                foreach($verificators as $v):
                    $res = $this->ESignModel->getSpecificVerificator($v)->row();
                    array_push($signers,
                        [
                            'uId'=>$uId,
                            'ekin_start'=>$ekin_start,
                            'ekin_end'=>$ekin_end,
                            'reqTo'=>$v,
                            'reqToName'=>$res->legalName,
                            'jobTitle'=>$res->jobTitle,
                        ] 
                    );
                endforeach;
                $this->ESignModel->setBatchEKVfcLookup($signers);
            }

            $message = "Request EKinerja Operator Berhasil Ditambahkan!";
            $this->session->set_flashdata('pesan',
                '<div 
                    class=" alert 
                            alert-success 
                            dismissible 
                            fade 
                            show
                            " 
                    role="alert">'.
                $message.
                '
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
            redirect(base_URL('administrator/kinerja/esign'),'refresh'); 
        }

    }

    public function esign() {
        $this->is_loggedIn();
        $this->is_admin();
        $ekReq = $this->ESignModel->getEKReqReqBy($this->session->userdata['uId'])->result();
        $data['eKinerja']=$ekReq;
        $this->load->view('template_administrator/header');
        $this->load->view('template_administrator/sidebar');
        $this->load->view('administrator/kinerja_req_esign_status',$data);
        $this->load->view('template_administrator/footer');
    }

    public function _rules_request_esign() {
		$this->form_validation->set_rules('username','username','required',['required' => 'Nama Wajib Diisi']);
		$this->form_validation->set_rules('starting_date','starting_date','required',['required' => 'Tanggal Awal Wajib Diisi']);
		$this->form_validation->set_rules('end_date','end_date','required',['required' => 'Tanggal Akhir Wajib Diisi']);
    }

}
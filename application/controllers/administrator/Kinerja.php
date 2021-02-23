<?php

class Kinerja extends CI_Controller{

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

	public function index()
	{

        $this->is_loggedIn();
        $this->is_admin();

		$data['title'] = "data kinerja";
		$data['kinerja']	= $this->kinerja_model->tampil_data()->result();
		$this->load->view('template_administrator/header');
		$this->load->view('template_administrator/sidebar');
		$this->load->view('administrator/kinerja',$data);
		$this->load->view('template_administrator/footer');
	}

	public function input()
	{

        $this->is_loggedIn();
        $this->is_admin();

		$data = array(
            'tanggal'  => set_value('tanggal'),
			'no'  => set_value('no'),
            'waktu'  => set_value('waktu'),
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
            $lokasi         = $this->input->post('lokasi');
            $waktu          = $this->input->post('waktu');
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

    // obosolete
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

        $object->getProperties()->setCreator("kitsui");
        $object->getProperties()->setLastModifiedBy("kitsui");
        $object->getProperties()->setTitle("Data Kinerja");

        $object->setActiveSheetIndex(0);
        $object->getActiveSheet()->setCellValue('A1', 'Tanggal');
        $object->getActiveSheet()->setCellValue('B1', 'No');
        $object->getActiveSheet()->setCellValue('C1', 'Nama');
        $object->getActiveSheet()->setCellValue('D1', 'Waktu');
        $object->getActiveSheet()->setCellValue('E1', 'Bidang');
        $object->getActiveSheet()->setCellValue('F1', 'Kegiatan');
        $object->getActiveSheet()->setCellValue('G1', 'Lokasi');
	   $object->getActiveSheet()->setCellValue('H1', 'Dokumentasi');

        $baris = 2;
        $no = 1;

        foreach ($data['kinerja'] as $k) {
            $object->getActiveSheet()->setCellValue('B'.$baris, $no++);
            $object->getActiveSheet()->setCellValue('A'.$baris, $k->tanggal);
            $object->getActiveSheet()->setCellValue('C'.$baris, $k->nama);
            $object->getActiveSheet()->setCellValue('D'.$baris, $k->waktu);
            $object->getActiveSheet()->setCellValue('E'.$baris, $k->bidang);
            $object->getActiveSheet()->setCellValue('F'.$baris, $k->kegiatan);
            $object->getActiveSheet()->setCellValue('G'.$baris, $k->lokasi);
            $object->getActiveSheet()->setCellValue('H'.$baris, $k->dokumentasi);

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
        $waktu = $this->input->post('waktu');
        $nama = $this->input->post('nama');
        $bidang = $this->input->post('bidang');
        $kegiatan = $this->input->post('kegiatan');
        $lokasi = $this->input->post('lokasi');

        
        $data = array(
        'nama' => $nama,
        'waktu' => $waktu,
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
            $reqBy = $this->session->userdata['uId'];
            $data = [
                'uId'=>$uId,
                'uName'=>$uName,
                'ekin_start'=>$ekin_start,
                'ekin_end'=>$ekin_end,
                'reqBy'=>$reqBy
            ];
            $this->ESignModel->SetEKReq($data);
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

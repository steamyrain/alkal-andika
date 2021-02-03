<?php

class Kinerja extends CI_Controller{

function __construct(){
        parent::__construct();

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

	public function index()
	{
		$data['title'] = "data kinerja";
		$data['kinerja']	= $this->kinerja_model->tampil_data()->result();
		$this->load->view('template_administrator/header');
		$this->load->view('template_administrator/sidebar');
		$this->load->view('administrator/kinerja',$data);
		$this->load->view('template_administrator/footer');
	}

	public function input()
	{
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
        // rules loaded
		$this->_rules();

        // check if form not valid / return FALSE
		if($this->form_validation->run() == FALSE) {
            echo validation_errors();
			$this->input();
        }

        // form is valid
        else 
        {
            echo "form valid\n";
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
                echo "upload gagal";
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
            /*
			$dokumentasi 	= $_FILES['dokumentasi'];
            if($dokumentasi['size'] == 0) { 
                echo "file empty\n";
            } 
            elseif($dokumentasi['error'] > 0) { 
                if ($dokumentasi['error'] == 1) {
                    echo "filesize exceeds php maxlimit\n";
                }
                elseif ($dokumentasi['error'] == 2) {
                    echo "filesize exceeds html form maxlimit\n";
                }
                elseif ($dokumentasi['error'] == 3) {
                    echo "file partially uploaded\n";
                }
                elseif ($dokumentasi['error'] == 4) {
                    echo "No file uploaded\n";
                }
                elseif ($dokumentasi['error'] == 6) {
                    echo "Missing temp folder\n";
                }
                elseif ($dokumentasi['error'] == 7) {
                    echo "failed write file to disk\n";
                }
                elseif ($dokumentasi['error'] == 8) {
                    echo "upload process stopped\n";
                }
            }
            else {
                echo "file not empty and uploaded with success\n";
                echo $_FILES['dokumentasi']['name']."\n";
                $config['upload_path'] = './assets/upload/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = 2000; 
                $this->load->library('upload', $config);
                if(!$this->upload->do_upload('dokumentasi'))
                {
                    echo "Upload Gagal\n"; 
                } 
                else {
                    echo "upload berhasil\n";
                    $dokumentasi = $this->upload->data('file_name');
                    $data = array(
                        'nama'			=> $nama,
                        'bidang'		=> $bidang,
                        'kegiatan'		=> $kegiatan,
                        'dokumentasi'	=> $dokumentasi
                    );
                    $this->kinerja_model->input_data($data);
                }
 			}	
             */
            /*$this->session->set_flashdata('pesan','<div class="alert alert-warning alert-danger dismissible fade show" role="alert">
                    Data Berhasil Ditambahkan!
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     </button>
                    </div>');
             */
            //redirect('administrator/kinerja');
	
	public function _rules()
	{
		$this->form_validation->set_rules('nama','nama','required',['required' => 'Nama Wajib Diisi']);
        $this->form_validation->set_rules('waktu','waktu','required',['required' => 'Nama Wajib Diisi']);
		$this->form_validation->set_rules('bidang','bidang','required',['required' => 'Bidang Wajib Diisi']);
        $this->form_validation->set_rules('lokasi','lokasi','required',['required' => 'Lokasi Wajib Diisi']);
	}

    public function print_form(){
        $data['operator']= $this->user_model->getOperatorOnly()->result();
        $this->load->view('template_administrator/header.php');
        $this->load->view('template_administrator/sidebar.php');
        $this->load->view('administrator/operator_print_form',$data);
        $this->load->view('template_administrator/footer.php');
    }

    public function print(){
        $data['kinerja']   = $this->kinerja_model->tampil_data("kinerja")->result();
        $this->load->view('administrator/print_kinerja',$data);
    }

    public function excel(){
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

}

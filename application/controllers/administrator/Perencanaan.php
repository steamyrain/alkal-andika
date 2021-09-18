<?php
date_default_timezone_set('asia/jakarta');

class Perencanaan extends CI_Controller {

     public function __construct(){
        parent:: __construct();
         $this->load->library('cart');
        
    }

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
        $data['perencanaan'] = $this->perencanaanModel->get_data('alkal_perencanaan')->result();

        //$this->load->model('perencanaanModel');
        //data = $this->perencanaanModel->joinTgl()->result();
       //var_dump($data);
      
        $this->load->view('template_administrator/header');
        $this->load->view('template_administrator/sidebar');
        $this->load->view('administrator/perencanaan',$data);
        $this->load->view('template_administrator/footer');
        $this->load->view('template_administrator/app',$data);
    }

    public function ajax_list()
    {
        $list = $this->perencanaanModel->get_data_new($this->input->post('tanggal'))->result();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $r) {
            $no++;
            $data[] = $r;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->perencanaanModel->count_all(),
                        "recordsFiltered" => $this->perencanaanModel->count_filtered(),
                        "data" => $data,
                );
        echo json_encode($output);
    }

    public function tambah_data()
    {
        $this->is_loggedIn();
        $this->is_admin();
      

        $data['title'] = "Tambah Data Perencanaan";
        $data['operator'] = $this->perencanaanModel->getOperatorOnly()->result();
        
        $data['serial'] = $this->perencanaanModel->get_data('alkal_alat_berat')->result();
        $data['kendaraan'] = $this->perencanaanModel->getAlat()->result();
        $data['dump_truck'] = $this->perencanaanModel->get_data('alkal_category_dt')->result();
        $data['no_dt'] = $this->perencanaanModel->get_data('alkal_dump_truck')->result();
        $data['no_kdo'] = $this->perencanaanModel->get_data('alkal_kdo')->result();
        $data['kdo'] = $this->perencanaanModel->getAlatkdo()->result();

        $data['perencanaan'] = $this->perencanaanModel->get_data('alkal_perencanaan')->result();

        //$data['kendaraan'] = $this->perencanaanModel->get_data('alkal_category_alat_berat')->result();


        $this->load->view('template_administrator/header');
        $this->load->view('template_administrator/sidebar');
        $this->load->view('administrator/perencanaan_form',$data);
        $this->load->view('template_administrator/footer');
        $this->load->view('template_administrator/app',$data);
        // var_dump($data['perencanaan']);
    }

    public function insert_list(){ 
        $this->_rules();

        if($this->form_validation->run() == FALSE ){
            $this->tambah_data();
        }else{
            $tanggal                = $this->input->post('tanggal');
            $lokasi                 = $this->input->post('lokasi');
            $kendaraan              = $this->input->post('kendaraan');
            $serial                 = $this->input->post('serial');
            $operator               = $this->input->post('operator');
            $pr_bbm                 = $this->input->post('pr_bbm');
           
            //$total = count($kendaraan)
            
            //for($i=0; $i<$data; $i++){

            $data = array(

                'tanggal'           => $tanggal,
                'lokasi'            => $lokasi,
                'kendaraan'         => $kendaraan,
                'serial'            => $serial,
                'operator'          => $operator,
                'pr_bbm'            => $pr_bbm, 
               
            );

            $arr = array(
                'id'=>uniqid(),
                'name'=>uniqid(),
                'price'=>1000,
                'qty'=>1,
                'options'=>$data,
            );

            $cart = $this->cart->insert($arr);
            echo json_encode($this->lists1());

        }
    }

    public function lists(){
        $data = $this->cart->contents();
        echo json_encode($data);
    }

     public function lists1(){
        $data = $this->cart->contents();
        return $data;
    }

    function delete_list($id){
        $this->cart->update(array("rowid"=>$id,"qty"=>0));
        
    }


    function delete(){
        $this->cart->destroy();
    }


    public function tambah_data_aksi()
    {



         if ($this->cart->contents()) {
               foreach ($this->cart->contents() as $key => $value) {
                 $data = array(

                'tanggal'           => $value['options']['tanggal'],
                'lokasi'            => $value['options']['lokasi'],
                'kendaraan'         => $value['options']['kendaraan'],
                'serial'            => $value['options']['serial'],
                'operator'          => $value['options']['operator'],
                'pr_bbm'            => $value['options']['pr_bbm'],

               
            );
            $this->perencanaanModel->insert_data($data,'alkal_perencanaan');
        }
        }else{
            $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Data Berhasil ditambahkan!</strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>');
        }
            $this->cart->destroy();
            $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Data Berhasil ditambahkan!</strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>');

            redirect('administrator/perencanaan');

        }
    

    public function _rules()
        {
            $this->form_validation->set_rules('tanggal','Tanggal','required');
            $this->form_validation->set_rules('lokasi','Lokasi','required');
            $this->form_validation->set_rules('pr_bbm','Perencanaan BBM','required');
           
        }


    public function update_data($id)
        {

             $this->is_loggedIn();
            $this->is_admin();
      
            $data['title'] = "Update Data Pegawai";
            
            $data['perencanaan'] = $this->db->query("SELECT * FROM alkal_perencanaan WHERE id_pr = '$id'")->result();
            $data['operator'] = $this->perencanaanModel->getOperatorOnly()->result();
            $data['serial'] = $this->perencanaanModel->get_data('alkal_alat_berat')->result();
            $data['kendaraan'] = $this->perencanaanModel->get_data('alkal_category_alat_berat')->result();

           
            $where = array('id_pr' => $id);

        

        $this->load->view('template_administrator/header');
        $this->load->view('template_administrator/sidebar');
        $this->load->view('administrator/perencanaan_update',$data);
        $this->load->view('template_administrator/footer');
        }

        public function update_data_aksi()
        {
            $this->_rules();

            if($this->form_validation->run() == FALSE ){
                $this->update_data();
            }else{
                $id                      = $this->input->post('id_pr');
                $tanggal                = $this->input->post('tanggal');
                $lokasi                 = $this->input->post('lokasi');
                $kendaraan              = $this->input->post('kendaraan');
                $serial                 = $this->input->post('serial');
                $operator               = $this->input->post('operator');
                $pr_bbm                 = $this->input->post('pr_bbm');
                $lokasi_baru            = $this->input->post('lokasi_baru');
                $operator_baru            = $this->input->post('operator_baru');
                $pk_bbm                  = $this->input->post('pk_bbm');
                $keterangan                  = $this->input->post('keterangan');
               
                
                
                    
                $data = array(

                    
                        'tanggal'           => $tanggal,
                        'lokasi'            => $lokasi,
                        'kendaraan'         => $kendaraan,
                        'serial'            => $serial,
                        'operator'          => $operator,
                        'pr_bbm'            => $pr_bbm,
                        'lokasi_baru'           => $lokasi_baru,
                        'operator_baru'     => $operator_baru,
                        'pk_bbm'            => $pk_bbm,
                        'keterangan'        => $keterangan,

                        
                    
                    
                );

                $where = array(
                    'id_pr' => $id
                );

                $this->perencanaanModel->update_data('alkal_perencanaan',$data,$where);
                $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Data Berhasil diUpdate!</strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>');

                redirect('administrator/perencanaan');

                }
            }

            public function delete_data($id)
            {
                $where = array('id_pr' =>$id);
                $this->perencanaanModel->delete_data($where, 'alkal_perencanaan');

                $this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong>Data Berhasil dihapus!</strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>');

                 redirect('administrator/perencanaan');

            }

         public function download_excel()
        {
            $from_date = $this->input->post('tanggal');
            // $to_date = $this->input->post('to_date');
            
            $hasil = $this->perencanaanModel->get_periode($from_date);
            
            $fileName = 'Pelaksanaan Tanggal '.$from_date.'.xlsx';

            // Load plugin PHPExcel nya
            include APPPATH.'PHPExcel-1.8/Classes/PHPExcel.php';
            
            // Panggil class PHPExcel nya
            $excel = new PHPExcel();
            // Settingan awal fil excel
            $excel->getProperties()->setCreator('Laporan Pelaksanaan by Admin')
                        ->setLastModifiedBy('Laporan Pelaksanaan by Admin')
                        ->setTitle("Laporan Pelaksanaan")
                        ->setSubject("Laporan Pelaksanaan")
                        ->setDescription("Laporan Pelaksanaan")
                        ->setKeywords("Laporan Pelaksanaan");

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


            $style_col2 = array(
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
            ),
            'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        
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


            $excel->setActiveSheetIndex(0)->setCellValue('A1', "Pelaksanaan Kegiatan Pekerjaan Tanggal : ".$from_date); 
            $excel->getActiveSheet()->mergeCells('A1:J1'); // Set Merge Cell pada kolom A1 sampai E1
            $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
            $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
            $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
            // Buat header tabel nya pada baris ke 3
            $excel->setActiveSheetIndex(0)->setCellValue('A3', "No"); // Set kolom A3 dengan tulisan 
            $excel->setActiveSheetIndex(0)->setCellValue('B3', "Lokasi"); // Set kolom C3 dengan tulisan 
            $excel->setActiveSheetIndex(0)->setCellValue('C3', "Alat/Kendaraan"); // Set kolom E3 dengan tulisan 
            $excel->setActiveSheetIndex(0)->setCellValue('D3', "No Identitas");

            $excel->setActiveSheetIndex(0)->setCellValue('E3', "Operator");
            $excel->setActiveSheetIndex(0)->setCellValue('F3', "Perencanaan BBM");
            $excel->setActiveSheetIndex(0)->setCellValue('G3', "Pelaksanaan BBM");
            $excel->setActiveSheetIndex(0)->setCellValue('H3', "Lokasi Baru");
            $excel->setActiveSheetIndex(0)->setCellValue('I3', "Operator Baru");
            $excel->setActiveSheetIndex(0)->setCellValue('J3', "Keterangan");



            // Apply style header yang telah kita buat tadi ke masing-masing kolom header
            $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);

            $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
            
            $excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col2);
            $excel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col2);
            $excel->getActiveSheet()->getStyle('J3')->applyFromArray($style_col2);

            $no = 1; // Untuk penomoran tabel, di awal set dengan 1
            $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
            $total_pr_bbm = 0;
            $total_pk_bbm = 0;
            foreach($hasil as $data){ // Lakukan looping pada variabel siswa

            $excel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(0,$numrow, $no);
            $excel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(1,$numrow, $data->lokasi);
            $excel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(2,$numrow, $data->kendaraan);
            $excel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(3,$numrow, $data->serial);
            $excel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(4,$numrow, $data->operator);
            $excel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(5,$numrow, $data->pr_bbm);
            $excel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(6,$numrow, $data->pk_bbm);
            $excel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(7,$numrow, $data->lokasi_baru);
            $excel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(8,$numrow, $data->operator_baru);
            $excel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(9,$numrow, $data->keterangan);
            
            
            $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_row);
            
            $total_pr_bbm += $data->pr_bbm;
            $total_pk_bbm += $data->pk_bbm;
            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
            }
            
            $excel->getActiveSheet()->setCellValueByColumnAndRow(5, $numrow, $total_pr_bbm);
            $excel->getActiveSheet()->setCellValueByColumnAndRow(6, $numrow, $total_pk_bbm);

            // Set width kolom
            $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); 
            $excel->getActiveSheet()->getColumnDimension('B')->setWidth(25); 
            $excel->getActiveSheet()->getColumnDimension('C')->setWidth(30); 
            $excel->getActiveSheet()->getColumnDimension('D')->setWidth(30); 
            $excel->getActiveSheet()->getColumnDimension('E')->setWidth(30);

            $excel->getActiveSheet()->getColumnDimension('F')->setWidth(20); 
            $excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);

            $excel->getActiveSheet()->getColumnDimension('H')->setWidth(30); 
            $excel->getActiveSheet()->getColumnDimension('I')->setWidth(30);
            $excel->getActiveSheet()->getColumnDimension('J')->setWidth(30); 
            
            
            // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
            $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
            // Set orientasi kertas jadi LANDSCAPE
            $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
            // Set judul file excel nya
            $excel->getActiveSheet(0)->setTitle("Lap Pelaksanaan");
            $excel->setActiveSheetIndex(0);
            
            // Proses file excel
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="'.$fileName.'"'); // Set nama file excel nya
            header('Cache-Control: max-age=0');
            $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
            ob_end_clean();
            $write->save('php://output');
    
        }
        
       public function download_excel_perencanaan()
        {
            $from_date = $this->input->post('tanggal');
            // $to_date = $this->input->post('to_date');
            
            $hasil = $this->perencanaanModel->get_periode($from_date);
            
            $fileName = 'Perencanaan Tanggal '.$from_date.'-'.time().'.xlsx';

            // Load plugin PHPExcel nya
            include APPPATH.'PHPExcel-1.8/Classes/PHPExcel.php';
            
            // Panggil class PHPExcel nya
            $excel = new PHPExcel();
            // Settingan awal fil excel
            $excel->getProperties()->setCreator('Laporan Perencanaan by Admin')
                        ->setLastModifiedBy('Laporan Perencanaan by Admin')
                        ->setTitle("Laporan Perencanaan")
                        ->setSubject("Laporan Perencanaan")
                        ->setDescription("Laporan Perencanaan")
                        ->setKeywords("Laporan Perencanaan");

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


            $style_col2 = array(
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
            ),
            'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        
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


            $excel->setActiveSheetIndex(0)->setCellValue('A1', "Perencanaan Kegiatan Pekerjaan Tanggal : ".$from_date); // Set kolom A1 dengan tulisan
            $excel->getActiveSheet()->mergeCells('A1:F1'); // Set Merge Cell pada kolom A1 sampai E1
            $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
            $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
            $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
            // Buat header tabel nya pada baris ke 3
            $excel->setActiveSheetIndex(0)->setCellValue('A3', "No"); // Set kolom A3 dengan tulisan
            $excel->setActiveSheetIndex(0)->setCellValue('B3', "Lokasi"); // Set kolom C3 dengan tulisan
            $excel->setActiveSheetIndex(0)->setCellValue('C3', "Alat Kendaraan"); // Set kolom C3 dengan tulisan
            $excel->setActiveSheetIndex(0)->setCellValue('D3', "No Identitas"); // Set kolom E3 dengan tulisan
            $excel->setActiveSheetIndex(0)->setCellValue('E3', "Pengguna");
            $excel->setActiveSheetIndex(0)->setCellValue('F3', "Perencanaan BBM");

            // Apply style header yang telah kita buat tadi ke masing-masing kolom header
            $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
            


            $no = 1; // Untuk penomoran tabel, di awal set dengan 1
            $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
            $total_pr_bbm = 0;
            $harga = 9500;
            foreach($hasil as $data){ // Lakukan looping pada variabel siswa

                // $hitung_pr_bbm += $data->pr_bbm;

            $excel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(0, $numrow, $no);
            $excel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(1, $numrow, $data->lokasi);
            $excel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(2, $numrow, $data->kendaraan);
            $excel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(3, $numrow, $data->serial);
            $excel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(4, $numrow, $data->operator);
            $excel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(5, $numrow, $data->pr_bbm);
            
            
            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
            
            $total_pr_bbm += $data->pr_bbm;
            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
            }
            $excel->getActiveSheet()->setCellValueByColumnAndRow(5, $numrow, $total_pr_bbm);
            $excel->getActiveSheet()->setCellValueByColumnAndRow(7, $numrow, $harga);
            $excel->getActiveSheet()->setCellValueByColumnAndRow(8, $numrow, $harga * $total_pr_bbm);

            // Set width kolom
            $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); 
            $excel->getActiveSheet()->getColumnDimension('B')->setWidth(25); 
            $excel->getActiveSheet()->getColumnDimension('C')->setWidth(30); 
            $excel->getActiveSheet()->getColumnDimension('D')->setWidth(30); 
            $excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);

            $excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
           
        
            // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
            $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
            // Set orientasi kertas jadi LANDSCAPE
            $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
            // Set judul file excel nya
            $excel->getActiveSheet(0)->setTitle("Laporan Perencanaan");
            $excel->setActiveSheetIndex(0);
            
            // Proses file excel
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="'.$fileName.'"'); // Set nama file excel nya
            header('Cache-Control: max-age=0');
            $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
            ob_end_clean();
            $write->save('php://output');
    
        }


        public function prev_data(){
            //
            $data = $this->db->query("SELECT * FROM alkal_perencanaan WHERE tanggal < DATE_FORMAT(NOW(),'%Y-%m-%d')  GROUP BY tanggal")->result();

            $arr = array();

            foreach ($data as $key => $value) {
                array_push($arr, array(
                    "id_pr"=>$value->id_pr,
                    "tanggal"=>$value->tanggal,
                    "lokasi"=>$value->lokasi,
                    "kendaraan"=>$value->kendaraan,
                    "serial"=>$value->serial,
                    "operator"=>$value->operator,
                    "pr_bbm"=>$value->pr_bbm,
                    "lokasi_baru"=>$value->lokasi_baru,
                    "operator_baru"=>$value->operator_baru,
                    "pr_bbm"=>$value->pr_bbm,
                    "keterangan"=>$value->keterangan,
                ));
            }
            
            echo json_encode($arr);
        }

            
        public function setdata($tgl=""){
             $data = $this->db->query("SELECT * FROM alkal_perencanaan WHERE tanggal = '$tgl' ")->result();

            $arr = array();

            foreach ($data as $key => $value) {


          
           


                $arr = array(

                'id'=>uniqid(),
                'name'=>uniqid(),
                'price'=>1000,
                'qty'=>1, 

                   "options"=>array(
                    "id_pr"=>$value->id_pr,
                    "tanggal"=>date('Y-m-d'),
                    "lokasi"=>$value->lokasi,
                    "kendaraan"=>$value->kendaraan,
                    "serial"=>$value->serial,
                    "operator"=>$value->operator,
                    "pr_bbm"=>$value->pr_bbm,
                    "lokasi_baru"=>$value->lokasi_baru,
                    "operator_baru"=>$value->operator_baru,
                    "pr_bbm"=>$value->pr_bbm,
                    "keterangan"=>$value->keterangan,
                    "edited"=>true
                )
                );

                 $this->cart->insert($arr);
            }
            
             echo json_encode($this->lists1());
        }


        public function updatepr(){
            $data = json_decode(file_get_contents("php://input"));
           $this->cart->update([
            "rowid"=>$data->rowid,
             "options"=>array(
                    "id_pr"=>$data->options->id_pr,
                    "tanggal"=>date('Y-m-d'),
                    "lokasi"=>$data->options->lokasi,
                    "kendaraan"=>$data->options->kendaraan,
                    "serial"=>$data->options->serial,
                    "operator"=>$data->options->operator,
                    "pr_bbm"=>$data->options->pr_bbm,
                    "status"=>$data->options->status,
                    "lokasi_baru"=>$data->options->lokasi_baru,
                    "operator_baru"=>$data->options->operator_baru,
                    "pr_bbm"=>$data->options->pr_bbm,
                    "keterangan"=>$data->options->keterangan,
                    "edited"=>true
                    )
           ]);
           echo 1;
        }

      public function updatepx($id,$val){
        $this->db->where('id_pr',$id);
        $update = $this->db->update('alkal_perencanaan',array('pk_bbm'=>$val));
        echo 1;
      }
      
       public function updatepz(){
        $data = json_decode(file_get_contents("php://input"));
           $this->cart->update([
            "rowid"=>$data->rowid,
             "options"=>array(
                    "id_pr"=>$data->options->id_pr,
                    "tanggal"=>date('Y-m-d'),
                    "lokasi"=>$data->options->lokasi,
                    "kendaraan"=>$data->options->kendaraan,
                    "serial"=>$data->options->serial,
                    "operator"=>$data->options->operator,
                    "pr_bbm"=>$data->options->pr_bbm,
                    "status"=>$data->options->status,
                    "lokasi_baru"=>$data->options->lokasi_baru,
                    "operator_baru"=>$data->options->operator_baru,
                    "pr_bbm"=>$data->options->pr_bbm,
                    "keterangan"=>$data->options->keterangan,
                    "edited"=>true
                    )
           ]);
           echo 1;
        }

       public function updatepy(){
        $id = $this->input->post('id');
        $val = $this->input->post('keterangan');
        $this->db->where('id_pr',$id);
        $update = $this->db->update('alkal_perencanaan',array('keterangan'=>$val));
      }

      public function get_user(){
        $response = $this->perencanaanModel->getUsers($this->input->post('searchTerm'));
  
        echo json_encode($response);
     }

     public function save_batch(){
        // Ambil data yang dikirim dari form
        $tanggal = $_POST['tanggal']; 
        $lokasi = $_POST['lokasi']; 
        $kendaraan = $_POST['kendaraan']; 
        $serial = $_POST['serial']; 
        $operator = $_POST['operator']; 
        $pr_bmm = $_POST['pr_bmm'];  
        $data = array();
        
        $index = 0; 
        foreach($tanggal as $value){ 
          array_push($data, array(
            'tanggal'=>$value,
            'lokasi'=>$lokasi[$index], 
            'kendaraan'=>$kendaraan[$index], 
            'serial'=>$serial[$index], 
            'operator'=>$operator[$index], 
            'pr_bbm'=>$pr_bmm[$index], 
          ));
          
          $index++;
        }
        
        $sql = $this->db->insert_batch('alkal_perencanaan',$data);
        

        if($sql){ 
            redirect('administrator/perencanaan');
        }else{ 
          echo "<script>alert('Data gagal disimpan');window.location = '".base_url('index.php/siswa/form')."';</script>";
        }
      }

      

    // public function status()
    //         {
    //         if (!is_numeric($this->uri->segment(4)) || !is_numeric($this->uri->segment(5)))
    //         {
    //         redirect('administrator/perencanaan');
    //         }
    //         // $this->perencanaanModel->update('alkal_perencanaan', ['status' => $this->uri->segment(3)], ['id_pr' => $this->uri->segment(4)]);
    //         // redirect('administrator/perencanaan');


    //         $data['status'] = $this->uri->segment(4);
    //             $cond = array('id_pr' => $this->uri->segment(5));

    //             $this->perencanaanModel->update('alkal_perencanaan', $data, $cond);
    //             redirect('administrator/perencanaan');
    //         }
    
    
    
     public function status($status,$id)
            {
            // if (!is_numeric($this->uri->segment(4)) || !is_numeric($this->uri->segment(5)))
            // {
            // redirect('administrator/perencanaan');
            // }
            // $this->perencanaanModel->update('alkal_perencanaan', ['status' => $this->uri->segment(3)], ['id_pr' => $this->uri->segment(4)]);
            // redirect('administrator/perencanaan');


                $data = array('status'=>$status);
                $cond = array('id_pr' => $id);

                $update =  $this->perencanaanModel->update('alkal_perencanaan', $data, $cond);
                
                if ($update) {
                    echo 1;
                }else{
                    echo 0;
                }

                // redirect('administrator/perencanaan');
            }



       public function printpdf()
        {
            $tanggal    = $this->input->post('tanggal');
            $this->load->library('pdfgenerator');
            $data['laphar'] = $this->perencanaanModel->getdatacetak($tanggal);
            $file_pdf = ('Perencanaan '.$tanggal);
            $paper = 'A4';
            $orientation = "portait";
            $html = $this->load->view('administrator/printlaporanperencanaan',$data, true);        
            $this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
        }

         public function printpdf_pelaksanaan()
        {
            $tanggal    = $this->input->post('tanggal');
            $this->load->library('pdfgenerator');
            $data['laphar'] = $this->perencanaanModel->getdatacetak($tanggal);
            $file_pdf = ('Pelaksanaan '.$tanggal);
            $paper = 'A4';
            $orientation = "landscape";
            $html = $this->load->view('administrator/printlaporanpelaksanaan',$data, true);        
            $this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
        }

}

?>



   

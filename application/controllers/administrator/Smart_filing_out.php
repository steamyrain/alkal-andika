<?php


class Smart_filing_out extends CI_Controller {

      function __construct(){
        parent:: __construct();
        $this->load->model('smart_filing_model');
         $this->load->library('upload');
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
        $data['smartfiling'] = $this->smart_filing_model->get_data_out()->result();

     
      
        $this->load->view('template_administrator/header');
        $this->load->view('template_administrator/sidebar');
       // $this->load->view('administrator/smart_filing',$data);
        $this->load->view('administrator/smart_filing_out',$data);
        $this->load->view('template_administrator/footer');
    }

     public function tambah_data()
    {
        $this->is_loggedIn();
        $this->is_admin();
      

        $data['title'] = "Tambah Data Surat Keluar ";
        $data = $this->mekanik_model->ambil_data($this->session->userdata['username']);
        $data = array(
             'username'  => $data->username,
             'level'    => $data->level,
           );

        $data = array(

            'id'            => set_value('id'),
            'dikirim_kpd'   => set_value('dikirim_kpd'),
            'no_surat'      => set_value('no_surat'),
            'tgl_surat'     => set_value('tgl_surat'),
            'perihal'       => set_value('perihal'),
            'tgl_kirim'     => set_value('tgl_kirim'),
            'file_surat'    => set_value('file_surat'),
            'td_terima'     => set_value('td_terima'),
            'tgl'           => set_value('tgl'),
            'kepada'        => set_value('kepada'),
            'file'          => set_value('file'),


        );

        $this->load->view('template_administrator/header');
        $this->load->view('template_administrator/sidebar');
        $this->load->view('administrator/smart_filing_out_form',$data);
        $this->load->view('template_administrator/footer');
    }

    public function tambah_data_aksi(){
        // $this->_rules();
        // if($this->form_validation->run() == FALSE){
            // $this->tambah_data();

        // }else{

               

               
              

                    $config['upload_path']          = './assets/uploads/';
                    $config['allowed_types']        = 'gif|jpg|png|pdf'; 
                    $config['encrypt_name']         = TRUE;
                    $this->upload->initialize($config);

                    if($this->upload->do_upload('file_surat')){
                        $upload = $this->upload->data();

                        $dikirim_kpd   = $this->input->post('dikirim_kpd');
                        $no_surat      = $this->input->post('no_surat');
                        $tgl_surat     = $this->input->post('tgl_surat');
                        $perihal       = $this->input->post('perihal');
                        $tgl_kirim     = $this->input->post('tgl_kirim');
                        $td_terima     = $this->input->post('td_terima');
                    
                        $tgl        = $this->input->post('tgl');
                        $kepada     = $this->input->post('kepada');
                        $file       = $this->input->post('file');
                        // $penginput  = $this->input->post('penginput');



                        $data = array(

                            'dikirim_kpd'      => $dikirim_kpd,
                            'no_surat'         => $no_surat,
                            'tgl_surat'        => $tgl_surat,
                            'perihal'          => $perihal,
                            'tgl_kirim'        => $tgl_kirim,
                            'file_surat'       => $upload['file_name'],
                            'td_terima'        => $td_terima,
                            // 'tgl'           => $tgl,
                            // 'kepada'        => $kepada,
                            // 'file'          => $file,
                            // 'penginput'     => $penginput,


                         );
                        // echo "<pre>";
                        // print_r($data);
                        $insert =  $this->smart_filing_model->input_data_out($data);

                        if($insert){
                            
                            $this->session->set_flashdata('success','Data berhasil di simpan');
                            redirect('administrator/smart_filing_out');
                        }else{
                            
                              $this->session->set_flashdata('error','Data gagal di simpan');
                            redirect('administrator/smart_filing_out');
                        }
                    }else{
                        $error = $this->upload->display_errors();
                        
                         $this->session->set_flashdata('error','Error: '.$error);
                         redirect('administrator/smart_filing_out');
                    }
                    


    }

     public function edit($id)
    {
        $this->is_loggedIn();
        $this->is_admin();
      

        $data['title'] = "Edit Data Surat Masuk ";
        $data = $this->mekanik_model->ambil_data($this->session->userdata['username']);
        $data = array(
             'username'  => $data->username,
             'level'    => $data->level,
           );

        $data = array(

            'id'            => set_value('id'),
            'dikirim_kpd'   => set_value('dikirim_kpd'),
            'no_surat'      => set_value('no_surat'),
            'tgl_surat'     => set_value('tgl_surat'),
            'perihal'       => set_value('perihal'),
            'tgl_kirim'     => set_value('tgl_kirim'),
            'file_surat'    => set_value('file_surat'),
            'td_terima'     => set_value('td_terima'),
            'tgl'           => set_value('tgl'),
            'kepada'        => set_value('kepada'),
            'file'          => set_value('file'),
            // 'penginput'     => set_value('penginput'),

        );

        $data['smartfiling'] = $this->db->get_where('smart_filing_out',array(
            "id"=>$id
        ))->row();


        $this->load->view('template_administrator/header');
        $this->load->view('template_administrator/sidebar');
        $this->load->view('administrator/smart_filing_out_edit',$data);
        $this->load->view('template_administrator/footer');
    }


function update_data_edit()
{           
            $upload1 = false;
            $upload2 = false;
            $error1=false;
            $error2=false;

            $upload_data1=array();
            $upload_data2=array();

            $file1="";
            $file2="";

            $config['upload_path']          = './assets/uploads/';
            $config['allowed_types']        = 'gif|jpg|png|pdf'; 
            $config['encrypt_name']         = TRUE;
            $this->upload->initialize($config);

           if(!empty($_FILES['file_surat']['name'])){
             if($this->upload->do_upload('file_surat')){
                $upload_data1 = $this->upload->data();
                $upload1 = true;
                $file1 = $upload_data1['file_name'];
            }else{
                $error1=true;
                 $this->session->set_flashdata('error','Upload file error');
                redirect('administrator/smart_filing_out');

            }
        }else{
             $upload1 = false;
        }

        if(!empty($_FILES['file_disposisi']['name'])){
            $config1['upload_path']          = './assets/uploads/';
            $config1['allowed_types']        = 'gif|jpg|png|pdf'; 
            $config1['encrypt_name']         = TRUE;
            $this->upload->initialize($config1);

            if($this->upload->do_upload('file_disposisi')){
                $upload_data2 = $this->upload->data();
                $upload2 = true;
                $file2 = $upload_data2['file_name'];
            }else{
                $error2=true;
                $this->session->set_flashdata('error','Upload file disposisi error');
                redirect('administrator/smart_filing_out');

            }
        }else{
             $upload2 = false;
        }

                        $dikirim_kpd   = $this->input->post('dikirim_kpd');
                        $no_surat      = $this->input->post('no_surat');
                        $tgl_surat     = $this->input->post('tgl_surat');
                        $perihal       = $this->input->post('perihal');
                        $tgl_kirim     = $this->input->post('tgl_kirim');
                        $td_terima     = $this->input->post('td_terima');
                    
                        $tgl           = $this->input->post('tgl');
                        $kepada        = $this->input->post('kepada');
                        // $file       = $this->input->post('file');
                        // $penginput     = $this->input->post('penginput');

                        $arr = array();
                        if($upload1==true && $upload2 ==false){
                            $arr = array(

                                'dikirim_kpd'      => $dikirim_kpd,
                                'no_surat'         => $no_surat,
                                'tgl_surat'        => $tgl_surat,
                                'perihal'          => $perihal,
                                'tgl_kirim'        => $tgl_kirim,
                                'td_terima'        => $td_terima,
                                'file_surat'       => $file1,
                                'tgl'              => $tgl,
                                'kepada'           => $kepada,
                                // 'file'          => $file2,
                                // 'penginput'        => $penginput, 



                            );
                             $this->db->where('id',$_POST['id']);
                        $insert =  $this->db->update('smart_filing_out',$arr);

                        if($insert){
                            
                            $this->session->set_flashdata('success','Data berhasil di update');
                            redirect('administrator/smart_filing_out');
                        }else{
                            
                              $this->session->set_flashdata('error','Data gagal di update');
                            redirect('administrator/smart_filing_out');
                        }

                        }if($upload2==true && $upload1 ==false){
                            $arr = array(


                                'dikirim_kpd'      => $dikirim_kpd,
                                'no_surat'         => $no_surat,
                                'tgl_surat'        => $tgl_surat,
                                'perihal'          => $perihal,
                                'tgl_kirim'        => $tgl_kirim,
                                'td_terima'        => $td_terima,
                                // 'file_surat'       => $file1,
                                'tgl'              => $tgl,
                                'kepada'           => $kepada,
                                'file'             => $file2,
                                // 'penginput'        => $penginput, 



                            );
                              $this->db->where('id',$_POST['id']);
                        $insert =  $this->db->update('smart_filing_out',$arr);

                        if($insert){
                            
                            $this->session->set_flashdata('success','Data berhasil di update');
                            redirect('administrator/smart_filing_out');
                        }else{
                            
                              $this->session->set_flashdata('error','Data gagal di update');
                            redirect('administrator/smart_filing_out');
                        }

                        }else if($upload2==true && $upload1 ==true){
                            $arr = array(

                               'dikirim_kpd'      => $dikirim_kpd,
                                'no_surat'         => $no_surat,
                                'tgl_surat'        => $tgl_surat,
                                'perihal'          => $perihal,
                                'tgl_kirim'        => $tgl_kirim,
                                'td_terima'        => $td_terima,
                                'file_surat'       => $file1,
                                'tgl'              => $tgl,
                                'kepada'           => $kepada,
                                'file'             => $file2,
                                // 'penginput'        => $penginput, 

                            );
                              $this->db->where('id',$_POST['id']);
                        $insert =  $this->db->update('smart_filing_out',$arr);

                        if($insert){
                            
                            $this->session->set_flashdata('success','Data berhasil di update');
                            redirect('administrator/smart_filing_out');
                        }else{
                            
                              $this->session->set_flashdata('error','Data gagal di update');
                            redirect('administrator/smart_filing_out');
                        }

                        }else{
                            $arr = array(

                                'dikirim_kpd'      => $dikirim_kpd,
                                'no_surat'         => $no_surat,
                                'tgl_surat'        => $tgl_surat,
                                'perihal'          => $perihal,
                                'tgl_kirim'        => $tgl_kirim,
                                'td_terima'        => $td_terima,
                                // 'file_surat'       => $file1,
                                'tgl'              => $tgl,
                                'kepada'           => $kepada,
                                // 'file'             => $file2,
                            );
                              $this->db->where('id',$_POST['id']);
                        $insert =  $this->db->update('smart_filing_out',$arr);

                        if($insert){
                            
                            $this->session->set_flashdata('success','Data berhasil di update');
                            redirect('administrator/smart_filing_out');
                        }else{
                            
                              $this->session->set_flashdata('error','Data gagal di update');
                            redirect('administrator/smart_filing_out');
                        }

                        }  
                      
                       

    }     


     function delete($id){
        $this->db->where('id',$id);
        $delete = $this->db->delete('smart_filing_out');
           if($delete){
                
                $this->session->set_flashdata('success','Data berhasil di hapus');
                redirect('administrator/smart_filing_out');
            }else{
                
                  $this->session->set_flashdata('error','Data gagal di hapus');
                redirect('administrator/smart_filing_out');
            }
    }         








}

    ?>

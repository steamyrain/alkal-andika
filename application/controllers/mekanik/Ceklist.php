<?php

class Ceklist extends CI_Controller{

  private function is_loggedIn() {
    if (!isset($this->session->userdata['username'])){
      $this->session->set_flashdata('pesan','<div class="alert alert-warning alert-danger dismissible fade show" role="alert">
        Anda Belum Login!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>');
      redirect('auth');
    }
  }

  private function is_mekanik() {
    if($this->session->userdata['level'] !== 'mekanik'){
      $this->session->set_flashdata('pesan','<div class="alert alert-warning alert-danger dismissible fade show" role="alert">
        Anda tidak terdaftar sebagai user!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>');
      redirect('auth');
    }
  }

  public function index()
  {
    $this->is_loggedIn();
    $this->is_mekanik();
    $data['title'] = "Ceklist";
    $data = $this->mekanik_model->ambil_data($this->session->userdata
     ['username']);
    $data = array(
     'username'  => $data->username,
     'level'    => $data->level,
   );


    $data['kendaraan'] = $this->ceklist_model->getAlat()->result();
    $data['serial'] = $this->ceklist_model->get_data()->result();
    $this->load->view('template_mekanik/header');
    $this->load->view('template_mekanik/sidebar');
    $this->load->view('mekanik/ceklist',$data);
    $this->load->view('template_mekanik/footer');
  }

  public function getlistceklis()
  {
    $serial = $this->input->post('kode');
    $data = $this->ceklist_model->getdataceklist($serial);

    header('Content-Type: application/json');
    echo json_encode($data);
  }

    public function test()
  {
    $serial = 1265;
    $data = $this->ceklist_model->getdataceklist($serial);

    header('Content-Type: application/json');
    echo json_encode($data);
  }



   public function getlistceklis1()
  {
    $serial = 1265;

    $kategori = $this->db->get('alkal_ceklist_category')->result();

    $arr = [];
    foreach ($kategori as $key => $value) {
      $item = $this->db->select('a.*')
                       ->from('alkal_ceklist_item a')
                       ->where('a.id_category',$value->id_category)
                       ->get()
                       ->result();
      $arr[] = [$value,$item];

    }

    echo '<pre>';
    print_r($arr);

    // header('Content-Type: application/json');
    // echo json_encode($data);
  }



  public function add_detail() {

      $data        = $this->input->post('data');
      // var_dump($data);

      for ($i = 0; $i < count($data) ; $i++) {
        
        echo $data[$i][1]; //tgl
        echo $data[$i][0]; //nama mek
        echo $data[$i][2]; //kendaraan
        echo $data[$i][3]; //serial
        echo $data[$i][4]; //kategori
        echo $data[$i][5]; //item
        echo $data[$i][6]; //kondisi
        echo $data[$i][7]; //keterangan
        
        $this->ceklist_model->simpandata($data[$i][1],$data[$i][0],$data[$i][2],$data[$i][3],$data[$i][4],$data[$i][5],$data[$i][6],$data[$i][7]);
        //tabel kolom  tgl,namamek,kenda,serial,kate,item,stateu,ket

        
      }
      // $tanggal        = $this->input->post('tanggal');
      // $nama_mekanik   = $this->input->post('nama_mekanik');
      // $kendaraan      = $this->input->post('kendaraan');
      // $serial         = $this->input->post('serial');
      // $nama_category  = $this->input->post('nama_category');
      // $nama_item      = $this->input->post('nama_item');
      // $kondisi        = $this->input->post('kondisi');

        echo json_encode(array(
          "statusCode"=>200
        ));  
      
        
  }


/**
    public function tambah_data_aksi()
    {


            $this->ceklist_model->insert_data($data,'alkal_ceklist');
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

            redirect('mekanik/ceklist');

        }

        **/



















      }


      ?>
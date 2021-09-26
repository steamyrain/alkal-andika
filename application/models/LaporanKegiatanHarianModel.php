<?php 
  class LaporanKegiatanHarianModel extends CI_Model {
    private $table='alkal_kegiatan_harian';
    private $tk_table='alkal_kegiatan_harian_tk';
    private $ab_table='alkal_kegiatan_harian_ab';
    public function getLaporanKegiatanHarian($kegiatanid) {
      if(isset($kegiatanid)){
        $this->db->select('KegiatanId,TanggalWaktuAwal,TanggalWaktuAkhir,Uraian,Lokasi,Keterangan');
        $this->db->from($this->table);
        $this->db->where('KegiatanId',$kegiatanid);
      } else {
        $this->db->select('KegiatanId,TanggalWaktuAwal,TanggalWaktuAkhir,Uraian,Lokasi,Keterangan');
        $this->db->from($this->table);
      }
      return $this->db->get();
    }
    public function setLaporanKegiatanHarian($kegiatanharian,$tk,$ab){
      $this->db->trans_start();
      $this->db->insert($this->table,$kegiatanharian);
      $KegiatanId = $this->db->query('SELECT KegiatanId from alkal_kegiatan_harian ORDER BY KegiatanId DESC LIMIT 1')->result()[0]->KegiatanId;
      if(isset($tk) && !empty($tk)){
        $tk = array_map(fn($value) => (isset($value)&&!empty($value))?array('KegiatanId'=>$KegiatanId, 'JobId'=>$value['JobId'], 'JobName'=>$value['JobName'], 'Jumlah'=>$value['Jumlah']):null,$tk);
      }
      if(isset($ab) && !empty($ab)){
        $ab = array_map(fn($value) => (isset($value)&&!empty($value))?array('KegiatanId'=>$KegiatanId, 'ABId'=>$value['ABId'], 'JenisAB'=>$value['JenisAB'], 'Jumlah'=>$value['Jumlah']):null,$ab);
      }
      foreach($tk as $data){
        if(isset($data)){
          $this->db->insert($this->tk_table,$data);
        }
      }
      foreach($ab as $data){
        if(isset($data)){
          $this->db->insert($this->ab_table,$data);
        }
      }
      $this->db->trans_complete();      
      return $this->db->trans_status();
    }
    public function getLKTK($KegiatanId){
      $this->db->select('JobName, Jumlah');
      $this->db->from($this->tk_table);
      $this->db->where('KegiatanId',$KegiatanId);
      return $this->db->get();
    }
    public function getLKAB($KegiatanId){
      $this->db->select('JenisAB, Jumlah');
      $this->db->from($this->ab_table);
      $this->db->where('KegiatanId',$KegiatanId);
      return $this->db->get();
    }
  }
?>

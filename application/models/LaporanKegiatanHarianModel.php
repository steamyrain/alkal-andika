<?php 
  class LaporanKegiatanHarianModel extends CI_Model {
    private $table='alkal_kegiatan_harian';
    private $tk_table='alkal_kegiatan_harian_tk';
    private $ab_table='alkal_kegiatan_harian_ab';
    private $dt_table='alkal_kegiatan_harian_dt';
    private $dokumentasi_table='alkal_kegiatan_harian_dokumentasi';
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
    public function setLaporanKegiatanHarian($kegiatanharian,$tk,$ab,$dt){
      $this->db->trans_start();
      $this->db->insert($this->table,$kegiatanharian);
      $KegiatanId = $this->db->query('SELECT KegiatanId from alkal_kegiatan_harian ORDER BY KegiatanId DESC LIMIT 1')->result()[0]->KegiatanId;
      if(isset($tk) && !empty($tk)){
        $tk = array_map(fn($value) => (isset($value)&&!empty($value))?array('KegiatanId'=>$KegiatanId, 'JobId'=>$value['JobId'], 'JobName'=>$value['JobName'], 'Jumlah'=>$value['Jumlah']):null,$tk);
      }
      if(isset($ab) && !empty($ab)){
        $ab = array_map(fn($value) => (isset($value)&&!empty($value))?array('KegiatanId'=>$KegiatanId, 'ABId'=>$value['ABId'], 'JenisAB'=>$value['JenisAB'], 'Jumlah'=>$value['Jumlah']):null,$ab);
      }
      if(isset($dt) && !empty($dt)){
        $dt = array_map(fn($value) => (isset($value)&&!empty($value))?array('KegiatanId'=>$KegiatanId, 'DTId'=>$value['DTId'], 'JenisDT'=>$value['JenisDT'], 'Jumlah'=>$value['Jumlah']):null,$dt);
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
      foreach($dt as $data){
        if(isset($data)){
          $this->db->insert($this->dt_table,$data);
        }
      }
      $this->db->trans_complete();
      if($this->db->trans_status() === FALSE){
        return null;
      } else {
        return $KegiatanId;
      }
    }
    public function getLKTK($KegiatanId){
      $this->db->select('KegiatanId,JobId,JobName,Jumlah');
      $this->db->from($this->tk_table);
      $this->db->where('KegiatanId',$KegiatanId);
      return $this->db->get();
    }
    public function getLKAB($KegiatanId){
      $this->db->select('KegiatanId,ABId,JenisAB,Jumlah');
      $this->db->from($this->ab_table);
      $this->db->where('KegiatanId',$KegiatanId);
      return $this->db->get();
    }
    public function getLKDK($KegiatanId){
      $this->db->select('KegiatanId,DokumentasiId,FileName,JenisDokumentasi');
      $this->db->from($this->dokumentasi_table);
      $this->db->where('KegiatanId',$KegiatanId);
      return $this->db->get();
    }
    public function getLKDT($KegiatanId){
      $this->db->select('KegiatanId,DTId,JenisDT,Jumlah');
      $this->db->from($this->dt_table);
      $this->db->where('KegiatanId',$KegiatanId);
      return $this->db->get();
    }
    public function deleteLKHarian($kegiatanId){
      $this->db->trans_start();
      $this->db->delete($this->table,array('KegiatanId'=>$kegiatanId));
      $this->db->delete($this->tk_table,array('KegiatanId'=>$kegiatanId));
      $this->db->delete($this->ab_table,array('KegiatanId'=>$kegiatanId));
      $this->db->delete($this->dokumentasi_table,array('KegiatanId'=>$kegiatanId));
      $this->db->trans_complete();
      return $this->db->trans_status();
    }
    public function setDokumentasi($data){
      $this->db->insert_batch($this->dokumentasi_table,$data);
    }
  }
?>

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
      $this->db->insert($table,$kegiatanharian);
      $KegiatanId = $this->db->query('SELECT LAST(KegiatanId) from alkal_kegiatan_harian LIMIT 1');
    }
  }
?>

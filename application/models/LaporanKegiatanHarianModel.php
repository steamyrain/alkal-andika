<?php 
  class LaporanKegiatanHarianModel extends CI_Model {
    private $table='alkal_kegiatan_harian';
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
  }
?>

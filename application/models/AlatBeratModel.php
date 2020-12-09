<?php 

class AlatBeratModel extends CI_Model {
    private $table='alkal_alat_berat';
    public function tampilAlatDanMerek() {
        $this->db->select(
            $this->table.'.id,'.
            $this->table.'.serial_number,'.
            $this->table.'.plate_number,'.
            'alkal_category_alat_berat.category,'.
            $this->table.'.sub_category,'.
            'alkal_brand.brand,'.
            $this->table.'.type,'.
            $this->table.'.active'
        );
        $this->db->from($this->table);
        $this->db->join(
            'alkal_brand',
            'alkal_brand.id='
            .$this->table.'.brandId'
        );
        $this->db->join(
            'alkal_category_alat_berat',
            'alkal_category_alat_berat.id='
            .$this->table.'.catId'
        );
        return $this->db->get();
    }
    public function getPlateAndSerial() {
        $this->db->select(
            'plate_number,serial_number'
        );
        $this->db->from($this->table);
        $this->db->where("plate_number<>'NULL' or serial_number<>'NULL'");
        return $this->db->get();
    }
    public function getAlatBeratSpecific($id) {
        $this->db->get_where($this->table,array('id'=>$id));
    }
    public function setAlatBerat($data) {
        $this->db->insert($this->table,$data);
    }
    public function deleteAlatBerat($vId){
        $this->db->delete($this->table,array('id'=>$vId));
    }
}

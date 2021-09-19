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
    public function getPlateSerialType() {
        $this->db->select(
            'plate_number,serial_number,type'
        );
        $this->db->from($this->table);
        //$this->db->where("plate_number<>'NULL' or serial_number<>'NULL'");
        return $this->db->get();
    }
    public function getAlatBeratSpecific($id) {
        return $this->db->get_where($this->table,array('id'=>$id));
    }
    public function updateAlatBerat($data,$id) {
        $this->db->update($this->table,$data,'id='.$id);
    }
    public function setAlatBerat($data) {
        $this->db->insert($this->table,$data);
    }
    public function deleteAlatBerat($vId){
        $this->db->delete($this->table,array('id'=>$vId));
    }

    public function getVINCategoryAndType() {
        $this->db->select('alkal_alat_berat.id as id,plate_number,serial_number,category,sub_category,type');
        $this->db->from($this->table);
        $this->db->join('alkal_category_alat_berat','alkal_category_alat_berat.id = '.$this->table.'.catId');
        $this->db->order_by('catId','asc');
        $this->db->order_by('sub_category','asc');
        return $this->db->get();
    }

    public function getAB(...$cols){
        $col_query = join(",",$cols);
        $this->db->select($col_query);
        $this->db->from($this->table);
        $this->db->join('alkal_category_alat_berat','alkal_category_alat_berat.id = alkal_alat_berat.catId');
        $this->db->order_by($this->table.'.catId');
        return $this->db->get();
    }

    public function getABBrandCategory() {
        $this->db->select($this->table.'.*,'.'alkal_brand.brand, alkal_category_alat_berat.category');
        $this->db->from($this->table);
        $this->db->join('alkal_brand','alkal_brand.id='.$this->table.'.brandId');
        $this->db->join('alkal_category_alat_berat','alkal_category_alat_berat.id='.$this->table.'.catId');
        return $this->db->get();
    }

    public function getJenisAB(){
      $this->db->distinct();
      $this->db->select('b.id as id, b.category as category, a.sub_category as sub_category');
      $this->db->from('alkal_alat_berat a');
      $this->db->join('alkal_category_alat_berat b','b.id = a.catId');
      return $this->db->get();
    }
}

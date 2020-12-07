<?php

class DumpTruckModel extends CI_Model {

    private $table="alkal_dump_truck";

    public function tampilTrukDanMerek() {
        $this->db->select($this->table.'.*,'.'alkal_brand.brand');
        $this->db->from($this->table);
        $this->db->join('alkal_brand','alkal_brand.id='.$this->table.'.brandId');
        return $this->db->get();
    }
    public function insertDT($data){
        $this->db->insert($this->table,$data);
    }
    public function getDTBrandCategory() {
        $this->db->select($this->table.'.*,'.'alkal_brand.brand, alkal_category_dt.category');
        $this->db->from($this->table);
        $this->db->join('alkal_brand','alkal_brand.id='.$this->table.'.brandId');
        $this->db->join('alkal_category_dt','alkal_category_dt.id='.$this->table.'.catId');
        return $this->db->get();
    }
    public function deleteDT($plate_number){
        $this->db->delete($this->table,$plate_number);
    }
}

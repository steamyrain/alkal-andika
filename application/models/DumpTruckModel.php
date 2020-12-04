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
}

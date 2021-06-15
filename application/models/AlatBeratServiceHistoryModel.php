<?php

class AlatBeratServiceHistoryModel extends CI_Model {

    public function getServiceHistories($ab_id,$service_id){
        $this->db->select('a.ab_id ab_id, a.service_id service_id, a.subservice_id subservice_id, b.plate_number plate_number, b.serial_number serial_number, a.service_date service_date,c.service_name service_name, d.subservice_name subservice_name,a.unit_total unit_total,a.unit_price unit_price,d.unit unit_unit,a.service_desc service_desc,a.id ab_service_history_id');
        $this->db->from('alkal_service_history_ab a');
        $this->db->join('alkal_alat_berat b','b.id = a.ab_id');
        $this->db->join('alkal_service_list_ab c','c.id = a.service_id');
        $this->db->join('alkal_service_sublist_ab d','d.id = a.subservice_id');
        $this->db->where('a.ab_id = '.$ab_id);
        $this->db->where('a.service_id = '.$service_id);
        return $this->db->get();
    }

    public function getServiceList($ab_id){
        if(!isset($ab_id) && empty($ab_id)) return null;
        $this->db->select('a.id service_id,a.service_name service_name,b.id subservice_id, b.subservice_name subservice_name,b.unit unit_unit');
        $this->db->from('alkal_service_list_ab a');
        $this->db->join('alkal_service_sublist_ab b','b.service_id = a.id');
        $this->db->join('alkal_service_ab_lookup c','c.service_id = a.id');
        $this->db->join('alkal_alat_berat d','d.catId = c.category_service_id');
        $this->db->where('d.id = '.$ab_id);
        return $this->db->get();
    }

    public function setABServiceHistory($data){
        $validData = [];
        foreach($data as $dat){
            if(!empty($dat)){
                array_push($validData,$dat);
            }
        }
        if(count($validData)>0){
            $this->db->insert_batch('alkal_service_history_ab',$validData);
        }
    }

    public function getABServiceHistoryRekap($data){
        $this->db->select('a.plate_number plate_number,a.serial_number serial_number,d.service_name service_name,c.service_date service_date,e.subservice_name service_unit,c.unit_total as unit_total,e.unit as unit_unit');
        $this->db->from('alkal_alat_berat a');
        $this->db->join('alkal_service_ab_lookup b','b.category_service_id = a.catId');
        $this->db->join('alkal_service_history_ab c','c.service_id = b.service_id and c.ab_id = a.id','left'); 
        $this->db->join('alkal_service_list_ab d','d.id = b.service_id'); 
        $this->db->join('alkal_service_sublist_ab e','e.id = c.subservice_id'); 
        $this->db->where('a.id = '.$data['ab_id']);
        $this->db->where("year(c.service_date) between '".$data['rekap_start']."' and '".$data['rekap_end']."'");
        $this->db->order_by("d.service_name,c.service_date desc");
        return $this->db->get();
    }

    public function getABServiceListSel($id){
        if (isset($id)){
            $this->db->select('alkal_alat_berat.id as ab_id, alkal_service_list_ab.id as service_id, alkal_service_list_ab.service_name as service_name');
            $this->db->from('alkal_alat_berat');
            $this->db->join('alkal_service_ab_lookup','alkal_service_ab_lookup.category_service_id = alkal_alat_berat.catId');
            $this->db->join('alkal_service_list_ab','alkal_service_list_ab.id = alkal_service_ab_lookup.service_id');
            $this->db->where('alkal_alat_berat.id = '.$id);
            return $this->db->get();
        }
    }

    public function deleteABServiceHistory($sh_id){
        $this->db->delete('alkal_service_history_ab',array('id'=>$sh_id));
    }

    public function updateABServiceHistory($data){
        $this->db->replace('alkal_service_history_ab',$data);
    }
}

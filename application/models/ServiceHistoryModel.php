<?php
class ServiceHistoryModel extends CI_Model {

    public function getDTServiceHistories($nopol=true){
        if($nopol){
            $this->db->select('b.plate_number as plate_number,a.dt_id as dt_id,a.service_id as service_id,a.serviced_by as serviced_by,c.service_name as service_name,a.service_date as service_date');
            $this->db->from('alkal_service_history_dt a');
            $this->db->join('alkal_dump_truck b','b.id = a.dt_id');
            $this->db->join('alkal_service_list_dt c','a.service_id = c.id');
            return $this->db->get();
        }
        else {
            return $this->db->get('alkal_service_history_dt');
        }
    }

    public function getDTServiceList($id){
        if (isset($id)){
            $this->db->select('a.id as id, a.service_name as service_name, b.id as subservice_id, b.subservice_name as subservice_name');
            $this->db->from('alkal_service_list_dt a');
            $this->db->join('alkal_service_sublist_dt b','b.service_id = a.id');
            $this->db->join('alkal_service_dt_lookup c','c.service_id = a.id');
            $this->db->join('alkal_category_dt_service_lookup d','d.category_service_id = c.category_service_id');
            $this->db->join('alkal_dump_truck e','e.catId = d.category_id');
            $this->db->where('e.id = '.$id);
            return $this->db->get();
        } else {
            $this->db->select('a.id as id, a.service_name as service_name');
            $this->db->from('alkal_service_list_dt a');
            return $this->db->get();
        }
    }

    public function setDTServiceHistory($data) {
        $this->db->insert('alkal_service_history_dt',$data);
    }
}

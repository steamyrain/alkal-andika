<?php

class Ceklist_model extends CI_Model{

    public function ambil_data($id)
    {
        $this->db->where('username', $id);
        return $this->db->get('user')->row();
    }

  // public function get_datadt($table){
  //     return $this->db->get($table);
  // }

  //  public function get_data_serial(){
  //    $get = $this->db->query("SELECT * FROM alkal_alat_berat WHERE catId = '1','2' ")

  //     return $get;
  // }

// Get Data Alat Berat
// public function get_data() {
//     $this->db->select('alkal_alat_berat.id as id,plate_number,serial_number,category,sub_category,type');
//     $this->db->from("alkal_alat_berat");
//     $this->db->join('alkal_category_alat_berat','alkal_category_alat_berat.id = .alkal_alat_berat.catId');
//     $this->db->order_by('serial_number','asc');
//     $this->db->where('catId <= 2');
//     return $this->db->get();
// }

//  public function getAlat() {
//     $this->db->select('alkal_alat_berat.id as id,plate_number,serial_number,category,sub_category,type');
//     $this->db->from("alkal_alat_berat");
//     $this->db->join('alkal_category_alat_berat','alkal_category_alat_berat.id = .alkal_alat_berat.catId');
//     $this->db->group_by('category','asc');
//     $this->db->group_by('type','asc');
//     $this->db->where('catId <= 2');
//     return $this->db->get();
// }

public function get_data() {
    $this->db->select('alkal_ceklist_kendaraan.id as id,plate_number,serial_number,category,sub_category,type');
    $this->db->from("alkal_ceklist_kendaraan");
    $this->db->join('alkal_ceklist_kd_category','alkal_ceklist_kd_category.id = .alkal_ceklist_kendaraan.catId');
    $this->db->order_by('serial_number','asc');
    // $this->db->where('catId <= 2');
    return $this->db->get();
}

 public function getAlat() {
    $this->db->select('alkal_ceklist_kendaraan.id as id,plate_number,serial_number,category,sub_category,type');
    $this->db->from("alkal_ceklist_kendaraan");
    $this->db->join('alkal_ceklist_kd_category','alkal_ceklist_kd_category.id = alkal_ceklist_kendaraan.catId');
    $this->db->group_by('category','asc');
    $this->db->group_by('type','asc');
    // $this->db->where('catId <= 2');
    return $this->db->get();
}


//Get Data Dumptruck
public function get_data_dt() {
    $this->db->select('alkal_dump_truck.id as id,plate_number');
    $this->db->from("alkal_dump_truck");
    $this->db->join('alkal_category_dt','alkal_category_dt.id = .alkal_dump_truck.catId');
    $this->db->order_by('plate_number','asc');  
    return $this->db->get();
}

public function get_alat_dt() {
    $this->db->select('alkal_dump_truck.id as id,,category,plate_number');
    $this->db->from("alkal_dump_truck");
    $this->db->join('alkal_category_dt','alkal_category_dt.id = .alkal_dump_truck.catId');
    $this->db->group_by('category','asc');  
    return $this->db->get();
}

 
// public function getdataceklist($serial=''){
//     $q = $this->db->query('SELECT
//         a.id,
//         a.category,
//         b.catId,
//         b.sub_category,
//         b.type,
//         b.serial_number,
//         b.plate_number,
//         b.brandId,
//         b.active,
//         c.nama_category,
//         d.nama_item
//         from alkal_category_alat_berat a
//         INNER JOIN alkal_alat_berat b on a.id = b.catId
//         LEFT JOIN alkal_ceklist_category c on b.catId = c.catId
//         LEFT JOIN alkal_ceklist_item d on c.catId = d.id_category AND d.catId = c.catId where  b.serial_number = "'.$serial.'" OR b.plate_number = "'.$serial.'"');
//     return $q->result();
// }

//Alat Berat 
// public function getdataceklist($serial=''){
//     $q = $this->db->query('SELECT
//         a.id,
//         a.category,
//         b.catId,
//         b.type,
//         b.serial_number,
//         b.plate_number,
//         b.brandId,
//         b.active,
//         c.nama_category,
//         c.sub_category,
//         d.nama_item
//         from alkal_category_alat_berat a
//         INNER JOIN alkal_alat_berat b on a.id = b.catId
//         LEFT JOIN alkal_ceklist_category c on b.catId = c.catId 
//         LEFT JOIN alkal_ceklist_item d on c.id_category = d.id_category AND c.catId = d.catId  where b.serial_number = "'.$serial.'" OR b.plate_number = "'.$serial.'"');
//     return $q->result();
// }

public function getdataceklist($serial=''){
    $q = $this->db->query('SELECT
        a.id,
        a.category,
        b.catId,
        b.type,
        b.serial_number,
        b.plate_number,
        b.brandId,
        b.active,
        c.nama_category,
        d.nama_item
        from alkal_ceklist_kd_category a
        INNER JOIN alkal_ceklist_kendaraan b on a.id = b.catId
        LEFT JOIN alkal_ceklist_category c on b.catId = c.catId 
        LEFT JOIN alkal_ceklist_item d on c.id_category = d.id_category AND c.catId = d.catId  where b.serial_number = "'.$serial.'" OR b.plate_number = "'.$serial.'"');
    return $q->result();
}

function simpandata($id,$tanggal,$waktu,$nama_mekanik,$kendaraan,$serial,$nama_category,$nama_item,$kondisi,$keterangan)
    {

       

        $query="INSERT INTO `alkal_ceklist`(`id_header`, `tanggal`, `waktu`, `nama_mekanik`, `kendaraan`, `serial`,`nama_category`,`nama_item`,`kondisi`,`keterangan`) 
        VALUES ('$id','$tanggal','$waktu','$nama_mekanik','$kendaraan','$serial','$nama_category','$nama_item','$kondisi','$keterangan')";
        $this->db->query($query);
    }


//Dumptruck
public function getdataceklis_dt($serial=''){
    $q = $this->db->query('SELECT
        a.id,
        a.category,
        b.brandId,
        b.type,
        b.plate_number,
        b.active,
        b.catId,
        c.nama_category,
        d.nama_item
        from alkal_category_dt a
        INNER JOIN alkal_dump_truck b on a.id = b.catId
        LEFT JOIN alkal_ceklist_category c on b.catId = c.catId
        LEFT JOIN alkal_ceklist_item d on c.id_category = d.id_category AND c.catId = d.catId  where b.plate_number = "'.$serial.'"');
    return $q->result();
}

// function simpandata_dt($data,$tanggal,$nama_mekanik,$kendaraan,$serial,$nama_category,$nama_item,$kondisi,$keterangan)
//     {
//         $query="INSERT INTO `alkal_ceklist`( `tanggal`, `nama_mekanik`, `kendaraan`, `serial`,`nama_category`,`nama_item`,`kondisi`,`keterangan`) 
//         VALUES ('$tanggal','$nama_mekanik','$kendaraan','$serial','$nama_category','$nama_item','$kondisi','$keterangan')";
//         $cek = $this->db->query($query);

        
//     }





function getdatacetak($id,$tanggal,$kendaraan,$serial)
{
    $q = $this->db->query('SELECT * FROM alkal_ceklist WHERE id_header = "'.$id.'" and tanggal = "'.$tanggal.'" and kendaraan = "'.$kendaraan.'" and serial = "'.$serial.'" ORDER BY nama_category asc');
    // echo $q;
    return $q->result();
}

function getdatalaporan()
{
    $q = $this->db->query('SELECT * FROM alkal_ceklist ORDER BY nama_category asc');
    // echo $q;
    return $q->result();
}


function getdatalaporan_by_id($id)
{
    $q = $this->db->query("SELECT * FROM alkal_ceklist where id_header = $id  ORDER BY nama_category asc");
     // echo $q;
    return $q->result();
}



/*
     public function get_ceklist_db() {
        $this->db->select('alkal_ceklist_category.id as id,nama_category,catId');
        $this->db->from("alkal_ceklist_category");
        $this->db->join('alkal_ceklist_item','alkal_ceklist_item.catId = .alkal_alat_berat.catId');
        $this->db->order_by('nama_category','asc');
        $this->db->order_by('nama_item','asc');
        return $this->db->get();
    }
   public function insert_data($data,$table){
        $this->db->insert($table,$data);
    }
    */
}

?>
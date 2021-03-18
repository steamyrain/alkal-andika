<?php 

if(!defined('BASEPATH')) exit('No direct script access allowed');

use DataTables\Database,
    DataTables\Editor,
    DataTables\Editor\Field;

require 'vendor/autoload.php';

class AlkalDatatables {
    private $editor;
    private $db;

    public function __construct(){
    $ci =& get_instance();
    $sql_details = array(
        "type" => "Mysql",
        "user" => $ci->db->username,
        "pass" => $ci->db->password,
        "host" => "localhost",
        "port" => "",
        "db"   => $ci->db->database,
        "dsn"  => "mysql:host:localhost; dbname=".$ci->db->database.";",
        "pdoAttr" => array()
    );
        $this->db = new Database($sql_details);
        $this->editor = new Editor($this->db,'alkal_user_kinerja',array('uid,jobid,job_dat,job_start'));
    }
    
    public function api() {
        $this->editor->fields(
            Field::inst('uid'),
            Field::inst('emp_name'),
            Field::inst('job_date'),
            Field::inst('job_start'),
            Field::inst('job_end'),
            Field::inst('job_id'),
            Field::inst('job'),
            Field::inst('job_desc'),
            Field::inst('valid_status'),
        )
        ->process($_POST)
        ->json();
        return $this->editor;
    }
}


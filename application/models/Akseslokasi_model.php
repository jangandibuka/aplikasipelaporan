<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Akseslokasi_model extends CI_Model
{
    public $table = "tb_users_akses_instansi";
    public $table_user = "tb_users";
    public $id = "id";

    function __construct()
    {
        parent::__construct();
    }

    function get_data($id = "")
    {
        $sql = "SELECT l.*, la.id as id_akses FROM mst_lokasi l 
        LEFT JOIN tb_lokasi_akses la ON la.id_lokasi = l.id AND la.id_instansi_type=$id
        ORDER BY l.id
        ";
        return $this->db->query($sql)->result();
    }

    function get_select()
    {
        return $this->db->query('SELECT * FROM mst_instansi_type WHERE is_active=1')->result();
    }
}

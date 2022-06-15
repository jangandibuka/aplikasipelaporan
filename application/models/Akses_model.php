<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Akses_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function get_menu($type = "")
    {
        $sql = "SELECT 
        menu.*, 
        IF(ma.id, 'Y', 'T') as akses 
        FROM `tb_menu` menu
        LEFT JOIN tb_menu_akses ma ON ma.id_menu = menu.id_menu AND ma.user_type='$type'
        WHERE menu.aktif='Y'";

        $query = $this->db->query($sql);
        return $query->result();
    }
}

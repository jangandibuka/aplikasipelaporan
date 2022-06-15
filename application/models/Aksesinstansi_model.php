<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Aksesinstansi_model extends CI_Model
{
    public $table = "tb_users_akses_instansi";
    public $table_user = "tb_users";
    public $id = "id";

    function __construct()
    {
        parent::__construct();
    }

    function get_data_users($id = "")
    {
        $where = "";
        if ($id !== "") {
            $where .= "WHERE u.id=$id";
        }

        $sql = "SELECT 
        u.*, 
        GROUP_CONCAT(
            CONCAT(
                '{\"id_akses\":\"', uai.id_akses_instansi, '\", ', 
                '\"id_instansi\":\"', uai.id_instansi, '\", ',
                '\"nama_instansi\":\"', uai.kampus, '\", ',
                '\"type_instansi\":\"', uai.type_instansi, '\"}'
            )
        ) as kampus
        FROM tb_users u
        LEFT JOIN (
            SELECT 
            uai.id as id_akses_instansi,
            uai.id_users as id_users_instansi,
            uai.id_instansi,
            k.*,
            it.instansi as type_instansi
            FROM tb_users_akses_instansi uai
            JOIN mst_kampus k ON k.id = uai.id_instansi 
            JOIN mst_instansi_type it ON k.id_instansi_type = it.id
        ) uai ON uai.id_users_instansi = u.id
        $where
        GROUP BY u.id";
        return $this->db->query($sql)->result();
    }

    function get_data_kampus($id = "")
    {
        $sql = "SELECT 
                k.*, 
                it.instansi,
                uai.id as id_akses, 
                uai.id_users as id_users_akses,
                uai.id_instansi as id_instansi_akses
                FROM mst_kampus k
                JOIN mst_instansi_type it ON k.id_instansi_type = it.id
                LEFT JOIN tb_users_akses_instansi uai ON k.id = uai.id_instansi AND uai.id_users=$id
                WHERE k.is_active=1
                ORDER BY k.id
        ";
        return $this->db->query($sql)->result();
    }

    function get_data_instansi_absensi($id = "")
    {
        $sql = "SELECT 
            uai.id as id_akses_instansi,
            uai.id_users as id_users_instansi,
            uai.id_instansi,
            k.*,
            it.instansi as type_instansi
            FROM tb_users_akses_instansi uai
            JOIN mst_kampus k ON k.id = uai.id_instansi 
            JOIN mst_instansi_type it ON k.id_instansi_type = it.id
            WHERE uai.id_users=$id
            ORDER BY k.kampus ASC";
        return $this->db->query($sql)->result();
    }

    function get_tab_lokasi_kampus()
    {
        $sql = "SELECT 
                la.*,
                l.lokasi,
                l.tab_name,
                iy.instansi
                FROM tb_lokasi_akses la
                LEFT JOIN mst_lokasi l ON l.id = la.id_lokasi
                LEFT JOIN mst_instansi_type iy ON iy.id = la.id_instansi_type
                WHERE la.id_instansi_type=1
                ";
        return $this->db->query($sql)->result();
    }

    function get_list_absensi_kampus()
    {
        $start             = $this->input->post('start');
        $length         = $this->input->post('length');
        $draw             = $this->input->post('draw');
        $page   = $this->input->post('page', true);
        $date   = $this->input->post('date', true);
        // $search = strtolower(trim($verified_data['search']));

        $sort   = $this->input->post('sort', true);
        $order  = $this->input->post('order', true);
        $id  = $this->input->post('id', true);
        $order_column = $order[0]['column'];
        $order_dir = strtoupper($order[0]['dir']);
        // $order_column = isset($order[0]['column']) ? count($order[0]['column']) : 0;
        // $order_dir = strtoupper(isset($order[0]['dir']) ? count($order[0]['dir']) : 0);

        $exact  = $this->input->post('exact', true);

        $columns = array(
            0 => 'tgl_absensi',
            1 => 'l.lokasi',
            2 => 'tgl_absensi',
        );

        $offset = ($page - 1) * $start;

        $where = " WHERE t.id_kampus=$id";

        if (!empty($date)) {
            $where .= " AND t.tgl_absensi='$date'";
        }

        $sql = "SELECT t.*, l.lokasi 
            FROM trx_absensi t
            JOIN mst_lokasi l ON t.id_lokasi = l.id $where";

        $query = $this->db->query($sql);

        $records_total = $query->num_rows();

        $sql .= " ORDER BY " . $columns[$order_column] . " {$order_dir}";

        if ($start != -1) {
            $sql .= " LIMIT {$length} OFFSET {$offset}";
        }

        $query     = $this->db->query($sql);
        $rows_data = $query->result();

        $rows = array();
        $i = ($offset + 1);
        foreach ($rows_data as $row) {
            $row->number = $i;

            $rows[] = $row;

            $i++;
        }

        return array(
            'draw'           => $draw,
            'recordsTotal'   => $records_total,
            'recordsFiltered' => $records_total,
            'data'           => $rows,
        );
    }

    function get_list_absensi_kantor()
    {
        $start  = $this->input->post('start');
        $length = $this->input->post('length');
        $draw   = $this->input->post('draw');
        $page   = $this->input->post('page', true);
        $date   = $this->input->post('date', true);
        // $search = strtolower(trim($verified_data['search']));

        $sort   = $this->input->post('sort', true);
        $order  = $this->input->post('order', true);
        $id  = $this->input->post('id', true);
        $order_column = $order[0]['column'];
        $order_dir = strtoupper($order[0]['dir']);

        $exact  = $this->input->post('exact', true);

        $columns = array(
            0 => 'tgl_absensi',
            1 => 'tgl_absensi',
            2 => 'tgl_absensi',
        );

        $offset = ($page - 1) * $start;

        $where = " WHERE t.id_kampus=$id";

        if (!empty($date)) {
            $where .= " AND t.tgl_absensi='$date'";
        }


        $sql = "SELECT t.*, m.tipe
            FROM trx_absensi_pegawai t
            JOIN mst_pegawai_type m ON t.id_pegawai_type = m.id $where";

        $query = $this->db->query($sql);

        $records_total = $query->num_rows();

        $sql .= " ORDER BY " . $columns[$order_column] . " {$order_dir}";

        if ($start != -1) {
            $sql .= " LIMIT {$length} OFFSET {$offset}";
        }

        $query     = $this->db->query($sql);
        $rows_data = $query->result();

        $rows = array();
        $i = ($offset + 1);
        foreach ($rows_data as $row) {
            $row->number = $i;

            $rows[] = $row;

            $i++;
        }

        return array(
            'draw'           => $draw,
            'recordsTotal'   => $records_total,
            'recordsFiltered' => $records_total,
            'data'           => $rows,
        );
    }
}

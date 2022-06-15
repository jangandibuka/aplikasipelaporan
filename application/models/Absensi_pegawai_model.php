<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Absensi_pegawai_model extends CI_Model
{

    public $table = 'trx_absensi_pegawai';
    public $id = 'id';
    public $uid = 'uid';
    public $id_pegawai_type = 'id_pegawai_type';
    public $tgl = 'tgl_absensi';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        return $this->db->query(
            "SELECT t.*, m.tipe, k.kampus
            FROM trx_absensi_pegawai t
            JOIN mst_pegawai_type m ON t.id_pegawai_type = m.id
            JOIN mst_kampus k ON t.id_kampus = k.id
            "
        )->result();
        //WHERE t.uid = ".$this->session->userdata('user_id')
        //)->result();
    }
    function get_all_by_pegawai($uid)
    {
        return $this->db->query(
            "SELECT t.*, m.tipe, k.kampus
            FROM trx_absensi_pegawai t
            JOIN mst_pegawai_type m ON t.id_pegawai_type = m.id
            JOIN mst_kampus k ON t.id_kampus = k.id WHERE t.uid = $uid
            "
        )->result();
        //WHERE t.uid = ".$this->session->userdata('user_id')
        //)->result();
    }

    function get_list_absensi_kampus_admin()
    {
        $start  = $this->input->post('start');
        $length = $this->input->post('length');
        $draw   = $this->input->post('draw');
        $page   = $this->input->post('page', true);
        $date   = $this->input->post('date', true);
        // $search = strtolower(trim($verified_data['search']));
        // var_dump($date);
        // die();
        $sort   = $this->input->post('sort', true);
        $order  = $this->input->post('order', true);
        // $uid  = $this->input->post('uid', true);
        $order_column = $order[0]['column'];
        $order_dir = strtoupper($order[0]['dir']);

        $exact  = $this->input->post('exact', true);

        $columns = array(
            0 => 'tgl_absensi',
            1 => 'tgl_absensi',
            2 => 'tgl_absensi',
        );

        $offset = ($page - 1) * $start;

        $where = " WHERE t.tgl_absensi='$date'";

        if (!empty($date)) {
            $where;
        }


        $sql = "SELECT t.*, m.lokasi, k.kampus
            FROM trx_absensi t
            JOIN mst_lokasi m ON t.id_lokasi = m.id JOIN mst_kampus k ON t.id_kampus = k.id $where";

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
            $no = $row->number = $i;

            $rows[] = array(
                "id" => $row->id,
                "number" => $no,
                "kampus" => $row->kampus,
                "lokasi" => $row->lokasi,
                "tgl_absensi" => tgl_indo($row->tgl_absensi),
                "jumlah_taruna" => $row->jumlah_taruna,
                "jumlah_taruna_wanita" => $row->jumlah_taruna_wanita,
                "pria_sehat" => $row->pria_sehat,
                "pria_covid" => $row->pria_covid,
                "pria_ijin" => $row->pria_ijin,
                "wanita_sehat" => $row->wanita_sehat,
                "wanita_covid" => $row->wanita_covid,
                "wanita_ijin" => $row->wanita_ijin,
                // "isoman" => $row->isoman,
                // "dirawat" => $row->dirawat,
            );

            $i++;
        }

        return array(
            'draw'           => $draw,
            'recordsTotal'   => $records_total,
            'recordsFiltered' => $records_total,
            'data'           => $rows,
        );
    }
    function get_list_absensi_pegawai_admin()
    {
        $start  = $this->input->post('start');
        $length = $this->input->post('length');
        $draw   = $this->input->post('draw');
        $page   = $this->input->post('page', true);
        $date   = $this->input->post('date', true);
        // $search = strtolower(trim($verified_data['search']));
        // var_dump($date);
        // die();
        $sort   = $this->input->post('sort', true);
        $order  = $this->input->post('order', true);
        // $uid  = $this->input->post('uid', true);
        $order_column = $order[0]['column'];
        $order_dir = strtoupper($order[0]['dir']);

        $exact  = $this->input->post('exact', true);

        $columns = array(
            0 => 'tgl_absensi',
            1 => 'tgl_absensi',
            2 => 'tgl_absensi',
        );

        $offset = ($page - 1) * $start;

        $where = " WHERE t.tgl_absensi='$date'";

        if (!empty($date)) {
            $where;
        }


        $sql = "SELECT t.*, m.tipe, k.kampus
            FROM trx_absensi_pegawai t
            JOIN mst_pegawai_type m ON t.id_pegawai_type = m.id JOIN mst_kampus k ON t.id_kampus = k.id $where";

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
            $no = $row->number = $i;

            $rows[] = array(
                "id" => $row->id,
                "number" => $no,
                "tgl_absensi" => tgl_indo($row->tgl_absensi),
                "kampus" => $row->kampus,
                "tipe" => $row->tipe,
                "jumlah_pegawai" => $row->jumlah_pegawai,
                "sehat" => $row->sehat,
                "covid" => $row->covid,
                "ijin" => $row->ijin,
                "wfo" => $row->wfo,
                "wfh" => $row->wfh,
                "dinas_luar" => $row->dinas_luar,
                "cuti" => $row->cuti,
                "isoman" => $row->isoman,
                "dirawat" => $row->dirawat,
            );

            $i++;
        }

        return array(
            'draw'           => $draw,
            'recordsTotal'   => $records_total,
            'recordsFiltered' => $records_total,
            'data'           => $rows,
        );
    }
    function get_list_absensi_pegawai($uid)
    {
        $start  = $this->input->post('start');
        $length = $this->input->post('length');
        $draw   = $this->input->post('draw');
        $page   = $this->input->post('page', true);
        $date   = $this->input->post('date', true);
        // $search = strtolower(trim($verified_data['search']));
        // var_dump($date);
        // die();
        $sort   = $this->input->post('sort', true);
        $order  = $this->input->post('order', true);
        // $uid  = $this->input->post('uid', true);
        $order_column = $order[0]['column'];
        $order_dir = strtoupper($order[0]['dir']);

        $exact  = $this->input->post('exact', true);

        $columns = array(
            0 => 'tgl_absensi',
            1 => 'tgl_absensi',
            2 => 'tgl_absensi',
        );

        $offset = ($page - 1) * $start;

        $where = " WHERE t.uid=$uid";

        if (!empty($date)) {
            $where .= " AND t.tgl_absensi='$date'";
        }


        $sql = "SELECT t.*, m.tipe, k.kampus
            FROM trx_absensi_pegawai t
            JOIN mst_pegawai_type m ON t.id_pegawai_type = m.id JOIN mst_kampus k ON t.id_kampus = k.id $where";

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
            $no = $row->number = $i;

            $rows[] = array(
                "id" => $row->id,
                "number" => $no,
                "tgl_absensi" => tgl_indo($row->tgl_absensi),
                "kampus" => $row->kampus,
                "tipe" => $row->tipe,
                "jumlah_pegawai" => $row->jumlah_pegawai,
                "sehat" => $row->sehat,
                "covid" => $row->covid,
                "ijin" => $row->ijin,
                "wfo" => $row->wfo,
                "wfh" => $row->wfh,
                "dinas_luar" => $row->dinas_luar,
                "cuti" => $row->cuti,
                "isoman" => $row->isoman,
                "dirawat" => $row->dirawat,
            );

            $i++;
        }

        return array(
            'draw'           => $draw,
            'recordsTotal'   => $records_total,
            'recordsFiltered' => $records_total,
            'data'           => $rows,
        );
    }

    function get_absensi_by($tgl)
    {
        return $this->db->query(
            "SELECT t.*, m.tipe, k.kampus
            FROM trx_absensi_pegawai t
            JOIN mst_pegawai_type m ON t.id_pegawai_type = m.id
            JOIN mst_kampus k ON t.id_kampus = k.id
            WHERE t.tgl_absensi ='" . $tgl . "'"
        )->result();
    }

    // get all kampus untuk admin
    function get_all_kampus()
    {
        return $this->db->query(
            "SELECT a.*, k.kampus, l.lokasi 
            FROM trx_absensi a 
            JOIN mst_kampus k ON a.id_kampus = k.id 
            JOIN mst_lokasi l ON a.id_lokasi = l.id; 
            "
        )->result();
    }

    function get_by_tgl($tgl, $id_kampus, $id_lokasi)
    {
        $tgl = date('Y-m-d', strtotime($tgl));
        return $this->db->query(
            "SELECT * FROM trx_absensi 
            WHERE tgl_absensi = '" . $tgl . "' AND id_kampus=" . $id_kampus . " AND id_lokasi =" . $id_lokasi
        )->result();
    }


    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // get total rows
    function total_rows($q = NULL)
    {
        $this->db->like('id_transaksi', $q);
        $this->db->or_like('no_telp', $q);
        $this->db->or_like('id_pelanggan', $q);
        $this->db->or_like('id_nominal', $q);
        $this->db->or_like('id_harga', $q);
        $this->db->or_like('status', $q);
        $this->db->or_like('tgl_transaksi', $q);
        $this->db->or_like('tgl_bayar', $q);
        $this->db->or_like('uid', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_transaksi', $q);
        $this->db->or_like('no_telp', $q);
        $this->db->or_like('id_pelanggan', $q);
        $this->db->or_like('id_nominal', $q);
        $this->db->or_like('id_harga', $q);
        $this->db->or_like('status', $q);
        $this->db->or_like('tgl_transaksi', $q);
        $this->db->or_like('tgl_bayar', $q);
        $this->db->or_like('uid', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    function update_absensi($id, $id_lokasi, $id_kampus, $uid, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->where($this->id_kampus, $id_kampus);
        $this->db->where($this->uid, $uid);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }


    //ServerSide
    // Get DataTable data
    function getUsers($postData = null)
    {

        $response = array();

        ## Read value
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value

        // Custom search filter 
        $searchCity = $this->input->post('date1');
        // var_dump($searchCity);
        // die();
        // $searchDate = $postData['date'];
        $uid = $postData['uid'];

        ## Search 
        $search_arr = array();
        $searchQuery = "";
        if ($searchValue != '') {
            $search_arr[] = " (p.tipe like '%" . $searchValue . "%' or 
         t.tgl_absensi like '%" . $searchValue . "%') ";
        }
        if ($searchCity != '') {
            $search_arr[] = "  t.tgl_absensi='" . $searchCity . "' ";
        }
        if ($uid != '') {
            $search_arr[] = " t.uid='" . $uid . "' ";
        }

        if (count($search_arr) > 0) {
            $searchQuery = implode(" and ", $search_arr);
        }

        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        $this->db->join('mst_pegawai_type p', 't.id_pegawai_type=p.id');
        $this->db->join('mst_kampus k', 't.id_kampus=k.id');
        $records = $this->db->get('trx_absensi_pegawai t')->result();
        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        $this->db->join('mst_pegawai_type p', 't.id_pegawai_type=p.id');
        $this->db->join('mst_kampus k', 't.id_kampus=k.id');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $records = $this->db->get('trx_absensi_pegawai t')->result();
        $totalRecordwithFilter = $records[0]->allcount;

        ## Fetch records
        $this->db->select('t.*, p.tipe, k.kampus');
        $this->db->join('mst_pegawai_type p', 't.id_pegawai_type=p.id');
        $this->db->join('mst_kampus k', 't.id_kampus=k.id');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get('trx_absensi_pegawai t')->result();

        $data = array();
        $no = 1;
        foreach ($records as $record) {
            // $data['nomor'] = $no++;
            $data[] = array(

                "tgl_absensi" => $record->tgl_absensi,
                "kampus" => $record->kampus,
                "tipe" => $record->tipe,
                "jumlah_pegawai" => $record->jumlah_pegawai,
                "sehat" => $record->sehat,
                "covid" => $record->covid,
                "ijin" => $record->ijin,
                "wfo" => $record->wfo,
                "wfh" => $record->wfh,
                "dinas_luar" => $record->dinas_luar,
                "cuti" => $record->cuti,
                "isoman" => $record->isoman,
                "dirawat" => $record->dirawat,
            );
        }

        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data,
        );

        return $response;
    }

    // Get cities array
    // public function getCities()
    // {

    //     ## Fetch records
    //     $this->db->distinct();
    //     $this->db->select('city');
    //     $this->db->order_by('city', 'asc');
    //     $records = $this->db->get('users')->result();

    //     $data = array();

    //     foreach ($records as $record) {
    //         $data[] = $record->city;
    //     }

    //     return $data;
    // }
}

/* End of file Transaksi_model.php */
/* Location: ./application/models/Transaksi_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-05-14 11:11:34 */
/* http://harviacode.com */
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Absensi_model extends CI_Model {

    public $table = 'trx_absensi';
    public $id = 'id';
    public $uid = 'uid';
    public $id_lokasi = 'id_lokasi';
    public $id_kampus = 'id_kampus';
    public $tgl = 'tgl_absensi';
    public $order = 'DESC';

    function __construct() {
        parent::__construct();
    }

    // get all
    function get_all() {
        //$this->db->order_by($this->id, $this->order);
        //return $this->db->get_where($this->table, array('uid' => $this->session->userdata('user_id')))->result();
        return $this->db->query(
            "SELECT t.*, l.lokasi 
            FROM trx_absensi t
            JOIN mst_lokasi l ON t.id_lokasi = l.id
            WHERE t.uid = ".$this->session->userdata('user_id')
            )->result();
    }


    function get_absensi_by($tgl){
        return $this->db->query(
            "SELECT a.*, k.kampus, l.lokasi 
            FROM trx_absensi a 
            JOIN mst_kampus k ON a.id_kampus = k.id 
            JOIN mst_lokasi l ON a.id_lokasi = l.id 
            WHERE a.tgl_absensi='".$tgl."'"
            )->result();
    }

    // get all kampus untuk admin
    function get_all_kampus() {
        return $this->db->query(
            "SELECT a.*, k.kampus, l.lokasi 
            FROM trx_absensi a 
            JOIN mst_kampus k ON a.id_kampus = k.id 
            JOIN mst_lokasi l ON a.id_lokasi = l.id; 
            ")->result();
    }

    function get_by_tgl($tgl, $id_kampus, $id_lokasi){
        $tgl = date('Y-m-d', strtotime($tgl));
        return $this->db->query(
            "SELECT * FROM trx_absensi 
            WHERE tgl_absensi = '".$tgl."' AND id_kampus=".$id_kampus." AND id_lokasi =".$id_lokasi)->result();
    }

    
    // get data by id
    function get_by_id($id) {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // get total rows
    function total_rows($q = NULL) {
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
    function get_limit_data($limit, $start = 0, $q = NULL) {
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
    function insert($data) {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data) {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    function update_absensi($id, $id_lokasi, $id_kampus, $uid, $data) {        
        $this->db->where($this->id, $id);
        $this->db->where($this->id_lokasi, $id_lokasi);
        $this->db->where($this->id_kampus, $id_kampus);
        $this->db->where($this->uid, $uid);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id) {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Transaksi_model.php */
/* Location: ./application/models/Transaksi_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-05-14 11:11:34 */
/* http://harviacode.com */
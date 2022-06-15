<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Akseslokasi extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('akses_model');
        $this->load->model('akseslokasi_model');
        $this->load->model('ion_auth_model');
        chek_session();
    }

    function index()
    {
        $data['title'] = "Akses Lokasi";
        $uid = $this->session->userdata('user_id');
        $k = $this->ion_auth_model->get_by_id($uid);
        $data['pic'] = '';
        $data['id'] = "";
        $data['select'] = $this->akseslokasi_model->get_select();
        // $data['record'] = $record;
        $this->template->display('akseslokasi/index', $data);
    }

    function get_data()
    {
        $type = $this->input->post('type');

        if ($type) {
            $data = $this->akseslokasi_model->get_data($type);
        } else {
            $data = [];
        }


        echo json_encode($data);
    }

    function action()
    {
        $insert = $this->input->post('insert');
        $delete = $this->input->post('delete');
        $this->db->trans_start();
        if (count($insert) > 0) {
            $this->db->insert_batch('tb_lokasi_akses', $insert);
        }

        if (count($delete) > 0) {
            $this->db->where_in('id', $delete);
            $this->db->delete('tb_lokasi_akses');
        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            echo false;
        } else {
            echo true;
        }
    }
}

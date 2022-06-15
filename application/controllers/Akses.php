<?php

use function PHPSTORM_META\type;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Akses extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('akses_model');
        $this->load->model('ion_auth_model');
        chek_session();
    }

    function index()
    {
        $data['title'] = "Menu Akses";
        $uid = $this->session->userdata('user_id');
        $k = $this->ion_auth_model->get_by_id($uid);
        $data['pic'] = '';
        $record = $this->akses_model->get_menu();
        $data['record'] = $record;
        $this->template->display('akses/index', $data);
    }

    function get_data()
    {
        $type = $this->input->post('type');

        if ($type) {
            $data = $this->akses_model->get_menu($type);
        } else {
            $data = [];
        }


        echo json_encode($data);
    }

    function action()
    {
        $insert = $this->input->post('insert');
        $delete = $this->input->post('delete');
        $proccess_insert = null;
        $proccess_delete = null;
        $this->db->trans_start();
        if (count($insert) > 0) {
            $proccess_insert = $this->db->insert_batch('tb_menu_akses', $insert);
        }

        if (count($delete) > 0) {
            $this->db->where_in('id', $delete);
            $proccess_delete = $this->db->delete('tb_menu_akses');
        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            echo false;
        } else {
            echo true;
        }
    }
}

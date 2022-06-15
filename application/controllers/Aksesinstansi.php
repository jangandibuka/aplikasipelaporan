<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Aksesinstansi extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('akses_model');
        $this->load->model('aksesinstansi_model');
        $this->load->model('Absensi_model');
        $this->load->model('Absensi_pegawai_model');
        $this->load->model('ion_auth_model');
        chek_session();
    }

    function index()
    {
        $data['title'] = "Akses Instansi";
        $uid = $this->session->userdata('user_id');
        $k = $this->ion_auth_model->get_by_id($uid);
        $data['pic'] = '';
        $data['id'] = "";
        // $data['record'] = $record;
        $this->template->display('aksesinstansi/index', $data);
    }

    function get_data($id = "")
    {
        if ($id == "") {
            echo json_encode($this->aksesinstansi_model->get_data_users());
        } else {
            echo json_encode($this->aksesinstansi_model->get_data_kampus($id));
        }
    }

    function setting($id = "")
    {
        $data['title'] = "Akses Instansi";
        $uid = $this->session->userdata('user_id');
        $k = $this->ion_auth_model->get_by_id($uid);
        $data['pic'] = '';
        $data['id'] = $id;
        // $data['record'] = $record;
        $this->template->display('aksesinstansi/setting', $data);
    }

    function action()
    {
        $insert = $this->input->post('insert');
        $delete = $this->input->post('delete');
        $proccess_insert = null;
        $proccess_delete = null;
        $this->db->trans_start();
        if (count($insert) > 0) {
            $proccess_insert = $this->db->insert_batch('tb_users_akses_instansi', $insert);
        }

        if (count($delete) > 0) {
            $this->db->where_in('id', $delete);
            $proccess_delete = $this->db->delete('tb_users_akses_instansi');
        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            echo false;
        } else {
            echo true;
        }
    }

    function view_absensi()
    {
        if ($_POST) {
            $type = $this->input->post('type', true);
            $id = $this->input->post('id', true);

            if ($type === 'kantor') {
                $data['apa'] = '';
                $this->load->view('aksesinstansi/absensi/kantor', $data);
            } else if ($type === 'kampus') {
                $data['apa'] = '';
                $this->load->view('aksesinstansi/absensi/kampus', $data);
            } else {
                echo $type;
                echo "uye";
            }
        }
    }
    function view_absensi_custom()
    {
        if ($_POST) {
            $type = $this->input->post('type', true);
            $id = $this->input->post('id', true);

            if ($type === 'kantor') {
                $data['apa'] = '';
                $this->load->view('aksesinstansi/absensi/kantor_onoffice', $data);
            } else if ($type === 'kampus') {
                $data['apa'] = '';
                $this->load->view('aksesinstansi/absensi/kampus_onoffice', $data);
            } else {
                echo $type;
                echo "uye";
            }
        }
    }

    function options_absensi()
    {
        $uid = $this->session->userdata('user_id');


        if ($uid) {
            $data = $this->aksesinstansi_model->get_data_instansi_absensi($uid);
        } else {
            $data = [];
        }

        echo json_encode($data);
    }

    function action_absensi_kampus()
    {
        $this->form_validation->set_rules('jumlah_taruna', 'Jumlah Taruna Pria', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('jumlah_taruna_wanita', 'Jumlah Taruna Wanita', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('pria_sehat', 'Taruna Pria Sehat', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('pria_covid', 'Taruna Pria Terpapar Covid', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('pria_ijin', 'Taruna Pria Ijin', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('wanita_sehat', 'Taruna Wanita Sehat', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('wanita_covid', 'Taruna Wanita Terpapar Covid', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('wanita_ijin', 'Taruna Wanita Ijin', 'required|regex_match[/^[0-9\-\+]+$/]');

        if ($this->form_validation->run() == FALSE) {
            $response = array(
                'code' => 0,
                'message' => array(
                    // 'tgl_absensi' => form_error('tgl_absensi'),
                    'jumlah_taruna' => form_error('jumlah_taruna'),
                    'jumlah_taruna_wanita' => form_error('jumlah_taruna_wanita'),
                    'pria_sehat' => form_error('pria_sehat'),
                    'pria_covid' => form_error('pria_covid'),
                    'pria_ijin' => form_error('pria_ijin'),
                    'wanita_sehat' => form_error('wanita_sehat'),
                    'wanita_covid' => form_error('wanita_covid'),
                    'wanita_ijin' => form_error('wanita_ijin'),
                )
            );
        } else {
            $uid = $this->session->userdata('user_id');
            $data = array(
                'tgl_absensi' => $this->input->post('tgl_absensi', TRUE),
                'jumlah_taruna' => $this->input->post('jumlah_taruna', TRUE),
                'jumlah_taruna_wanita' => $this->input->post('jumlah_taruna_wanita', TRUE),
                'pria_sehat' => $this->input->post('pria_sehat', TRUE),
                'pria_covid' => $this->input->post('pria_covid', TRUE),
                'pria_ijin' => $this->input->post('pria_ijin', TRUE),
                'wanita_sehat' => $this->input->post('wanita_sehat', TRUE),
                'wanita_covid' => $this->input->post('wanita_covid', TRUE),
                'wanita_ijin' => $this->input->post('wanita_ijin', TRUE),
                'id_kampus' => $this->input->post('id_kampus', TRUE),
                'id_lokasi' => $this->input->post('id_lokasi', TRUE),
                'manual_taruna' => '0',
                'manual_taruni' => '0',
                //'id' => $this->input->post('id', TRUE),
                'uid' => $uid,
            );
            $cek = $this->Absensi_model->get_by_tgl(
                $this->input->post('tgl_absensi'),
                $this->input->post('id_kampus'),
                $this->input->post('id_lokasi')
            ); //print_r($cek);die();
            foreach ($cek as $c) {
                $data['id'] = $c->id;
                $id = $c->id;
            }
            if ($cek) {
                $this->Absensi_model->update_absensi(
                    $id,
                    $this->input->post('id_lokasi'),
                    $this->input->post('id_kampus'),
                    $uid,
                    $data
                );
                $response = array(
                    'code' => 1,
                    'message' => 'Data Absen berhasil disimpan'
                );
            } else {
                $this->Absensi_model->insert($data);
                $response = array(
                    'code' => 1,
                    'message' => 'Data Absen berhasil disimpan'
                );
            }
        }

        echo json_encode($response);
    }

    function action_absensi_pegawai()
    {
        $this->form_validation->set_rules('jumlah_pegawai', 'Jumlah Pegawai', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('id_pegawai_type', 'Tipe Pegawai', 'required|regex_match[/^[0-9\-\+]+$/]');
        //$this->form_validation->set_rules('tgl_absensi', 'Tgl. Absensi', 'required|regex_match[/^[0-9\-\+]+$/]');
        // $this->form_validation->set_rules('sehat', 'Pegawai Sehat', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('covid', 'Pegawai Terpapar', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('ijin', 'Pegawai Sakit/Ijin, dan lainnya', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('wfo', 'Pegawai WFO', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('wfh', 'Pegawai WFH', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('dinas_luar', 'Pegawai Dinas Luar', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('tugas_belajar', 'Pegawai Tugas Belajar', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('cuti', 'Pegawai Cuti', 'required|regex_match[/^[0-9\-\+]+$/]');
        // $this->form_validation->set_rules('isoman', 'Pegawai Isoman', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('dirawat', 'Pegawai Dirawat', 'required|regex_match[/^[0-9\-\+]+$/]');
        if ($this->form_validation->run() == FALSE) {
            $response = array(
                'code' => 0,
                'message' => array(
                    'jumlah_pegawai' => form_error('jumlah_pegawai'),
                    'id_pegawai_type' => form_error('id_pegawai_type'),
                    'id_kampus' => form_error('id_kampus'),
                    // 'sehat' => form_error('sehat'),
                    'covid' => form_error('covid'),
                    'ijin' => form_error('ijin'),
                    'wfo' => form_error('wfo'),
                    'wfh' => form_error('wfh'),
                    'dinas_luar' => form_error('dinas_luar'),
                    'tugas_belajar' => form_error('tugas_belajar'),
                    'cuti' => form_error('cuti'),
                    // 'isoman' => form_error('isoman'),
                    'dirawat' => form_error('dirawat'),
                    'vaksin1' => form_error('vaksin1'),
                    'vaksin2' => form_error('vaksin2'),
                    'vaksin_lain' => form_error('vaksin_lain'),
                )
            );
        } else {
            $uid = $this->session->userdata('user_id');
            $data = array(
                'tgl_absensi' => $this->input->post('tgl_absensi', TRUE),
                'jumlah_pegawai' => $this->input->post('jumlah_pegawai', TRUE),
                'id_pegawai_type' => $this->input->post('id_pegawai_type', TRUE),
                'id_kampus' => $this->input->post('id_kampus', TRUE),
                // 'sehat' => $this->input->post('sehat', TRUE),
                'covid' => $this->input->post('covid', TRUE),
                'ijin' => $this->input->post('ijin', TRUE),
                'wfo' => $this->input->post('wfo', TRUE),
                'wfh' => $this->input->post('wfh', TRUE),
                'dinas_luar' => $this->input->post('dinas_luar', TRUE),
                'tugas_belajar' => $this->input->post('tugas_belajar', TRUE),
                'cuti' => $this->input->post('cuti', TRUE),
                // 'isoman' => $this->input->post('isoman', TRUE),
                'dirawat' => $this->input->post('dirawat', TRUE),
                'vaksin1' => $this->input->post('vaksin1', TRUE),
                'vaksin2' => $this->input->post('vaksin2', TRUE),
                'vaksin_lain' => $this->input->post('vaksin_lain', TRUE),
                'uid' => $uid,
            );
           

        $this->Absensi_pegawai_model->insert($data);
           $response = array(
            'code' => 1,
            'message' => 'Data Absen berhasil disimpan'
        );
        //    if($d){
        //     $response = array(
        //         'code' => 1,
        //         'message' => 'Data Absen berhasil disimpan'
        //     );
        //    }else{
        //     $response = array(
        //         'code' => 2,
        //         'message' => 'Data Absen gagal disimpan'
        //     );
        //    }
           
        }

        echo json_encode($response);
    }

    function get_list_absensi_kampus()
    {
        $data = $this->aksesinstansi_model->get_list_absensi_kampus();
        echo json_encode($data);
        // var_dump($data);
        // die();
    }

    function get_list_absensi_kantor()
    {
        $data = $this->aksesinstansi_model->get_list_absensi_kantor();
        echo json_encode($data);
    }
}

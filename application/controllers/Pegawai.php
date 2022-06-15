<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pegawai extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Absensi_model');
        $this->load->model('Kampus_model');
        $this->load->model('Groups_model');
        $this->load->model('Lokasi_model');
        $this->load->model('Users_groups_model');
        $this->load->model('Type_pegawai_model');
        $this->load->model('Absensi_pegawai_model');
        $this->load->model('aksesinstansi_model');
        $this->load->model('ion_auth_model');
        $this->load->library('form_validation');
        chek_session();
    }



    public function index()
    {
        $uid = $this->session->userdata('user_id');
        $k = $this->ion_auth_model->get_by_id($uid);
        $tipe = $this->Type_pegawai_model->get_all();

        // cari users group
        $users = $this->Users_groups_model->get_users_id($uid);
        // cek apakah administrator (group_id = 1)
        // var_dump($users->group_id);
        // die();
        if ($users->group_id == 1) {
            $data = array(
                'uid' => $uid,
                'pic' => '',

            );
            $this->template->display('pegawai/trx_pegawai_list_admin', $data);
        } else {
            $row = $this->Kampus_model->get_by_id($k->id_kampus);
            $data = array(
                'uid' => $uid,
                'pic' => $row->kampus,
                'pegawai_data' => $this->Absensi_pegawai_model->get_all_by_pegawai($uid),
            );
            $this->template->display('pegawai/trx_pegawai_list', $data);
        }
    }
    function get_list_absensi_kampus_admin()
    {
        $uid = $this->session->userdata('user_id');
        // $date   = $this->input->post('date', true);
        $data = $this->Absensi_pegawai_model->get_list_absensi_kampus_admin();
        echo json_encode($data);
    }
    function get_list_absensi_pegawai_admin()
    {
        $uid = $this->session->userdata('user_id');
        // $date   = $this->input->post('date', true);
        $data = $this->Absensi_pegawai_model->get_list_absensi_pegawai_admin($uid);
        echo json_encode($data);
    }
    function get_list_absensi_pegawai()
    {
        $uid = $this->session->userdata('user_id');
        // $date   = $this->input->post('date', true);
        $data = $this->Absensi_pegawai_model->get_list_absensi_pegawai($uid);
        echo json_encode($data);
    }

    public function userList()
    {

        // POST data
        $postData = $this->input->post();

        // Get data
        $data = $this->Absensi_pegawai_model->getUsers($postData);

        echo json_encode($data);
    }

    public function onoffice()
    {
        $uid = $this->session->userdata('user_id');
        $k = $this->ion_auth_model->get_by_id($uid);
        $row = $this->Kampus_model->get_by_id($k->id_kampus);
        $tipe = $this->Type_pegawai_model->get_all();
        $data = array(
            'button' => 'Submit Absensi',
            'action' => site_url('pegawai/create_action_onoffice'),
            'id' => set_value('id'),
            'id_kampus' => $row->id,
            'tgl_absensi' => set_value('tgl_absensi'),
            'jumlah_taruna' => set_value('jumlah_taruna'),
            'pria_sehat' => set_value('pria_sehat'),
            'pria_covid' => set_value('pria_covid'),
            'pria_ijin' => set_value('pria_ijin'),
            'wanita_sehat' => set_value('wanita_sehat'),
            'wanita_covid' => set_value('wanita_covid'),
            'wanita_ijin' => set_value('wanita_ijin'),
            'vaksin1' => set_value('vaksin1'),
            'vaksin2' => set_value('vaksin2'),
            'vaksin_lain' => set_value('vaksin_lain'),
            'uid' => $uid,
            'pic' => $row->kampus,
        );
        $data['lokasi_data'] = $this->aksesinstansi_model->get_tab_lokasi_kampus();
        $data['tipe'] = $tipe;
        // var_dump($data);
        // die();
        $this->template->display('aksesinstansi/onoffice/form_onoffice', $data);
    }

    public function create_action_onoffice()
    {
        $uid = $this->session->userdata('user_id');
        $k = $this->ion_auth_model->get_by_id($uid);
        $row = $this->Kampus_model->get_by_id($k->id_kampus);

        $this->form_validation->set_rules('jumlah_pegawai', 'Jumlah Pegawai', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('sehat', 'Jumlah Pegawai Sehat', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('covid', 'Jumlah Pegawai Terpapar Covid', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('ijin', 'Jumlah Pegawai Ijin', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('wfo', 'Jumlah Pegawai WFO', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('wfh', 'Jumlah Pegawai WFH', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('dinas_luar', 'Jumlah Pegawai Dinas Luar', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('tugas_belajar', 'Jumlah Pegawai Tugas Belajar', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('cuti', 'Jumlah Pegawai Cuti', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('isoman', 'Jumlah Pegawai Isoman', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('vaksin1', 'Jumlah Sudah Vaksin 1', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('vaksin2', 'Jumlah Sudah Vaksin 2', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('vaksin_luar', 'Jumlah Sudah Vaksin Lainnya', 'required|regex_match[/^[0-9\-\+]+$/]');
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $uid = $this->session->userdata('user_id');
            $data = array(
                'tgl_absensi' => $this->input->post('tgl_absensi', TRUE),
                'jumlah_taruna' => $this->input->post('jumlah_taruna', TRUE),
                'pria_sehat' => $this->input->post('pria_sehat', TRUE),
                'pria_covid' => $this->input->post('pria_covid', TRUE),
                'pria_ijin' => $this->input->post('pria_ijin', TRUE),
                'wanita_sehat' => $this->input->post('wanita_sehat', TRUE),
                'wanita_covid' => $this->input->post('wanita_covid', TRUE),
                'wanita_ijin' => $this->input->post('wanita_ijin', TRUE),
                'id_kampus' => $this->input->post('id_kampus', TRUE),
                'id_lokasi' => $this->input->post('id_lokasi', TRUE),
                //'id' => $this->input->post('id', TRUE),
                'uid' => $uid,
            );
            // cek, kl absensi di tgl tsb sudah ada, di update. Jika belum, ditambah
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
            } else {
                $this->Absensi_model->insert($data);
            }
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('pegawai/onoffice'));
        }
    }

    function action_absensi_pegawai()
    {
        $this->form_validation->set_rules('jumlah_pegawai', 'Jumlah Pegawai', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('id_pegawai_type', 'Tipe Pegawai', 'required|regex_match[/^[0-9\-\+]+$/]');
        //$this->form_validation->set_rules('tgl_absensi', 'Tgl. Absensi', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('sehat', 'Pegawai Sehat', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('covid', 'Pegawai Terpapar', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('ijin', 'Pegawai Sakit/Ijin, dan lainnya', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('wfo', 'Pegawai WFO', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('wfh', 'Pegawai WFH', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('dinas_luar', 'Pegawai Dinas Luar', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('tugas_belajar', 'Pegawai Tugas Belajar', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('cuti', 'Pegawai Cuti', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('isoman', 'Pegawai Isoman', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('dirawat', 'Pegawai Dirawat', 'required|regex_match[/^[0-9\-\+]+$/]');
        if ($this->form_validation->run() == FALSE) {
            $response = array(
                'code' => 0,
                'message' => array(
                    'jumlah_pegawai' => form_error('jumlah_pegawai'),
                    'id_pegawai_type' => form_error('id_pegawai_type'),
                    'id_kampus' => form_error('id_kampus'),
                    'sehat' => form_error('sehat'),
                    'covid' => form_error('covid'),
                    'ijin' => form_error('ijin'),
                    'wfo' => form_error('wfo'),
                    'wfh' => form_error('wfh'),
                    'dinas_luar' => form_error('dinas_luar'),
                    'tugas_belajar' => form_error('tugas_belajar'),
                    'cuti' => form_error('cuti'),
                    'isoman' => form_error('isoman'),
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
                'sehat' => $this->input->post('sehat', TRUE),
                'covid' => $this->input->post('covid', TRUE),
                'ijin' => $this->input->post('ijin', TRUE),
                'wfo' => $this->input->post('wfo', TRUE),
                'wfh' => $this->input->post('wfh', TRUE),
                'dinas_luar' => $this->input->post('dinas_luar', TRUE),
                'tugas_belajar' => $this->input->post('tugas_belajar', TRUE),
                'cuti' => $this->input->post('cuti', TRUE),
                'isoman' => $this->input->post('isoman', TRUE),
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
        }

        echo json_encode($response);
    }
    public function create()
    {
        $uid = $this->session->userdata('user_id');
        $k = $this->ion_auth_model->get_by_id($uid);
        $tipe = $this->Type_pegawai_model->get_all();
        $row = $this->Kampus_model->get_by_id($k->id_kampus);
        $data = array(
            'button' => 'Submit',
            'action' => site_url('pegawai/create_action'),
            'id' => set_value('id'),
            'id_kampus' => $row->id,
            'tgl_absensi' => set_value('tgl_absensi'),
            'id_pegawai_type' => set_value('jumlah_taruna'),
            'jumlah_pegawai' => set_value('pria_sehat'),
            'sehat' => set_value('pria_covid'),
            'covid' => set_value('pria_ijin'),
            'ijin' => set_value('wanita_sehat'),
            'wfo' => set_value('wanita_covid'),
            'wfh' => set_value('wanita_inin'),
            'dinas_luar' => set_value('wanita_inin'),
            'tugas_belajar' => set_value('wanita_inin'),
            'cuti' => set_value('wanita_inin'),
            'isoman' => set_value('wanita_inin'),
            'dirawat' => set_value('wanita_inin'),
            'uid' => $uid,
            'pic' => $row->kampus,
            'subtitle' => 'Tambah Absensi',
        );
        $data['tipe'] = $tipe;
        $this->template->display('pegawai/trx_pegawai_form', $data);
    }

    public function create_action()
    {
        $uid = $this->session->userdata('user_id');
        $k = $this->ion_auth_model->get_by_id($uid);
        $row = $this->Kampus_model->get_by_id($k->id_kampus);

        $this->form_validation->set_rules('jumlah_pegawai', 'Jumlah Pegawai', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('id_pegawai_type', 'Tipe Pegawai', 'required|regex_match[/^[0-9\-\+]+$/]');
        //$this->form_validation->set_rules('tgl_absensi', 'Tgl. Absensi', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('sehat', 'Pegawai Sehat', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('covid', 'Pegawai Terpapar', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('ijin', 'Pegawai Sakit/Ijin, dan lainnya', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('wfo', 'Pegawai WFO', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('wfh', 'Pegawai WFH', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('dinas_luar', 'Pegawai Dinas Luar', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('tugas_belajar', 'Pegawai Tugas Belajar', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('cuti', 'Pegawai Cuti', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('isoman', 'Pegawai Isoman', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('dirawat', 'Pegawai Dirawat', 'required|regex_match[/^[0-9\-\+]+$/]');
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $uid = $this->session->userdata('user_id');
            $data = array(
                'tgl_absensi' => $this->input->post('tgl_absensi', TRUE),
                'jumlah_pegawai' => $this->input->post('jumlah_pegawai', TRUE),
                'id_pegawai_type' => $this->input->post('id_pegawai_type', TRUE),
                'id_kampus' => $this->input->post('id_kampus', TRUE),
                'sehat' => $this->input->post('sehat', TRUE),
                'covid' => $this->input->post('covid', TRUE),
                'ijin' => $this->input->post('ijin', TRUE),
                'wfo' => $this->input->post('wfo', TRUE),
                'wfh' => $this->input->post('wfh', TRUE),
                'dinas_luar' => $this->input->post('dinas_luar', TRUE),
                'tugas_belajar' => $this->input->post('tugas_belajar', TRUE),
                'cuti' => $this->input->post('cuti', TRUE),
                'isoman' => $this->input->post('isoman', TRUE),
                'dirawat' => $this->input->post('dirawat', TRUE),
                'uid' => $uid,
            );

            $this->Absensi_pegawai_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('pegawai'));
        }
    }

    public function update($id)
    {
        $uid = $this->session->userdata('user_id');
        $k = $this->ion_auth_model->get_by_id($uid);
        $kam = $this->Kampus_model->get_by_id($k->id_kampus);
        $row = $this->Absensi_pegawai_model->get_by_id($id);
        $tipe = $this->Type_pegawai_model->get_all();
        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('pegawai/update_action'),
                'id' => set_value('id', $row->id),
                'id_kampus' => set_value('id_kampus', $row->id_kampus),
                'tgl_absensi' => set_value('tgl_absensi', $row->tgl_absensi),
                'id_pegawai_type' => set_value('id_pegawai_type', $row->id_pegawai_type),
                'jumlah_pegawai' => set_value('jumlah_pegawai', $row->jumlah_pegawai),
                'sehat' => set_value('sehat', $row->sehat),
                'covid' => set_value('covid', $row->covid),
                'ijin' => set_value('ijin', $row->ijin),
                'wfo' => set_value('wfo', $row->wfo),
                'wfh' => set_value('wfh', $row->wfh),
                'dinas_luar' => set_value('dinas_luar', $row->dinas_luar),
                'tugas_belajar' => set_value('tugas_belajar', $row->tugas_belajar),
                'cuti' => set_value('wanita_ijin', $row->cuti),
                'isoman' => set_value('wanita_ijin', $row->isoman),
                'dirawat' => set_value('wanita_ijin', $row->dirawat),
                'vaksin1' => set_value('vaksin1', $row->vaksin1),
                'vaksin2' => set_value('vaksin2', $row->vaksin2),
                'vaksin_lain' => set_value('vaksin_lain', $row->vaksin_lain),
                'uid' => set_value('uid', $row->uid),
                'pic' => $kam->kampus,
                'subtitle' => 'Edit Absensi',
            );

            $data['tipe'] = $tipe;
            $this->template->display('pegawai/trx_pegawai_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pegawai'));
        }
    }

    public function update_action()
    {
        $uid = $this->session->userdata('user_id');
        $k = $this->ion_auth_model->get_by_id($uid);
        $kam = $this->Kampus_model->get_by_id($k->id_kampus);

        $this->form_validation->set_rules('jumlah_pegawai', 'Jumlah Pegawai', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('id_pegawai_type', 'Tipe Pegawai', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('sehat', 'Pegawai Sehat', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('covid', 'Pegawai Terpapar', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('ijin', 'Pegawai Sakit/Ijin, dan lainnya', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('wfo', 'Pegawai WFO', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('wfh', 'Pegawai WFH', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('dinas_luar', 'Pegawai Dinas Luar', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('tugas_belajar', 'Pegawai Tugas Belajar', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('cuti', 'Pegawai Cuti', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('isoman', 'Pegawai Isoman', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('dirawat', 'Pegawai Dirawat', 'required|regex_match[/^[0-9\-\+]+$/]');

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_transaksi', TRUE));
        } else {
            $data = array(
                'tgl_absensi' => $this->input->post('tgl_absensi', TRUE),
                'jumlah_pegawai' => $this->input->post('jumlah_pegawai', TRUE),
                'id_pegawai_type' => $this->input->post('id_pegawai_type', TRUE),
                'id_kampus' => $this->input->post('id_kampus', TRUE),
                'sehat' => $this->input->post('sehat', TRUE),
                'covid' => $this->input->post('covid', TRUE),
                'ijin' => $this->input->post('ijin', TRUE),
                'wfo' => $this->input->post('wfo', TRUE),
                'wfh' => $this->input->post('wfh', TRUE),
                'dinas_luar' => $this->input->post('dinas_luar', TRUE),
                'tugas_belajar' => $this->input->post('tugas_belajar', TRUE),
                'cuti' => $this->input->post('cuti', TRUE),
                'isoman' => $this->input->post('isoman', TRUE),
                'dirawat' => $this->input->post('dirawat', TRUE),
                'vaksin1' => $this->input->post('vaksin1', TRUE),
                'vaksin2' => $this->input->post('vaksin2', TRUE),
                'vaksin_lain' => $this->input->post('vaksin_lain', TRUE),
                'uid' => $uid,
            );
            $this->Absensi_pegawai_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pegawai'));
        }
    }

    public function delete($id)
    {
        $row = $this->Transaksi_model->get_by_id($id);

        if ($row) {
            $this->Transaksi_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('transaksi'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('transaksi'));
        }
    }

    public function _rules()
    {

        $this->form_validation->set_rules('id_pelanggan', 'id pelanggan', 'trim|required');
        $this->form_validation->set_rules('id_nominal', 'id nominal', 'trim|required');
        $this->form_validation->set_rules('id_harga', 'id harga', 'trim|required');
        $this->form_validation->set_rules('status', 'status', 'trim|required');
        $this->form_validation->set_rules('tgl_transaksi', 'tgl transaksi', 'trim|required');
        $this->form_validation->set_rules('id_transaksi', 'id_transaksi', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        if ($_GET['date']) {
            $tgl = $_GET['date'];
        } else {
            $tgl = "";
        }

        $this->load->helper('exportexcel');
        $namaFile = "absensi_pegawai.xls";
        $judul = "absensi pegwai";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
        xlsWriteLabel($tablehead, $kolomhead++, "Tgl. Absensi");
        xlsWriteLabel($tablehead, $kolomhead++, "Kantor");
        xlsWriteLabel($tablehead, $kolomhead++, "Tipe Pegawai");
        xlsWriteLabel($tablehead, $kolomhead++, "Jumlah Pegawai");
        xlsWriteLabel($tablehead, $kolomhead++, "Pegawai Sehat");
        xlsWriteLabel($tablehead, $kolomhead++, "Pegawai Terpapar");
        xlsWriteLabel($tablehead, $kolomhead++, "Pegawai Sakit");
        xlsWriteLabel($tablehead, $kolomhead++, "WFO");
        xlsWriteLabel($tablehead, $kolomhead++, "WFH");
        xlsWriteLabel($tablehead, $kolomhead++, "Dinas Luar");
        xlsWriteLabel($tablehead, $kolomhead++, "tugas_belajar");
        xlsWriteLabel($tablehead, $kolomhead++, "Cuti");
        xlsWriteLabel($tablehead, $kolomhead++, "Isoman");
        xlsWriteLabel($tablehead, $kolomhead++, "Dirawat");
        xlsWriteLabel($tablehead, $kolomhead++, "Vaksin 1");
        xlsWriteLabel($tablehead, $kolomhead++, "Vaksin 2");
        xlsWriteLabel($tablehead, $kolomhead++, "Vaksin Lain");

        foreach ($this->Absensi_pegawai_model->get_absensi_by($tgl) as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteNumber($tablebody, $kolombody++, $data->tgl_absensi);
            xlsWriteLabel($tablebody, $kolombody++, $data->kampus);
            xlsWriteNumber($tablebody, $kolombody++, $data->tipe);
            xlsWriteNumber($tablebody, $kolombody++, $data->jumlah_pegawai);
            xlsWriteNumber($tablebody, $kolombody++, $data->sehat);
            xlsWriteNumber($tablebody, $kolombody++, $data->covid);
            xlsWriteNumber($tablebody, $kolombody++, $data->ijin);
            xlsWriteNumber($tablebody, $kolombody++, $data->wfo);
            xlsWriteNumber($tablebody, $kolombody++, $data->wfh);
            xlsWriteNumber($tablebody, $kolombody++, $data->dinas_luar);
            xlsWriteNumber($tablebody, $kolombody++, $data->tugas_belajar);
            xlsWriteNumber($tablebody, $kolombody++, $data->cuti);
            xlsWriteNumber($tablebody, $kolombody++, $data->isoman);
            xlsWriteNumber($tablebody, $kolombody++, $data->dirawat);
            xlsWriteNumber($tablebody, $kolombody++, $data->vaksin1);
            xlsWriteNumber($tablebody, $kolombody++, $data->vaksin2);
            xlsWriteNumber($tablebody, $kolombody++, $data->vaksin_lain);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }
}

/* End of file Transaksi.php */
/* Location: ./application/controllers/Transaksi.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-05-14 11:11:34 */
/* http://harviacode.com */
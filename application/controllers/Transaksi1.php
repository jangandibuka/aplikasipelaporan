<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Transaksi extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Absensi_model');
        $this->load->model('Absensi_pegawai_model');
        $this->load->model('Kampus_model');
        $this->load->model('Groups_model');
        $this->load->model('Users_groups_model');
        $this->load->model('ion_auth_model');
        $this->load->model('Lokasi_model');
        $this->load->model('aksesinstansi_model');
        $this->load->model('Type_pegawai_model');
        $this->load->library('form_validation');
        chek_session();
    }

    public function index()
    {
        $uid = $this->session->userdata('user_id');
        $k = $this->ion_auth_model->get_by_id($uid);

        // cari users group
        $users = $this->Users_groups_model->get_users_id($uid);
        // cek apakah administrator (group_id = 1)
        if ($users->group_id == 1) {
            $data = array(
                'uid' => $uid,
                'pic' => '',
                'absensi_data' => $this->Absensi_model->get_all_kampus(),
            );
            $this->template->display('transaksi/trx_absensi_kampus', $data);
        } else {
            $row = $this->Kampus_model->get_by_id($k->id_kampus);
            $data = array(
                'uid' => $uid,
                'pic' => $row->kampus,
                'absensi_data' => $this->Absensi_model->get_all(),
            );
            $this->template->display('aksesinstansi/absensi/list', $data);
        }
    }

    public function create()
    {
        $uid = $this->session->userdata('user_id');
        $k = $this->ion_auth_model->get_by_id($uid);
        $row = $this->Kampus_model->get_by_id($k->id_kampus);
        $tipe = $this->Type_pegawai_model->get_all();
        $data = array(
            'button' => 'Submit Absensi',
            'action' => site_url('transaksi/create_action'),
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
        $this->template->display('aksesinstansi/absensi/form', $data);
    }

    public function create_action()
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
            redirect(site_url('transaksi/create'));
        }
    }

    public function update($id)
    {
        $uid = $this->session->userdata('user_id');
        $k = $this->ion_auth_model->get_by_id($uid);
        $kam = $this->Kampus_model->get_by_id($k->id_kampus);
        $row = $this->Absensi_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('transaksi/update_action'),
                'id' => set_value('id', $row->id),
                'id_kampus' => set_value('id_kampus', $row->id_kampus),
                'tgl_absensi' => set_value('tgl_absensi', $row->tgl_absensi),
                'jumlah_taruna' => set_value('jumlah_taruna', $row->jumlah_taruna),
                'jumlah_taruna_wanita' => set_value('jumlah_taruna_wanita', $row->jumlah_taruna_wanita),
                'pria_sehat' => set_value('pria_sehat', $row->pria_sehat),
                'pria_covid' => set_value('pria_covid', $row->pria_covid),
                'pria_ijin' => set_value('pria_ijin', $row->pria_ijin),
                'wanita_sehat' => set_value('wanita_sehat', $row->wanita_sehat),
                'wanita_covid' => set_value('wanita_covid', $row->wanita_covid),
                'wanita_ijin' => set_value('wanita_ijin', $row->wanita_ijin),
                'id_lokasi' => set_value('id_lokasi', $row->id_lokasi),
                'uid' => set_value('uid', $row->uid),
                'pic' => $kam->kampus,
            );
            $data['lokasi_data'] = $this->Lokasi_model->get_all();
            //print_r($data);die();    
            $this->template->display('transaksi/trx_absensi_form_edit', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('transaksi'));
        }
    }

    public function update_action()
    {
        $uid = $this->session->userdata('user_id');
        $k = $this->ion_auth_model->get_by_id($uid);
        $kam = $this->Kampus_model->get_by_id($k->id_kampus);

        $this->form_validation->set_rules('jumlah_taruna', 'Jumlah Taruna', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('jumlah_taruna_wanita', 'Jumlah Taruna Wanita', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('pria_sehat', 'Taruna Pria Sehat', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('pria_covid', 'Taruna Pria Terpapar Covid', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('pria_ijin', 'Taruna Pria Ijin', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('wanita_sehat', 'Taruna Wanita Sehat', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('wanita_covid', 'Taruna Wanita Terpapar Covid', 'required|regex_match[/^[0-9\-\+]+$/]');
        $this->form_validation->set_rules('wanita_ijin', 'Taruna Wanita Ijin', 'required|regex_match[/^[0-9\-\+]+$/]');

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_transaksi', TRUE));
        } else {
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
            );
            $this->Absensi_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('transaksi'));
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
        if($_GET['date']){ $tgl = $_GET['date'];}else{ $tgl=""; } 
        //$a=$this->Absensi_model->get_absensi_by($tgl);
        //echo '<pre>';print_r($a);echo '</pre>';die();

        $this->load->helper('exportexcel');
        $namaFile = "absensi_taruna.xls";
        $judul = "Absensi Taruna";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Nama Instansi");
        xlsWriteLabel($tablehead, $kolomhead++, "Lokasi");
        xlsWriteLabel($tablehead, $kolomhead++, "Tgl. Absensi");
        xlsWriteLabel($tablehead, $kolomhead++, "Jumlah Taruna");
        xlsWriteLabel($tablehead, $kolomhead++, "Jumlah Taruni");
        xlsWriteLabel($tablehead, $kolomhead++, "Taruna Pria Sehat");
        xlsWriteLabel($tablehead, $kolomhead++, "Taruna Pria Terpapar");
        xlsWriteLabel($tablehead, $kolomhead++, "Taruna Pria Sakit/Ijin");
        xlsWriteLabel($tablehead, $kolomhead++, "Taruna Wanita Sehat");
        xlsWriteLabel($tablehead, $kolomhead++, "Taruna Wanita Terpapar");
        xlsWriteLabel($tablehead, $kolomhead++, "Taruna Wanita Sakit/Ijin");

        foreach ($this->Absensi_model->get_absensi_by($tgl) as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->kampus);
            xlsWriteLabel($tablebody, $kolombody++, $data->lokasi);
            xlsWriteLabel($tablebody, $kolombody++, $data->tgl_absensi);
            xlsWriteNumber($tablebody, $kolombody++, $data->jumlah_taruna);
            xlsWriteNumber($tablebody, $kolombody++, $data->jumlah_taruna_wanita);
            xlsWriteNumber($tablebody, $kolombody++, $data->pria_sehat);
            xlsWriteNumber($tablebody, $kolombody++, $data->pria_covid);
            xlsWriteNumber($tablebody, $kolombody++, $data->pria_ijin);
            xlsWriteNumber($tablebody, $kolombody++, $data->wanita_sehat);
            xlsWriteNumber($tablebody, $kolombody++, $data->wanita_covid);
            xlsWriteNumber($tablebody, $kolombody++, $data->wanita_ijin);

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
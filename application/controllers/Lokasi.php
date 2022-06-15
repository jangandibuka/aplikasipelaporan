<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lokasi extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Lokasi_model');        
        $this->load->library('form_validation');
        chek_session();
    }

    public function index() {
        $uid = $this->session->userdata('user_id'); 
        $k = $this->ion_auth_model->get_by_id($uid);

        $lokasi = $this->Lokasi_model->get_all();
        $data = array(
            'lokasi_data' => $lokasi,
            'pic' => '',
        );

        $this->template->display('lokasi/tb_lokasi_list', $data);
    }

    public function read($id) {
        $row = $this->Propinsi_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'kota' => $row->kota,
            );
            $this->template->display('kota/tb_kota_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kota'));
        }
    }

    public function create() {
        $uid = $this->session->userdata('user_id');        
        $k = $this->ion_auth_model->get_by_id($uid);
        $data = array(
            'button' => 'Create',
            'action' => site_url('lokasi/create_action'),
            'id' => set_value('id'),
            'lokasi' => set_value('lokasi'),
            'tab_name' => set_value('tab_name'),
            'tab_first' => set_value('tab_first'),
            'on_dashboard' => set_value('on_dashboard'),
            'is_active' => set_value('is_active'),
            'uid' => $uid, 
            'pic' => '',
        );
         $this->template->display('lokasi/tb_lokasi_form', $data);
    }

    public function create_action() {
        $uid = $this->session->userdata('user_id');
        $this->form_validation->set_rules('lokasi', 'Nama Lokasi', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $this->create(); 
        } else { 
            $data = array(
                'lokasi' => $this->input->post('lokasi', TRUE),
                'is_active' => $this->input->post('is_active', TRUE),
                'tab_name' => $this->input->post('tab_name', TRUE),
                'tab_first' => $this->input->post('tab_first', TRUE),
                'on_dashboard' => $this->input->post('on_dashboard', TRUE),
                'is_active' => $this->input->post('is_active', TRUE),
                'created_by' => $this->session->userdata('user_id'),
                'uid' => $uid,
            );

            $this->Lokasi_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('lokasi'));
        }
    }

    public function update($id) {
        $uid = $this->session->userdata('user_id');        
        $k = $this->ion_auth_model->get_by_id($uid);
        $row = $this->Lokasi_model->get_by_id($id);
        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('lokasi/update_action'),
                'id'     => set_value('id', $row->id),
                'lokasi'      => set_value('lokasi', $row->lokasi),
                'is_active'   => set_value('is_active', $row->is_active),
                'tab_name'   => set_value('tab_name', $row->tab_name),
                'tab_first'   => set_value('tab_first', $row->tab_first),
                'on_dashboard'   => set_value('is_active', $row->on_dashboard),
                'uid' => $this->session->userdata('user_id'),
                'pic' => '',
            );
             $this->template->display('lokasi/tb_lokasi_form', $data);
        } else { 
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('lokasi'));
        }
    }

    public function update_action() {
        $uid = $this->session->userdata('user_id');        
        $k = $this->ion_auth_model->get_by_id($uid);

        $this->form_validation->set_rules('lokasi', 'Nama Lokasi', 'required');
        $this->form_validation->set_rules('tab_name', 'Nama Tab', 'required');
        $this->form_validation->set_rules('tab_first', 'Urutan Tab', 'required');
        if ($this->form_validation->run() == FALSE) { 
            $this->update($this->input->post('id', TRUE));
        } else { 
            $data = array(
                'id'        => $this->input->post('id', TRUE),
                'lokasi'    => $this->input->post('lokasi', TRUE),
                'is_active' => $this->input->post('is_active', TRUE),
                'tab_name' => $this->input->post('tab_name', TRUE),
                'tab_first' => $this->input->post('tab_first', TRUE),
                'on_dashboard' => $this->input->post('on_dashboard', TRUE),
            );
            $this->Lokasi_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('lokasi'));
        }
    }

    public function delete($id) {
        $row = $this->Kampus_model->get_by_id($id);

        if ($row) {
            $this->Kota_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('kota'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kota'));
        }
    }

    public function _rules() {
        $this->form_validation->set_rules('kampus', 'Nama Kampus', 'trim|required');
        $this->form_validation->set_rules('pimpinan', 'Pimpinan Kampus', 'trim|required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('id_propinsi', 'id_propinsi', 'trim|required');
        $this->form_validation->set_rules('id_kota', 'id_kota', 'trim|required');
        $this->form_validation->set_rules('is_active', 'is_active', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-red">', '</span>');
    }

    public function excel() {
        $this->load->helper('exportexcel');
        $namaFile = "daftar_lokasi.xls";
        $judul = "Daftar Lokasi";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Nama Lokasi");
        xlsWriteLabel($tablehead, $kolomhead++, "Nama Tab");
        xlsWriteLabel($tablehead, $kolomhead++, "Tab Aktif");
        xlsWriteLabel($tablehead, $kolomhead++, "Tampil di Dashboard");
        xlsWriteLabel($tablehead, $kolomhead++, "Status");

        foreach ($this->Lokasi_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->lokasi);
            xlsWriteLabel($tablebody, $kolombody++, $data->tab_name);
            xlsWriteLabel($tablebody, $kolombody++, ($data->tab_first ==1)?"Tab Aktif":"Tab Selanjutnya");
            xlsWriteLabel($tablebody, $kolombody++, ($data->on_dashboard==1)?"Tampil":"Tidak");
            xlsWriteLabel($tablebody, $kolombody++, ($data->is_active==1)?"Aktif":"Tidak");

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Pelanggan.php */
/* Location: ./application/controllers/Pelanggan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-05-14 11:09:25 */
/* http://harviacode.com */
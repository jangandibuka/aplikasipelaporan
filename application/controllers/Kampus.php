<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kampus extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Kampus_model');
        $this->load->model('Propinsi_model');
        $this->load->model('Kota_model');
        $this->load->model('Instansi_model');
        $this->load->library('form_validation');
        chek_session();
    }

    public function index()
    {
        $kampus = $this->Kampus_model->get_all();

        $data = array(
            'kampus_data' => $kampus,
            'pic' => ''
        );

        $this->template->display('kampus/tb_kampus_list', $data);
    }

    public function read($id)
    {
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

    public function create()
    {
        $uid = $this->session->userdata('user_id');
        $data = array(
            'button' => 'Create',
            'action' => site_url('kampus/create_action'),
            'id' => set_value('id'),
            'kampus' => set_value('kampus'),
            'pimpinan' => set_value('pimpinan'),
            'alamat' => set_value('alamat'),
            'email' => set_value('email'),
            'id_propinsi' => set_value('id_propinsi'),
            'id_kota' => set_value('id_kota'),
            'longitude' => set_value('longitude'),
            'latitude' => set_value('latitude'),
            'id_instansi_type' => set_value('id_instansi_type'),
            'uid' => $uid,
            'pic' => ''
        );
        $data['propinsi'] = $this->db->get_where('mst_propinsi', array('uid' => $uid))->result();
        $data['instansi'] = $this->Instansi_model->get_all();
        $data['kota'] = $this->Kota_model->get_all();
        $this->template->display('kampus/tb_kampus_form', $data);
    }

    public function create_action()
    {
        //$this->_rules();
        $this->form_validation->set_rules('kampus', 'Nama Kampus', 'required');
        $this->form_validation->set_rules('pimpinan', 'Nama Pimpinan Kampus', 'required');
        $this->form_validation->set_rules('id_propinsi', 'Provinsi', 'required');
        $this->form_validation->set_rules('id_kota', 'Kota', 'required');
        $this->form_validation->set_rules('id_instansi_type', 'Type Instansi', 'required');
        $this->form_validation->set_rules('is_active', 'Status Kampus', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'kampus' => $this->input->post('kampus', TRUE),
                'pimpinan' => $this->input->post('pimpinan', TRUE),
                'alamat' => $this->input->post('alamat', TRUE),
                'email' => $this->input->post('email', TRUE),
                'id_propinsi' => $this->input->post('id_propinsi', TRUE),
                'id_kota' => $this->input->post('id_kota', TRUE),
                'longitude' => $this->input->post('longitude', TRUE),
                'latitude' => $this->input->post('latitude', TRUE),
                'is_active' => $this->input->post('is_active', TRUE),
                'id_instansi_type' => $this->input->post('id_instansi_type', TRUE),
                'created_by' => $this->session->userdata('user_id'),
                'uid' => $this->session->userdata('user_id'),
            );

            $this->Kampus_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('kampus'));
        }
    }

    public function update($id)
    {
        $uid = $this->session->userdata('user_id');
        $row = $this->Kampus_model->get_by_id($id);
        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('kampus/update_action'),
                'id'     => set_value('id', $row->id),
                'kampus'      => set_value('kampus', $row->kampus),
                'pimpinan'    => set_value('pimpinan', $row->pimpinan),
                'alamat'    => set_value('pimpinan', $row->alamat),
                'email'    => set_value('pimpinan', $row->email),
                'id_propinsi' => set_value('id_propinsi', $row->id_propinsi),
                'id_kota'     => set_value('id_kota', $row->id_kota),
                'longitude'     => set_value('longitude', $row->longitude),
                'latitude'     => set_value('latitude', $row->latitude),
                'is_active'   => set_value('is_active', $row->is_active),
                'id_instansi_type'   => set_value('id_instansi_type', $row->id_instansi_type),
                'uid' => $this->session->userdata('user_id'),
                'pic' => ''
            );
            $data['propinsi'] = $this->db->get_where('mst_propinsi', array('uid' => $uid))->result();
            $data['kota'] = $this->Kota_model->get_all();
            $data['instansi'] = $this->Instansi_model->get_all();
            //print_r($data['kota']);die();
            $this->template->display('kampus/tb_kampus_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kampus'));
        }
    }

    public function update_action()
    {
        //$this->_rules();
        $this->form_validation->set_rules('kampus', 'Nama Kampus', 'required');
        $this->form_validation->set_rules('pimpinan', 'Nama PIC', 'required');
        $this->form_validation->set_rules('email', 'email', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'kampus' => $this->input->post('kampus', TRUE),
                'pimpinan' => $this->input->post('pimpinan', TRUE),
                'email' => $this->input->post('email', TRUE),
                'id_propinsi' => $this->input->post('id_propinsi', TRUE),
                'id_kota' => $this->input->post('id_kota', TRUE),
                'longitude' => $this->input->post('longitude', TRUE),
                'latitude' => $this->input->post('latitude', TRUE),
                'alamat' => $this->input->post('alamat', TRUE),
            );
            $this->Kampus_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('kampus'));
        }
    }

    public function delete($id)
    {
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

    public function _rules()
    {
        $this->form_validation->set_rules('kampus', 'Nama Kampus', 'trim|required');
        $this->form_validation->set_rules('pimpinan', 'Pimpinan Kampus', 'trim|required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('id_propinsi', 'id_propinsi', 'trim|required');
        $this->form_validation->set_rules('id_kota', 'id_kota', 'trim|required');
        $this->form_validation->set_rules('is_active', 'is_active', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-red">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "daftar_instansi.xls";
        $judul = "DAFTAR INSTANSI";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Tipe Instansi");
        xlsWriteLabel($tablehead, $kolomhead++, "PIC Instansi");
        xlsWriteLabel($tablehead, $kolomhead++, "Alamat Instansi");
        xlsWriteLabel($tablehead, $kolomhead++, "Email");
        xlsWriteLabel($tablehead, $kolomhead++, "Propinsi");
        xlsWriteLabel($tablehead, $kolomhead++, "Kota");
        xlsWriteLabel($tablehead, $kolomhead++, "Latitude");
        xlsWriteLabel($tablehead, $kolomhead++, "Longitude");
        xlsWriteLabel($tablehead, $kolomhead++, "Status");

        foreach ($this->Kampus_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->kampus);
            xlsWriteLabel($tablebody, $kolombody++, $data->instansi);
            xlsWriteLabel($tablebody, $kolombody++, $data->pimpinan);
            xlsWriteLabel($tablebody, $kolombody++, $data->alamat);
            xlsWriteLabel($tablebody, $kolombody++, $data->email);
            xlsWriteLabel($tablebody, $kolombody++, $data->propinsi);
            xlsWriteLabel($tablebody, $kolombody++, $data->kota);
            xlsWriteLabel($tablebody, $kolombody++, $data->latitude);
            xlsWriteLabel($tablebody, $kolombody++, $data->longitude);
            xlsWriteLabel($tablebody, $kolombody++, ($data->is_active == 1)?"Aktif":"Tidak Aktif");

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }
}

/* End of file Kampus.php */
/* Location: ./application/controllers/Kampus.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-05-14 11:09:25 */
/* http://harviacode.com */
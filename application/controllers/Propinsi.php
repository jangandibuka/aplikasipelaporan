<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Propinsi extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Propinsi_model');
        $this->load->library('form_validation');
        chek_session();
    }

    public function index()
    {
        $propinsi = $this->Propinsi_model->get_all();

        $data = array(
            'propinsi_data' => $propinsi,
            'pic' => ''
        );

        $this->template->display('propinsi/tb_propinsi_list', $data);
    }

    public function read($id)
    {
        $row = $this->Propinsi_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id_pelanggan,
                'propinsi' => $row->nama_pelanggan,
            );
            $this->template->display('propinsi/tb_propinsi_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('propinsi'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('propinsi/create_action'),
            'id' => set_value('id'),
            'propinsi' => set_value('propinsi'),
            'pic' => ''
        );
        $this->template->display('propinsi/tb_propinsi_form', $data);
    }

    public function create_action()
    {

        $this->form_validation->set_rules('propinsi', 'Propinsi', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'propinsi' => $this->input->post('propinsi', TRUE),
                'uid' => $this->session->userdata('user_id'),
            );

            $this->Propinsi_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('propinsi'));
        }
    }

    public function update($id)
    {
        $row = $this->Propinsi_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('pelanggan/update_action'),
                'id_pelanggan' => set_value('id_pelanggan', $row->id_pelanggan),
                'nama_pelanggan' => set_value('nama_pelanggan', $row->nama_pelanggan),
                'alamat' => set_value('alamat', $row->alamat),
                'no_telpn' => set_value('no_telpn', $row->no_telpn),
            );
            $this->template->display('pelanggan/tb_pelanggan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pelanggan'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_pelanggan', TRUE));
        } else {
            $data = array(
                'nama_pelanggan' => $this->input->post('nama_pelanggan', TRUE),
                'alamat' => $this->input->post('alamat', TRUE),
                'no_telpn' => $this->input->post('no_telpn', TRUE),
            );

            $this->Pelanggan_model->update($this->input->post('id_pelanggan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pelanggan'));
        }
    }

    public function delete($id)
    {
        $row = $this->Pelanggan_model->get_by_id($id);

        if ($row) {
            $this->Pelanggan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('pelanggan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pelanggan'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('propinsi', 'nama pelanggan', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-red">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "daftar_propinsi.xls";
        $judul = "DAFTAR PROPINSI";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Nama Propinsi");

        foreach ($this->Propinsi_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->propinsi);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }
}

/* End of file Propinsi.php */
/* Location: ./application/controllers/Propinsi.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-05-14 11:09:25 */
/* http://harviacode.com */
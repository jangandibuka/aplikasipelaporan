<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kota extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Kota_model');
        $this->load->library('form_validation');
        chek_session();
    }

    public function index() {
        $kota = $this->Kota_model->get_all();

        $data = array(
            'kota_data' => $kota
        );

        $this->template->display('kota/tb_kota_list', $data);
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
        $data = array(
            'button' => 'Create',
            'action' => site_url('kota/create_action'),
            'id' => set_value('id'),
            'kota' => set_value('kota'),
        );
        $this->template->display('kota/tb_kota_form', $data);
    }

    public function create_action() {

        $this->form_validation->set_rules('kota', 'Kota', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->create(); 
        } else {
            $data = array(
                'kota' => $this->input->post('kota', TRUE),
                'uid' => $this->session->userdata('user_id'),
            );

            $this->Kota_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('kota'));
        }
    }

    public function update($id) {
        $row = $this->Kota_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('kota/update_action'),
                'id' => set_value('id', $row->id),
                'kota' => set_value('kota', $row->kota),
            );
            $this->template->display('kota/tb_kota_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kota'));
        }
    }

    public function update_action() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'kota' => $this->input->post('kota', TRUE),
            );

            $this->Kota_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('kota'));
        }
    }

    public function delete($id) {
        $row = $this->Kota_model->get_by_id($id);

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
        $this->form_validation->set_rules('kota', 'Nama Kota/Kabupaten', 'trim|required');
        /*$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
        $this->form_validation->set_rules('no_telpn', 'no telp', 'trim|required|regex_match[/^[0-9\-\+]+$/]|max_length[15]');
        $this->form_validation->set_rules('id_pelanggan', 'id_pelanggan', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-red">', '</span>');
        */
    }

    function get_kotakabupaten(){
        $id = $this->input->post('id_propinsi');
        $kota = $this->Kota_model->get_kotakabupaten($id);

        $lists = "<option value=''>Pilih Kota/Kabupaten</option>";
        foreach($kota as $data){
          $lists .= "<option value='".$data->id."'>".$data->kota."</option>"; // Tambahkan tag option ke variabel $lists
        }
        $callback = array('list_kota'=>$lists); // Masukan variabel lists tadi ke dalam array $callback dengan index array : list_kota
        echo json_encode($callback); // konversi varibael $callback menjadi JSON
    }

    public function excel() {
        $this->load->helper('exportexcel');
        $namaFile = "daftar_kabupaten.xls";
        $judul = "DAFTAR KABUPATEN";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Nama Kota/Kabupaten");

        foreach ($this->Kota_model->get_all_propkota() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->propinsi);
            xlsWriteLabel($tablebody, $kolombody++, $data->kota);

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
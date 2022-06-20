<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Kampus_model');
        $this->load->model('aksesinstansi_model');
        $this->load->model('ion_auth_model');
        chek_session();
    }

    function index()
    {
        $data['title'] = "Home";
        $uid = $this->session->userdata('user_id');
        $k = $this->ion_auth_model->get_by_id($uid);
        $row = $this->Kampus_model->get_by_id($k->id_kampus);
        if ($this->ion_auth->is_admin()) {
            $data['user'] = $this->db->get('tb_users')->num_rows();
            // $data['jumlah_kampus'] = $this->db->query("SELECT count(*) AS jumlah_kampus FROM mst_kampus")->result();
            // $data['kampus_aktif'] = $this->db->query("SELECT count(*) AS kampus_aktif FROM mst_kampus WHERE is_active=1")->result();
            $data['kampus'] = $this->Kampus_model->get_new_kampus();
            $data['pic'] = '';

            $tgl = date('Y-m-d');
            // $absensi = $this->db->query("select lokasi, sum(jumlah_taruna) as jumlah_taruna from (
            //     select ml.lokasi, sum(ta.jumlah_taruna) as jumlah_taruna from trx_absensi ta 
            //     join mst_lokasi ml on ta.id_lokasi = ml.id
            //     where ta.tgl_absensi = '" . $tgl . "' AND ml.is_active=1 AND ml.on_dashboard=1
            //     group by ml.lokasi, ta.jumlah_taruna
            //     ) as x
            //     group by lokasi;")->result();
            // $terpapar = $this->db->query("select mk.kampus, mk.latitude, mk.longitude,  sum(ta.pria_covid + ta.wanita_covid) as terpapar  from trx_absensi ta 
            // 	join mst_lokasi ml on ta.id_lokasi = ml.id
            // 	join mst_kampus mk on ta.id_kampus = mk.id 
            // 	where ta.tgl_absensi = '" . $tgl . "' AND ml.is_active=1 AND ml.on_dashboard=1
            // 	group by mk.kampus, mk.latitude, mk.longitude;")->result();

            // $data['absensi'] = $absensi;
            // $data['terpapar'] = $terpapar;
            $this->template->display('dashboard/admin_dashboard', $data);
        } else {
            $data['judul'] = "Perbandingan Pegawai sudah vaksinasi";
            $vaksin1 = $this->db->query("SELECT sum(vaksin1) as count
                from trx_absensi_pegawai GROUP BY DAY(created_date) ORDER BY created_date");
            $data['vaksin1'] = json_encode(array_column($vaksin1->result(), 'count'), JSON_NUMERIC_CHECK);
            $vaksin2 = $this->db->query("SELECT sum(vaksin2) as count
                from trx_absensi_pegawai GROUP BY DAY(created_date) ORDER BY created_date");
            $data['vaksin2'] = json_encode(array_column($vaksin2->result(), 'count'), JSON_NUMERIC_CHECK);
            $vaksinLain = $this->db->query("SELECT sum(vaksin_lain) as count
                from trx_absensi_pegawai GROUP BY DAY(created_date) ORDER BY created_date");
            $data['vaksinLain'] = json_encode(array_column($vaksinLain->result(), 'count'), JSON_NUMERIC_CHECK);
            $query = $this->db->query("SELECT tgl_absensi from trx_absensi_pegawai group by tgl_absensi order by tgl_absensi ASC");
            $data['user'] = $this->db->get('tb_users')->num_rows();
            $data['pic'] = $row->kampus;

            $day = array();
            $d = "[";
            foreach ($query->result_array() as $row) {
                $d .= "'" . $row['tgl_absensi'] . "',";
            }
            $hari = substr($d, 0, -1) . "]";
            //echo $hari;
            //echo '<pre>';print_r($day);echo '</pre>';die();
            $data['hari'] = $hari;

            $data_akses = $this->aksesinstansi_model->get_data_instansi_absensi($uid);
            $no_kampus = 0;
            $no_pegawai = 0;
            foreach ($data_akses as $item) {
                if ($item->type_instansi == 'Kampus') {
                    $no_kampus++;
                } else {
                    $no_pegawai++;
                }
            }

            $data['akses_kampus'] = $no_kampus > 0;
            $data['akses_pegawai'] = $no_pegawai > 0;


            $this->template->display('dashboard/member', $data);
        }
    }

    function get_data()
    {
        $tgl = $this->input->post('tanggal', true); //date('Y-m-d');
        if ($this->ion_auth->is_admin()) {
            $where = '';
            $where_instansi = '';
        } else {
            $uid = $this->session->userdata('user_id');
            $data = $this->aksesinstansi_model->get_data_instansi_absensi($uid);
            $data_id = array();
            foreach ($data as $item) {
                if ($item->type_instansi == 'Kampus') {
                    array_push($data_id, $item->id_instansi);
                }
            }
            $where = " AND ta.id_kampus IN(" . join(',', $data_id) . ")";
            $where_instansi = " AND id IN(" . join(',', $data_id) . ")";
        }
        if ($tgl != '') {
            $absensi = $this->db->query("select
                lokasi,
                COALESCE(sum(jumlah_taruna), 0) as jumlah_taruna,
                COALESCE(sum(jumlah_pria), 0) as jumlah_pria,
                COALESCE(sum(jumlah_taruna_wanita), 0) as jumlah_taruna_wanita,
                COALESCE(sum(sehat), 0) as sehat,
                COALESCE(sum(sehat_pria), 0) as sehat_pria,
                COALESCE(sum(sehat_wanita), 0) as sehat_wanita,
                COALESCE(sum(covid), 0) as covid,
                COALESCE(sum(covid_pria), 0) as covid_pria,
                COALESCE(sum(covid_wanita), 0) as covid_wanita,
                COALESCE(sum(ijin), 0) as ijin,
                COALESCE(sum(ijin_pria), 0) as ijin_pria,
                COALESCE(sum(ijin_wanita), 0) as ijin_wanita
                from (
                    select ml.lokasi,
                    sum(ta.pria_sehat + ta.wanita_sehat + ta.pria_covid + ta.wanita_covid + ta.pria_ijin + ta.wanita_ijin ) as jumlah_taruna,
                    sum(ta.jumlah_taruna) as jumlah_pria,
                    sum(ta.wanita_sehat + ta.wanita_covid + ta.wanita_ijin) as jumlah_taruna_wanita,
                    sum(ta.pria_sehat + ta.wanita_sehat) as sehat,
                    sum(ta.pria_sehat) as sehat_pria,
                    sum(ta.wanita_sehat) as sehat_wanita,
                    sum(ta.pria_covid + ta.wanita_covid) as covid,
                    sum(ta.pria_covid) as covid_pria,
                    sum(ta.wanita_covid) as covid_wanita,
                    sum(ta.pria_ijin + ta.wanita_ijin) as ijin,
                    sum(ta.pria_ijin) as ijin_pria,
                    sum(ta.wanita_ijin) as ijin_wanita
                    from mst_lokasi ml
                    left join trx_absensi ta on ta.id_lokasi = ml.id and ta.tgl_absensi = '$tgl' $where
                    where ml.is_active=1 AND ml.on_dashboard=1
                    group by ml.lokasi, ta.jumlah_taruna, ta.jumlah_taruna_wanita, ta.pria_sehat, ta.pria_covid, ta.pria_ijin, ta.wanita_sehat, ta.wanita_ijin, ta.wanita_covid
                ) as x
            group by lokasi
            ")->result();
            $update_taruna = $this->db->query("SELECT ta.id_kampus FROM trx_absensi ta WHERE ta.tgl_absensi='$tgl' $where GROUP BY ta.id_kampus")->num_rows();
            $jumlah_taruna = $this->db->query("SELECT count(id) as jumlah FROM `mst_kampus` WHERE id_instansi_type=1 $where_instansi")->row();
            // $terpapar = $this->db->query("select mk.kampus, mk.latitude, mk.longitude,  sum(ta.pria_covid + ta.wanita_covid) as terpapar  from trx_absensi ta 
            //         join mst_lokasi ml on ta.id_lokasi = ml.id
            //         join mst_kampus mk on ta.id_kampus = mk.id 
            //         where ta.tgl_absensi = '" . $tgl . "' AND ml.is_active=1 AND ml.on_dashboard=1
            //         group by mk.kampus, mk.latitude, mk.longitude;")->result();
            $terpapar_covid = $this->db->query("SELECT 
                ta.tgl_absensi,
                COALESCE(SUM(ta.pria_covid + ta.wanita_covid),0) AS COVID
                FROM trx_absensi ta
                WHERE MONTH(tgl_absensi)=MONTH('$tgl') $where
                GROUP BY tgl_absensi")->result();
        } else {
            $terpapar = [];
            $terpapar_covid = [];
            $update_taruna = 0;
            $absensi = [];
        }

        echo json_encode([
            'absensi' => $absensi,
            'update_taruna' => $update_taruna != null ? $update_taruna : '0',
            'jumlah_taruna' => $jumlah_taruna->jumlah,
            'terpapar_covid' => $terpapar_covid
        ]);
    }

    function get_data_kantor()
    {
        $tgl = $this->input->post('tanggal', true); //date('Y-m-d');

        if ($this->ion_auth->is_admin()) {
            $where = '';
            $where_instansi = '';
        } else {
            $uid = $this->session->userdata('user_id');
            $data = $this->aksesinstansi_model->get_data_instansi_absensi($uid);
            $data_id = array();
            foreach ($data as $item) {
                if ($item->type_instansi != 'Kampus') {
                    array_push($data_id, $item->id_instansi);
                }
            }
            $where = " AND ta.id_kampus IN(" . join(',', $data_id) . ")";
            $where_instansi = " AND id IN(" . join(',', $data_id) . ")";
        }

        if ($tgl != '') {
            $sql = "SELECT
            COALESCE(SUM(jumlah_pegawai), 0) as jumlah_pegawai,
            COALESCE(SUM(wfo + wfh + dinas_luar + tugas_belajar),0) as sehat,
            COALESCE(SUM(covid),0) as covid,
            COALESCE(SUM(ijin + cuti),0) as ijin,
            COALESCE(SUM(wfo),0) as wfo,
            COALESCE(SUM(wfh),0) as wfh,
            COALESCE(SUM(isoman),0) as sakit,
            COALESCE(SUM(dinas_luar),0) as dinas_luar,
            COALESCE(SUM(vaksin1),0) as vaksin1,
            COALESCE(SUM(vaksin2),0) as vaksin2,
            COALESCE(SUM(vaksin_lain),0) as vaksin_lain,
            COALESCE(SUM(cuti),0) as cuti
            from trx_absensi_pegawai ta
            WHERE tgl_absensi='$tgl' $where";
            $absensi = $this->db->query($sql)->row();
            $update_kantor = $this->db->query("SELECT id_kampus FROM trx_absensi_pegawai WHERE tgl_absensi='$tgl' GROUP BY id_kampus")->num_rows();
            $jumlah_kantor = $this->db->query("SELECT count(id) as jumlah FROM `mst_kampus` WHERE id_instansi_type=2 $where_instansi")->row();
        } else {
            $absensi = array(
                "covid" => "0",
                "ijin" => "0",
                "jumlah_pegawai" => "0",
                "sehat" => "0",
                "vaksin1" => "0",
                "vaksin2" => "0",
                "vaksin_lain" => "0",
                "sakit" => "0"
            );
            $update_kantor = 0;
        }

        echo json_encode([
            'absensi' => $absensi,
            'update_kantor' => $update_kantor,
            'jumlah_kantor' => $jumlah_kantor->jumlah
        ]);
    }
}

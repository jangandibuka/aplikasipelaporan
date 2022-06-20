<script src="<?php echo base_url('assets/js/jquery-1.12.0.min.js') ?>"></script>
<section class='content-header'>
    <h1>
        ABSENSI INSTANSI
        <small>Tambah Absensi INSTANSI</small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Reporting</a></li>
        <li class='active'>Tambah Absensi</li>
    </ol>
</section>

<section class="content d-flex align-items-center w-100">
    <div class="row">
        <div class="contaienr">
            <div class="col-md-8 d-flex align-items-center w-100">

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Tambah Absensi</h3>

                        <div class="box-tools pull-right">
                            <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="form-group">
                            <label>Pilih Instansi</label>
                            <select class="form-control" id="instansi">
                                <option value="">-- Pilih Instansi --</option>
                            </select>
                        </div>
                        <hr />
                        <div id="view-load-absensi">
                            <div class="view-kampus" style="display: none;">
                                <?php $this->load->view('aksesinstansi/absensi/kampus') ?>
                            </div>
                            <div class="view-kantor" style="display: none;">
                                <?php $this->load->view('aksesinstansi/absensi/kantor') ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>


<script>
    $(document).ready(function() {
        var base_url = '<?php echo base_url() ?>';
        var select = '#instansi';
        var elmSelect = $(select);
        var view = '#view-load-absensi';
        var elmView = $(view);
        var aksesUser = 'aksesUser';

        if (localStorage.getItem(aksesUser)) {
            var data = localStorage.getItem(aksesUser);
            var value = data.split('|');
            if (value[1] == 'kantor') {
                $(`.view-kampus`).hide();
                $(`.view-kantor`).show();
            } else if (value[1] == 'kampus') {
                $(`.view-kampus`).show();
                $(`.view-kantor`).hide();
            } else {
                $(`.view-kampus`).hide();
                $(`.view-kantor`).hide();
            }
        }

        elmSelect.change(function(e) {
            var data = e.target.value;
            var value = data.split('|');
            localStorage.setItem(aksesUser, data);
            if (value[1] == 'kantor') {
                $(`.view-kampus`).hide();
                $(`.view-kantor`).show();
            } else if (value[1] == 'kampus') {
                $(`.view-kampus`).show();
                $(`.view-kantor`).hide();
            } else {
                $(`.view-kampus`).hide();
                $(`.view-kantor`).hide();
            }

            $('.form-absensi .form-control').val('');
            $('.form-absensi .datepicker').val('<?php echo date('Y-m-d') ?>');
            $('.form-absensi .text-red').html('');
            $('.form-absensi-pegawai .form-control').val('');
            $('.form-absensi-pegawai .datepicker').val('<?php echo date('Y-m-d') ?>');
            $('.form-absensi-pegawai .text-red').html('');
        })

        var action = {
            getDataSelect: function() {
                $.ajax({
                    url: base_url + '/aksesinstansi/options_absensi',
                    beforeSend: function() {
                        generateHtml.select.loading(true);
                    },
                    success: function(response) {
                        var data = JSON.parse(response);
                        generateHtml.select.init(data);
                    }
                })
            },
            getView: function(id_instansi = '', type = '', id = '') {
                $.ajax({
                    url: base_url + '/aksesinstansi/view_absensi',
                    method: 'POST',
                    data: {
                        instansi: id_instansi,
                        type: type,
                        id: id
                    },
                    beforeSend: function() {

                    },
                    success: function(response) {
                        elmView.html(response);
                    }
                })
            }
        }

        var generateHtml = {
            select: {
                init: function(data) {
                    var html = '<option value="">Pilih Instansi/Kampus</option>';
                    // var html = '';
                    data.map(function(item) {

                        var value = `${item.id_instansi}|${item.type_instansi.toLowerCase()}`;
                        var selected = value == localStorage.getItem(aksesUser) ? 'selected="selected"' : '';
                        html += `<option value="${value}" ${selected}>${item.kampus} (${item.type_instansi})</option>`;
                    });

                    elmSelect.html(html);
                    this.loading(false);
                },
                loading: function(status = false) {
                    elmSelect.attr('disabled', status);
                }
            }
        }
        // action.init();

        $('.form-absensi').on('submit', function(e) {
            e.preventDefault();
            var id_kampus = elmSelect.val().split('|')[0];
            var elmForm = {
                tgl_absensi: e.target.tgl_absensi,
                jumlah_taruna: e.target.jumlah_taruna,
                jumlah_taruna_wanita: e.target.jumlah_taruna_wanita,
                pria_sehat: e.target.pria_sehat,
                pria_covid: e.target.pria_covid,
                pria_ijin: e.target.pria_ijin,
                wanita_sehat: e.target.wanita_sehat,
                wanita_covid: e.target.wanita_covid,
                wanita_ijin: e.target.wanita_ijin,
            }
            var idForm = $(this).attr('id');
            $.ajax({
                url: base_url + '/aksesinstansi/action_absensi_kampus',
                method: 'POST',
                data: {
                    tgl_absensi: elmForm.tgl_absensi.value,
                    jumlah_taruna: elmForm.jumlah_taruna.value,
                    jumlah_taruna_wanita: elmForm.jumlah_taruna_wanita.value,
                    pria_sehat: elmForm.pria_sehat.value,
                    pria_covid: elmForm.pria_covid.value,
                    pria_ijin: elmForm.pria_ijin.value,
                    wanita_sehat: elmForm.wanita_sehat.value,
                    wanita_covid: elmForm.wanita_covid.value,
                    wanita_ijin: elmForm.wanita_ijin.value,
                    id_lokasi: e.target.id_lokasi.value,
                    // input_manual_taruna: e.target.jumlah_taruna_pria_manual.value,
                    // input_manual_taruni: e.target.jumlah_taruna_wanita_manual.value,
                    id_kampus: id_kampus
                },
                beforeSend: function() {
                    var errorMessage = Object.keys(elmForm);
                    errorMessage.map(function(i) {
                        $(`#${idForm} .error-${i}`).html('')
                    })
                    $(`#${idForm} button`).attr('disabled', true);
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    if (data.code == 0) {
                        var errorMessage = Object.keys(data.message);
                        errorMessage.map(function(i) {
                            $(`#${idForm} .error-${i}`).html(data.message[i])
                        })
                    } else {
                        // window.alert(data.message);
                        Swal.fire({
                            // position: 'top-end',
                            title: 'Info',
                            icon: 'success',
                            text: data.message,
                            showConfirmButton: false,
                            timer: 2500
                        });
                        $('.form-absensi .form-control').val('');
                    }

                    $(`#${idForm} button`).attr('disabled', false);
                }
            })
        })

        $('.form-absensi-pegawai').on('submit', function(e) {
            e.preventDefault();
            var id_kampus = elmSelect.val().split('|')[0];
            var elmForm = {
                tgl_absensi: e.target.tgl_absensi,
                id_pegawai_type: e.target.id_pegawai_type,
                sehat: e.target.sehat,
                covid: e.target.covid,
                ijin: e.target.ijin,
                wfo: e.target.wfo,
                jumlah_pegawai: e.target.jumlah_pegawai,
                wfh: e.target.wfh,
                dinas_luar: e.target.dinas_luar,
                tugas_belajar: e.target.tugas_belajar,
                cuti: e.target.cuti,
                isoman: e.target.isoman,
                dirawat: e.target.dirawat,
                vaksin1: e.target.vaksin1,
                vaksin2: e.target.vaksin2,
                vaksin_lain: e.target.vaksin_lain,
            }
            // var idForm = $(this).attr('id');
            $.ajax({
                url: base_url + '/aksesinstansi/action_absensi_pegawai',
                method: 'POST',
                data: {
                    tgl_absensi: elmForm.tgl_absensi.value,
                    id_pegawai_type: elmForm.id_pegawai_type.value,
                    sehat: elmForm.sehat.value,
                    covid: elmForm.covid.value,
                    ijin: elmForm.ijin.value,
                    wfo: elmForm.wfo.value,
                    jumlah_pegawai: elmForm.jumlah_pegawai.value,
                    wfh: elmForm.wfh.value,
                    dinas_luar: elmForm.dinas_luar.value,
                    tugas_belajar: elmForm.tugas_belajar.value,
                    cuti: elmForm.cuti.value,
                    isoman: elmForm.isoman.value,
                    dirawat: elmForm.dirawat.value,
                    vaksin1: elmForm.vaksin1.value,
                    vaksin2: elmForm.vaksin2.value,
                    vaksin_lain: elmForm.vaksin_lain.value,
                    id_kampus: id_kampus
                },
                beforeSend: function() {
                    var errorMessage = Object.keys(elmForm);
                    errorMessage.map(function(i) {
                        $(`.form-absensi-pegawai .error-${i}`).html('')
                    })
                    $(`.form-absensi-pegawai button`).attr('disabled', true);
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    if (data.code == 0) {
                        var errorMessage = Object.keys(data.message);
                        errorMessage.map(function(i) {
                            $(`.form-absensi-pegawai .error-${i}`).html(data.message[i])
                        })
                    } else {
                        Swal.fire({
                            // position: 'top-end',
                            title: 'Info',
                            icon: 'success',
                            text: data.message,
                            showConfirmButton: false,
                            timer: 2500
                        });
                        $('.form-absensi-pegawai .form-control').val('');
                    }

                    $(`.form-absensi-pegawai button`).attr('disabled', false);
                }
            })
        })

        action.getDataSelect();
    })
</script>
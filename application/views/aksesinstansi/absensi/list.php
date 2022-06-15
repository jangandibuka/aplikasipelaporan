<script src="<?php echo base_url('assets/js/jquery-1.12.0.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>

<script>
    @media(min - width: 992 px) {
        .col - md - 5 {
            width: 41.66666667 % ;
            left: -45 px;
        }
    }
</script>

<section class='content-header'>
    <h1>
        DAFTAR ABSENSI PER INSTANSI
        <small>Absensi INSTANSI</small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Reporting</a></li>
        <li class='active'>Daftar Absensi</li>
    </ol>
</section>


<section class="content">

    <div class="box box-primary">

        <div class="box-header with-border">
            <h3 class="box-title">Daftar Data Instansi</h3>

            <div class="box-tools pull-right">
                <?php
                echo
                anchor('transaksi/create/', '<i class="glyphicon glyphicon-plus"></i>Tambah Data', array('class' => 'btn btn-primary btn-sm btn-tambah'))
                    . " " .
                    '<button class="btn btn-primary btn-sm btn-download"><i class="fa fa-file-excel-o"></i> Excel</button>';
                ?>
                <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
            </div>
        </div>

        <div class="box-body">
            <div class="col-md-8">
                <?php $this->view('template/message'); ?>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label>Pilih Instansi</label>
                    <select class="form-control" id="instansi">
                        <option value="">-- Pilih Instansi --</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Tanggal Absensi</label>
                    <input class="form-control date" value="<?php echo date('Y-m-d') ?>" readonly="readonly" />
                </div>
            </div>

            <p>

            <div id="view-load-absensi">
                <div class="view-kampus" style="display: none;">
                    <?php $this->load->view('aksesinstansi/absensi/list_kampus') ?>
                </div>
                <div class="view-kantor" style="display: none;">
                    <?php $this->load->view('aksesinstansi/absensi/list_kantor') ?>
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
        var table_kampus = $("#table-absensi-kampus");
        var table_kantor = $("#table-absensi-kantor");
        var aksesUser = 'aksesUser';

        $('.date').datetimepicker({
            timepicker: false,
            format: 'yyyy-mm-dd',
            endDate: '<?php echo date('Y-m-d') ?>',
            minView: 2,
            autoclose: 1,
        });

        var actions = {
            init: function() {
                this.getDataSelect();
            },
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

        }

        var tableKampus = {
            loadData: function() {
                table_kampus.DataTable({
                    serverSide: true,
                    processing: true,
                    responsive: true,
                    scrollX: true,
                    ajax: {
                        url: base_url + 'aksesinstansi/get_list_absensi_kampus',
                        method: 'POST',
                        data: function(d) {
                            var valSelect = localStorage.getItem(aksesUser) ? localStorage.getItem(aksesUser) : elmSelect.val();
                            d.id = valSelect == '' ? '0' : valSelect.split('|')[0]
                            d.date = $('.date').val();
                            console.log(d[data]);

                        },
                    },
                    order: [
                        [2, "desc"]
                    ],
                    pageLength: 10,
                    // searching: false,
                    columns: [{
                            data: 'number',
                            orderable: false,
                            className: 'text-center',
                            width: '15px'
                        },
                        {
                            data: 'lokasi',
                            orderable: false,
                            className: 'text-left',
                        },
                        {

                            data: 'tgl_absensi',
                            orderable: false,
                            className: 'text-left',
                        },
                        {
                            data: 'jumlah_taruna',
                            orderable: false,
                            className: 'text-center',
                        },
                        {
                            data: 'jumlah_taruna_wanita',
                            orderable: false,
                            className: 'text-center',
                        },
                        {
                            data: 'pria_sehat',
                            orderable: false,
                            className: 'text-center',
                        },
                        {
                            data: 'pria_covid',
                            orderable: false,
                            className: 'text-center',
                        },
                        {
                            data: 'pria_ijin',
                            orderable: false,
                            className: 'text-center',
                        },
                        {
                            data: 'wanita_sehat',
                            orderable: false,
                            className: 'text-center',
                        },
                        {
                            data: 'wanita_covid',
                            orderable: false,
                            className: 'text-center',
                        },
                        {
                            data: 'wanita_ijin',
                            orderable: false,
                            className: 'text-center',
                        },
                        {
                            data: null,
                            orderable: false,
                            render: function(data, type, row) {
                                return '<a href="<?php echo base_url('transaksi/update/') ?>' + row.id + '" class="btn btn-info btn-sm"><i class="fa fa-pencil-square-o"></i> Edit</a>';
                            }
                        }
                    ],
                    fnDrawCallback: function(allRow) {
                        if (localStorage.getItem(aksesUser)) {
                            $('.btn-tambah').show();
                            $('.btn-download').show();
                        } else {
                            $('.btn-tambah').hide();
                            $('.btn-download').hide();
                        }
                        if (allRow.json.recordsTotal) {
                            $('.btn-download').attr('disabled', false);
                        } else {
                            $('.btn-download').attr('disabled', true);
                        }
                    }

                });
            },
            reload: function() {
                table_kampus.DataTable().ajax.reload();
            },
            init: function() {
                if (!jQuery().DataTable) {
                    return;
                }
                let check = $.fn.dataTable.isDataTable('#table-absensi-kampus');

                if (check) {
                    this.reload();
                } else {
                    this.loadData();
                }

            }
        }

        var tableKantor = {
            loadData: function() {
                table_kantor.DataTable({
                    serverSide: true,
                    processing: true,
                    responsive: true,
                    scrollX: true,
                    ajax: {
                        url: base_url + 'aksesinstansi/get_list_absensi_kantor',
                        method: 'POST',
                        data: function(d) {
                            var valSelect = localStorage.getItem(aksesUser) ? localStorage.getItem(aksesUser) : elmSelect.val();
                            d.id = valSelect == '' ? '0' : valSelect.split('|')[0];
                            d.date = $('.date').val();

                        },
                    },
                    order: [
                        [2, "desc"]
                    ],
                    pageLength: 10,
                    // searching: false,
                    columns: [{
                            data: 'number',
                            orderable: false,
                            className: 'text-center',
                            width: '15px'
                        },
                        {
                            data: 'tgl_absensi',
                            orderable: false,
                            className: 'text-left',
                        },
                        {
                            data: 'tipe',
                            orderable: false,
                            className: 'text-left',
                        },
                        {
                            data: 'jumlah_pegawai',
                            orderable: false,
                            className: 'text-left',
                        },
                        {
                            data: 'sehat',
                            orderable: false,
                            className: 'text-left',
                        },
                        {
                            data: 'covid',
                            orderable: false,
                            className: 'text-left',
                        },
                        {
                            data: 'ijin',
                            orderable: false,
                            className: 'text-left',
                        },
                        {
                            data: 'wfo',
                            orderable: false,
                            className: 'text-left',
                        },
                        {
                            data: 'wfh',
                            orderable: false,
                            className: 'text-left',
                        },
                        {
                            data: 'dinas_luar',
                            orderable: false,
                            className: 'text-left',
                        },
                        {
                            data: 'cuti',
                            orderable: false,
                            className: 'text-left',
                        },
                        {
                            data: 'isoman',
                            orderable: false,
                            className: 'text-left',
                        },
                        {
                            data: 'dirawat',
                            orderable: false,
                            className: 'text-left',
                        },
                        {
                            data: 'vaksin1',
                            orderable: false,
                            className: 'text-left',
                        },
                        {
                            data: 'vaksin2',
                            orderable: false,
                            className: 'text-left',
                        },
                        {
                            data: 'vaksin_lain',
                            orderable: false,
                            className: 'text-left',
                        },
                        {
                            data: null,
                            orderable: false,
                            render: function(data, type, row) {
                                return '<a href="<?php echo base_url('pegawai/update/') ?>' + row.id + '" class="btn btn-info btn-sm"><i class="fa fa-pencil-square-o"></i> Edit</a>';
                            }
                        }
                    ],
                    fnDrawCallback: function(allRow) {
                        if (localStorage.getItem(aksesUser)) {
                            $('.btn-tambah').show();
                            $('.btn-download').show();
                        } else {
                            $('.btn-tambah').hide();
                            $('.btn-download').hide();
                        }
                        if (allRow.json.recordsTotal) {
                            $('.btn-download').attr('disabled', false);
                        } else {
                            $('.btn-download').attr('disabled', true);
                        }
                    }

                });
            },
            reload: function() {
                table_kantor.DataTable().ajax.reload();
            },
            init: function() {
                if (!jQuery().DataTable) {
                    return;
                }
                let check = $.fn.dataTable.isDataTable('#table-absensi-kantor');

                if (check) {
                    this.reload();
                } else {
                    this.loadData();
                }

            }
        }

        var generateHtml = {
            select: {
                init: function(data) {
                    var html = '';
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

        actions.init();

        if (localStorage.getItem(aksesUser)) {
            var data = localStorage.getItem(aksesUser);
            var value = data.split('|');

            if (value[1] == 'kantor') {
                $(`.view-kampus`).hide();
                $(`.view-kantor`).show();
                tableKantor.init();
            } else if (value[1] == 'kampus') {
                $(`.view-kampus`).show();
                $(`.view-kantor`).hide();
                tableKampus.init();
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
                tableKantor.init();
            } else if (value[1] == 'kampus') {
                $(`.view-kampus`).show();
                $(`.view-kantor`).hide();
                tableKampus.init();
            } else {
                $(`.view-kampus`).hide();
                $(`.view-kantor`).hide();
            }

        });

        $('.date').change(function(e) {
            if (localStorage.getItem(aksesUser)) {
                var data = localStorage.getItem(aksesUser);
                var value = data.split('|');
                if (value[1] == 'kantor') {
                    tableKantor.init();
                } else if (value[1] == 'kampus') {
                    tableKampus.init();
                }
            }
        })

        $(".btn-download").click(function(event) {
            // var dateFrom = $("#dateFrom").val();
            // var dateTo = $("#dateTo").val();
            // var port_origin = $("#port_origin").val();
            // var port_destination = $("#port_destination").val();
            // var searchData = $('#searchData').val();
            // var searchName = $("#searchData").attr('data-name');

            var url = "";
            if (localStorage.getItem(aksesUser)) {
                var data = localStorage.getItem(aksesUser);
                var value = data.split('|');
                if (value[1] == 'kantor') {
                    url += `<?php echo site_url('pegawai/excel') ?>`;
                } else if (value[1] == 'kampus') {
                    url += `<?php echo site_url('transaksi/excel') ?>`;
                }
                url += `?id_instansi=${value[0]}&date=${$('.date').val()}`;
            }

            console.log('download', url);

            window.location.href = url;
        });

    });
</script>
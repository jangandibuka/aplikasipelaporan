<section class='content-header'>
    <h1>
        ABSENSI SEMUA INSTANSI
        <small>Daftar absensi</small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Transaksi</a></li>
        <li class='active'>Daftar Absensi</li>
    </ol>
</section>
<section class='content'>
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box box-primary'>
                <div class="box-body">
                    <div class='box-header with-border'>
                        <h3 class='box-title'>
                            <!--<input type="submit" name="submit" class="btn btn-primary btn-sm" id="submit_btn" value="Excel" />-->
                            <button class="btn btn-primary btn-sm btn-download"><i class="fa fa-file-excel-o"></i> Excel</button>
                        </h3>
                    </div><!-- /.box-header -->
                    <div class="col-md-3">
                        <div class="form-group" id="tgl_absensi">
                            <label>Tanggal Absensi</label>
                            <input class="form-control date1" value="<?php echo date('Y-m-d') ?>" readonly="readonly" />
                        </div>
                    </div>
                </div>
                <div class='box-body table-responsive'>
                    <table class="table table-bordered table-striped" id="mytablekampusAdmin">
                        <thead>
                            <tr>
                                <th width="80px">No</th>
                                <th>Nama Instansi</th>
                                <th>Lokasi</th>
                                <th>Tgl. Absensi</th>
                                <th>Total Taruna Pria</th>
                                <th>Total Taruna Wanita</th>
                                <th>Taruna Pria Sehat</th>
                                <th>Taruna Pria Terpapar</th>
                                <th>Taruna Pria Sakit/Ijin</th>
                                <th>Taruna Wanita Sehat</th>
                                <th>Taruna Wanita Terpapar</th>
                                <th>Taruna Wanita Sakit/Ijin</th>
                            </tr>
                        </thead>

                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var base_url = '<?php echo base_url() ?>';
        var table_kantor = $("#mytablekampusAdmin");
        var aksesUser = 'aksesUser';
        // $("#mytable").dataTable();

        $('.date1').datetimepicker({
            timepicker: false,
            format: 'yyyy-mm-dd',
            endDate: '<?php echo date('Y-m-d') ?>',
            minView: 2,
            autoclose: 1,
        });


        $(".btn-download").click(function(event) {
            var url = "";
            url += `<?php echo site_url('transaksi/excel') ?>`;
            url += `?date=${$('.date').val()}`;

            console.log('download', url);

            window.location.href = url;
        });
        var dd = $('.date1').val();


        var tabelKampusAdmin = {
            loadData: function() {
                console.log('data' + dd);

                table_kantor.DataTable({
                    serverSide: true,
                    processing: true,
                    // responsive: true,
                    scrollX: true,
                    ajax: {
                        url: base_url + 'pegawai/get_list_absensi_kampus_admin',

                        method: 'POST',
                        data: function(d) {

                            d.date = $('.date1').val();
                            console.log(d);
                        },
                    },
                    order: [
                        [2, "desc"]
                    ],
                    pageLength: 10,

                    rowGroup: {
                        dataSrc: function(row) {
                            return row.tgl_absensi;
                        }
                    },

                    // searching: false,
                    columns: [{
                            data: 'number',
                            orderable: false,
                            className: 'text-center',
                            width: '15px'
                        },
                        {
                            data: 'kampus',
                            orderable: false,
                            className: 'text-left',

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
                            className: 'text-left',
                        },
                        {
                            data: 'jumlah_taruna_wanita',
                            orderable: false,
                            className: 'text-left',
                        },
                        {
                            data: 'pria_sehat',
                            orderable: false,
                            className: 'text-left',
                        },
                        {
                            data: 'pria_covid',
                            orderable: false,
                            className: 'text-left',
                        },
                        {
                            data: 'pria_ijin',
                            orderable: false,
                            className: 'text-left',
                        },
                        {
                            data: 'wanita_sehat',
                            orderable: false,
                            className: 'text-left',
                        },
                        {
                            data: 'wanita_covid',
                            orderable: false,
                            className: 'text-left',
                        },
                        {
                            data: 'wanita_ijin',
                            orderable: false,
                            className: 'text-left',
                        },


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
                let check = $.fn.dataTable.isDataTable('#mytablekampusAdmin');

                if (check) {
                    this.reload();
                } else {
                    this.loadData();
                }

            }
        }

        $('.date1').change(function(e) {
            if (localStorage.getItem(aksesUser)) {
                var data = localStorage.getItem(aksesUser);

                tabelKampusAdmin.init();

            }
        });


        tabelKampusAdmin.init();

    });



    // $(".btn-download").click(function(event) {
    //     var url = "";
    //     url += `<?php echo site_url('transaksi/excel') ?>`;
    //     url += `?date=${$('.date').val()}`;

    //     console.log('download', url);

    //     window.location.href = url;
    // });
</script>
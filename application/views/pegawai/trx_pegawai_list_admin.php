<script src="<?php echo base_url('assets/js/jquery-1.12.0.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<section class='content-header'>
    <h1>
        ABSENSI PEGAWAI PER INSTANSI
        <small>Daftar absensi</small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Reporting</a></li>
        <li class='active'>Daftar Absensi Pegawai</li>
    </ol>
</section>
<section class='content'>
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box box-primary'>
                <div class="box-body">
                    <div class='box-header with-border'>
                        <h3 class='box-title'>
                            <?php //echo anchor('pegawai/create/', '<i class="glyphicon glyphicon-plus"></i>Tambah Data', array('class' => 'btn btn-primary btn-sm')); 
                            ?>
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

                <div class='box-body'>
                    <?php $this->load->view('pegawai/tbl_pegawai_admin') ?>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->

<script type="text/javascript">
    $(document).ready(function() {
        var base_url = '<?php echo base_url() ?>';
        var table_kantor = $("#tablepegawai");
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
            url += `<?php echo site_url('pegawai/excel') ?>`;
            url += `?date1=${$('.date1').val()}`;

            console.log('download', url);

            window.location.href = url;
        });
        var dd = $('.date1').val();


        var tabelPegawai = {
            loadData: function() {
                console.log('data' + dd);

                table_kantor.DataTable({
                    serverSide: true,
                    processing: true,
                    // responsive: true,
                    scrollX: true,
                    ajax: {
                        url: base_url + 'pegawai/get_list_absensi_pegawai_admin',

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
                            data: 'tgl_absensi',
                            orderable: false,
                            className: 'text-left',
                            render: function(data, type, row, meta) {
                                return data;
                            },

                        },
                        {
                            data: 'kampus',
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
                let check = $.fn.dataTable.isDataTable('#tablepegawai');

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

                tabelPegawai.init();

            }
        });


        tabelPegawai.init();

    });
</script>
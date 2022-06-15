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
                    <?php $this->load->view('pegawai/tbl_pegawai') ?>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->

<script type="text/javascript">
    $(document).ready(function() {
        var userDataTable = $('#userTable');
        var aksesUser = 'aksesUser';
        $('.date1').datetimepicker({
            timepicker: false,
            format: 'yyyy-mm-dd',
            endDate: '<?php echo date('Y-m-d') ?>',
            minView: 2,
            autoclose: 1,
        });
        var uid = '<?= $this->session->userdata('user_id') ?>';
        var no = 1;
        var tabelPegawai = {
            loadData: function() {
                userDataTable.DataTable({
                    'processing': true,
                    'serverSide': true,
                    'serverMethod': 'post',
                    //'searching': false, // Remove default Search Control
                    'ajax': {
                        'url': '<?= base_url() ?>/pegawai/userList',
                        'data': function(data) {
                            // data.searchCity = $('.date1').val();
                            data.uid = uid;
                            console.log(data.searchCity);
                        }
                    },
                    rowGroup: {
                        dataSrc: [
                            'tgl_absensi:data',
                            'tgl_absensi:data'
                        ]
                    },
                    'columns': [{

                            data: null,
                            class: "align - top",
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            data: 'tgl_absensi',
                            orderable: false,
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

                        {
                            data: null,
                            orderable: false,
                            render: function(data, type, row) {
                                return '<a href="<?php echo base_url('pegawai/update/') ?>' + row.id + '" class="btn btn-info btn-sm"><i class="fa fa-pencil-square-o"></i> Edit</a>';
                            }
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
                userDataTable.DataTable().ajax.reload();
            },
            init: function() {
                if (!jQuery().DataTable) {
                    return;
                }
                let check = $.fn.dataTable.isDataTable('#userTable');

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
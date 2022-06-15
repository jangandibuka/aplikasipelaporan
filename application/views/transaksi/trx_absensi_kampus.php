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
                            <input class="form-control date" value="<?php echo date('Y-m-d') ?>" readonly="readonly" />
                        </div>
                    </div>
                </div>
                <div class='box-body table-responsive'>
                    <table class="table table-bordered table-striped" id="mytable">
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
                        <tbody>
                            <?php
                            $start = 0;
                            foreach ($absensi_data as $absensi) {
                            ?>
                                <tr>
                                    <td><?php echo ++$start ?></td>
                                    <td><?php echo $absensi->kampus ?></td>
                                    <td><?php echo $absensi->lokasi ?></td>
                                    <td><?php echo tgl_indo($absensi->tgl_absensi) ?></td>
                                    <td><?php echo $absensi->jumlah_taruna ?></td>
                                    <td><?php echo $absensi->jumlah_taruna_wanita ?></td>
                                    <td><?php echo $absensi->pria_sehat ?></td>
                                    <td><?php echo $absensi->pria_covid ?></td>
                                    <td><?php echo $absensi->pria_ijin ?></td>
                                    <td><?php echo $absensi->wanita_sehat ?></td>
                                    <td><?php echo $absensi->wanita_covid ?></td>
                                    <td><?php echo $absensi->wanita_ijin ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
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
        //$("#mytable").dataTable();

        var table = $('#mytable').DataTable();

        $('#mytable').on('search.dt', function() {
            var value = $('.dataTables_filter input').val();
            console.log(value); // <-- the value          
        });

        $('.date').datetimepicker({
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

    });
</script>
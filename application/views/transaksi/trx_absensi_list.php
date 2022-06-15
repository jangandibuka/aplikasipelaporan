<section class='content-header'>
    <h1>
        ABSENSI PER INSTANSI
        <small>Daftar absensi</small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Reporting</a></li>
        <li class='active'>Daftar Absensi</li>
    </ol>
</section>
<section class='content'>
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box box-primary'>
                <div class='box-header with-border'>
                    <h3 class='box-title'><?php echo anchor('transaksi/create/', '<i class="glyphicon glyphicon-plus"></i>Tambah Data', array('class' => 'btn btn-primary btn-sm')); ?>
                        <?php echo anchor(site_url('transaksi/excel'), ' <i class="fa fa-file-excel-o"></i> Excel', 'class="btn btn-primary btn-sm"'); ?></h3>
                </div><!-- /.box-header -->
                <div class='box-body table-responsive'>
                    <table class="table table-bordered table-striped" id="mytable">
                        <thead>
                            <tr>
                                <th width="80px">No</th>
                                <th>Lokasi</th>
                                <th>Tgl. Absensi</th>
                                <th>Total Taruna</th>
                                <th>Taruna Pria Sehat</th>
                                <th>Taruna Pria Terpapar</th>
                                <th>Taruna Pria Sakit/Ijin</th>
                                <th>Taruna Wanita Sehat</th>
                                <th>Taruna Wanita Terpapar</th>
                                <th>Taruna Wanita Sakit/Ijin</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $start = 0;
                            foreach ($absensi_data as $absensi) {
                            ?>
                                <tr>
                                    <td><?php echo ++$start ?></td>
                                    <td><?php echo $absensi->lokasi ?></td>
                                    <td><?php echo tgl_indo($absensi->tgl_absensi) ?></td>
                                    <td><?php echo $absensi->jumlah_taruna ?></td>
                                    <td><?php echo $absensi->pria_sehat ?></td>
                                    <td><?php echo $absensi->pria_covid ?></td>
                                    <td><?php echo $absensi->pria_ijin ?></td>
                                    <td><?php echo $absensi->wanita_sehat ?></td>
                                    <td><?php echo $absensi->wanita_covid ?></td>
                                    <td><?php echo $absensi->wanita_ijin ?></td>
                                    <td style="text-align:center" width="50px">
                                        <?php
                                        echo anchor(site_url('transaksi/update/' . $absensi->id), '<i class="fa fa-pencil-square-o"></i>', array('data-toggle' => 'tooltip', 'title' => 'edit', 'class' => 'btn btn-info btn-sm'));
                                        ?>
                                    </td>
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
        $("#mytable").dataTable();
    });
</script>
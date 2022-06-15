<section class='content-header'>
    <h1>
        INSTANSI
        <small>Daftar Instansi</small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Master</a></li>
        <li class='active'>Daftar Instansi</li>
    </ol>
</section>

<section class='content'>
    <div class='row'>
        <div class='col-xs-12'>

            <div class='box box-primary'>
                <div class='box-header with-border'>
                    <h3 class='box-title'><?php echo anchor('kampus/create/', '<i class="glyphicon glyphicon-plus"></i>Tambah Data', array('class' => 'btn btn-primary btn-sm')); ?>
                        <?php echo anchor(site_url('kampus/excel'), ' <i class="fa fa-file-excel-o"></i> Excel', 'class="btn btn-primary btn-sm"'); ?></h3>
                </div><!-- /.box-header -->
                <div class='box-body table-responsive'>
                    <table class="table table-bordered table-striped" id="mytable">
                        <thead>
                            <tr>
                                <th width="80px">No</th>
                                <th>Nama Instansi</th>
                                <th>Type Instansi</th>
                                <th>Nama PIC</th>
                                <th>Alamat</th>
                                <th>Email</th>
                                <th>Propinsi</th>
                                <th>Kota</th>
                                <th>Status</th>
                                <th>Longitude</th>
                                <th>Latitude</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $start = 0;
                            foreach ($kampus_data as $kampus) {
                            ?>
                                <tr>
                                    <td><?php echo ++$start ?></td>
                                    <td><?php echo $kampus->kampus ?></td>
                                    <td><?php echo $kampus->instansi ?></td>
                                    <td><?php echo $kampus->pimpinan ?></td>
                                    <td><?php echo $kampus->alamat ?></td>
                                    <td><?php echo $kampus->email ?></td>
                                    <td><?php echo $kampus->propinsi ?></td>
                                    <td><?php echo $kampus->kota ?></td>
                                    <td><?php echo $kampus->is_active = 1 ? "Aktif" : "Tidak Aktif"; ?></td>
                                    <td><?php echo $kampus->longitude == NULL ? "-" : $kampus->longitude ?></td>
                                    <td><?php echo $kampus->latitude == NULL ? "-" : $kampus->latitude ?></td>
                                    <td style="text-align:center" width="50px">
                                        <?php
                                        echo anchor(site_url('kampus/update/' . $kampus->id), '<i class="fa fa-pencil-square-o"></i>', array('data-toggle' => 'tooltip', 'title' => 'edit', 'class' => 'btn btn-info btn-sm'));
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
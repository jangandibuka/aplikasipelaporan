
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
                        <?php //echo anchor('pegawai/create/', '<i class="glyphicon glyphicon-plus"></i>Tambah Data', array('class' => 'btn btn-primary btn-sm')); ?>
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
                                <th>Tgl. Absensi</th>
                                <th>Kantor</th>
                                <th>Tipe Pegawai</th>                                
                                <th>Jumlah Pegawai</th>
                                <th>Pegawai Sehat</th>                        
                                <th>Pegawai Terpapar</th>
                                <th>Pegawai Sakit/Ijin</th>
                                <th>WFO</th>                        
                                <th>WFH</th>
                                <th>Dinas Luar</th>
                                <th>Cuti</th>
                                <th>Isoman</th> 
                                <th>Dirawat</th>                                
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $start = 0;
                            foreach ($pegawai_data as $absensi) {
                                ?>
                                <tr>
                                    <td><?php echo ++$start ?></td>
                                    <td><?php echo $absensi->tgl_absensi ?></td>
                                    <td><?php echo $absensi->kampus ?></td>
                                    <td><?php echo $absensi->tipe ?></td>
                                    <td><?php echo $absensi->jumlah_pegawai ?></td>
                                    <td><?php echo $absensi->sehat ?></td>
                                    <td><?php echo $absensi->covid ?></td>
                                    <td><?php echo $absensi->ijin ?></td>
                                    <td><?php echo $absensi->wfo ?></td>
                                    <td><?php echo $absensi->wfh ?></td>
                                    <td><?php echo $absensi->dinas_luar ?></td>
                                    <td><?php echo $absensi->cuti ?></td>
                                    <td><?php echo $absensi->isoman ?></td>
                                    <td><?php echo $absensi->dirawat ?></td>
                                    <td style="text-align:center" width="50px">
                                        <?php
                                        echo anchor(site_url('pegawai/update/' . $absensi->id), '<i class="fa fa-pencil-square-o"></i>', array('data-toggle' => 'tooltip', 'title' => 'edit', 'class' => 'btn btn-info btn-sm'));
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
    $(document).ready(function () {
        $("#mytable").dataTable();

        $('.date').datetimepicker({
            timepicker: false,
            format: 'yyyy-mm-dd',
            endDate: '<?php echo date('Y-m-d') ?>',
            minView: 2,
            autoclose: 1,
        });

        $(".btn-download").click(function(event) {
            var url = "";
            url += `<?php echo site_url('pegawai/excel') ?>`;
            url += `?date=${$('.date').val()}`;
        
            console.log('download', url);

            window.location.href = url;
        });

    });
</script>


<section class='content-header'>
    <h1>
        LOKASI
         <small>Daftar Lokasi</small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Master</a></li>
        <li class='active'>Daftar Lokasi</li>
    </ol>
</section>        
<section class='content'>
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box box-primary'>  
                <div class='box-header with-border'>
                    <h3 class='box-title'><?php echo anchor('lokasi/create/', '<i class="glyphicon glyphicon-plus"></i>Tambah Data', array('class' => 'btn btn-primary btn-sm')); ?>
                        <?php echo anchor(site_url('lokasi/excel'), ' <i class="fa fa-file-excel-o"></i> Excel', 'class="btn btn-primary btn-sm"'); ?></h3>
                </div><!-- /.box-header -->
                <div class='box-body table-responsive'>
                    <table class="table table-bordered table-striped" id="mytable">
                        <thead>
                            <tr>
                                <th width="80px">No</th>
                                <th>Nama Lokasi</th>
                                <th>Nama Tab</th>   
                                <th>Awal Tab</th>
                                <th>Tampilkan di Dashboard</td>
                                <th>Status</th>                             
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            $start = 0;
                            foreach ($lokasi_data as $lokasi) {
                                ?>
                                <tr>
                                    <td><?php echo ++$start ?></td>
                                    <td><?php echo $lokasi->lokasi ?></td>
                                    <td><?php echo $lokasi->tab_name ?></td>  
                                    <?php       
                                        if ($lokasi->tab_first == 1) {
                                            $tab_first = "<span class='label label-success'>Ya</span>";
                                        } else {
                                            $tab_first = "<span class='label label-info'>Tidak</span>";
                                        }         
                                    ?>                                  
                                    <td><?php echo $tab_first ?></td>
                                    <td><?php echo $lokasi->on_dashboard ==1?"Tampilkan":"Tidak"; ?></td>
                                    <?php       
                                        if ($lokasi->is_active == 1) {
                                            $status = "<span class='label label-success'>Aktif</span>";
                                        } else {
                                            $status = "<span class='label label-danger'>Tidak Aktif</span>";
                                        }         
                                    ?>
                                    <td><?php echo $status ?></td>                     
                                    <td style="text-align:center" width="50px">
                                        <?php
                                        echo anchor(site_url('lokasi/update/' . $lokasi->id), '<i class="fa fa-pencil-square-o"></i>', array('data-toggle' => 'tooltip', 'title' => 'edit', 'class' => 'btn btn-info btn-sm'));
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
    });
</script>

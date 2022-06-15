<section class='content-header'>
    <h1>
        LOKASI
        <small>Tambah Lokasi</small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Master</a></li>
        <li class='active'>Tambah Lokasi</li>
    </ol>
</section>        
<section class='content'>
    <div class='row'>
        <!-- left column -->
        <div class='col-md-12'>
            <!-- general form elements -->
            <div class='box box-primary'>
                <div class='box-header'>
                    <div class='col-md-5'>
                        <form action="<?php echo $action; ?>" method="post">
                            <div class='box-body'>
                                <div class='form-group'>Nama Lokasi <?php echo form_error('lokasi') ?>
                                    <input type="text" class="form-control" name="lokasi" id="lokasi" placeholder="Nama Lokasi" value="<?php echo $lokasi ?>" />
                                </div>        
                                <div class='form-group'>Nama Tab <?php echo form_error('tab_name') ?>
                                    <input type="text" class="form-control" name="tab_name" id="tab_name" placeholder="Nama Tab" value="<?php echo $tab_name ?>" />
                                </div>
                                <div class='form-group'>Awal Tab? <?php echo form_error('tab_first') ?>                                        
                                    <?php 
                                    if($tab_first == 0){ ?>
                                        <select name="tab_first" id="tab_first" class="form-control" >
                                            <option value=1>Ya</option> 
                                            <option value=0 selected>Tidak</option>
                                        </select>
                                    <?php 
                                    }else if($tab_first == 1){ ?>
                                        <select name="tab_first" id="tab_first" class="form-control" >
                                            <option value=1 selected>Ya</option> 
                                            <option value=0>Tidak</option>
                                    </select>
                                    <?php 
                                    }else{  ?>
                                        <select name="tab_first" id="tab_first" class="form-control" >
                                            <option value="" selected>-- Pilih --</option>                                            
                                            <option value=1>Ya</option> 
                                            <option value=0>Tidak</option>
                                        </select>
                                    <?php
                                    }
                                    ?>
                                </div>           
                                <div class='form-group'>Tampilkan di Dashboard? <?php echo form_error('on_dashboard') ?>                                        
                                    <?php
                                    if($on_dashboard == 0){ ?>
                                        <select name="on_dashboard" id="on_dashboard" class="form-control" >
                                            <option value=1>Tampilkan</option> 
                                            <option value=0 selected>Tidak Ditampilkan</option>
                                        </select>
                                    <?php 
                                    }else if($on_dashboard == 1){?>
                                        <select name="on_dashboard" id="on_dashboard" class="form-control" >
                                            <option value=1 selected>Tampilkan</option> 
                                            <option value=0>Tidak Ditampilkan</option>
                                    </select>
                                    <?php 
                                    }else{ ?>
                                        <select name="on_dashboard" id="on_dashboard" class="form-control" >
                                            <option value="" selected>-- Tampilkan --</option>                                            
                                            <option value=1>Tampilkan</option> 
                                            <option value=0>Tidak Ditampilkan</option>
                                        </select>
                                    <?php
                                    }
                                    ?>
                                </div>                                   
                                <div class='form-group'>Status <?php echo form_error('is_active') ?>    
                                    <?php
                                    if($is_active == 0){?>
                                        <select name="is_active" id="is_active" class="form-control" >
                                            <option value=1>Aktif</option> 
                                            <option value=0 selected>Tidak Aktif</option>
                                        </select>
                                    <?php 
                                    }else if($is_active == 1){ ?>
                                        <select name="is_active" id="is_active" class="form-control" >
                                            <option value=1 selected>Aktif</option> 
                                            <option value=0>Tidak Aktif</option>
                                    </select>
                                    <?php 
                                    }else{?>
                                        <select name="is_active" id="is_active" class="form-control" >
                                            <option value=1>Aktif</option> 
                                            <option value=0>Tidak Aktif</option>
                                        </select>
                                    <?php
                                    }
                                    ?>
                                </div>                               

                            </div>
                            <div class='box-footer'>
                                <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
                                <input type="hidden" name="created_by" value="<?php echo $uid; ?>" /> 
                                <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                                <a href="<?php echo site_url('lokasi') ?>" class="btn btn-default">Cancel</a>
                            </div>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</section><!-- /.content -->



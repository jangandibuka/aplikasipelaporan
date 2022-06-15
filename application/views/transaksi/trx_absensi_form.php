<head>
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>

<style>
    .content-header>h1 {
        margin: 0;
        font-size: 24px;
        margin-left: 15px;
    }
</style>

<section class='content-header'>
    <h1>
        ABSENSI TARUNA
        <small>Tambah Absensi Taruna</small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Transaksi</a></li>
        <li class='active'>Tambah Absensi</li>
    </ol>
</section>

<section class='content'>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
                    <ul class="nav nav-tabs">
                        <?php
                        foreach ($lokasi_data as $lokasi) {
                            if ($lokasi->tab_first == 1) { ?>
                                <li class="active"><a href="<?php echo $lokasi->tab_name; ?>" data-toggle="tab"><b><?php echo $lokasi->lokasi ?></b></a></li>
                            <?php } else { ?>
                                <li><a href="<?php echo $lokasi->tab_name; ?>" data-toggle="tab"><b><?php echo $lokasi->lokasi ?></b></a></li>
                        <?php
                            }
                        } ?>
                        <!-- <li><a href="#contact_02" data-toggle="tab">Molly Lewis</a></li>-->
                        <!--<li><a href="#" class="add-contact" data-toggle="tab">+ Add Contact</a></li>-->
                    </ul>

                    <div class="tab-content">
                        <?php foreach ($lokasi_data as $lokasi) {
                            if ($lokasi->tab_first == 1) { ?>
                                <div class="tab-pane active" id="<?php echo substr($lokasi->tab_name, 1); ?>">
                                    <form action="<?php echo $action; ?>" method="post">
                                        </p>
                                        <div class="card-body">

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class='form-group'>Tgl Absensi <?php echo form_error('tgl_absensi'); ?>
                                                        <input type="datetime" class="form-control datepicker" id="<?php echo $lokasi->tab_name; ?>" name="tgl_absensi" data-date-format="yyyy-mm-dd hh:mm" id="datetimepicker" placeholder="yyyy-mm-dd hh:mm" value="<?php echo $tgl_absensi ?>" />
                                                    </div>
                                                    <div class='form-group'>Taruna Pria Sehat <?php echo form_error('pria_sehat') ?>
                                                        <input type="text" class="form-control" name="pria_sehat" id="pria_sehat" placeholder="Jumlah Taruna Pria Sehat" value="<?php echo $pria_sehat; ?>" />
                                                    </div>
                                                    <div class='form-group'>Taruna Pria Terpapar Covid <?php echo form_error('pria_covid') ?>
                                                        <input type="text" class="form-control" name="pria_covid" id="pria_covid" placeholder="Jumlah Taruna Pria Terpapar Covid" value="<?php echo $pria_covid; ?>" />
                                                    </div>
                                                    <div class='form-group'>Taruna Pria Sakit/Ijin dan lainnya <?php echo form_error('pria_ijin') ?>
                                                        <input type="text" class="form-control" name="pria_ijin" id="pria_ijin" placeholder="Jumlah Taruna Pria Sakit/Ijin dan lainnya" value="<?php echo $pria_ijin; ?>" />
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class='form-group'>Jumlah Taruna <?php echo form_error('jumlah_taruna') ?>
                                                        <input type="text" class="form-control" name="jumlah_taruna" id="jumlah_taruna" placeholder="Jumlah Total Taruna" value="<?php echo $jumlah_taruna; ?>" />
                                                    </div>
                                                    <div class='form-group'>Taruna Wanita Sehat <?php echo form_error('wanita_sehat') ?>
                                                        <input type="text" class="form-control" name="wanita_sehat" id="wanita_sehat" placeholder="Jumlah Taruna Wanita Sehat" value="<?php echo $wanita_sehat; ?>" />
                                                    </div>
                                                    <div class='form-group'>Taruna Wanita Terpapar Covid <?php echo form_error('wanita_covid') ?>
                                                        <input type="text" class="form-control" name="wanita_covid" id="wanita_covid" placeholder="Jumlah Taruna Wanita Terpapar Covid" value="<?php echo $wanita_covid; ?>" />
                                                    </div>
                                                    <div class='form-group'>Taruna Wanita Sakit/Ijin dan lainnya <?php echo form_error('wanita_ijin') ?>
                                                        <input type="text" class="form-control" name="wanita_ijin" id="wanita_ijin" placeholder="Jumlah Taruna Wanita Sakit/Ijin dan lainnya" value="<?php echo $wanita_ijin; ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='box-footer'>
                                                <input type="hidden" name="id" value="<?php echo $id ?>" />
                                                <input type="hidden" name="id_lokasi" value="<?php echo $lokasi->id; ?>" />
                                                <input type="hidden" name="uid" value="<?php echo $uid; ?>" />
                                                <input type="hidden" name="id_kampus" value="<?php echo $id_kampus; ?>" />
                                                <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                                                <a href="<?php echo site_url('transaksi') ?>" class="btn btn-default">Cancel</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            <?php } else { ?>
                                <div class="tab-pane" id="<?php echo substr($lokasi->tab_name, 1); ?>">
                                    <form action="<?php echo $action; ?>" method="post">
                                        </p>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class='form-group'>Tgl Absensi <?php echo form_error('tgl_absensi') ?>
                                                        <input type="datetime" class="form-control datepicker" id="<?php echo $lokasi->tab_name; ?>" name="tgl_absensi" data-date-format="yyyy-mm-dd hh:mm" id="datetimepicker" placeholder="yyyy-mm-dd hh:mm" value="<?php echo $tgl_absensi ?>" />
                                                    </div>
                                                    <div class='form-group'>Taruna Pria Sehat <?php echo form_error('pria_sehat') ?>
                                                        <input type="text" class="form-control" name="pria_sehat" id="pria_sehat" placeholder="Jumlah Taruna Pria Sehat" value="<?php echo $pria_sehat; ?>" />
                                                    </div>
                                                    <div class='form-group'>Taruna Pria Covid <?php echo form_error('pria_covid') ?>
                                                        <input type="text" class="form-control" name="pria_covid" id="pria_covid" placeholder="Jumlah Taruna Pria Terpapar Covid" value="<?php echo $pria_covid; ?>" />
                                                    </div>
                                                    <div class='form-group'>Taruna Pria Ijin <?php echo form_error('pria_ijin') ?>
                                                        <input type="text" class="form-control" name="pria_ijin" id="pria_ijin" placeholder="Jumlah Taruna Pria Ijin" value="<?php echo $pria_ijin; ?>" />
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class='form-group'>Jumlah Taruna <?php echo form_error('jumlah_taruna') ?>
                                                        <input type="text" class="form-control" name="jumlah_taruna" id="jumlah_taruna" placeholder="Jumlah Total Taruna" value="<?php echo $jumlah_taruna; ?>" />
                                                    </div>
                                                    <div class='form-group'>Taruna Wanita Sehat <?php echo form_error('wanita_sehat') ?>
                                                        <input type="text" class="form-control" name="wanita_sehat" id="wanita_sehat" placeholder="Jumlah Taruna Wanita Sehat" value="<?php echo $wanita_sehat; ?>" />
                                                    </div>
                                                    <div class='form-group'>Taruna Wanita Covid <?php echo form_error('wanita_covid') ?>
                                                        <input type="text" class="form-control" name="wanita_covid" id="wanita_covid" placeholder="Jumlah Taruna Wanita Terpapar Covid" value="<?php echo $wanita_covid; ?>" />
                                                    </div>
                                                    <div class='form-group'>Taruna Wanita Ijin <?php echo form_error('wanita_ijin') ?>
                                                        <input type="text" class="form-control" name="wanita_ijin" id="wanita_ijin" placeholder="Jumlah Taruna Wanita Ijin" value="<?php echo $wanita_ijin; ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='box-footer'>
                                                <input type="hidden" name="id" value="<?php echo $id ?>" />
                                                <input type="hidden" name="id_lokasi" value="<?php echo $lokasi->id; ?>" />
                                                <input type="hidden" name="uid" value="<?php echo $uid; ?>" />
                                                <input type="hidden" name="id_kampus" value="<?php echo $id_kampus; ?>" />
                                                <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                                                <a href="<?php echo site_url('transaksi') ?>" class="btn btn-default">Cancel</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                        <?php
                            }
                        } ?>
                    </div>

                </div>
            </div>
        </div>

    </div>
</section><!-- /.content -->
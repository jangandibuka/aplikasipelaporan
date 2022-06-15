<section class='content-header'>
    <h1>
        INSTANSI
        <small>Tambah Instansi</small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Master</a></li>
        <li class='active'>Tambah Instansi</li>
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
                                <div class='form-group'>Nama Instansi <?php echo form_error('kampus') ?>
                                    <input type="text" class="form-control" name="kampus" id="kampus" placeholder="Nama Kampus" value="<?php echo $kampus ?>" />
                                </div>
                                <div class='form-group'>Status <?php echo form_error('id_instansi_type') ?>
                                    <select name="id_instansi_type" id="is_active" class="form-control">
                                        <option value="">Pilih Type Instansi</option>
                                        <?php
                                        foreach ($instansi as $row) {
                                            if ($row->id == $id_instansi_type) {
                                                $select = "selected";
                                            } else {
                                                $select = "";
                                            }
                                            echo "<option {$select} value='{$row->id}'>{$row->instansi}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class='form-group'>Nama PIC <?php echo form_error('pimpinan') ?>
                                    <input type="text" class="form-control" name="pimpinan" id="pimpinan" placeholder="Nama pimpinan Kampus" value="<?php echo $pimpinan ?>" />
                                </div>
                                <div class='form-group'>Alamat <?php echo form_error('alamat') ?>
                                    <textarea class="form-control" rows="3" id="alamat" name="alamat"><?php echo $alamat ?></textarea>
                                </div>
                                <div class='form-group'>Email <?php echo form_error('email') ?>
                                    <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email ?>" />
                                </div>
                                <div class='form-group'>Propinsi <?php echo form_error('id_propinsi') ?>
                                    <select id="id_propinsi" name="id_propinsi" class="form-control">
                                        <option value="" selected>Pilih Propinsi</option>
                                        <?php foreach ($propinsi as $row) : ?>
                                            <?php if ($id_propinsi == $row->id) { ?>
                                                <option selected value="<?php echo $row->id; ?>"><?php echo $row->propinsi; ?></option>
                                            <?php } else { ?>
                                                <option value="<?php echo $row->id; ?>"><?php echo $row->propinsi; ?></option>
                                            <?php } ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">Kota/Kabupaten <?php echo form_error('id_kota') ?>
                                    <select id="id_kota" name="id_kota" class="id_kota form-control">
                                        <?php foreach ($kota as $k) : ?>
                                            <?php if ($id_kota == $k->id) { ?>
                                                <option selected value="<?php echo $k->id; ?>"><?php echo $k->kota; ?></option>
                                            <?php } else { ?>
                                                <option value="">Pilih Kota/Kabupaten</option>
                                            <?php } ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class='form-group'>Longitude <?php echo form_error('longitude') ?>
                                    <input type="text" class="form-control" name="longitude" id="longitude" placeholder="Isikan nilai longitude" value="<?php echo $longitude ?>" />
                                </div>
                                <div class='form-group'>Latitude <?php echo form_error('latitude') ?>
                                    <input type="text" class="form-control" name="latitude" id="latitude" placeholder="Isikan nilai latitude" value="<?php echo $latitude ?>" />
                                </div>
                                <div class='form-group'>Status <?php echo form_error('status') ?>
                                    <select name="is_active" id="is_active" class="form-control">
                                        <option value=1>Aktif</option>
                                        <option value=0>Tidak Aktif</option>
                                    </select>
                                </div>

                            </div>
                            <div class='box-footer'>
                                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                                <input type="hidden" name="created_by" value="<?php echo $uid; ?>" />
                                <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                                <a href="<?php echo site_url('kampus') ?>" class="btn btn-default">Cancel</a>
                            </div>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</section><!-- /.content -->


<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery-2.2.3.min.js' ?>"></script>
<script type="text/javascript" src="<?php echo base_url() . 'assets/js/bootstrap.js' ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#id_propinsi').change(function() {
            var id = $(this).val();
            $.ajax({
                url: "<?php echo base_url(); ?>kota/get_kotakabupaten",
                method: "POST",
                data: {
                    id_propinsi: id
                },
                async: false,
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<option>' + data[i].kota + '</option>';
                    }
                    $('#id_kota').html(data.list_kota).show();
                }
            });
        });
    });
</script>
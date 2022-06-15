<script src="<?php echo base_url('assets/js/jquery-1.12.0.min.js') ?>"></script>
<section class='content-header'>
    <h1>
        EDIT ABSENSI
        <small>Edit Absensi</small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Reporting</a></li>
        <li class='active'>Edit Absensi</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit Data Absensi</h3>

                    <div class="box-tools pull-right">
                        <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                    </div>
                </div>

                <div class="box-body">
                    <form action="<?php echo $action; ?>" id="edit-absensi-kampus" method="post">
                        </p>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-4">
                                        <div class='form-group'>Tgl Absensi <?php echo form_error('tgl_absensi'); ?>
                                            <input type="datetime" class="form-control datepicker" name="tgl_absensi" data-date-format="yyyy-mm-dd hh:mm" id="datetimepicker" placeholder="yyyy-mm-dd hh:mm" value="<?php echo $tgl_absensi ?>" readonly="readonly" />
                                        </div>
                                    </diV>
                                    <div class="col-md-4"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-4">
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
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-4">
                                        <div class='form-group'>Jumlah Taruna Pria <?php echo form_error('jumlah_taruna') ?>
                                            <input type="text" class="form-control" name="jumlah_taruna" id="jumlah_taruna" placeholder="Total Taruna Pria" value="<?php echo $jumlah_taruna; ?>" readonly="readonly" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class='form-group'>Jumlah Taruna Wanita <?php echo form_error('jumlah_taruna_wanita') ?>
                                            <input type="text" class="form-control" name="jumlah_taruna_wanita" id="jumlah_taruna_wanita" placeholder="Total Taruna Wanita" value="<?php echo $jumlah_taruna_wanita; ?>" readonly="readonly" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='box-footer'>
                                <input type="hidden" name="id" value="<?php echo $id ?>" />
                                <input type="hidden" name="id_lokasi" value="<?php echo $id_lokasi ?>" />
                                <input type="hidden" name="uid" value="<?php echo $uid; ?>" />
                                <input type="hidden" name="id_kampus" value="<?php echo $id_kampus; ?>" />
                                <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                                <a href="<?php echo site_url('transaksi') ?>" class="btn btn-default">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<script>
    $(document).ready(function(e) {
        var idForm = '#edit-absensi-kampus';
        var inputArr = [
            'pria_sehat',
            'pria_covid',
            'pria_ijin',
        ];

        var inputArrWanita = [
            'wanita_sehat',
            'wanita_covid',
            'wanita_ijin'
        ];

        var elmJumlah = $(idForm + ' input[name="jumlah_taruna"]');

        inputArr.map(function(item) {
            $(idForm + ` input[name="${item}"`).keyup(function(e) {
                // var value = ;
                e.target.value = e.target.value.replace(/[^\d]/g, "");
                let value = parseInt(e.target.value);
                sumData();
            })
        })

        function sumData() {
            let sum = 0;
            inputArr.map(function(item) {
                let value = $(idForm + ` input[name="${item}"]`).val();
                let valueNumber = parseInt(value);
                sum += isNaN(valueNumber) ? 0 : valueNumber;
            });
            elmJumlah.val(sum);
            // return sum;
        }

        sumData();

        // wanita
        var elmJumlahWanita = $(idForm + ' input[name="jumlah_taruna_wanita"]');

        inputArrWanita.map(function(item) {
            $(idForm + ` input[name="${item}"`).keyup(function(e) {
                // var value = ;
                e.target.value = e.target.value.replace(/[^\d]/g, "");
                let value = parseInt(e.target.value);
                sumDataWanita();
            })
        })

        function sumDataWanita() {
            let sumWanita = 0;
            inputArrWanita.map(function(item) {
                let value = $(idForm + ` input[name="${item}"]`).val();
                let valueNumber = parseInt(value);
                sumWanita += isNaN(valueNumber) ? 0 : valueNumber;
            });
            elmJumlahWanita.val(sumWanita);
            // return sum;
        }

        sumDataWanita();

    })
</script>
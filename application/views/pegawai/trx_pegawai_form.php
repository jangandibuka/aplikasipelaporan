<script src="<?php echo base_url('assets/js/jquery-1.12.0.min.js') ?>"></script>

<section class='content-header'>
    <h1>
        ABSENSI PEGAWAI
        <small><?php echo $subtitle ?></small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Reporting</a></li>
        <li class='active'>Tambah Absensi</li>
    </ol>
</section>

<section class='content'>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
                    <form action="<?php echo $action; ?>" method="post" class="form-absensi-pegawai">
                        </p>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class='form-group'>Tgl Absensi <?php echo form_error('tgl_absensi'); ?>
                                        <input type="datetime" class="form-control datepicker" id="datepicker" name="tgl_absensi" data-date-format="yyyy-mm-dd" id="datetimepicker" placeholder="yyyy-mm-dd" value="<?php echo $tgl_absensi ?>" readonly="readonly" />
                                    </div>
                                    <div class='form-group'>Tipe Pegawai <?php echo form_error('id_pegawai_type') ?>
                                        <select name="id_pegawai_type" id="id_pegawai_type" class="form-control">
                                            <option value="">Pilih Tipe Pegawai</option>
                                            <?php
                                            foreach ($tipe as $row) {
                                                if ($row->id == $id_pegawai_type) {
                                                    $select = "selected";
                                                } else {
                                                    $select = "";
                                                }
                                                echo "<option {$select} value='{$row->id}'>{$row->tipe}</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class='form-group'>Pegawai Sehat1<?php echo form_error('sehat') ?>
                                        <input type="text" class="form-control" name="sehat" id="sehat" placeholder="Jumlah Pegawai Sehat" value="<?php echo $sehat; ?>" />
                                    </div>
                                    <div class='form-group'>Pegawai Terpapar<?php echo form_error('covid') ?>
                                        <input type="text" class="form-control" name="covid" id="covid" placeholder="Jumlah Pegawai Terpapar Covid" value="<?php echo $covid; ?>" />
                                    </div>
                                    <div class='form-group'>Pegawai Ijin<?php echo form_error('ijin') ?>
                                        <input type="text" class="form-control" name="ijin" id="ijin" placeholder="Jumlah Pegawai Sakit/Ijin, dan lainnya" value="<?php echo $ijin; ?>" />
                                    </div>
                                    <div class='form-group'>Pegawai WFO<?php echo form_error('wfo') ?>
                                        <input type="text" class="form-control" name="wfo" id="wfo" placeholder="Jumlah Pegawai WFO" value="<?php echo $wfo; ?>" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class='form-group'>Jumlah Pegawai <?php echo form_error('jumlah_pegawai') ?>
                                        <input type="text" class="form-control" name="jumlah_pegawai" id="jumlah_pegawai" placeholder="Jumlah Total Pegawai" value="<?php echo $jumlah_pegawai; ?>" readonly="readonly" />
                                    </div>
                                    <div class='form-group'>Pegawai WFH<?php echo form_error('wfh') ?>
                                        <input type="text" class="form-control" name="wfh" id="wfh" placeholder="Jumlah Pegawai WFH" value="<?php echo $wfh; ?>" />
                                    </div>
                                    <div class='form-group'>Pegawai Dinas Luar<?php echo form_error('dinas_luar') ?>
                                        <input type="text" class="form-control" name="dinas_luar" id="dinas_luar" placeholder="Jumlah Pegawai Dinas Luar" value="<?php echo $dinas_luar; ?>" />
                                    </div>
                                    <div class='form-group'>Pegawai Tugas_belajar<?php echo form_error('tugas_belajar') ?>
                                        <input type="text" class="form-control" name="tugas_belajar" id="tugas_belajar" placeholder="Jumlah Pegawai Tugas Belajar" value="<?php echo $tugas_belajar; ?>" />
                                    </div>
                                    <div class='form-group'>Pegawai Cuti<?php echo form_error('cuti') ?>
                                        <input type="text" class="form-control" name="cuti" id="cuti" placeholder="Jumlah Pegawai Cuti" value="<?php echo $cuti; ?>" />
                                    </div>
                                    <div class='form-group'>Pegawai Isoman<?php echo form_error('isoman') ?>
                                        <input type="text" class="form-control" name="isoman" id="isoman" placeholder="Jumlah Pegawai Isoman" value="<?php echo $isoman; ?>" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class='form-group'>Pegawai Dirawat<?php echo form_error('dirawat') ?>
                                        <input type="text" class="form-control" name="dirawat" id="dirawat" placeholder="Jumlah Pegawai Dirawat" value="<?php echo $dirawat; ?>" />
                                    </div>
                                    <div class='form-group'>Vaksin 1<?php echo form_error('vaksin1') ?>
                                        <input type="text" class="form-control" name="vaksin1" id="vaksin1" placeholder="Jumlah Pegawai Sudah vaksin1" value="<?php echo $vaksin1; ?>" />
                                    </div>
                                    <div class='form-group'>Vaksin 2<?php echo form_error('vaksin2') ?>
                                        <input type="text" class="form-control" name="vaksin2" id="vaksin2" placeholder="Jumlah Pegawai Sudah vaksin2" value="<?php echo $vaksin2; ?>" />
                                    </div>
                                    <div class='form-group'>Vaksin Lain<?php echo form_error('vaksin_lain') ?>
                                        <input type="text" class="form-control" name="vaksin_lain" id="vaksin_lain" placeholder="Jumlah Pegawai sudah vaksin lain" value="<?php echo $vaksin_lain; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class='box-footer'>
                                <input type="hidden" name="id" value="<?php echo $id ?>" />
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
</section><!-- /.content -->

<script>
    $(document).ready(function(e) {
        var idForm = '.form-absensi-pegawai';
        var inputArr = [
            'sehat',
            'covid',
            'ijin',
            'wfo',
            'wfh',
            'dinas_luar',
            'tugas_belajar',
            'cuti',
            'isoman',
            'dirawat',
            // 'vaksin1',
            // 'vaksin2',
            // 'vaksin_lain',
        ];

        var elmJumlah = $(idForm + ' input[name="jumlah_pegawai"]');

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

    })
</script>
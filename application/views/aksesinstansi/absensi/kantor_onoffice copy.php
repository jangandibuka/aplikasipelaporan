<form class="form-absensi-pegawai" method="post">
    </p>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class='form-group'>Tgl Absensi
                    <input type="datetime" class="form-control datepicker" id="datepicker" name="tgl_absensi" data-date-format="yyyy-mm-dd" id="datetimepicker" placeholder="yyyy-mm-dd" value="<?php echo date('Y-m-d') ?>" readonly="readonly" />
                </div>
                <div class='form-group'>Tipe Pegawai
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
                    <div class="error-id_pegawai_type text-red"></div>
                </div>

                <div class='form-group'>Pegawai Sehat
                    <input type="text" class="form-control" name="sehat" id="sehat" placeholder="Jumlah Pegawai Sehat" />
                    <div class="error-sehat text-red"></div>
                </div>
                <div class='form-group'>Pegawai Terpapar
                    <input type="text" class="form-control" name="covid" id="covid" placeholder="Jumlah Pegawai Terpapar Covid" />
                    <div class="error-covid text-red"></div>
                </div>
                <div class='form-group'>Pegawai Izin
                    <input type="text" class="form-control" name="ijin" id="ijin" placeholder="Jumlah Pegawai Izin dan lainnya" />
                    <div class="error-ijin text-red"></div>
                </div>
                <div class='form-group'>Pegawai WFO
                    <input type="text" class="form-control" name="wfo" id="wfo" placeholder="Jumlah Pegawai WFO" />
                    <div class="error-wfo text-red"></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class='form-group'>Jumlah Pegawai
                    <input type="text" class="form-control" name="jumlah_pegawai" id="jumlah_pegawai" placeholder="Jumlah Total Pegawai" readonly="readonly" />
                    <div class="error-jumlah_pegawai text-red"></div>
                </div>
                <div class='form-group'>Pegawai WFH
                    <input type="text" class="form-control" name="wfh" id="wfh" placeholder="Jumlah Pegawai WFH" />
                    <div class="error-wfh text-red"></div>
                </div>
                <div class='form-group'>Pegawai Dinas Luar
                    <input type="text" class="form-control" name="dinas_luar" id="dinas_luar" placeholder="Jumlah Pegawai Dinas Luar" />
                    <div class="error-dinas_luar text-red"></div>
                </div>
                <div class='form-group'>Pegawai Tugas Belajar
                    <input type="text" class="form-control" name="tugas_belajar" id="tugas_belajar" placeholder="Jumlah Pegawai Tugas Belajar" />
                    <div class="error-tugas_belajar text-red"></div>
                </div>
                <div class='form-group'>Pegawai Cuti
                    <input type="text" class="form-control" name="cuti" id="cuti" placeholder="Jumlah Pegawai Cuti" />
                    <div class="error-cuti text-red"></div>
                </div>
                <div class='form-group'>Pegawai Isoman
                    <input type="text" class="form-control" name="isoman" id="isoman" placeholder="Jumlah Pegawai Isoman" />
                    <div class="error-isoman text-red"></div>
                </div>
            </div>
            <hr>
            <div class="col-md-4">
                <div class='form-group'>
                    <br><br><br>
                    <input type="hidden" class="form-control" name="" id="" readonly="readonly" />
                    <div class="error-jumlah_pegawai text-red"></div>
                </div>
                <div class='form-group'>Pegawai Sakit
                    <input type="text" class="form-control" name="dirawat" id="dirawat" placeholder="Jumlah Pegawai Sakit" />
                    <div class="error-dirawat text-red"></div>
                </div>
                <div class='form-group'>Sudah Vaksin 1
                    <input type="text" class="form-control" name="vaksin1" id="vaksin1" placeholder="Vaksin 1" />
                    <div class="error-dirawat text-red"></div>
                </div>
                <div class='form-group'>Sudah Vaksin 2
                    <input type="text" class="form-control" name="vaksin2" id="vaksin2" placeholder="Vaksin 2" />
                    <div class="error-dirawat text-red"></div>
                </div>
                <div class='form-group'>Sudah Vaksin Lainnya
                    <input type="text" class="form-control" name="vaksin_lain" id="vaksin_lain" placeholder="Vaksin Lainnya" />
                    <div class="error-dirawat text-red"></div>
                </div>
            </div>
        </div>
        <div class='box-footer'>
            <!-- <input type="hidden" name="id" value="<?php echo $id ?>" /> -->
            <!-- <input type="hidden" name="uid" value="<?php echo $uid; ?>" /> -->
            <!-- <input type="hidden" name="id_kampus" value="<?php echo $id_kampus; ?>" /> -->
            <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
            <a href="<?php echo site_url('transaksi') ?>" class="btn btn-default">Cancel</a>
        </div>
    </div>
</form>

<script>
    $(document).ready(function(e) {
        var idForm = '.form-absensi-pegawai';
        var inputArr = [
            // 'sehat',
            'covid',
            'ijin',
            'wfo',
            'wfh',
            'dinas_luar',
            'tugas_belajar',
            'cuti',
            'isoman',
            'dirawat'
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
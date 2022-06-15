<?php
$id_lokasi1 = $lokasi_data[0]->id_lokasi;
$id_lokasi2 = $lokasi_data[1]->id_lokasi;
$id_lokasi3 = $lokasi_data[2]->id_lokasi;
$tabname1 = $lokasi_data[0]->tab_name;
$tabname2 = $lokasi_data[1]->tab_name;
$tabname3 = $lokasi_data[2]->tab_name;
echo $id_lokasi1;
echo $id_lokasi2;
echo $id_lokasi3;
?>
<form method="post" class="form-absensi" id="form-abs">
    <!-- <form method="post" class="form-absensi" id="form-abs-<?php echo $lokasi->id_lokasi ?>"> -->
    </p>
    <div class="card-body">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title"><?= $lokasi_data[0]->lokasi ?></h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-4">
                    <div class='form-group'><b>Tgl Absensi</b>
                        <input type="datetime" class="form-control datepicker" id="<?php echo $tabname1; ?>" name="tgl_absensi" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" value="<?php echo date('Y-m-d') ?>" readonly="readonly" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class='form-group'><b>Jumlah Taruna</b>
                        <input type="text" class="form-control" name="jumlah_taruna<?= $id_lokasi1 ?>" id="jumlah_taruna<?= $id_lokasi1 ?>" placeholder="Jumlah Taruna Pria" readonly="readonly" />
                        <div class="error-jumlah_taruna text-red"></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class='form-group'><b>Jumlah Taruni</b>
                        <input type="text" class="form-control" name="jumlah_taruna_wanita<?= $id_lokasi1 ?>" id="jumlah_taruna_wanita<?= $id_lokasi1 ?>" placeholder="Jumlah Taruna Wanita" readonly="readonly" />
                        <div class="error-jumlah_taruna text-red"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-4">
                    <div class='form-group'>Taruna
                        <input type="text" class="form-control" name="jumlah_taruna_pria_manual<?= $id_lokasi1 ?>" id="jumlah_taruna_pria_manual<?= $id_lokasi1 ?>" placeholder="Jumlah Taruna Pria" readonly />
                        <div class="error-pria_sehat text-red"></div>
                    </div>
                    <div class='form-group'>Taruni
                        <input type="text" class="form-control" name="jumlah_taruna_wanita_manual<?= $id_lokasi1 ?>" id="jumlah_taruna_wanita_manual<?= $id_lokasi1 ?>" placeholder="Jumlah Taruna Wanita" readonly />
                        <div class="error-pria_covid text-red"></div>
                    </div>
                    <div class='form-group'>
                        <a href="javascript:;" class="btn btn-success btn-manual-taruna" onclick="inputManualTaruna()">Set Jumlah Taruna</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class='form-group'>Taruna Pria Sehat
                        <input type="text" class="form-control" name="pria_sehat<?= $id_lokasi1 ?>" id="pria_sehat<?= $id_lokasi1 ?>" placeholder="Jumlah Taruna Pria Sehat" />
                        <div class="error-pria_sehat text-red"></div>
                    </div>
                    <div class='form-group'>Taruna Pria Terpapar Covid
                        <input type="text" class="form-control" name="pria_covid<?= $id_lokasi1 ?>" id="pria_covid<?= $id_lokasi1 ?>" placeholder="Jumlah Taruna Pria Terpapar Covid" />
                        <div class="error-pria_covid text-red"></div>
                    </div>
                    <div class='form-group'>Taruna Pria Sakit/Ijin dan lainnya
                        <input type="text" class="form-control" name="pria_ijin<?= $id_lokasi1 ?>" id="pria_ijin<?= $id_lokasi1 ?>" placeholder="Jumlah Taruna Pria Sakit/Ijin dan lainnya" />
                        <div class="error-pria_ijin text-red"></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class='form-group'>Taruna Wanita Sehat
                        <input type="text" class="form-control" name="wanita_sehat<?= $id_lokasi1 ?>" id="wanita_sehat<?= $id_lokasi1 ?>" placeholder="Jumlah Taruna Wanita Sehat" />
                        <div class="error-wanita_sehat text-red"></div>
                    </div>
                    <div class='form-group'>Taruna Wanita Terpapar Covid
                        <input type="text" class="form-control" name="wanita_covid<?= $id_lokasi1 ?>" id="wanita_covid<?= $id_lokasi1 ?>" placeholder="Jumlah Taruna Wanita Terpapar Covid" />
                        <div class="error-wanita_covid text-red"></div>
                    </div>
                    <div class='form-group'>Taruna Wanita Sakit/Ijin dan lainnya
                        <input type="text" class="form-control" name="wanita_ijin<?= $id_lokasi1 ?>" id="wanita_ijin<?= $id_lokasi1 ?>" placeholder="Jumlah Taruna Wanita Sakit/Ijin dan lainnya" />
                        <div class="error-wanita_ijin text-red"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

            </div>
        </div>


        <!-- Box 2 -->
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title"><?= $lokasi_data[1]->lokasi ?></h3>


            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-4">
                    <div class='form-group'><b>Tgl Absensi</b>
                        <input type="datetime" class="form-control datepicker" id="<?php echo $tabname1; ?>" name="tgl_absensi" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" value="<?php echo date('Y-m-d') ?>" readonly="readonly" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class='form-group'><b>Jumlah Taruna</b>
                        <input type="text" class="form-control" name="jumlah_taruna<?= $id_lokasi2 ?>" id="jumlah_taruna<?= $id_lokasi2 ?>" placeholder="Jumlah Taruna Pria" readonly="readonly" />
                        <div class="error-jumlah_taruna text-red"></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class='form-group'><b>Jumlah Taruni</b>
                        <input type="text" class="form-control" name="jumlah_taruna_wanita<?= $id_lokasi2 ?>" id="jumlah_taruna_wanita<?= $id_lokasi2 ?>" placeholder="Jumlah Taruna Wanita" readonly="readonly" />
                        <div class="error-jumlah_taruna text-red"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-4">
                    <div class='form-group'>Taruna
                        <input type="text" class="form-control" name="jumlah_taruna_pria_manual<?= $id_lokasi2 ?>" id="jumlah_taruna_pria_manual<?= $id_lokasi2 ?>" placeholder="Jumlah Taruna Pria" readonly />
                        <div class="error-pria_sehat text-red"></div>
                    </div>
                    <div class='form-group'>Taruni
                        <input type="text" class="form-control" name="jumlah_taruna_wanita_manual<?= $id_lokasi2 ?>" id="jumlah_taruna_wanita_manual<?= $id_lokasi2 ?>" placeholder="Jumlah Taruna Wanita" readonly />
                        <div class="error-pria_covid text-red"></div>
                    </div>

                </div>
                <div class="col-md-4">
                    <div class='form-group'>Taruna Pria Sehat
                        <input type="text" class="form-control" name="pria_sehat<?= $id_lokasi2 ?>" id="pria_sehat<?= $id_lokasi2 ?>" placeholder="Jumlah Taruna Pria Sehat" />
                        <div class="error-pria_sehat text-red"></div>
                    </div>
                    <div class='form-group'>Taruna Pria Terpapar Covid
                        <input type="text" class="form-control" name="pria_covid<?= $id_lokasi2 ?>" id="pria_covid<?= $id_lokasi2 ?>" placeholder="Jumlah Taruna Pria Terpapar Covid" />
                        <div class="error-pria_covid text-red"></div>
                    </div>
                    <div class='form-group'>Taruna Pria Sakit/Ijin dan lainnya
                        <input type="text" class="form-control" name="pria_ijin<?= $id_lokasi2 ?>" id="pria_ijin<?= $id_lokasi2 ?>" placeholder="Jumlah Taruna Pria Sakit/Ijin dan lainnya" />
                        <div class="error-pria_ijin text-red"></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class='form-group'>Taruna Wanita Sehat
                        <input type="text" class="form-control" name="wanita_sehat<?= $id_lokasi2 ?>" id="wanita_sehat<?= $id_lokasi2 ?>" placeholder="Jumlah Taruna Wanita Sehat" />
                        <div class="error-wanita_sehat text-red"></div>
                    </div>
                    <div class='form-group'>Taruna Wanita Terpapar Covid
                        <input type="text" class="form-control" name="wanita_covid<?= $id_lokasi2 ?>" id="wanita_covid<?= $id_lokasi2 ?>" placeholder="Jumlah Taruna Wanita Terpapar Covid" />
                        <div class="error-wanita_covid text-red"></div>
                    </div>
                    <div class='form-group'>Taruna Wanita Sakit/Ijin dan lainnya
                        <input type="text" class="form-control" name="wanita_ijin<?= $id_lokasi2 ?>" id="wanita_ijin<?= $id_lokasi2 ?>" placeholder="Jumlah Taruna Wanita Sakit/Ijin dan lainnya" />
                        <div class="error-wanita_ijin text-red"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

            </div>
        </div>


        <!-- Box 3 -->

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title"><?= $lokasi_data[2]->lokasi ?></h3>


            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-4">
                    <div class='form-group'><b>Tgl Absensi</b>
                        <input type="datetime" class="form-control datepicker" id="<?php echo $tabname1; ?>" name="tgl_absensi" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" value="<?php echo date('Y-m-d') ?>" readonly="readonly" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class='form-group'><b>Jumlah Taruna</b>
                        <input type="text" class="form-control" name="jumlah_taruna<?= $id_lokasi3 ?>" id="jumlah_taruna<?= $id_lokasi3 ?>" placeholder="Jumlah Taruna Pria" readonly="readonly" />
                        <div class="error-jumlah_taruna text-red"></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class='form-group'><b>Jumlah Taruni</b>
                        <input type="text" class="form-control" name="jumlah_taruna_wanita<?= $id_lokasi3 ?>" id="jumlah_taruna_wanita<?= $id_lokasi3 ?>" placeholder="Jumlah Taruna Wanita" readonly="readonly" />
                        <div class="error-jumlah_taruna text-red"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-4">
                    <div class='form-group'>Taruna
                        <input type="text" class="form-control" name="jumlah_taruna_pria_manual<?= $id_lokasi3 ?>" id="jumlah_taruna_pria_manual<?= $id_lokasi3 ?>" placeholder="Jumlah Taruna Pria" readonly />
                        <div class="error-pria_sehat text-red"></div>
                    </div>
                    <div class='form-group'>Taruni
                        <input type="text" class="form-control" name="jumlah_taruna_wanita_manual<?= $id_lokasi3 ?>" id="jumlah_taruna_wanita_manual<?= $id_lokasi3 ?>" placeholder="Jumlah Taruna Wanita" readonly />
                        <div class="error-pria_covid text-red"></div>
                    </div>

                </div>
                <div class="col-md-4">
                    <div class='form-group'>Taruna Pria Sehat
                        <input type="text" class="form-control" name="pria_sehat<?= $id_lokasi3 ?>" id="pria_sehat<?= $id_lokasi3 ?>" placeholder="Jumlah Taruna Pria Sehat" />
                        <div class="error-pria_sehat text-red"></div>
                    </div>
                    <div class='form-group'>Taruna Pria Terpapar Covid
                        <input type="text" class="form-control" name="pria_covid<?= $id_lokasi3 ?>" id="pria_covid<?= $id_lokasi3 ?>" placeholder="Jumlah Taruna Pria Terpapar Covid" />
                        <div class="error-pria_covid text-red"></div>
                    </div>
                    <div class='form-group'>Taruna Pria Sakit/Ijin dan lainnya
                        <input type="text" class="form-control" name="pria_ijin<?= $id_lokasi3 ?>" id="pria_ijin<?= $id_lokasi3 ?>" placeholder="Jumlah Taruna Pria Sakit/Ijin dan lainnya" />
                        <div class="error-pria_ijin text-red"></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class='form-group'>Taruna Wanita Sehat
                        <input type="text" class="form-control" name="wanita_sehat<?= $id_lokasi3 ?>" id="wanita_sehat<?= $id_lokasi3 ?>" placeholder="Jumlah Taruna Wanita Sehat" />
                        <div class="error-wanita_sehat text-red"></div>
                    </div>
                    <div class='form-group'>Taruna Wanita Terpapar Covid
                        <input type="text" class="form-control" name="wanita_covid<?= $id_lokasi3 ?>" id="wanita_covid<?= $id_lokasi3 ?>" placeholder="Jumlah Taruna Wanita Terpapar Covid" />
                        <div class="error-wanita_covid text-red"></div>
                    </div>
                    <div class='form-group'>Taruna Wanita Sakit/Ijin dan lainnya
                        <input type="text" class="form-control" name="wanita_ijin<?= $id_lokasi3 ?>" id="wanita_ijin<?= $id_lokasi3 ?>" placeholder="Jumlah Taruna Wanita Sakit/Ijin dan lainnya" />
                        <div class="error-wanita_ijin text-red"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

            </div>
        </div>
        <div class='box-footer'>
            <!-- <input type="hidden" name="id_lokasi" value="<?php echo $id_lokasi1; ?>" /> -->
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
        // $('#tab1').datetimepicker({
        //     format: 'mm/dd/yyyy',
        // }).on('changeDate', function(e) {
        //     $("#modalGambar").modal();
        // });
        /*$("#tab1").click(function(e) {
            e.preventDefault();
            $("#modalGambar").modal();
        });
        */
        // var idForm = '#<?php echo "form-abs-$lokasi->id_lokasi" ?>';
        var inputArr1 = [
            'pria_sehat1',
            'pria_covid1',
            'pria_ijin1',
        ];

        var inputArrWanita1 = [
            'wanita_sehat1',
            'wanita_covid1',
            'wanita_ijin1'
        ];
        var inputArr2 = [
            'pria_sehat',
            'pria_covid',
            'pria_ijin',
        ];

        var inputArrWanita2 = [
            'wanita_sehat',
            'wanita_covid',
            'wanita_ijin'
        ];
        var inputArr3 = [
            'pria_sehat',
            'pria_covid',
            'pria_ijin',
        ];

        var inputArrWanita3 = [
            'wanita_sehat',
            'wanita_covid',
            'wanita_ijin'
        ];


        var elmJumlah1 = $(input[name = "jumlah_taruna<?= $id_lokasi1 ?>"]);

        inputArr1.map(function(item) {
            $(input[name = `"${item}"`]).keyup(function(e) {
                // var value = ;
                e.target.value = e.target.value.replace(/[^\d]/g, "");
                let value = parseInt(e.target.value);
                sumData();
            })
        })

        function sumData() {
            let sum = 0;
            inputArr1.map(function(item) {
                let value = $(input[name = `"${item}"`]).val();
                let valueNumber = parseInt(value);
                sum += isNaN(valueNumber) ? 0 : valueNumber;
            });
            elmJumlah1.val(sum);
            // return sum;
        }

        sumData();

        // wanita
        var elmJumlahWanita1 = $('input[name="jumlah_taruna_wanita<?= $id_lokasi1 ?>"]');

        inputArrWanita1.map(function(item) {
            $(`input[name="${item}"`).keyup(function(e) {
                // var value = ;
                e.target.value = e.target.value.replace(/[^\d]/g, "");
                let value = parseInt(e.target.value);
                sumDataWanita();
            })
        })

        function sumDataWanita() {
            let sumWanita = 0;
            inputArrWanita1.map(function(item) {
                let value = $(`input[name="${item}"]`).val();
                let valueNumber = parseInt(value);
                sumWanita += isNaN(valueNumber) ? 0 : valueNumber;
            });
            elmJumlahWanita1.val(sumWanita);
            // return sum;
        }

        sumDataWanita();

    });
</script>





<script>
    function inputManualTaruna() {
        var idModal = '#modalInputManualTaruna';
        $(idModal).modal();
        $(idModal + ' input[name="idForm"]').val(idform);
        $(`${idModal} input[name="jumlah_taruna1"]`).val($(input[name = "jumlah_taruna_pria_manual1"]).val());
        $(`${idModal} input[name="jumlah_taruna_wanita1"]`).val($(input[name = "jumlah_taruna_wanita_manual1"]).val());
    }

    function closeModalTaruna() {
        var idModal = '#modalInputManualTaruna';
        $(idModal).modal("toggle");

        var jumlah_taruna = $(`${idModal} input[name="jumlah_taruna1"]`);
        var jumlah_taruni = $(`${idModal} input[name="jumlah_taruna_wanita1"]`);
        var idForm = $(`${idModal} input[name="idForm"]`);

        $(input[name = "jumlah_taruna_pria_manual1"]).val(jumlah_taruna.val());
        $(input[name = "jumlah_taruna_wanita_manual1"]).val(jumlah_taruni.val());

        jumlah_taruna.val("");
        jumlah_taruni.val("");
        idForm.val("");

    }
</script>

<!-- modal -->
<div class="modal fade" id="modalInputManualTaruna" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
                <h3 id="workout-modal-title">Input Manual</h3>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form">

                    <div class="form-group">
                        <label for="firstname" class="col-sm-4 control-label">Jumlah Taruna:</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="jumlah_taruna1" placeholder="" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="lastname" class="col-sm-4 control-label">Jumlah Taruni:</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="jumlah_taruni_wanita1" placeholder="" value="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-sm-8">
                            <input type="hidden" value="" name="idForm">
                            <button type="button" class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                            <button type="button" class="btn btn-primary" id="add-workout" onclick="closeModalTaruna()">OK</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->
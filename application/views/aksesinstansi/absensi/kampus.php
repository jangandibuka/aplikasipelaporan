<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-tabs">
            <?php
            $no = 0;
            foreach ($lokasi_data as $lokasi) {
                $no++;
                $class = $no == 1 ? 'class="active"' : '';
                echo "<li $class><a href='$lokasi->tab_name' data-toggle='tab'><b>$lokasi->lokasi</b></a></li>";
            } ?>
        </ul>

        <div class="tab-content">
            <?php
            $num = 0;
            foreach ($lokasi_data as $lokasi) {
                $num++;
            ?>
                <div class="tab-pane <?php echo $num == 1 ? 'active' : '' ?>" id="<?php echo substr($lokasi->tab_name, 1); ?>">
                    <!-- <form action="<?php echo $action; ?>" method="post" class="apa"> -->
                    <form method="post" class="form-absensi" id="form-abs-<?php echo $lokasi->id_lokasi ?>">
                        </p>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-4">
                                        <div class='form-group'><b>Tgl Absensi</b>
                                            <input type="datetime" class="form-control datepicker" id="<?php echo $lokasi->tab_name; ?>" name="tgl_absensi" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" value="<?php echo date('Y-m-d') ?>" readonly="readonly" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class='form-group'><b>Jumlah Taruna</b>
                                            <input type="text" class="form-control" name="jumlah_taruna" id="jumlah_taruna" placeholder="Jumlah Taruna Pria" readonly="readonly" />
                                            <div class="error-jumlah_taruna text-red"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class='form-group'><b>Jumlah Taruni</b>
                                            <input type="text" class="form-control" name="jumlah_taruna_wanita" id="jumlah_taruna_wanita" placeholder="Jumlah Taruna Wanita" readonly="readonly" />
                                            <div class="error-jumlah_taruna text-red"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- <div class="col-md-4">
                                <div class='form-group'>Taruna
                                    <input type="text" class="form-control" name="jumlah_taruna_pria_manual" id="jumlah_taruna_pria_manual" placeholder="Jumlah Taruna Pria" readonly />
                                    <div class="error-pria_sehat text-red"></div>
                                </div>
                                <div class='form-group'>Taruni
                                    <input type="text" class="form-control" name="jumlah_taruna_wanita_manual" id="jumlah_taruna_wanita_manual" placeholder="Jumlah Taruna Wanita" readonly />
                                    <div class="error-pria_covid text-red"></div>
                                </div>
                                <div class='form-group'>
                                    <a href="javascript:;" id="btn-manual-taruna" class="btn btn-success btn-manual-taruna" onclick="inputManualTaruna('form-abs-<?php echo $lokasi->id_lokasi ?>')">Set Jumlah Taruna</a>
                                </div>
                            </div> -->
                                    <div class="col-md-6">
                                        <div class='form-group'>Taruna Sehat
                                            <input type="text" class="form-control" name="pria_sehat" id="pria_sehat" placeholder="Jumlah Taruna Pria Sehat" />
                                            <div class="error-pria_sehat text-red"></div>
                                        </div>
                                        <div class='form-group'>Taruna Terpapar Covid
                                            <input type="text" class="form-control" name="pria_covid" id="pria_covid" placeholder="Jumlah Taruna Pria Terpapar Covid" />
                                            <div class="error-pria_covid text-red"></div>
                                        </div>
                                        <div class='form-group'>Taruna Sakit/Ijin dan lainnya
                                            <input type="text" class="form-control" name="pria_ijin" id="pria_ijin" placeholder="Jumlah Taruna Pria Sakit/Ijin dan lainnya" />
                                            <div class="error-pria_ijin text-red"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class='form-group'>Taruni Sehat
                                            <input type="text" class="form-control" name="wanita_sehat" id="wanita_sehat" placeholder="Jumlah Taruna Wanita Sehat" />
                                            <div class="error-wanita_sehat text-red"></div>
                                        </div>
                                        <div class='form-group'>Taruni Terpapar Covid
                                            <input type="text" class="form-control" name="wanita_covid" id="wanita_covid" placeholder="Jumlah Taruna Wanita Terpapar Covid" />
                                            <div class="error-wanita_covid text-red"></div>
                                        </div>
                                        <div class='form-group'>Taruni Sakit/Ijin dan lainnya
                                            <input type="text" class="form-control" name="wanita_ijin" id="wanita_ijin" placeholder="Jumlah Taruna Wanita Sakit/Ijin dan lainnya" />
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
                                <input type="hidden" name="id_lokasi" value="<?php echo $lokasi->id; ?>" />
                                <!-- <input type="hidden" name="id" value="<?php echo $id ?>" /> -->
                                <!-- <input type="hidden" name="uid" value="<?php echo $uid; ?>" /> -->
                                <!-- <input type="hidden" name="id_kampus" value="<?php echo $id_kampus; ?>" /> -->
                                <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                                <a href="<?php echo site_url('transaksi') ?>" class="btn btn-default">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>

                <script>
                    $(document).ready(function(e) {

                        $("#btn-manual-taruna").click();


                        // var idModal = '#modalInputManualTaruna';
                        // $(idModal).modal().show();


                        // $('#tab2').ready(function(d) {
                        //     $("#btn-manual-taruna").click();
                        // });
                        // $('#tab3').ready(function(d) {
                        //     $("#btn-manual-taruna").click();
                        // });
                        // $("#tab1").on('click', function(e) {

                        //     $("#btn-manual-taruna").click();

                        // });
                        // $("#tab2").click(function(e) {

                        //     $("#btn-manual-taruna").click();

                        // });
                        // $("#tab3").click(function(e) {

                        //     $("#btn-manual-taruna").click();

                        // });

                        var idForm = '#<?php echo "form-abs-$lokasi->id_lokasi" ?>';
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
            <?php } ?>
        </div>
    </div>

</div>


<script>
    function inputManualTaruna(idform = '') {
        var idModal = '#modalInputManualTaruna';
        $(idModal).modal();
        $(idModal + ' input[name="idForm"]').val(idform);
        $(`${idModal} input[name="jumlah_taruna"]`).val($(`#${idform} input[name="jumlah_taruna_pria_manual"]`).val());
        $(`${idModal} input[name="jumlah_taruni"]`).val($(`#${idform} input[name="jumlah_taruna_wanita_manual"]`).val());
    }

    function closeModalTaruna() {
        var idModal = '#modalInputManualTaruna';
        $(idModal).modal("toggle");

        var jumlah_taruna = $(`${idModal} input[name="jumlah_taruna"]`);
        var jumlah_taruni = $(`${idModal} input[name="jumlah_taruni"]`);
        var idForm = $(`${idModal} input[name="idForm"]`);

        $(`#${idForm.val()} input[name="jumlah_taruna_pria_manual"]`).val(jumlah_taruna.val());
        $(`#${idForm.val()} input[name="jumlah_taruna_wanita_manual"]`).val(jumlah_taruni.val());

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
                            <input type="text" class="form-control" name="jumlah_taruna" placeholder="" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="lastname" class="col-sm-4 control-label">Jumlah Taruni:</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="jumlah_taruni" placeholder="" value="">
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
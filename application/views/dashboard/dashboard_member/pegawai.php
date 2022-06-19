<div class="box box-solid box-primary">
    <div class="box-header with-border text-center">
        <h2 class="box-title">Informasi Kondisi Pegawai</h2>

        <!-- <div class="box-tools pull-right">
        </div> -->
    </div>

    <div class="box-body">
        <h4 class="text-center">Jumlah Pegawai = <span class="jml-pegawai">0</span></h4>

        <!-- Info Jumlah Status pegawai -->
        <div class="row">
            <div class="col-md-3">
                <div class="info-box bg-green">
                    <span class="info-box-number jml-pegawai-sehat">0</span>
                    <div class="info-box-title">Sehat</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-box bg-yellow">
                    <span class="info-box-number jml-pegawai-izin">0</span>
                    <div class="info-box-title">Cuti/Izin & Lainnya</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-box bg-aqua">
                    <span class="info-box-number jml-pegawai-izin">0</span>
                    <div class="info-box-title">Sakit</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-box bg-red">
                    <span class="info-box-number jml-pegawai-covid">0</span>
                    <div class="info-box-title">Terkonfirmasi Covid-19</div>
                </div>
            </div>
            <!-- <div class="col-md-2">
                <div class="info-box bg-aqua">
                    <span class="info-box-number jml-pegawai-update">0</span>
                    <div class="info-box-title">Update perkantor</div>
                </div>
            </div> -->
        </div>

        <div class="clearfix"></div>
        <hr />

        <!-- <h4 class="text-center">Lokasi Taruna & Taruni</h4> -->
        <div class="row p-0 m-0">
            <div class="col-md-6 box-loading-ajax-pegawai" style="margin: 0; border: solid 1px grey">

                <canvas id="myChartVaksin"></canvas>
            </div>
            <div class="col-md-6 box-loading-ajax-pegawai" style="margin: 0; border: solid 1px grey">

                <canvas id="myChartlokasi"></canvas>
            </div>

        </div>

    </div>
</div>

<script>
    $(document).ready(function() {
        var clsJmlPegawai = '.jml-pegawai';
        var clsLoadingPegawai = '.box-loading-ajax-pegawai';
        var elmJmlKantor = $(clsJmlPegawai);
        var elmPegawaiSehat = $(clsJmlPegawai + '-sehat');
        var elmPegawaiCovid = $(clsJmlPegawai + '-covid');
        var elmPegawaiijin = $(clsJmlPegawai + '-izin');
        var elmPegawaiSakit = $(clsJmlPegawai + '-sakit')
        var elmPegawaiUpdate = $(clsJmlPegawai + '-update');

        var get_data_kantor = function(value = '') {
            $.ajax({
                url: '<?php echo base_url('/dashboard/get_data_kantor') ?>',
                method: 'POST',
                data: {
                    tanggal: value
                },
                beforeSend: function() {
                    loading.start(clsLoadingPegawai);
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    contentPegawai.info(data.absensi);
                    contentPegawai.chart(data.absensi);
                    elmPegawaiUpdate.html(`${data.update_kantor} / ${data.jumlah_kantor}`);
                    loading.stop(clsLoadingPegawai);
                }
            })
        }

        var contentPegawai = {
            info: function(data) {
                var result = {
                    jumlah: parseInt(data.jumlah_pegawai),
                    sehat: parseInt(data.sehat),
                    covid: parseInt(data.covid),
                    ijin: parseInt(data.ijin),
                    sakit: parseInt(data.sakit)
                }

                elmJmlKantor.html(result.jumlah);
                elmPegawaiSehat.html(result.sehat);
                elmPegawaiCovid.html(result.covid);
                elmPegawaiijin.html(result.ijin);
                elmPegawaiSakit.html(result.sakit);
            },
            chart: function(data) {
                ChartVaksin.data.datasets.forEach(dataset => {
                    dataset.data = [data.vaksin1, data.vaksin2, data.vaksin_lain];
                });
                ChartVaksin.update();

                ChartLokasi.data.datasets.forEach(dataset => {
                    dataset.data = [data.wfh, data.wfo, data.dinas_luar, data.cuti];
                });
                ChartLokasi.update();
            }
        }

        get_data_kantor('<?php echo date('Y-m-d') ?>');


        // chart vaksin
        var ctxVaksin = document.getElementById('myChartVaksin').getContext('2d');

        var ChartVaksin = new Chart(ctxVaksin, {
            type: 'doughnut',
            // data: data,
            options: {
                responsive: true,
                maintainAspectRatio: true,
                title: {
                    display: true,
                    text: 'Informasi Vaksin Kepegawaian',
                    fontSize: 24
                },
                layout: {
                    padding: {
                        left: 5,
                        right: 5,
                        top: 5,
                        bottom: 5
                    }
                },
                legend: {
                    display: true,
                    position: 'left'
                }
            },
            data: {
                datasets: [{
                    backgroundColor: COLORS_CHART,
                    data: []
                }],
                labels: ['Vaksin 1', 'Vaksin 2', 'Vaksin Booster']
            }
        });

        // chart lokasi
        var ctxLokasi = document.getElementById('myChartlokasi').getContext('2d');

        var ChartLokasi = new Chart(ctxLokasi, {
            type: 'doughnut',
            // data: data,
            options: {
                responsive: true,
                maintainAspectRatio: true,
                title: {
                    display: true,
                    text: 'Informasi Lokasi Pegawai',
                    fontSize: 24
                },
                layout: {
                    padding: {
                        left: 5,
                        right: 5,
                        top: 5,
                        bottom: 5
                    }
                },
                legend: {
                    display: true,
                    position: 'left'
                }
            },
            data: {
                datasets: [{
                    backgroundColor: COLORS_CHART,
                    data: []
                }],
                labels: ['WFH', 'WFO', 'Dinas Luar', 'Cuti']
            }
        });
    })
</script>
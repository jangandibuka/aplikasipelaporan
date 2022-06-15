<div class="box box-solid box-default">
    <div class="box-header with-border text-center">
        <h3 class="box-title">Informasi Kondisi Taruna</h3>

        <!-- <div class="box-tools pull-right">
        </div> -->
    </div>

    <div class="box-body">
        <h4 class="text-center">Jumlah Taruna & Taruni = <span class="jml-taruna">0</span></h4>
        <hr />
        <!-- Info Jumlah Status Taruna -->
        <div class="row">
            <div class="col-md-3">
                <div class="info-box bg-green">
                    <span class="info-box-number jml-taruna-sehat">0</span>
                    <div class="info-box-title">Sehat</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-box bg-yellow">
                    <span class="info-box-number jml-taruna-izin">0</span>
                    <div class="info-box-title">Sakit/Izin & Lainnya</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-box bg-red">
                    <span class="info-box-number jml-taruna-covid">0</span>
                    <div class="info-box-title">Terkonfirmasi Covid-19</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-box bg-aqua">
                    <span class="info-box-number jml-taruna-update">0</span>
                    <div class="info-box-title">Update perkampus</div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>
        <hr />
        <!-- Info Lokasi Taruna -->
        <h4 class="text-center">Lokasi Taruna & Taruni</h4>
        <div class="row p-0 m-0">
            <div class="col-md-6 box-loading-ajax p-0">
                <div class="col-md-5 p-0">
                    <img src="<?php echo base_url(); ?>assets/img/pria-taruna.png" height="180px" width="80px">
                    <img src="<?php echo base_url(); ?>assets/img/wanita-taruna.png" height="180px" width="80px">
                </div>
                <div class="col-md-7 p-0">
                    <div style="font-size: 30px;" class="jumlah-absensi"></div>
                </diV>
            </div>
            <div class="col-md-6 box-loading-ajax" style="margin: 0;">

                <canvas id="myChart"></canvas>
            </div>
        </div>

        <div class="clearfix"></div>
        <hr />

        <div class="row">
            <div class="col-md-4 box-loading-ajax">
                <canvas id="persen-update-taruna"></canvas>
            </div>
            <div class="col-md-8 box-loading-ajax">
                <canvas id="covid-bulan-taruna"></canvas>
            </div>
        </div>

        <div class="clearfix"></div>
        <hr />
        <div class="row">
            <div class="col-md-4 box-loading-ajax" style="height: 300px;"><canvas id="chart-kondisi-sehat-taruna"></canvas></div>
            <div class="col-md-4 box-loading-ajax" style="height: 300px;"><canvas id="chart-kondisi-covid-taruna"></canvas></div>
            <div class="col-md-4 box-loading-ajax" style="height: 300px;"><canvas id="chart-kondisi-ijin-taruna"></canvas></div>
        </div>

    </div>
</div>
<script src="<?php echo base_url('assets/js/plugins/chartjs/chartjs-plugin-doughnutlabel.min.js') ?>"></script>
<script>
    $(document).ready(function() {
        var clsAbsensi = '.jumlah-absensi';
        var elmAbsensi = $(clsAbsensi);
        var clsLoading = '.box-loading-ajax';
        var clsJmlTaruna = '.jml-taruna';
        var elmJumlahTaruna = $(clsJmlTaruna);
        var elmSehat = $(clsJmlTaruna + '-sehat');
        var elmCovid = $(clsJmlTaruna + '-covid');
        var elmijin = $(clsJmlTaruna + '-izin');
        var elmUpdate = $(clsJmlTaruna + '-update');


        var get_data = function(value = '') {
            $.ajax({
                url: '<?php echo base_url('dashboard/get_data') ?>',
                method: 'POST',
                data: {
                    tanggal: value
                },
                beforeSend: function() {
                    loading.start(clsLoading);
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    content.info(data.absensi);
                    content.absensi(data.absensi);
                    content.chart(data.absensi);
                    content.chartPercent(data.jumlah_taruna, data.update_taruna);
                    content.chartKonsisi(data.absensi);
                    content.chartTerpaparCovid(data.terpapar_covid);
                    elmUpdate.html(`${data.update_taruna} / ${data.jumlah_taruna}`);
                    loading.stop(clsLoading);
                }
            })
        }

        var content = {
            info: function(data) {
                var result = {
                    jumlah: 0,
                    sehat: 0,
                    covid: 0,
                    ijin: 0
                }
                data.forEach(function(data) {
                    result.jumlah += parseInt(data.jumlah_taruna);
                    result.sehat += parseInt(data.sehat);
                    result.covid += parseInt(data.covid);
                    result.ijin += parseInt(data.ijin);
                });
                elmJumlahTaruna.html(result.jumlah);
                elmSehat.html(result.sehat);
                elmCovid.html(result.covid);
                elmijin.html(result.ijin);
            },
            absensi: function(data) {
                var html = '';
                var jumlah_taruna = data.reduce(function(result, item) {
                    result += parseInt(item.jumlah_taruna);
                    return result;
                }, 0);
                data.map(function(item) {
                    var total_star = 10;
                    var hit = Math.round(((item.jumlah_taruna / jumlah_taruna) * 100) / total_star);
                    // var hit = Math.round((item.jumlah_taruna / 1000));
                    html += `<div>`;
                    for (var c = 1; c <= total_star; c++) {
                        if (c <= hit) {
                            html += `<span class="fa fa-male fa-10x checked"></span> `;
                        } else {
                            html += `<span class="fa fa-male fa-10x"></span> `;
                        }
                    }
                    html += `<div style="font-size: 14px;">TARUNA on ${item.lokasi} : ${item.jumlah_taruna}</div>
                        </div>
                    `;
                });
                elmAbsensi.html(html);
            },
            chart: function(data) {
                var dataChart = {
                    labels: [],
                    data: []
                };


                data.map(function(item) {
                    dataChart.labels.push(item.lokasi);
                    dataChart.data.push(item.jumlah_taruna);
                });

                ChartTaruna.data.labels = dataChart.labels;
                ChartTaruna.data.datasets.forEach(dataset => {
                    dataset.data = dataChart.data;
                });
                ChartTaruna.update();

            },
            chartPercent: function(jumlah, update) {
                var blmUpdate = jumlah - update;
                var persen = (update / jumlah) * 100;
                ChartPersenUpdateTaruna.data.datasets[0].data = [update, blmUpdate];
                ChartPersenUpdateTaruna.options.plugins.doughnutlabel.labels[0].text = persen.toFixed(2) + '%';
                ChartPersenUpdateTaruna.update();
            },
            chartTerpaparCovid: function(data) {
                data.map(function(d) {
                    var arrKey = parseInt(d.tgl_absensi.split('-')[2]) - 1;
                    ChartCovidBulan.data.datasets[0].data[arrKey] = d.COVID;
                });
                ChartCovidBulan.update();
            },
            chartKonsisi: function(data) {
                var dataKondisi = data.reduce(function(a, b) {
                    Object.keys(b).map(function(c) {
                        if (a[c] != undefined) {
                            a[c] += parseInt(b[c]);
                        } else {
                            a[c] = parseInt(b[c]);
                        }
                    })

                    return a;
                }, {});


                ChartSehatTaruna.data.datasets[0].data = [dataKondisi.sehat_wanita];
                ChartSehatTaruna.data.datasets[1].data = [dataKondisi.sehat_pria];
                ChartSehatTaruna.update();

                ChartCovidTaruna.data.datasets[0].data = [dataKondisi.covid_wanita];
                ChartCovidTaruna.data.datasets[1].data = [dataKondisi.covid_pria];
                ChartCovidTaruna.update();

                CharIjinTaruna.data.datasets[0].data = [dataKondisi.ijin_wanita];
                CharIjinTaruna.data.datasets[1].data = [dataKondisi.ijin_pria];
                CharIjinTaruna.update();
            }
        }

        get_data('<?php echo date('Y-m-d') ?>');

        // chart
        var ctx = document.getElementById('myChart').getContext('2d');

        var ChartTaruna = new Chart(ctx, {
            type: 'doughnut',
            // data: data,
            options: {
                responsive: true,
                maintainAspectRatio: true,
                layout: {
                    padding: {
                        left: 0,
                        right: 0
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
                labels: []
            }
        });


        // chart terkonfirmasi covid dalam 1 bulan
        var dt = new Date();
        var month = dt.getMonth();
        var year = dt.getFullYear();
        var daysInMonth = new Date(year, month + 1, 0).getDate();
        var dat = {
            labels: [],
            data: []
        };

        for (var i = 1; i <= daysInMonth; i++) {
            // let d = year;
            // let m = month + 1;
            // d += m < 10 ? `-0${m}` : `-${m}`;
            // d += i < 10 ? `-0${i}` : `-${i}`;
            // dat.labels.push(d);
            i = i < 10 ? `0${i}` : i;
            dat.labels.push(i)
            dat.data.push(0);
        }

        var ctx_covid_bulan = document.getElementById('covid-bulan-taruna').getContext('2d');
        const ChartCovidBulan = new Chart(ctx_covid_bulan, {
            type: 'line',
            options: {
                title: {
                    display: true,
                    text: 'Data Terkonfirmasi Covid-19 Taruna & Taruni',
                    fontSize: 16
                },
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            min: 0,
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            // autoSkip: false,
                            // padding: 10,
                            // maxRotation: 90,
                            // minRotation: 90
                        }
                    }]
                },
                tooltips: {
                    callbacks: {
                        title: function(tooltipItem, data) {
                            var label = 'Tanggal ' + tooltipItem[0].xLabel;
                            return label
                        },
                        label: function(tooltipItem, data) {
                            var label = data.datasets[tooltipItem.datasetIndex].label || '';

                            if (label) {
                                label += ': ';
                            }
                            label += Math.round(tooltipItem.yLabel * 100) / 100;
                            return " " + label + " orang";
                        }
                    }
                }
            },
            data: {
                labels: dat.labels,
                datasets: [{
                    label: '',
                    data: dat.data,
                    fill: true,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                }]
            }
        });


        // chart persen update taruna
        var ctx_persen_update_taruna = document.getElementById('persen-update-taruna').getContext('2d');
        const ChartPersenUpdateTaruna = new Chart(ctx_persen_update_taruna, {
            type: 'doughnut',
            data: {
                labels: ['Sudah Update', 'Belum Update'],
                datasets: [{
                    backgroundColor: [COLORS_CHART[5], '#ccc'],
                    data: [50, 60]
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Update Harian Per Kampus',
                    fontSize: 16
                },
                cutoutPercentage: 80,
                plugins: {
                    doughnutlabel: {
                        labels: [{
                            text: '',
                            font: {
                                size: 20,
                                weight: 'bold'
                            }
                        }]
                    }
                }
            }
        })


        // chart Kondisi
        const configChartKondisi = function(title = '', color = [0, 0, 0]) {
            var bgPerempuan = `rgba(${color[0]}, ${color[1]}, ${color[2]}, 1)`,
                bgLakiLaki = `rgba(${color[0]}, ${color[1]}, ${color[2]}, 0.7)`;

            return {
                type: 'bar',
                options: {
                    title: {
                        display: true,
                        text: title,
                        fontSize: 16
                    },
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        yAxes: [{
                            // display: true,
                            ticks: {
                                beginAtZero: true,
                                min: 0,
                                // stepSize: 1,
                                // suggestedMin: 0
                            }
                        }]
                    }
                },
                data: {
                    labels: [''],
                    datasets: [{
                            label: 'Perempuan',
                            data: [],
                            backgroundColor: bgPerempuan,
                        },
                        {
                            label: 'Laki - Laki',
                            data: [],
                            backgroundColor: bgLakiLaki,
                        }
                    ]
                },
            }
        };

        // Kondisi Sehat
        var ctx_kondisi_sehat_taruna = document.getElementById('chart-kondisi-sehat-taruna').getContext('2d');
        var ChartSehatTaruna = new Chart(ctx_kondisi_sehat_taruna, configChartKondisi('Sehat Per Gender', [75, 192, 192]));

        // Kondisi Covid
        var ctx_kondisi_covid_taruna = document.getElementById('chart-kondisi-covid-taruna').getContext('2d');
        var ChartCovidTaruna = new Chart(ctx_kondisi_covid_taruna, configChartKondisi('Terkonfirmasi Positif Per Gender', [255, 99, 132]));

        // Kondisi Ijin
        var ctx_kondisi_ijin_taruna = document.getElementById('chart-kondisi-ijin-taruna').getContext('2d');
        var CharIjinTaruna = new Chart(ctx_kondisi_ijin_taruna, configChartKondisi('Izin/Sakit & Lainnya Per Gender', [255, 205, 86]));

    });
</script>
<section class="content-header">
    <h1>
        Dashboard
        <small>Aplikasi Pelaporan</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>
                        <?php
                        foreach ($jumlah_kampus as $r) {
                            echo $r->jumlah_kampus;
                        }
                        ?>
                    </h3>
                    <p>Jumlah Instansi</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="<?php echo base_url('kampus'); ?>" class="small-box-footer">More Detail <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>
                        <?php
                        foreach ($kampus_aktif as $k) {
                            echo $k->kampus_aktif;
                        }
                        ?>
                    </h3>
                    <p>Instansi Aktif</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="<?php echo base_url('transaksi/lunas'); ?>" class="small-box-footer">More Detail <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>
                        <?php echo $user; ?>
                    </h3>
                    <p>Total Users </p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="<?php echo base_url('pelanggan'); ?>" class="small-box-footer">More Deatail <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->

    </div><!-- /.row -->

    <!-- Left col -->
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Data Instansi Terbaru</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table class="table no-margin">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Instansi</th>
                            <th>Nama PIC</th>
                            <th>Alamat</th>
                            <th>Email</th>
                            <th>Propinsi</th>
                            <th>Kota/Kabupaten</th>
                            <th>Tgl. Dibuat</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($kampus as $kampus) {
                            if ($kampus->is_active == 1) {
                                $status = "<span class='label label-success'>Aktif</span>";
                            } elseif ($transaksi->status == 0) {
                                $status = "<span class='label label-danger'>Tidak Aktif</span>";
                            }
                        ?>
                            <tr>
                                <td><?php echo $no ?></td>
                                <td><?php echo $kampus->kampus ?></td>
                                <td><?php echo $kampus->pimpinan ?></td>
                                <td><?php echo $kampus->alamat ?></td>
                                <td><?php echo $kampus->email ?></td>
                                <td><?php echo $kampus->propinsi ?></td>
                                <td><?php echo $kampus->kota ?></td>
                                <td><?php echo $kampus->created_date ?></td>
                                <td><?php echo $status ?></td>
                            </tr>
                        <?php
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
            <a href="<?php echo site_url('kampus'); ?>" class="btn btn-sm btn-info btn-flat pull-left">Daftar Kampus</a>
        </div>

    </div>
    <div>
        <canvas id="myChart" width="400" height="400"></canvas>
    </div>
    <div style="padding: 10px 0px; text-align: center;">
        <div class="text">Dashboard analytic</div>
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- iklan_TARUNA -->
        <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-5746089618495474" data-ad-slot="6145123342" data-ad-format="auto"></ins>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
    </div>
</section>

<script>
    const ctx = document.getElementById('myChart').getContext('2d');
    let color = [
        'rgba(255, 99, 132)',
        'rgba(54, 162, 235)',
        'rgba(255, 206, 86)',
        'rgba(75, 192, 192)',
        'rgba(153, 102, 255)',
        'rgba(255, 159, 64)'
    ];
    const myChart = new Chart(ctx, {
        type: 'bar',
        height: '200px',
        options: {
            title: {
                display: true,
                text: 'Status Kesehatan Taruna',
                fontSize: 24
            },
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    // position: 'Bottom'
                }
            }
        },
        data: {
            labels: ['A', 'B', 'C'],
            datasets: [{
                    label: 'Sehat',
                    data: [10, 9, 10],
                    backgroundColor: color[1]
                },
                {
                    label: 'Terkonfirmasi Covid-19',
                    data: [1, 2, 2],
                    backgroundColor: color[2]
                },
                {
                    label: 'Izin/Sakit Lainnya',
                    data: [1, 1, 0],
                    backgroundColor: color[3]
                }
            ]
        }
        // data: {
        //     labels: ['Sehat', 'Terkonfirmasi Covid 19', 'Izin/Sakil Lainnya'],
        //     datasets: [{
        //         label:'Sehat',
        //     }]
        //     // labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        //     // datasets: [{
        //     //     label: 'Sehat',
        //     //     data: [12, 19, 3, 5, 2, 3],
        //     //     backgroundColor: [
        //     //         'rgba(255, 99, 132)',
        //     //         'rgba(54, 162, 235)',
        //     //         'rgba(255, 206, 86)',
        //     //         'rgba(75, 192, 192)',
        //     //         'rgba(153, 102, 255)',
        //     //         'rgba(255, 159, 64)'
        //     //     ],
        //     //     // borderColor: [
        //     //     //     'rgba(255, 99, 132, 1)',
        //     //     //     'rgba(54, 162, 235, 1)',
        //     //     //     'rgba(255, 206, 86, 1)',
        //     //     //     'rgba(75, 192, 192, 1)',
        //     //     //     'rgba(153, 102, 255, 1)',
        //     //     //     'rgba(255, 159, 64, 1)'
        //     //     // ],
        //     //     borderWidth: 1
        //     // }]
        // },
    });
</script>
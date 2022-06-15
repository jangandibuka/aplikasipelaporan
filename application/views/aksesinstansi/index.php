<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class='box-header with-border'>
                    <h3 class="box-title">User Akses Instansi</h3>
                    <label class='box-tools pull-right action-menu'>

                    </label>
                </div>
                <div class="box-body table-responsive">
                    <table id="table-menu-setting" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>User</th>
                                <th>Akses Instansi</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
</section><!-- /.content -->

<script src="<?php echo base_url('assets/js/jquery-1.12.0.min.js') ?>"></script>

<script>
    $(document).ready(function() {
        var table = "#table-menu-setting";
        $.ajax({
            url: '<?php echo base_url('/aksesinstansi/get_data') ?>',
            beforeSend: function() {
                $(table + ' tbody').html('<td colspan="4" class="text-center text-bold">Loading...</td>');
            },
            success: function(response) {
                var data = JSON.parse(response);
                var html = '';
                data.map(function(item, index) {
                    var htmlInstansi = '';
                    if (item.kampus) {
                        var kampus = JSON.parse('[' + item.kampus + ']');
                        // htmlInstansi += '<ul>';
                        kampus.map(function(i, k) {
                            htmlInstansi += `${k + 1}. ${i.nama_instansi} (${i.type_instansi})</br>`;
                        })
                        // htmlInstansi += '</ul>';
                    } else {
                        htmlInstansi += '-';
                    }
                    html += `<tr>
                        <td>${index + 1}</td>
                        <td>${item.first_name} ${item.last_name}</td>
                        <td>${htmlInstansi}</td>
                        <td><a href="<?php echo base_url() ?>aksesinstansi/setting/${item.id}" class="btn btn-primary btn-sm"><i class="fa fa-gears"></i> Setting</a></td>
                    </tr>`;

                });

                $(table + ' tbody').html(html);
            }
        })
    })
</script>
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
                                <th>Nama Instansi</th>
                                <th>Type Instansi</th>
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
        var id = '<?php echo $id ?>';
        var menu_data = [];

        $(document).on('click', '.btn-save', function(e) {
            var elm = $('input[type="checkbox"]');
            // var type = $(select).val();
            var data_insert = [];
            var data_delete = [];
            elm.each(function(index, elmt) {
                var value = elmt.value;
                var checked = elmt.checked;
                var data = menu_data.filter(f => f.id == value)[0];
                var akses_load = data.id_akses != null ? true : false;

                if (checked != akses_load) {
                    if (akses_load) {
                        data_delete.push(data.id_akses);
                    } else {
                        data_insert.push({
                            id_instansi: value,
                            id_users: id
                        })
                    }
                }
            });

            $.ajax({
                url: '<?php echo base_url('aksesinstansi/action') ?>',
                data: {
                    insert: data_insert,
                    delete: data_delete
                },
                method: "POST",
                beforeSend: function(data) {
                    $('.btn-save').html('loading...').attr('disabled', true);
                },
                success: function(response) {
                    document.location.href = '<?php echo base_url('/aksesinstansi') ?>'
                }
            })
        });



        $.ajax({
            url: '<?php echo base_url('/aksesinstansi/get_data/') ?>' + id,
            beforeSend: function() {
                $(table + ' tbody').html('<td colspan="3" class="text-center text-bold">Loading...</td>');
            },
            success: function(response) {
                var data = JSON.parse(response);
                var html = '';
                menu_data = data;
                if (data.length > 0) {
                    var button = `
                    <button class="btn btn-primary btn-sm btn-save"><i class="fa fa-pencil"></i> Update</button>
                    <a href="<?php echo base_url('/aksesinstansi') ?>" class="btn btn-success btn-sm"><i class="fa fa-arrow-left"></i> Batal</a>
                    `;
                    $('.action-menu').append(button);
                }
                data.map(function(item, index) {
                    html += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${item.kampus}</td>
                        <td>${item.instansi}</td>
                        <td><input type="checkbox" name="akses[]" value="${item.id}" ${item.id_akses != null ? 'checked="checked"' : ''}></td>
                    </tr>
                    `;
                });

                $(table + ' tbody').html(html);
            }
        })
    })
</script>
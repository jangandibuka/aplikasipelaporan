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
                                <th>Jenis Instansi</th>
                                <th colspan="2">
                                    <select class="form-control" id="instansi_type">
                                        <option value="">-- Pilih Jenis Instansi --</option>
                                        <?php
                                        foreach ($select as $row) {
                                            echo "<option value='$row->id'>$row->instansi</option>";
                                        }
                                        ?>
                                    </select>
                                </th>
                            </tr>
                            <tr>
                                <th>No</th>
                                <th>Lokasi</th>
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
        var elmTable = $(table + ' tbody');
        var select = "#instansi_type";
        var elmSelect = $(select);
        var menu_data = [];

        $(select).change(function(e) {
            get_data();
        })

        $(document).on('click', '.btn-save', function(e) {
            var elm = $('input[type="checkbox"]');
            var type = $(select).val();
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
                            id_lokasi: value,
                            id_instansi_type: type
                        })
                    }
                }
            });

            $.ajax({
                url: '<?php echo base_url('akseslokasi/action') ?>',
                data: {
                    insert: data_insert,
                    delete: data_delete
                },
                method: "POST",
                beforeSend: function(data) {
                    $('.btn-save').html('loading...').attr('disabled', true);
                    elmSelect.attr('disabled', true);
                },
                success: function(response) {
                    get_data();
                }
            })
        });

        var get_data = function() {
            var type = elmSelect.val();
            $.ajax({
                url: '<?php echo base_url('/akseslokasi/get_data') ?>',
                method: 'POST',
                data: {
                    type: type
                },
                beforeSend: function() {
                    tableInit.loading();
                    $('.action-menu').html('');
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    tableInit.generate(data);
                    menu_data = data;
                }
            })
        }

        var tableInit = {
            generate: function(data) {
                var html = '';
                if (data.length > 0) {
                    $('.action-menu').append('<button class="btn btn-primary btn-sm btn-save"><i class="fa fa-pencil"></i> Update</button>');
                }
                data.map(function(item, index) {
                    html += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${item.lokasi}</td>
                        <td><input type="checkbox" name="akses[]" value="${item.id}" ${item.id_akses != null ? 'checked="checked"' : ''}></td>
                    </tr>
                    `;
                })
                elmTable.html(html);
                elmSelect.attr('disabled', false);
            },
            loading: function() {
                elmTable.html('<td colspan="3" class="text-center text-bold">Loading...</td>');
                elmSelect.attr('disabled', true);
            }
        }
    })
</script>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class='box-header with-border'>
                    <h3 class="box-title">Menu Akses</h3>
                    <label class='box-tools pull-right action-menu'>

                    </label>
                </div>
                <div class="box-body table-responsive">
                    <select id="user-type" class="form-control">
                        <option value="">Pilih User Type</option>
                        <option value="Administrator">Administrator</option>
                        <option value="Admin">PIC Kampus</option>
                        <option value="Office">PIC Office</option>
                    </select>
                    <hr />
                    <table id="table-menu-setting" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Menu</th>
                                <th>Icon</th>
                                <th>link url</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>

                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
</section><!-- /.content -->

<script src="<?php echo base_url('assets/js/jquery-1.12.0.min.js') ?>"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var table = '#table-menu-setting';
        var select = '#user-type';
        var menu_data = [];


        $(select).change(function(e) {
            getData();
        })

        $(document).on('click', '.btn-save', function(e) {
            var elm = $('input[type="checkbox"]');
            var type = $(select).val();
            var data_insert = [];
            var data_delete = [];
            elm.each(function(index, elmt) {
                var value = elmt.value;
                var checked = elmt.checked;
                var data = menu_data.filter(f => f.id_menu == value)[0];
                var akses_load = data.akses == 'Y' ? true : false;

                if (checked != akses_load) {
                    if (akses_load) {
                        data_delete.push(value);
                    } else {
                        data_insert.push({
                            id_menu: value,
                            user_type: type
                        })
                    }
                }
            });

            $.ajax({
                url: '<?php echo base_url('akses/action') ?>',
                data: {
                    insert: data_insert,
                    delete: data_delete
                },
                method: "POST",
                beforeSend: function(data) {
                    $('.btn-save').html('loading...').attr('disabled', true);
                },
                success: function(response) {
                    getData();
                }
            })
        });


        function getData() {
            var type = $(select).val();
            $.ajax({
                url: '<?php echo base_url('akses/get_data') ?>',
                method: 'POST',
                data: {
                    type: type
                },
                beforeSend: function(e) {
                    tableInit.loading();
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    tableInit.generate(data);
                    menu_data = data;
                },
                error: function(error) {
                    console.log(error);
                }
            })

        }

        var tableInit = {
            generate: function(data) {
                var data = data;
                var menu = data.filter(f => f.parent == '0');
                var html = '';

                if (data.length > 0) {
                    $('.action-menu').append('<button class="btn btn-primary btn-sm btn-save"><i class="fa fa-pencil"></i> Update</button>');
                }

                menu.map(function(item, index) {
                    let dataChild = data.filter(f => f.parent == item.id_menu);
                    let rowSpan = dataChild.length > 0 ? `rowspan="${dataChild.length + 1}"` : '';
                    let htmlChild = '';
                    dataChild.map(function(ic, id) {
                        htmlChild += `
                            <tr>
                                <td>${ic.nama_menu}</td>
                                <td>${ic.icon}</td>
                                <td>${ic.link}</td>
                                <td><input type="checkbox" name="akses[]" value="${ic.id_menu}" ${ic.akses == 'Y' ? 'checked="checked"' : ''}></td>
                            </tr>`;
                    });
                    html += `
                            <tr>
                                <td ${rowSpan}>${index + 1}</td>
                                <td>${item.nama_menu}</td>
                                <td>${item.icon}</td>
                                <td>${item.link}</td>
                                <td><input type="checkbox" name="akses[]" value="${item.id_menu}" ${item.akses == 'Y' ? 'checked="checked"' : ''}></td>
                            </tr>
                    ${htmlChild}
                    `;
                });

                $(table + ' tbody').html(html);
                $(select).attr('disabled', false);
            },
            loading: function() {
                $(select).attr('disabled', true);
                $('.action-menu').html('');
                $(table + ' tbody').html(`<tr><td colspan="5" style="text-align: center;">Loading...</td></tr>`);
            }
        }


    });
</script>
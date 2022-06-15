<section class="content-header">
    <h1>
        <?php echo strtoupper(lang('create_user_heading')); ?>
        <small><?php echo lang('create_user_subheading'); ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-suitcase"></i>Seting</a></li>
        <li class="active"><?php echo lang('create_user_heading'); ?></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <div class="col-md-5">
                        <?php
                        echo form_open('auth/create_user');
                        ?>
                        <div class="text-red"><?php echo $message; ?></div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="example">Nama Depan</label>
                                <input type="text" name="first_name" id="first_name" class="form-control" required oninvalid="setCustomValidity('Nama Depan !')" oninput="setCustomValidity('')" placeholder="Masukan Nama Depan">
                            </div>
                            <div class="form-group">
                                <label for="">Nama Belakang</label>
                                <input type="text" class="form-control" name="last_name" id="last_name" required oninvalid="setCustomValidity('Nama Belakang !')" oninput="setCustomValidity('')" placeholder="Masukan Nama Belakang">
                            </div>
                            <div class="form-group">
                                <label for="">Username</label>
                                <input type="text" class="form-control" name="username" id="username" required oninvalid="setCustomValidity('Nama Pengguna !')" oninput="setCustomValidity('')" placeholder="Nama Pengguna">
                                <?php echo form_error('username', '<div class="text-red">', '</div>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="">Alamat Email</label>
                                <input type="email" class="form-control" name="email" id="email" required oninvalid="setCustomValidity('Email Kosong/ Format Tidak Sesuai !')" oninput="setCustomValidity('')" placeholder="example@example.com">
                            </div>
                            <div class='form-group'><?php echo form_error('id_kampus') ?>
                                <label for="">Instansi</label>
                                <select id="id_kampus" name="id_kampus" class="form-control">
                                    <option value="" selected>Pilih Instansi/Kampus</option>
                                    <?php foreach ($kampus as $row) : ?>
                                        <?php //if($id_kampus == $row->id){ 
                                        ?>
                                        <!--<option selected value="<?php echo $row->id; ?>"><?php echo $row->kampus; ?></option>-->
                                        <?php //}else{ 
                                        ?>
                                        <option value="<?php echo $row->id; ?>"><?php echo $row->kampus; ?></option>
                                        <?php //} 
                                        ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" class="form-control" name="password" id="password" required oninvalid="setCustomValidity('Password Kosong !')" oninput="setCustomValidity('')" placeholder="Masukan Password (min 8 max 20)">
                            </div>
                            <div class="form-group">
                                <label for="">Ulangi Password</label>
                                <input type="password" class="form-control" name="password_confirm" id="password_confirm" required oninvalid="setCustomValidity('Ulang Password Kosong !')" oninput="setCustomValidity('')" placeholder="Ulangi Password">
                            </div>

                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Simpan</button>
                            <a href="javascript:history.back()" class="btn btn-primary">Kembali</a>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class='content-header'>
	<h1>
		PROPINSI
	</h1>
	<ol class='breadcrumb'>
		<li><a href='#'><i class='fa fa-suitcase'></i>Master</a></li>
		<li class='active'>Daftar propinsi</li>
	</ol>
</section>        
<section class='content'>
    <div class='row'> 
        <!-- left column -->
        <div class='col-md-12'>
            <!-- general form elements -->
            <div class='box box-primary'>
                <div class='box-header'>
                <div class='col-md-5'>
        <form action="<?php echo $action; ?>" method="post"><div class='box-body'>
	    <div class='form-group'>Propinsi <?php echo form_error('propinsi') ?>
            <input type="text" class="form-control" name="propinsi" id="propinsi" placeholder="Nama Propinsi" value="<?php echo $propinsi; ?>" />
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('propinsi') ?>" class="btn btn-default">Cancel</a>
	 </div>
            </form>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div>
</section><!-- /.content -->
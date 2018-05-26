<?php $this->load->view('layouts/base_start') ?>

<div class="container">
  <legend>Edit Data Kelas</legend>
  <div class="col-xs-12 col-sm-12 col-md-12">
  <?php echo form_open_multipart('kelas/update/'.$data->kode); ?>

    <?php echo form_hidden('kode', $data->kode) ?>
    
  	<div class="form-group">
      <label for="kelas">Kelas</label>
      <input type="text" class="form-control" id="kelas" name="kelas" placeholder="Masukkan Kelas"
        value="<?php echo $data->gelar ?>">
    </div>

    <?php echo $error;?>

    <a class="btn btn-info" href="<?php echo site_url('kelas/') ?>">Kembali</a>
    <button type="submit" class="btn btn-primary">OK</button>

  <?php echo form_close(); ?>
  </div>
</div>

<?php $this->load->view('layouts/base_end') ?>
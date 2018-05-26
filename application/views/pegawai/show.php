<?php $this->load->view('layouts/base_start') ?>

<div class="container">
  <legend>Lihat Pegawai</legend>
  <div class="content">
    <div class="form-group">
      <label for="nama">Nama</label>
      <p><?php echo $data->nama ?></p>
    </div>
    <div class="form-group">
      <label for="nim">NIM</label>
      <p><?php echo $data->nim ?></p>
    </div>
    <div class="form-group">
      <label for="jurusan">Jurusan</label>
      <p><?php echo $data->jurusan ?></p>
    </div>
    <div class="form-group">
      <label for="foto">Foto</label>
      <p><img src="<?php echo base_url('assets/uploads/').$data->foto; ?>"></p>
      <p><?php echo $data->foto ?></p>
    </div>
    <div class="form-group">
      <label for="jabatan">Jabatan</label>
      <p><?php echo $data->gelar ?></p>
    </div>
    <a class="btn btn-info" href="<?php echo site_url('pegawai/') ?>">Kembali</a>
  </div>
</div>

<?php $this->load->view('layouts/base_end') ?>
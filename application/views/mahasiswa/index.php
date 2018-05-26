<?php $this->load->view('layouts/base_start') ?>

<div class="container">
  <legend>Daftar Mahasiswa</legend>
  <div class="col-xs-12 col-sm-12 col-md-12">
    <table class="table table-striped">
      <thead>
        <th>No</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>
          <a class="btn btn-primary" href="<?php echo site_url('mahasiswa/create/') ?>">
            Tambah
          </a>
        </th>
      </thead>
      <tbody>
        <?php $number = 1; foreach($mahasiswa as $row) { ?>
        <tr>
          <td>
            <a href="<?php echo site_url('mahasiswa/show/'.$row->id) ?>">
              <?php echo $number++ ?>
            </a>
          </td>
          <td>
            <a href="<?php echo site_url('mahasiswa/show/'.$row->id) ?>">
              <?php echo $row->nama ?>
            </a>
          </td>
          <td>
              <a src="<?php echo base_url('mahasiswa/show/').$row->alamat; ?>"> 
              <?php echo $row->alamat; ?>
            </a>
          </td>
          <td>
            <?php echo form_open('mahasiswa/destroy/'.$row->id); ?>
            <a class="btn btn-info" href="<?php echo site_url('mahasiswa/edit/'.$row->id) ?>">
              Ubah
            </a>
            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?')">Hapus</button>
            <?php echo form_close() ?>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>

<?php $this->load->view('layouts/base_end') ?>
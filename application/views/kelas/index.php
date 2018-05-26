<?php $this->load->view('layouts/base_start') ?>

<div class="container">
  <legend>Daftar Kelas</legend>
  <div class="col-xs-12 col-sm-12 col-md-12">
    <table class="table table-striped">
      <thead>
        <th>No</th>
        <th>Kelas</th>
        <th>
          <a class="btn btn-primary" href="<?php echo site_url('kelas/create') ?>">
            Tambah
          </a>
        </th>
      </thead>
      <tbody>
        <?php $number = 1; foreach($kelas as $row) { ?>
        <tr>
          <td>
              <?php echo $number++ ?>
          </td>
          <td>
              <?php echo $row->gelar ?>
          </td>
          <td>
            <?php echo form_open('kelas/destroy/'.$row->kode); ?>
            <a class="btn btn-info" href="<?php echo site_url('kelas/edit/'.$row->kode) ?>">
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
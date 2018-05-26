<?php $this->load->view('layouts/base_start') ?>

<div class="container">
  <legend>Daftar Jabatan</legend>
  <div class="col-xs-12 col-sm-12 col-md-12">
    <table class="table table-striped">
      <thead>
        <th>No</th>
        <th>Jabatan</th>
        <th>
          <a class="btn btn-primary" href="<?php echo site_url('jabatan/create') ?>">
            Tambah
          </a>
        </th>
      </thead>
      <tbody>
        <?php $number = 1; foreach($jabatan as $row) { ?>
        <tr>
          <td>
              <?php echo $number++ ?>
          </td>
          <td>
              <?php echo $row->gelar ?>
          </td>
          <td>
            <?php echo form_open('jabatan/destroy/'.$row->kode); ?>
            <a class="btn btn-info" href="<?php echo site_url('jabatan/edit/'.$row->kode) ?>">
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
<?php $this->load->view('layouts/base_start') ?>
<head>
  <link rel="stylesheet" href="<?php echo base_url("bootstrap/css/bootstrap.css"); ?>">
    
    <style type="text/css">
    .bg-border {
        border: 1px solid #ddd;
        border-radius: 4px 4px;
        padding: 15px 15px;
    }
    </style>
</head>
 
<div class="container">
  <legend>Daftar Mahasiswa</legend>
  <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2 well">
        <?php 
        $attr = array("class" => "form-horizontal", "role" => "form", "id" => "form1", "nama" => "form1");
        echo form_open("pegawai/index.php", $attr);?>
            <div class="form-group">
                <div class="col-md-6">
                    <input class="form-control" id="nama" name="nama" placeholder="Search for Nama..." type="text" value="<?php echo set_value('nama'); ?>" />
                </div>
                <div class="col-md-6">
                    <input id="btn_search" name="btn_search" type="submit" class="btn btn-danger" value="Search" />
                    <a href="<?php echo base_url(). "index.php/pegawai/index"; ?>" class="btn btn-primary">Show All</a>
                </div>
            </div>
        <?php echo form_close(); ?>
        </div>
    </div>
  
 
  </div>
    <table class="table table-striped table-bordered dataTables">
      <thead>
        <th>No</th>
        <th>Nama</th>
        <th>NIM</th>
        <th>Jurusan</th>
        <th width="200">Foto</th>
        <th>
          <a class="btn btn-primary" href="<?php echo site_url('pegawai/create/') ?>">
            Tambah
          </a>
        </th>
      </thead>
      <tbody>
        <?php $number = 1; foreach($pegawai as $row) { ?>
        <tr>
          <td>
            <a href="<?php echo site_url('pegawai/show/'.$row->id) ?>">
              <?php echo $number++ ?>
            </a>
          </td>
          <td>
            <a href="<?php echo site_url('pegawai/show/'.$row->id) ?>">
              <?php echo $row->nama ?>
            </a>
          </td>
           <td>
            <a href="<?php echo site_url('pegawai/show/'.$row->id) ?>">
              <?php echo $row->nim ?>
            </a>
          </td>
          <td>
            <a href="<?php echo site_url('pegawai/show/'.$row->id) ?>">
              <?php echo $row->jurusan ?>
            </a>
          </td>
          <td>
              <img src="<?php echo base_url('assets/uploads/').$row->foto; ?>" style="display:block; width:100%; height:100%;">
          </td>
          <td>
            <?php echo form_open('pegawai/destroy/'.$row->id); ?>
            <a class="btn btn-info" href="<?php echo site_url('pegawai/edit/'.$row->id) ?>">
              Ubah
            </a>
            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?')">Hapus</button>
            <?php echo form_close() ?>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>

  <div class="row-center">
        <div class="col-md-8 col-md-offset-5">
            <?php echo $pagination; ?>
        </div>
  </div>
</div>
<!-- Bootstrap CSS -->
<!-- Bootstrap DataTables CSS -->
<!-- Jquery -->
<script type="text/javascript" language="javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<!-- Jquery DataTables -->
<script type="text/javascript" language="javascript" src="http:////cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
<!-- Bootstrap dataTables Javascript -->
<script type="text/javascript" language="javascript" src="http://cdn.datatables.net/plug-ins/9dcbecd42ad/integration/bootstrap/3/dataTables.bootstrap.js"></script>

<!-- Panggil Fungsi -->
<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
 $('.table-paginate').dataTable();
 } );
</script>

<?php $this->load->view('layouts/base_end') ?>
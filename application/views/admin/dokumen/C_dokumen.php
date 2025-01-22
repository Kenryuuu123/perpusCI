
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap-datepicker.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/select2/select2.min.css">
<!--content -->
<div class="box box-solid box-success">
  <div class="box-header with-border">
    <h3 class="box-title"><i class="fa fa-plus"></i> <i class="fa fa-book"></i> Tambah Dokumen</h3>
    <div class="box-tools pull-right">
    </div><!-- /.box-tools -->
  </div><!-- /.box-header -->
   <div class="box-body">

   	<?php if(!empty(validation_errors())){
   			echo '<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                <p>Inputan tidak terisi dengan benar. Cek kembali</p>';
                echo validation_errors();
             echo '</div>';

   	}?>
    <!--show error message here -->
    <div class="form-group"></div>
    <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>admin/Dokumen/tambah_dokumen" role="form" enctype="multipart/form-data">
      <div class="box-body">
        <div class="form-group">
          <label class="col-sm-2 control-label">Deskripsi</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" name="deskripsi" placeholder="Deskripsi" required>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Judul Dokumen</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" name="juduldok" placeholder="Judul Dokumen" required>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Kategori</label>
          <div class="col-sm-4">
            <select name="kategori" class="js-example-basic-single form-control" data-placeholder="Klik untuk memilih" required>
              <option value="">&nbsp;</option>
              <?php foreach ($data_kategori->result_array() as $op) { ?>
                <option value="<?php echo $op['id_kategori']; ?>"><?php echo $op['kategori']; ?></option>
              <?php } ?>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Penerbit</label>
          <div class="col-sm-4">
            <select name="penerbit" class="js-example-basic-single form-control" data-placeholder="Klik untuk memilih" required>
              <option value="">&nbsp;</option>
              <?php foreach ($data_penerbit->result_array() as $op) { ?>
                <option value="<?php echo $op['id_penerbit']; ?>"><?php echo $op['nama_penerbit']; ?></option>
              <?php } ?>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Instansi</label>
          <div class="col-sm-4">
            <select name="instansi" class="js-example-basic-single form-control" data-placeholder="Klik untuk memilih" required>
              <option value="">&nbsp;</option>
              <?php foreach ($data_instansi->result_array() as $op) { ?>
                <option value="<?php echo $op['id_instansi']; ?>"><?php echo $op['nama_instansi']; ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-sm-2 control-label">Tanggal</label>
          <div class="col-sm-3">
            <input type="date" class="form-control" name="tgl" required>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Nama File</label>
          <div class="col-sm-4">
            <select name="id_nama_file" class="js-example-basic-single form-control" data-placeholder="Klik untuk memilih" required>
              <option value="">&nbsp;</option>
              <?php foreach ($data_nama_file->result_array() as $op) { ?>
                <option value="<?php echo $op['id_nama_file']; ?>"><?php echo $op['jenis_file']; ?></option>
              <?php } ?>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Hak Akses Petugas</label>
          <div class="col-sm-4">
            <select name="id_petugas[]" class="js-example-basic-single form-control" multiple="multiple" data-placeholder="Klik untuk memilih">
            <option value="">&nbsp;</option>
                <?php foreach ($data_id_petugas->result_array() as $op) { ?>
                <option value="<?php echo $op['id_petugas']; ?>"><?php echo $op['nama']; ?></option>
              <?php } ?>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Sifat (Private / Publik)</label>
          <div class="col-sm-4">
            <select name="sifat" class="js-example-basic-single form-control" data-placeholder="Klik untuk memilih" required>
              <option value="">&nbsp;</option>
              <?php foreach ($data_sifat->result_array() as $op) { ?>
                <option value="<?php echo $op['id_sifat']; ?>"><?php echo $op['sifat']; ?></option>
              <?php } ?>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">No Dokumen</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" name="no_dok" placeholder="No Dokumen" required>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Keterangan</label>
          <div class="col-sm-5">
            <textarea class="form-control" name="keterangan" rows="4" placeholder="Keterangan" required></textarea>
          </div>
        </div>

          <div class="form-group">
              
                <label for="berkas">Unggah Dokumen</label>
                <input type="file" name="berkas" class="form-control" required>
              
          </div>
        <!-- <button type="submit" class="btn btn-primary"><i class="fa fa-upload"></i> Unggah</button> -->
        
      </div>
      
      <div class="col-sm-4">
      </div>
      <div class="col-sm-4">
        <div class="btn-group">
          <button type="reset" class="btn btn-info"><i class="fa fa-refresh"></i> Reset</button>
        </div>
        <div class="btn-group">
          <form action="<?= site_url('admin/Dokumen/tambah_dokumen');?>" method="post" enctype="multipart/form-data">
          <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Tambah</button>
          <?php echo form_close(); ?>
          </form>
        </div>
      </div>
    </form>

              <!-- /.box-footer -->
            </form>
  </div>
  <div class="box-footer">
  <td>
    <div align ="Right"> <a  href="<?php echo base_url(); ?>admin/Dokumen/dokumen"  class="btn btn-danger" role="button" data-toggle="tooltip" title="Kembali"></i>Back</a></div>
  </td>
  </div>
  <div class="box-footer">
    Menambah Data Dokumen Perpustakaan, isi form diatas untuk menambahkan data dokumen. 
  </div><!-- box-footer -->
</div><!-- /.box -->

<script>
$(document).ready(function() {
    $('.js-example-basic-multiple').select2({
        theme: "classic",
        placeholder: "Pilih hak akses petugas",
        allowClear: true
    });
});
</script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap-datepicker.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/select2/select2.min.css">
<!--content -->
<div class="box box-solid box-success">
  <div class="box-header with-border">
    <h3 class="box-title"><i class="fa fa-pencil"></i> <i class="fa fa-file"></i>Edit Dokumen</h3>
    <div class="box-tools pull-right">
    </div>
  </div><!-- /.box-header -->
   <div class="box-body">

    <?php if(!empty(validation_errors())){
      echo '<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                <p>Inputan tidak terisi dengan benar. Cek kembali</p>';
                echo validation_errors();
             echo '</div>';
    }?>

    <!--show error message here -->
    <div class="form-group"></div>
	<form class="form-horizontal" method="post"  action="<?php echo base_url(); ?>admin/Dokumen/update_dokumen" role="form" enctype="multipart/form-data">

  <?php
  foreach($dokumen->result_array() as $op)
  {
?>
        <div class="box-body">
          <div class="form-group">
            <label class="col-sm-2 control-label">ID Dokumen</label>
            <div class="col-sm-4">
              <input type="text" value="<?php echo $op['id_dokumen']; ?>" class="form-control" name="id_dokumen" disabled=disabled placeholder="ID Dokumen">
              <input type="hidden" value="<?php echo $op['id_dokumen']; ?>" name="id">
            </div>
          </div>

          <!-- Tambahan Deskripsi -->
          <div class="form-group">
              <label class="col-sm-2 control-label">Deskripsi</label>
              <div class="col-sm-6">
                  <input type="text" value="<?php echo $op['deskripsi'];?>" class="form-control" name="deskripsi" placeholder="Deskripsi">
              </div>
          </div>

          <!-- Tambahan Judul Dokumen -->
          <div class="form-group">
              <label class="col-sm-2 control-label">Judul Dokumen</label>
              <div class="col-sm-6">
                  <input type="text" value="<?php echo $op['juduldok'];?>" class="form-control" name="juduldok" placeholder="Judul Dokumen">
              </div>
          </div>

          <!-- Tambahan Kategori -->
          <div class="form-group">
                 <label class="col-sm-2 control-label">Kategori</label>
                  <div class="col-sm-5">
		               <select name="kategori" class="js-example-basic-single form-control" data-placeholder="Klik untuk memilih">
		  				      <option value="">&nbsp;</option>
		  				      <?php foreach($data_kategori->result_array() as $op2)
                            {
                            ?>
                              <?php  if($op2['id_kategori']== $op['id_kategori']){
                              ?>
                                <option value="<?php echo $op2['id_kategori'];?>" selected><?php echo $op2['kategori'];?></option>
                              <?php }
                                    else{?>
                                <option value="<?php echo $op2['id_kategori'];?>"><?php echo $op2['kategori'];?></option>
                              <?php
                                }
                                ?>
                            <?php
                            }
                            ?>
						      </select>
		      		  </div>
              </div>

          <!-- Tambahan Penerbit -->
            <div class="form-group">
              <label class="col-sm-2 control-label">Penerbit</label>
              <div class="col-sm-5">
		          <select  name="penerbit" class="js-example-basic-single form-control" data-placeholder="Klik untuk memilih">
		  				<option value="">&nbsp;</option>
                <?php foreach($data_penerbit->result_array() as $op2)
                          {
                            ?>
                              <?php  if($op2['id_penerbit']== $op['id_penerbit']){
                              ?>
                                <option value="<?php echo $op2['id_penerbit'];?>" selected><?php echo $op2['nama_penerbit'];?></option>
                              <?php }
                                    else{?>
                                <option value="<?php echo $op2['id_penerbit'];?>"><?php echo $op2['nama_penerbit'];?></option>
                              <?php
                                }
                                ?>
                            <?php
                          }
                        ?>
						  </select>
		      	  </div>
            </div>

          <!-- Tambahan Instansi -->
          <div class="form-group">
              <label class="col-sm-2 control-label">Instansi</label>
              <div class="col-sm-5">
		          <select  name="instansi" class="js-example-basic-single form-control" data-placeholder="Klik untuk memilih">
		  				<option value="">&nbsp;</option>
                <?php foreach($data_instansi->result_array() as $op2)
                          {
                            ?>
                              <?php  if($op2['id_instansi']== $op['id_instansi']){
                              ?>
                                <option value="<?php echo $op2['id_instansi'];?>" selected><?php echo $op2['nama_instansi'];?></option>
                              <?php }
                                    else{?>
                                <option value="<?php echo $op2['id_instansi'];?>"><?php echo $op2['nama_instansi'];?></option>
                              <?php
                                }
                                ?>
                            <?php
                          }
                        ?>
						  </select>
		      	  </div>
            </div>

          <!-- Tambahan Tanggal -->
          <div class="form-group">
              <label class="col-sm-2 control-label">Tanggal</label>
              <div class="col-sm-2">
                  <input type="date" value="<?php echo $op['tgl'];?>" class="form-control" name="tgl" placeholder="tgl">
              </div>
          </div>

          <!-- Tambahan Nama File -->
          <div class="form-group">
              <label class="col-sm-2 control-label">Nama File</label>
              <div class="col-sm-5">
		          <select  name="nama_file" class="js-example-basic-single form-control" data-placeholder="Klik untuk memilih">
		  				<option value="">&nbsp;</option>
                <?php foreach($data_nama_file->result_array() as $op2)
                          {
                            ?>
                              <?php  if($op2['id_nama_file']== $op['id_nama_file']){
                              ?>
                                <option value="<?php echo $op2['id_nama_file'];?>" selected><?php echo $op2['jenis_file'];?></option>
                              <?php }
                                    else{?>
                                <option value="<?php echo $op2['id_nama_file'];?>"><?php echo $op2['jenis_file'];?></option>
                              <?php
                                }
                                ?>
                            <?php
                          }
                        ?>
						  </select>
		      	  </div>
            </div>

          <!-- Tambahan No Dokumen -->
          <div class="form-group">
              <label class="col-sm-2 control-label">No Dokumen</label>
              <div class="col-sm-3">
                  <input type="text" value="<?php echo $op['no_dok'];?>" class="form-control" name="no_dok" placeholder="No Dokumen">
              </div>
          </div>

          <!-- Tambahan Keterangan -->
          <div class="form-group">
              <label class="col-sm-2 control-label">Keterangan</label>
              <div class="col-sm-6">
                  <textarea class="form-control" name="ket" rows="4" placeholder="Ket"><?php echo $op['ket'];?></textarea>
              </div>
          </div>

          <div class="form-group">
              <label class="col-sm-2 control-label">Hak Akses Petugas</label>
              <div class="col-sm-5">
		          <select  name="id_petugas[]" class="js-example-basic-single form-control" multiple="multiple" data-placeholder="Klik untuk memilih">
		  				<!-- <option value="">&nbsp;</option> -->
                <?php foreach($data_id_petugas->result_array() as $op2)
                          {
                            ?>
                              <?php  if($op2['id_petugas']== $op['id_petugas']){
                              ?>
                                <option value="<?php echo $op2['id_petugas'];?>" selected><?php echo $op2['nama'];?></option>
                              <?php }
                                    else{?>
                                <option value="<?php echo $op2['id_petugas'];?>"><?php echo $op2['nama'];?></option>
                              <?php
                                }
                                ?>
                            <?php
                          }
                        ?>
						  </select>
                    <td>
                    <?php
                    if(!empty($op['id_petugas'])) {
                        $petugas_array = explode(',', $op['id_petugas']);
                        foreach($petugas_array as $id_pet) {
                            $query = $this->db->get_where('tb_petugas', array('id_petugas' => $id_pet));
                            if($query->num_rows() > 0) {
                                $nama_petugas = $query->row();
                                echo '<span class="label label-info" style="margin:2px;display:inline-block;background-color:#00bcd4;color:#000;">'.$nama_petugas->nama.'<span class="close-btn" style="margin-left:5px;cursor:pointer;">x</span></span> ';
                            }
                        }
                    }
                    ?>
                </td>
		      	  </div>
            </div>

          <div class="form-group">
              <label class="col-sm-2 control-label">Sifat (Private / Publik)</label>
              <div class="col-sm-5">
		          <select  name="sifat" class="js-example-basic-single form-control" data-placeholder="Klik untuk memilih">
		  				<option value="">&nbsp;</option>
                <?php foreach($data_sifat->result_array() as $op2)
                          {
                            ?>
                              <?php  if($op2['id_sifat']== $op['id_sifat']){
                              ?>
                                <option value="<?php echo $op2['id_sifat'];?>" selected><?php echo $op2['sifat'];?></option>
                              <?php }
                                    else{?>
                                <option value="<?php echo $op2['id_sifat'];?>"><?php echo $op2['sifat'];?></option>
                              <?php
                                }
                                ?>
                            <?php
                          }
                        ?>
						  </select>
		      	  </div>
            </div>

                          
          <div class="form-group">
            <label for="berkas">Unggah Dokumen</label>
            <input type="file" name="berkas" id="berkas" class="form-control" accept=".pdf,.doc,.docx,.jpg,.png,.mp4,.mkv">
          </div>
        <div class ="col-sm-4">
          </div
        <div class="col-sm-4">
          <div class="btn-group">
            <button type="reset" class="btn btn-info"><i class="fa fa-refresh"></i> Reset</button>
          </div>
          <div class="btn-group">
            <button type="submit" class="btn btn-success"><i class="fa fa-pencil"></i> Update</button>
          </div>
        </div>
      <?php } ?>
    </form>
  </div>
  <div class="box-footer">
    <td>
    <div align="Right"> <a href="<?php echo base_url(); ?>admin/Dokumen/dokumen" class="btn btn-danger" role="button" data-toggle="tooltip" title="Kembali">Back</a></div>
  </td>
  </div>
  <div class="box-footer">
    Update Data Dokumen, edit form diatas untuk mengubah data dokumen.
  </div>
</div>

<script>
document.querySelectorAll('.close-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        let label = this.parentNode;
        label.parentNode.removeChild(label);
    });
});
</script>
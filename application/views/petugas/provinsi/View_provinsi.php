<!--css khusus halaman ini -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.css">


<!--modal dialog untuk hapus -->
  <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Konfirmasi Hapus</h4>
                </div>
            
                <div class="modal-body">
                    <p>Anda akan menghapus Data Provinsi  ini</p>
                    <p><strong>Peringatan</strong>  Setelah data dihapus, data tidak dapat dikembalikan!</p>
                    <br />
                    <p>Ingin melanjutkan menghapus?</p>
                    <p class="debug-url"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger btn-ok">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<!--content -->
<div class="box box-solid box-success">
  <div class="box-header with-border">
    <h3 class="box-title"><i class="fa fa-book"></i> Daftar Provinsi</h3>
    <div class="box-tools pull-right">
    
    </div><!-- /.box-tools -->

  </div><!-- /.box-header -->
   <div class="box-body">
   <!-- <div class="btn-group"><a href="<?php echo base_url(); ?>petugas/Provinsi/create"  class="btn btn-success" role="button" data-toggle="tooltip" title="Tambah Provinsi"><i class="fa fa-plus"></i>  Tambah provinsi</a></div> -->
   <div class="form-group"></div>
   <table id="" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead class="bg-success">
            <tr>
                <th>No</th>
                <!--th class="center"> <i class="glyphicon glyphicon-plus"></i></th-->
                <th>Nama_provinsi</th>
                <th>Kota</th>
            </tr>
        </thead>
        <tbody>
         <?php
  $no = 1;
    foreach($data_provinsi->result_array() as $op)
    {
    ?>
            <tr>
                <td><?php echo $no++ ;?></td>
                <!--td class="details-control"><i class="btn btn-box-tool" data-toggle="tooltip" title="Tampilkan Detail"><i class="glyphicon glyphicon-plus"></i></i>
                </td-->
                <td><?php echo $op['nama_provinsi'];?></td>
                <td><?php echo $op['kota'];?></td>
    </tr>
<?php
    }
  ?>            
         </tbody>
    </table>
  </div>
  <div class="box-footer">
    Menampilkan daftar Provinsi, mengedit dan menghapus provinsi klik tombol pada kolom pilihan.
  </div><!-- box-footer -->
</div><!-- /.box -->



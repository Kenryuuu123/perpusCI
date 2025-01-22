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
                    <p>Anda akan menghapus Data Buku beserta detail stok buku ini</p>
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
    <h3 class="box-title"><i class="fa fa-book"></i> Daftar Dokumen</h3>
    <div class="box-tools pull-right">
    
    </div><!-- /.box-tools -->

  </div><!-- /.box-header -->
   <div class="box-body">
   <div class="btn-group"><a href="<?php echo base_url(); ?>admin/dokumen/tambah_dokumen"  class="btn btn-success" role="button" data-toggle="tooltip" title="Tambah Data Dokumen"><i class="fa fa-plus"></i>  Tambah Data Dokumen</a></div>
   <div class="form-group"></div>
   <table id="table-dokumen" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead class="bg-success">
            <tr>
                <th width="5%">No</th>
                <th width="10%">Deskripsi</th>
                <th width="15%">Judul Dokumen</th>
                <th width="10%"> Kategori</th>
                <th width="10%"> Penerbit</th>
                <th width="5%">Instansi</th>
                <th width="5%">Tanggal</th>
                <th width="5%">Nama file</th>
                <th width="5%">No Dokumen</th>
                <th width="5%">Ket</th>
                <th width="5%">Berkas</th>
                <th width="9%">Aksi</th>
            </tr>
        </thead>
         <?php
  $no = 1;
    foreach($data_dokumen->result_array() as $op)
    {
    ?>
            <tr>
                <td><?php echo $no++ ;?></td>
                <td><?php echo $op['deskripsi'];?></td>
                <td><?php echo $op['juduldok'];?></td>
                <td><?php echo $op['kategori'];?></td>
                <td><?php echo $op['nama_penerbit'];?></td>
                <td><?php echo $op['nama_instansi'];?></td>
                <td><?php echo $op['tgl'];?></td>
                <td><?php echo $op['jenis_file'];?></td>
                <td><?php echo $op['no_dok'];?></td>
                <td><?php echo $op['ket'];?></td>
                <td>
                    <?php 
                    $file = $op['berkas']; 
                    $file_url = base_url() . "/uploads/upload/" . $file;
                    
                    if (!empty($file)) {
                        echo '<a href="' . $file_url . '" target="_blank">' . $file . '</a>';
                    } else {
                        echo 'File tidak tersedia';
                    }
                    ?>
                </td>
                <td>
                <?php echo 
                    // '<div class="btn-group">
                    // <a href="'.base_url().'admin/Dokumen/detail_dokumen/?id_dokumen='.$op['id_dokumen'].'" class="btn btn-info" role="button" data-toggle="tooltip" title="Detail Stok"><i class="fa fa-list"></i></a>
                    // </div>
                     '<a href="'.base_url().'admin/Dokumen/edit_dokumen/?id_dokumen='.$op['id_dokumen'].'" class="btn btn-warning" role="button" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
                    <span data-toggle="modal" data-target="#confirm-delete" data-href="'.base_url().'admin/Dokumen/hapus_dokumen/?id_dokumen='.$op['id_dokumen'].'">
                    <a class="btn btn-danger" role="button" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash"></i></a>
                    </span>
                </td>
            </tr>';?>
<?php
   } 
  ?>            
         </tbody>
    </table>
  </div>
  <div class="box-footer">
    Menampilkan daftar Dokumen, untuk melihat detail dokumen klik tombol + dan untuk melihat detail stok, mengedit dan menghapus dokumen klik tombol pada kolom pilihan.
  </div><!-- box-footer -->
</div><!-- /.box -->


      
  
<!--css khusus halaman ini -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.css">

<?php var_dump($petugas);?>
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
   <!-- <div class="btn-group"><a href="<?php echo base_url(); ?>admin/dokumen/tambah_dokumen"  class="btn btn-success" role="button" data-toggle="tooltip" title="Tambah Data Dokumen"><i class="fa fa-plus"></i>  Tambah Data Dokumen</a></div> -->
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
                <th width="9%">Sifat</th>
                <th width="5%">Aksi</th>
            </tr>
        </thead>
         <?php
  $no = 1;
    foreach($data_dokumen->result_array() as $op)
    {
        $petugas_array = explode(',', $op['id_petugas']);
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

                    if($op['id_sifat'] == 2){
                        // echo '<a href="' . $file_url . '" target="_blank">' . $file . '</a>';
                        echo $file;
                    }
                    if($op['id_sifat'] == 1 && in_array($petugas, $petugas_array)){
                        // echo '<a href="' . $file_url . '" target="_blank">' . $file . '</a>';
                        echo $file;
                    }else{
                        echo '-';
                    }

                    ?>
                </td>
                <td><?php echo $op['sifat'];?></td>
                <td>
                    <?php 
                    if($op['id_sifat'] == 2 || ($op['id_sifat'] == 1 && in_array($petugas, $petugas_array))){
                        echo 
                        '<div class="btn-group">
                            <a href="'.base_url().'petugas/Dokumen/view_dokumen/'.$op['id_dokumen'].'" class="btn btn-info" role="button" data-toggle="tooltip" title="View"><i class="fa fa-search"></i></a>
                            <a href="'.base_url().'petugas/Dokumen/download_dokumen/'.$op['id_dokumen'].'" class="btn btn-success" role="button" data-toggle="tooltip" title="Download"><i class="fa fa-download"></i></a>
                        </div>';
                    }
                    // }else{
                    //     echo
                    //     '<div class="btn-group">
                    //         <a href="'.base_url().'petugas/Dokumen/view_dokumen/'.$op['id_dokumen'].'" class="btn btn-info" role="button" data-toggle="tooltip" title="View"><i class="fa fa-search"></i></a>
                    //     </div>';
                    // }
                    ?>
            <?php
            } 
            ?>            
         </tbody>
    </table>
  </div>
  <div class="box-footer">
    Menampilkan daftar Dokumen, untuk melihat detail dokumen klik tombol button untuk melihat dokumen, mendownload dokumen klik tombol pada kolom pilihan.
  </div><!-- box-footer -->
</div><!-- /.box -->


      
  
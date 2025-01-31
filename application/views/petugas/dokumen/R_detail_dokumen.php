<!-- CSS khusus halaman ini -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.css">

<!-- Content -->
<div class="box box-solid box-success">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-file"></i> Detail Dokumen</h3>
        <div class="box-tools pull-right"></div>
    </div>

    <div class="box-body">
        <table id="table-dokumen" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead class="bg-success">
                <tr>
                    <th width="5%">No</th>
                    <th width="20%">Judul Dokumen</th>
                    <th width="20%">Nama File Dokumen</th>
                    <th width="20%">Berkas</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach($data_detail_dokumen->result_array() as $op){
                    $petugas_array = explode(',', $op['id_petugas']);
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $op['juduldok']; ?></td>
                        <td><?php echo $op['jenis_file']; ?></td>
                        <td>
                            <?php
                            $file = $op['berkas'];
                            $file_url = base_url() . "uploads/upload/" . $file;

                            // Perbaikan logika hak akses
                            if($op['id_sifat'] == 2){
                                // Dokumen publik selalu dapat diakses
                                echo '<a href="' . $file_url . '" target="_blank">' . $file . '</a>';
                            } elseif($op['id_sifat'] == 1 && in_array($petugas, $petugas_array)){
                                // Dokumen privat hanya dapat diakses oleh pemilik
                                echo '<a href="' . $file_url . '" target="_blank">' . $file . '</a>';
                            } else {
                                echo '-';
                            }
                            ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>

        <div class="box-footer">
            <div align="right">
                <a href="<?php echo base_url(); ?>petugas/Dokumen/dokumen" class="btn btn-danger" role="button" data-toggle="tooltip" title="Kembali">Kembali</a>
            </div>
            <p>Menampilkan daftar Dokumen, untuk melihat detail dokumen klik tautan</p>
        </div>
    </div>
</div>
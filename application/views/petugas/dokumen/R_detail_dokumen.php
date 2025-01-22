<!-- CSS khusus halaman ini -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.css">

<!-- Content -->
<div class="box box-solid box-success">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-file"></i> Detail Dokumen</h3>
        <div class = "box-tools pull-right">
    </div> <!-- /.box-tools -->
</div> <!-- /.box-header -->
<div class="box body">
<div class="form-group"></div>
<table id="table-dokumen" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead class = "bg-success">
        <tr>
            <th width="5%">No</th>
            <th width="20%">Judul Dokumen</th>
            <th width="20%">Nama File Dokumen</th>
            <th width="20%">Berkas</th>
        </tr>
        </thead>
        <?php
        $no = 1;
        foreach($data_detail_dokumen->result_array() as $op){
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $op['juduldok']; ?></td>
                <td><?php echo $op['jenis_file']; ?></td>
                <td>
                    <?php
                    $file = $op['berkas'];
                    $file_url = base_url() . "/uploads/upload/" . $file;

                    if($op['id_sifat'] == 2){
                        echo '<a href="' . $file_url . '" target="_blank">' . $file . '</a>';
                        echo $file;
                    }
                    if($op['id_sifat'] == 1 && $op['id_petugas'] == $petugas){
                        echo '<a href="' . $file_url . '" target="_blank">' . $file . '</a>';
                        echo $file;
                    }else{
                        echo '-';
                    }
                    ?>
                </td>
            <?php    
        }
        ?>
    </tbody>
    </table>
    <div class ="box-footer">
        Menampilkan daftar Dokumen, untuk melihat detail dokumen klik to
    </div> <!-- /.box-body -->
    </div> <!-- /.box -->

    

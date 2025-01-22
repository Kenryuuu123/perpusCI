<!--css khusus halaman ini -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.css">

<!--modal dialog untuk hapus -->
<!-- <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Konfirmasi Hapus</h4>
            </div>
            <div class="modal-body">
                <p>Anda akan menghapus Detail Stok dokumen ini.</p>
                <p><strong>Peringatan:</strong> Setelah data dihapus, data tidak dapat dikembalikan!</p>
                <br />
                <p>Ingin melanjutkan menghapus?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Hapus</a>
            </div>
        </div>
    </div>
</div> -->

<!--content -->
<div class="box box-solid box-success">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-book"></i> Daftar Detail Dokumen</h3>
    </div>

    <div class="box-body">
        
        <?php echo $this->session->flashdata('message'); ?>

        <!-- Tabel Detail Dokumen -->
        <table id="example2" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead class="bg-success">
                <tr>
                    <th>No</th>
                    <th>ID Dokumen</th>
                    <th>Judul Dokumen</th>
                    <th>Nama File</th>
                    <th>Preview File</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($data_detail_dokumen as $detail) { ?>
        <?php if (is_object($detail)) { ?>
            <tr>
                <td><?= $detail->id_dokumen ?></td>
                <td><?= $detail->juduldok ?></td>
                <td><?= $detail->jenis_file ?></td>
                <td>
                    <?php if ($detail->berkas) { ?>
                        <a href="<?= base_url('uploads/' . $detail->berkas) ?>" target="_blank">Lihat File</a>
                    <?php } else { ?>
                        File tidak tersedia
                    <?php } ?>
                </td>
            </tr>
        <?php } else { ?>
            <tr>
                <td colspan="4">Data tidak tersedia</td>
            </tr>
        <?php } ?>
    <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="box-footer">
        <div align="right">
            <a href="<?php echo base_url(); ?>admin/Dokumen/dokumen" class="btn btn-danger" role="button" data-toggle="tooltip" title="Kembali">Back</a>
        </div>
    </div>
</div>

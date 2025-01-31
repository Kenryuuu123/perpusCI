<!--css khusus halaman ini -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.css">
<!-- jQuery -->
<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>

<!-- DataTables JavaScript -->
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!--content -->
<div class="box box-solid box-success">
  <div class="box-header with-border">
    <h3 class="box-title"><i class="fa fa-history"></i> Log Aktivitas Dokumen</h3>
    <div class="box-tools pull-right">
    </div><!-- /.box-tools -->
  </div><!-- /.box-header -->

  <div class="box-body">
   <div class="form-group"></div>
   <table id="table-dokumen" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead class="bg-success">
                  <tr>
                    <th>No</th>
                    <th>Nama Petugas</th>
                    <th>Judul Dokumen</th>
                    <th>Waktu Akses</th>
                    <th>Jenis Akses</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $no = 1;
            foreach($logs as $log) {
                $label_class = '';
                switch($log->jenis_akses) {
                    case 'view':
                        $label_class = 'label-info';
                        break;
                    case 'download':
                        $label_class = 'label-success';
                        break;
                    case 'edit':
                        $label_class = 'label-warning';
                        break;
                }
            ?>
                <tr>
                    <td><?php echo $no++ ;?></td>
                    <td><?php echo $log->nama;?></td>
                    <td><?php echo $log->juduldok;?></td>
                    <td><?php echo date('d-m-Y H:i:s', strtotime($log->diakses)); ?></td>
                    <td><span class="label <?php echo $label_class;?>"><?php echo ucfirst($log->jenis_akses);?></span></td>
                </tr>
         <?php } ?>            
         </tbody>
    </table>
  </div>
  <div class="box-footer">
    Menampilkan daftar aktivitas dokumen yang diakses oleh petugas.
  </div><!-- box-footer -->
</div><!-- /.box -->

<!-- DataTables -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#table-dokumen').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "language": {
                "search": "Cari:",
                "lengthMenu": "Tampilkan _MENU_ entri",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Berikutnya",
                    "previous": "Sebelumnya"
                }
            }
        });
    });
</script>
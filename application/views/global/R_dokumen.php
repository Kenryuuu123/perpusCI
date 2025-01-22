<div class="row">
	<div class="col m12">
		<h5>Daftar Data Dokumen Perpustakaan</h5>
		<hr>
	</div>


	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.css">

	<div class="form-group"></div>
	<table id="table-dokumen" class="table  table-bordered" cellspacing="0" width="100%">
		<thead class="teal white-text">
			<tr>
				<th>No</th>
				<th>Deskripsi</th>
				<th>Judul Dokumen</th>
				<th>Kategori</th>
				<th>Penerbit</th>
				<th>Instansi</th>
				<th>Tanggal</th>
				<th>Nama File</th>
				<th>No Dokumen</th>
				<th>Keterangan</th>
			</tr>
		</thead>
		<tbody>
			<?php
  $no = 1;
    foreach($data_dokumen->result_array() as $op)
    {
    ?>
			<tr>
			<td><?php echo $no++ ;?></td>
                <td><?php echo $op['deskripsi'];?></td>
                <td><?php echo $op['juduldok'];?></td>
                <td>
					<?php
					$kategori = $op['id_kategori'];
					foreach ($data_kategori->result_array() as $kategori_item) {
						if ($kategori_item['id_kategori'] == $kategori) {
							echo $kategori_item['kategori'];
							break;
						}
					}
					?>
				</td>

                <td>
					<?php
					$penerbit = $op['id_penerbit'];
					foreach ($data_penerbit->result_array() as $penerbit_item) {
						if ($penerbit_item['id_penerbit'] == $penerbit) {
							echo $penerbit_item['nama_penerbit'];  
							break;  
						}
					}
					?>
				</td>

                <td>
					<?php
					$instansi = $op['id_instansi'];
					foreach ($data_instansi->result_array() as $instansi_item) {
						if ($instansi_item['id_instansi'] == $instansi) {
							echo $instansi_item['nama_instansi'];
							break;
						}
					}
					?>
				</td>

                <td><?php echo $op['tgl'];?></td>

				<td>
					<?php
					$nama_file = $op['id_nama_file'];
					foreach ($data_nama_file->result_array() as $nama_file_item) {
						if ($nama_file_item['id_nama_file'] == $nama_file) {
							echo $nama_file_item['jenis_file'];
							break;
						}
					}
					?>
				</td>

				<td><?php echo $op['no_dok']?></td>
                <td><?php echo $op['ket'];?></td>
			</tr>
			<?php
    }
  ?>
		</tbody>
	</table>
</div>


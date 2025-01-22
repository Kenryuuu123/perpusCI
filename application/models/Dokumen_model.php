<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dokumen_model extends CI_Model
 {

	public function search($q)
	{
		$this->qq = explode(' ',$q);
	}
	public function kategori($q){
		if($q=="a.id_dokumen"){
			$concat = " ".$q."=".((int)addslashes(trim(implode(" ",$this->qq))));
		} else {
		$concat = "";
		foreach($this->qq as $zx){
			$concat.=' '.($q).' LIKE \'%'.addslashes(strtolower(trim($zx))).'%\' OR';
		}}
		
		$this->wheree = ' WHERE'.rtrim($concat,'OR');
	}
	//query pengambilan semua data
	public function getAllData1() {
		$query = "SELECT 
					a.*, 
					b.nama_penerbit, 
					c.kategori, 
					d.nama_instansi, 
					e.jenis_file,
					f.sifat
				  FROM 
					tb_dokumen a 
				  LEFT JOIN tb_penerbit b ON b.id_penerbit = a.id_penerbit 
				  LEFT JOIN tb_kategori c ON c.id_kategori = a.id_kategori 
				  LEFT JOIN tb_instansi d ON d.id_instansi = a.id_instansi 
				  LEFT JOIN tb_nama_file e ON e.id_nama_file = a.id_nama_file
				  LEFT JOIN tb_sifat f ON f.id_sifat = a.id_sifat
				  LEFT JOIN tb_petugas g ON g.id_petugas = a.id_petugas
				  order by a.id_dokumen";
		return $this->db->query($query);
	}

	// public function getAllDataPetugas() {
	// 	$query = "SELECT 
	// 				a.*, 
	// 				b.nama_penerbit, 
	// 				c.kategori, 
	// 				d.nama_instansi, 
	// 				e.jenis_file,
	// 				f.username
	// 			  FROM 
	// 				tb_dokumen a 
	// 			  LEFT JOIN tb_penerbit b ON b.id_penerbit = a.id_penerbit 
	// 			  LEFT JOIN tb_kategori c ON c.id_kategori = a.id_kategori 
	// 			  LEFT JOIN tb_instansi d ON d.id_instansi = a.id_instansi 
	// 			  LEFT JOIN tb_nama_file e ON e.id_nama_file = a.id_nama_file
	// 			  JOIN tb_login f ON f.username = a.username ";
		
	// 	return $this->db->query($query);
	// }

	public function get_dokumen_by_id($id)
{
    return $this->db->get_where('dokumen', ['id_dokumen' => $id])->row_array();
}

	//query pengambilan semua data
	public function getAllData($table)
	{
		return $this->db->get($table);
	}
	//menghapus data dalam tabel
	function deleteData($table,$data)
	{
		$this->db->delete($table, $data);
	}
	function deletedetData($table,$col,$id_det_buku)
	{
		$this->db->where($col,$id_det_buku);
		$aks=$this->db->delete($table);
		return $aks;
	}

	//memasukan data - insert
	function insertData($table,$data)
	{
		$this->db->insert($table,$data);
	}

	//query untuk mengambil detail by id
	function get_detail($table,$id_table,$id) {
		$query = $this->db->get_where($table, array($id_table => $id));
		return $query;
	}

	function get_detaill($table, $id_table, $id) {
		$query = $this->db->get_where($table, [$id_table => $id]);
			return $query->row(); // Mengembalikan satu baris sebagai objek
		}

	// public function get_detaill(){
	// 	$query = $this->db->query('SELECT * FROM tb_dokumen');
	// 	return $query;
	// }
// 	public function get_detail($table, $column, $value)
// {
//     $query = $this->db->get_where($table, array($column => $value));
//     return $query->result();
// }

	function get_detail12($table,$col1,$col2,$id,$tgl) {
		$query = $this->db->get_where($table, array($col1 => $id,
						$col2=>$tgl));
		return $query;
	}
	function get_detail1($table,$id_table,$id) {
		$this->db->where($id_table,$id);
		$query = $this->db->get($table);
		$isi=$query->row_array();
		return $isi;
	}
	function get_detail123($table,$id_table,$id) {
		$this->db->where($id_table,$id);
		$p=$this->db->get($table);
		return $p;
	}

	function get_detail_dokumen($id_dokumen) {
		$this->db->select('a.id_detail_dokumen, a.id_dokumen, a.id_nama_file, a.berkas, b.juduldok, c.jenis_file');
		$this->db->from('tb_detail_dokumen a');
		$this->db->join('tb_dokumen b', 'a.id_dokumen = b.id_dokumen', 'LEFT');
		$this->db->join('tb_nama_file c', 'a.id_nama_file = c.id_nama_file', 'LEFT');
		$this->db->where('a.id_dokumen', $id_dokumen);
		$query = $this->db->get();
		return $query->result();
	}
	
	function updateData1($table,$data,$field,$id)
	{
		$this->db->where($field,$id);
		$this->db->update($table,$data);
	}	

	function updateData($table,$data,$field,$key)
	{
		$this->db->where($key,$field);
		$this->db->update($table,$data);
	}	

// 	public function update_berkas($table, $data, $id, $id_field)
// {
//     $this->db->where($id_field, $id);
//     return $this->db->update($table, $data);
// }

	// function update_berkas($table, $data, $id, $key) {
	// 	$this->db->where($key, $id);
	// 	$this->db->update($table, $data);
	// }
	// public function update_berkas($data) {
	// 	$this->db->where('id_dokumen', $data['id_dokumen']);
	// 	$this->db->update('tb_detail_dokumen', $data);
	// }
	public function update_berkas($table, $data, $id, $field_id) {
		$this->db->where($field_id, $id);
		return $this->db->update($table, $data);  // Pastikan $data adalah array yang benar
	}
	

	public function get_stok($id_buku){
		$query =$this->db->where('id_buku', $id_buku)
						->limit(1)
						->get('tb_buku');
      	if ($query->num_rows() > 0){
			return $query->row();
		} else {
			return array();
		
		}
	}
	function Delete($table,$field,$id)
	{
		$this->db->where($field,$id);
		$this->db->delete($table);
	}	

// 	public function check_file()
// {
//     if (empty($_FILES['dokumen_file']['name'])) {
//         $this->form_validation->set_message('check_file', 'Dokumen wajib diunggah.');
//         return FALSE;
//     }
//     return TRUE;
// }

	//*last edited 10 April 2017
	//batch insert
	function insertData_batch($table,$data)
	{
		$this->db->insert_batch($table,$data);
	}

	public function countRow($status,$id_buku){
		$query = $this->db->query("SELECT status FROM tb_detail_buku WHERE status='".$status."' AND id_buku='".$id_buku."'");
		echo $query->num_rows();
	}

	public function countRow_pinjam($status,$id_pinjam){
		$query = $this->db->query("SELECT status FROM tb_detail_pinjam WHERE status='".$status."' AND id_pinjam='".$id_pinjam."'");
		$query->num_rows();
	}

	public function update_status($table,$data,$field1,$key1, $field2, $key2)
	{
		$this->db->where($field1,$key1);
		$this->db->where($field2,$key2);
		$this->db->update($table,$data);
	}	

	public function update_status2($no_buku, $id_buku, $data)
	{
		$this->db->where('no_buku',$no_buku);
		$this->db->where('id_buku',$id_buku);
		$this->db->update('tb_detail_buku',$data);
	}	

	function get_detail2($table,$id_table, $id) {
		$this->db->where($id_table,$id);
		$this->db->where('status','1');
		$query = $this->db->get($table);
		return $query;
	}

	public function get_total($id_pinjam){
		$query =$this->db->where('id_pinjam', $id_pinjam)
						->limit(1)
						->get('tb_pinjam');
      	if ($query->num_rows() > 0){
			return $query->row();
		} else {
			return array();
		
		}
	}
	/*update tgl 5/5 2017 */
	/*keperluan chart */
	public function get_jml_peminjaman($first_date, $second_date){
		$this->db->select('id_pinjam, COUNT(id_pinjam) as total');
		$this->db->where('tgl_pinjam >=', $first_date);
		$this->db->where('tgl_pinjam <=', $second_date);
		$query = $this->db->get('tb_pinjam');
		if ($query->num_rows() > 0){
			return $query->row();
		} else {
			return array();
		
		}
	}

	public function buku_pinjam(){
		$query = $this->db->query("SELECT tb_buku.id_buku, tb_buku.judul, count(tb_detail_pinjam.id_buku) AS total FROM `tb_buku` JOIN tb_detail_pinjam on tb_buku.id_buku=tb_detail_pinjam.id_buku GROUP BY tb_detail_pinjam.id_buku ORDER BY total DESC LIMIT 10");
		return $query->result_array();
	}


	public function kategori_pinjam(){
		$query = $this->db->query("SELECT tb_kategori.id_kategori, tb_kategori.kategori, count(tb_detail_pinjam.id_buku) AS total FROM `tb_kategori` JOIN tb_buku on tb_buku.id_kategori=tb_kategori.id_kategori JOIN tb_detail_pinjam on tb_detail_pinjam.id_buku=tb_buku.id_buku GROUP BY tb_kategori.id_kategori ORDER BY total DESC LIMIT 10");
		return $query->result_array();
	}

	public function kelas_pinjam(){
		$query = $this->db->query("SELECT tb_kelas.id_kelas, tb_kelas.kelas, count(tb_pinjam.id_anggota) AS total FROM `tb_kelas` JOIN tb_anggota on tb_kelas.id_kelas=tb_anggota.id_kelas JOIN tb_pinjam on tb_pinjam.id_anggota=tb_anggota.id_anggota GROUP BY tb_kelas.id_kelas ORDER BY total DESC LIMIT 10");
		return $query->result_array();
	}
	
}

/* End of file Perpus_model.php */
/* Location: ./application/models/Perpus_model.php */
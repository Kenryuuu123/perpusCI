<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dokumen extends CI_Controller {


	public function __construct(){
		parent::__construct();
		
		$this->load->model('Dokumen_model');
	}

	public function index(){

		$data['title']='Home Perpustakaan';
		$tmp['content']=$this->load->view('global/home', $data,TRUE);
		$this->load->view('global/layout',$tmp);
		
	}

	// public function profile(){

	// 	$data['title']='Profile Sekolah';
	// 	$tmp['content']=$this->load->view('global/profile', $data,TRUE);
	// 	$this->load->view('global/layout',$tmp);
		
	// }

	//menampilkan daftar dokumen
	public function list_dokumen(){
		$data['title']='Daftar Dokumen';
			/*data yang ditampilkan*/
			$data['data_dokumen'] = $this->Dokumen_model->getAllData("tb_dokumen");
			// $data['data_buku'] = $this->Dokumen_model->getAllData("tb_buku")->result_array();
			$data['data_kategori'] = $this->Dokumen_model->getAllData("tb_kategori");
			$data['data_penerbit'] = $this->Dokumen_model->getAllData("tb_penerbit");
			$data['data_instansi'] = $this->Dokumen_model->getAllData("tb_instansi");
			$data['data_nama_file'] = $this->Dokumen_model->getAllData("tb_nama_file");
			$data['data_sifat'] = $this->Dokumen_model->getAllData("tb_sifat");
			// $data['data_rak'] = $this->Dokumen_model->getAllData("tb_rak");
			// $data['model'] = $this->Dokumen_model;
			/*masukan data kedalam view */
			//$data['js']=$this->load->view('admin/buku/js');
			$tmp['content']=$this->load->view('global/R_dokumen',$data, TRUE);
			$this->load->view('global/layout',$tmp);
		}

	//menampilkan daftar detail stock buku
	// public function detail_stok(){

	// 	$id_buku = $this->input->get('id_dokumen', TRUE);	
	// 		/*layout*/	
	// 		$data['title']='Daftar Detail Stock Buku';
	// 		$data['pointer']="buku/buku/";
	// 		$data['classicon']="fa fa-book";
	// 		$data['main_bread']="Data Buku";
	// 		$data['sub_bread']="Detail Stock Buku";
	// 		$data['desc']="Data Detail Stock, Menampilkan Detail Stock Buku Perpustakaan";

	// 		/*data yang ditampilkan*/
	// 		$data['data_stok_buku'] = $this->Buku_model->get_detail("tb_detail_buku",'id_buku', $id_buku);
	// 		$data['data_kategori'] = $this->Buku_model->getAllData("tb_kategori");
	// 		$data['data_penerbit'] = $this->Buku_model->getAllData("tb_penerbit");
	// 		$data['data_pengarang'] = $this->Buku_model->getAllData("tb_pengarang");
	// 		$data['data_rak'] = $this->Buku_model->getAllData("tb_rak");
	// 		$data['id']= $id_buku;
	// 		$data['error']="";
			
	// 		/*masukan data kedalam view */
	// 		$tmp['content']=$this->load->view('global/R_detail_stok',$data, TRUE);
	// 		$this->load->view('global/layout',$tmp);	//}
	// }
}

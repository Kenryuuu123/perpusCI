<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Instansi extends MY_Controller {

	public function __construct()
		{
			parent::__construct();
			//$this->Security_model->login_check();
			$this->load->model('Dokumen_model');
		}
	public function index()
	{
		$data['log']=$this->db->get_where('tb_petugas',array('id_petugas' => $this->session->userdata('username')))->result();
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		/*jika status login Yes dan status admin tampilkan*/
		if(!empty($cek) && $stts=='petugas')
		{
			/*layout*/	
			$data['title']='Daftar Instansi';
			$data['pointer']="Instansi";
			$data['classicon']="fa fa-book";
			$data['main_bread']="Data Instansi";
			$data['sub_bread']="Daftar Instansi";
			$data['desc']="Data Master Instansi, Menampilkan data Instansi buku";

			/*data yang ditampilkan*/
			$data['data_instansi'] = $this->Dokumen_model->getAllData("tb_instansi");
			//$data['data_kelas'] = $this->Buku_model->getAllData("tb_kelas");
			//$data['data_agama'] = $this->Buku_model->getAllData("tb_agama");
			//$data['isi']=$this->Anggota_model->get_all();
			//$data['js']=$this->load->view('admin/anggota/js');
			$tmp['content']=$this->load->view('petugas/instansi/View_instansi',$data, TRUE);
			$this->load->view('petugas/layout',$tmp);
		}
		else
		/*jika status login NO atau status bukan admin kembalikan ke login*/
		{
			header('location:'.base_url().'web/log');
		}
	}
	public function create() {
		// Periksa session
		if (!$this->session->userdata('logged_in') || $this->session->userdata('stts') != 'admin') {
			header('location:'.base_url().'web/log');
		}
	
		$data['log'] = $this->db->get_where('tb_petugas', array('id_petugas' => $this->session->userdata('username')))->result();
	
		// Validasi form
		$this->form_validation->set_rules('nama_instansi', 'Nama Instansi', 'trim|required');
	
		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Tambah Instansi';
			$data['pointer'] = "Instansi";
			$data['classicon'] = "fa fa-book";
			$data['main_bread'] = "Data instansi";
			$data['sub_bread'] = "Input Instansi";
			$data['desc'] = "form untuk Input data Instansi";
	
			// Data yang ditampilkan
			$data['data_instansi'] = $this->Dokumen_model->getAllData("tb_instansi");
	
			$tmp['content'] = $this->load->view('admin/instansi/Create_instansi', $data, TRUE);
			$this->load->view('admin/layout', $tmp);
		} else {
			$data = array(
				'nama_instansi' => $this->input->post('nama_instansi')
			);
	
			// Insert data
			$quer = $this->Dokumen_model->insertData('tb_instansi', $data);
	
			// Pesan sukses
			$this->session->set_flashdata('sukses', 'Data berhasil ditambahkan');
			redirect("admin/Instansi", "refresh");
		}
	}
	public function edit()
	{ 
		$data['log']=$this->db->get_where('tb_petugas',array('id_petugas' => $this->session->userdata('username')))->result();
  		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{		
				$id = $this->input->get('id_instansi',true);	
				$this->form_validation->set_rules('nama_instansi', 'nama_instansi', 'trim|required');
				if($this->form_validation->run()==FALSE)
				{
					//$data ['err'] = validation_errors();
					$data['title']='Edit Instansi';
					$data['pointer']="Instansi";
					$data['classicon']="fa fa-book";
					$data['main_bread']="Data instansi";
					$data['sub_bread']="Edit Instansi";
					$data['desc']="Form untuk melakukan edit data instansi";

					/*data yang ditampilkan*/
					$data['instansi'] = $this->Dokumen_model->get_detail1('tb_instansi','id_instansi',$id);
					//$data['data_kelas'] = $this->Buku_model->getAllData("tb_kelas");
					//$data['data_agama'] = $this->Buku_model->getAllData("tb_agama");
					$tmp['content']=$this->load->view('admin/instansi/Edit_instansi',$data,true);
					$this->load->view('admin/layout',$tmp);
				}
		}
		else
		{
			header('location:'.base_url().'web/log');
		}
 	}
 	public function update()
	{ 
		$data['log']=$this->db->get_where('tb_petugas',array('id_petugas' => $this->session->userdata('username')))->result();
  		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{		
				$id = $this->input->post('id_instansi');	
				$this->form_validation->set_rules('nama_instansi', 'nama_instansi', 'trim|required');
				if($this->form_validation->run()==FALSE)
				{
					//$data ['err'] = validation_errors();
					$data['title']='Edit Instansi';
					$data['pointer']="Instansi";
					$data['classicon']="fa fa-book";
					$data['main_bread']="Data Instansi";
					$data['sub_bread']="Edit instansi";
					$data['desc']="Form untuk melakukan edit instansi";

					/*data yang ditampilkan*/
					$data['nama_instansi'] = $this->Buku_model->get_detail1('tb_instansi','id_instansi',$id);
					//$data['data_kelas'] = $this->Buku_model->getAllData("tb_kelas");
					//$data['data_agama'] = $this->Buku_model->getAllData("tb_agama");
					$tmp['content']=$this->load->view('admin/instansi/Edit_instansi',$data,true);
					$this->load->view('admin/layout',$tmp);
				}
			 	else
				{
					$id = $this->input->post('id_instansi');	
					$field='id_instansi';
		            $data = array(
		                          'nama_instansi' => $this->input->post('nama_instansi')
		                        );
					$quer=$this->Buku_model->updateData1('tb_instansi',$data,$field,$id);
					redirect("admin/Instansi","refresh");	
				}
		}
		else
		{
			header('location:'.base_url().'web/log');
		}
 	}
 	public function delete()
		{
			$data['log']=$this->db->get_where('tb_petugas',array('id_petugas' => $this->session->userdata('username')))->result();
			$field='id_instansi';
			$id = $this->input->get('id_instansi',true);	
  			$query = $this->Dokumen_model->delete('tb_instansi',$field,$id);					
			if ($query)
				{
					$this->session->set_flashdata("message","berhasil");
					redirect("admin/Instansi","refresh");
				}
			else
				{
					$this->session->set_flashdata("message","gagal");
					redirect("admin/Instansi","refresh");
				}
 		}
}
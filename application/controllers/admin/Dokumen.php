<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class dokumen extends MY_Controller {


	public function __construct(){
		parent::__construct();

		$this->load->model('Dokumen_model');
	}

	//menampilkan daftar buku
	public function dokumen()
	{
		$data['log']=$this->db->get_where('tb_petugas',array('id_petugas' => $this->session->userdata('username')))->result();
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		/*jika status login Yes dan status admin tampilkan*/
		if(!empty($cek) && $stts=='admin')
		{
			/*layout*/	
			$data['title']='Daftar dokumen';
			$data['pointer']="dokumen/dokumen";
			$data['classicon']="fa fa-book";
			$data['main_bread']="Data Dokumen";
			$data['sub_bread']="Daftar Dokumen";
			$data['desc']="Data Master Dokumen, Menampilkan data Dokumen Perpustakaan";

			/*data yang ditampilkan*/
			$data['data_dokumen'] = $this->Dokumen_model->getAllData1();
			// $data['data_kategori']
			$data['model'] = $this->Dokumen_model;
			/*masukan data kedalam view */
			//$data['js']=$this->load->view('admin/buku/js');
			$tmp['content']=$this->load->view('admin/dokumen/R_dokumen',$data, TRUE);
			$this->load->view('admin/layout',$tmp);
		}
		else
		/*jika status login NO atau status bukan admin kembalikan ke login*/
		{
			header('location:'.base_url().'web/log');
		}
	}

	//hapus buku
	public function hapus_dokumen()
	{
		$data['log'] = $this->db->get_where('tb_petugas', array('id_petugas' => $this->session->userdata('username')))->result();
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		
		if (!empty($cek) && $stts == 'admin') {
			$id_dokumen = $this->input->get('id_dokumen', TRUE);
			
			// Ambil detail dokumen untuk mendapatkan nama berkas
			$dokumen = $this->Dokumen_model->get_detaill('tb_dokumen', 'id_dokumen', $id_dokumen);
			
			if ($dokumen && !empty($dokumen->berkas)) {
				// Hapus berkas dari folder
				$file_path = './uploads/upload/' . $dokumen->berkas;
				if (file_exists($file_path)) {
					unlink($file_path);
				}
			}
			
			// Hapus data dari database
			$hapus = array('id_dokumen' => $id_dokumen);
			$this->Dokumen_model->deleteData('tb_dokumen', $hapus);
			
			// Tambahkan pesan sukses (opsional)
			$this->session->set_flashdata('success', 'Dokumen berhasil dihapus.');
			
			header('location:' . base_url() . 'admin/Dokumen/dokumen');
		} else {
			header('location:' . base_url() . 'web/log');
		}
	}

	//tambah buku
	//tambah buku
// 	public function tambah_dokumen()
// {
// 	$data['log']=$this->db->get_where('tb_petugas',array('id_petugas' => $this->session->userdata('username')))->result();
// 	$cek = $this->session->userdata('logged_in');
// 	$stts = $this->session->userdata('stts');
// 	if(!empty($cek) && $stts=='admin')
// 	{	

// 		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required|min_length[5]');
// 		$this->form_validation->set_rules('juduldok', 'Judul Dokumen', 'trim|required|min_length[5]');
// 		$this->form_validation->set_rules('kategori', 'Kategori', 'trim|required');
// 		$this->form_validation->set_rules('penerbit', 'Penerbit', 'trim|required');
// 		$this->form_validation->set_rules('instansi', 'Instansi', 'trim|required');
// 		$this->form_validation->set_rules('tgl', 'Tanggal', 'trim|required');
// 		$this->form_validation->set_rules('id_nama_file', 'Nama File', 'trim|required');
// 		$this->form_validation->set_rules('no_dok', 'No Dokumen', 'trim|required');

// 		if ($this->form_validation->run() === FALSE)
// 		{
// 			/*layout*/	
// 			$data['title']='Tambah Dokumen';
// 			$data['pointer']='dokumen/dokumen';
// 			$data['classicon']='fa fa-book';
// 			$data['main_bread']='Daftar Dokumen';
// 			$data['sub_bread']='Tambah Dokumen';
// 			$data['desc']='Form menambahkan data dokumen Perpustakaan';

// 			/*data yang ditampilkan*/
// 			$data['data_kategori'] = $this->Dokumen_model->getAllData("tb_kategori");
// 			$data['data_penerbit'] = $this->Dokumen_model->getAllData("tb_penerbit");
// 			$data['data_instansi'] = $this->Dokumen_model->getAllData("tb_instansi");
// 			$data['data_nama_file'] = $this->Dokumen_model->getAllData("tb_nama_file");
// 			// $data['data_rak'] = $this->Buku_model->getAllData("tb_rak");
// 			/*masukan data kedalam view */
// 			$tmp['content']=$this->load->view('admin/dokumen/C_dokumen',$data, TRUE);
// 			$this->load->view('admin/layout',$tmp);
// 		}
// 		else
// 		{
// 			$this->db->where('id_dokumen',$this->input->post('id_dokumen'));
// 			$isi=$this->db->count_all_results('tb_dokumen');
// 			if($isi==0){
// 				$data = array(
// 					'id_dokumen' => $this->input->post('id_dokumen'),
// 					'deskripsi' => $this->input->post('deskripsi'),
// 					'juduldok' => $this->input->post('juduldok'),
// 					'id_kategori' => $this->input->post('kategori'),
// 					'id_penerbit' => $this->input->post('penerbit'),
// 					'id_instansi' => $this->input->post('instansi'),
// 					'tgl' => $this->input->post('tgl'),
// 					'id_nama_file' => $this->input->post('id_nama_file'),
// 					'no_dok' => $this->input->post('no_dok'),
// 					'ket' => $this->input->post('keterangan')
// 				);
		
// 				// var_dump($data);die();
// 					$this->Dokumen_model->insertData('tb_dokumen',$data);
// 					redirect ('admin/Dokumen/dokumen');
// 			}
// 			else 
// 				{
// 				/*layout*/	
// 				$data['title']='Tambah Dokumen';
// 				$data['pointer']='dokumen/dokumen';
// 				$data['classicon']='fa fa-book';
// 				$data['main_bread']='Daftar Dokumen';
// 				$data['sub_bread']='Tambah Dokumen';
// 				$data['desc']='Form menambahkan data dokumen Perpustakaan';

// 				/*data yang ditampilkan*/
// 				$data['data_kategori'] = $this->Dokumen_model->getAllData("tb_kategori");
// 				$data['data_penerbit'] = $this->Dokumen_model->getAllData("tb_penerbit");
// 				$data['data_instansi'] = $this->Dokumen_model->getAllData("tb_instansi");
// 				$data['data_nama_file'] = $this->Dokumen_model->getAllData("tb_nama_file");
// 				// $data['data_rak'] = $this->Buku_model->getAllData("tb_rak");
// 				/*masukan data kedalam view */
// 				$tmp['content']=$this->load->view('admin/dokumen/C_dokumen',$data, TRUE);
// 				$this->load->view('admin/layout',$tmp);
			
// 			}
// 		}
// 	}
// 	else
// 	{
	
// 		header('location:'.base_url().'web/log');
// 	}
// }

public function tambah_dokumen()
{
	$data['log'] = $this->db->get_where('tb_petugas', array('id_petugas' => $this->session->userdata('username')))->result();
	$cek = $this->session->userdata('logged_in');
	$stts = $this->session->userdata('stts');
	if (!empty($cek) && $stts == 'admin') {	

		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required|min_length[5]');
		$this->form_validation->set_rules('juduldok', 'Judul Dokumen', 'trim|required|min_length[5]');
		$this->form_validation->set_rules('kategori', 'Kategori', 'trim|required');
		$this->form_validation->set_rules('penerbit', 'Penerbit', 'trim|required');
		$this->form_validation->set_rules('instansi', 'Instansi', 'trim|required');
		$this->form_validation->set_rules('tgl', 'Tanggal', 'trim|required');
		$this->form_validation->set_rules('id_nama_file', 'Nama File', 'trim|required');
		$this->form_validation->set_rules('no_dok', 'No Dokumen', 'trim|required');
		$this->form_validation->set_rules('sifat', 'Sifat Dokumen', 'trim|required');
		$this->form_validation->set_rules('id_petugas[]','ID Petugas');
		$this->form_validation->set_rules('berkas', 'Berkas', 'callback_check_file');
		if ($this->form_validation->run() === FALSE) {
			// echo validation_errors();
			// echo '1';die();
			/*layout*/	
			$data['title'] = 'Tambah Dokumen';
			$data['pointer'] = 'dokumen/dokumen';
			$data['classicon'] = 'fa fa-book';
			$data['main_bread'] = 'Daftar Dokumen';
			$data['sub_bread'] = 'Tambah Dokumen';
			$data['desc'] = 'Form menambahkan data dokumen Perpustakaan';

			/*data yang ditampilkan*/
			$data['data_kategori'] = $this->Dokumen_model->getAllData("tb_kategori");
			$data['data_penerbit'] = $this->Dokumen_model->getAllData("tb_penerbit");
			$data['data_instansi'] = $this->Dokumen_model->getAllData("tb_instansi");
			$data['data_nama_file'] = $this->Dokumen_model->getAllData("tb_nama_file");
			$data['data_sifat'] = $this->Dokumen_model->getAllData("tb_sifat");
			$data['data_berkas'] = $this->Dokumen_model->getAllData("tb_dokumen");
			$data['data_id_petugas'] = $this->Dokumen_model->getAllData("tb_petugas");
			/*masukan data kedalam view */
			$tmp['content'] = $this->load->view('admin/dokumen/C_dokumen', $data, TRUE);
			$this->load->view('admin/layout', $tmp);
		} else {
			// Konfigurasi upload file
			// echo '2';die();
			$config['upload_path']   = './uploads/upload/'; // Lokasi penyimpanan file
			$config['allowed_types'] = 'pdf|doc|docx|jpg|png|mp4|mkv'; // Jenis file yang diperbolehkan
			$config['max_size']      = 51200;
			// $config['max_width'] = 0;
			// $config['max_height'] = 0;
			// $config['max_size'] = 0;
			$config['encrypt_name'] = false;
			$this->upload->initialize($config);
			$this->load->library('upload', $config);
		
			if (!$this->upload->do_upload('berkas')) {
				// Jika upload gagal, tampilkan pesan error
				// echo '3';die();
				// var_dump($data); die();
				$data['error'] = $this->upload->display_errors();
				$data['title'] = 'Tambah Dokumen';
				$data['pointer'] = 'dokumen/dokumen';
				$data['classicon'] = 'fa fa-book';
				$data['main_bread'] = 'Daftar Dokumen';
				$data['sub_bread'] = 'Tambah Dokumen';
				$data['desc'] = 'Form menambahkan data dokumen Perpustakaan';

				$data['data_kategori'] = $this->Dokumen_model->getAllData("tb_kategori");
				$data['data_penerbit'] = $this->Dokumen_model->getAllData("tb_penerbit");
				$data['data_instansi'] = $this->Dokumen_model->getAllData("tb_instansi");
				$data['data_nama_file'] = $this->Dokumen_model->getAllData("tb_nama_file");
				$data['data_sifat'] = $this->Dokumen_model->getAllData("tb_sifat");
				$data['data_berkas'] = $this->Dokumen_model->getAllData("tb_dokumen");
				$data['data_id_petugas'] = $this->Dokumen_model->getAllData("tb_petugas");
 				$tmp['content'] = $this->load->view('admin/dokumen/C_dokumen', $data, TRUE);
				$this->load->view('admin/layout', $tmp);
			} else {
				// Jika upload berhasil, ambil nama file
				// echo '4';die();
				$upload_data = $this->upload->data();
				// var_dump($upload_data); die();
				// $jenis_file = $upload_data ['jenis_file'];
				$nama_berkas = $upload_data['file_name'];
				$file_berkas= file_get_contents($upload_data['full_path']);
				$this->db->where('id_dokumen', $this->input->post('id_dokumen'));
				$isi = $this->db->count_all_results('tb_dokumen');
				if ($isi == 0) {
					// Data untuk disimpan ke database
					$id_petugas_array = $this->input->post('id_petugas');
					$id_petugas_string = !empty($id_petugas_array) ? implode(',', $id_petugas_array) : '';
					$data_dokumen = array(
						'id_dokumen'   => $this->input->post('id_dokumen'),
						'deskripsi'    => $this->input->post('deskripsi'),
						'juduldok'     => $this->input->post('juduldok'),
						'id_kategori'  => $this->input->post('kategori'),
						'id_penerbit'  => $this->input->post('penerbit'),
						'id_instansi'  => $this->input->post('instansi'),
						'tgl'          => $this->input->post('tgl'),
						'id_nama_file' => $this->input->post('id_nama_file'),
						'no_dok'       => $this->input->post('no_dok'),
						'ket'          => $this->input->post('keterangan'),
						'id_petugas'   => $id_petugas_string,
						'id_sifat'	   => $this->input->post('sifat'),
						'berkas'	   => $nama_berkas // Simpan nama file
					);
					// var_dump($data);die();
					$this->Dokumen_model->insertData('tb_dokumen', $data_dokumen);
					$id_dokumen = $this->db->insert_id();

					// Simpan data ke tabel relasi tb_dokumen_petugas
					if (!empty($id_petugas_array)) {
						foreach ($id_petugas_array as $id_petugas) {
							$data_relasi = array(
								'id_dokumen' => $id_dokumen,
								'id_petugas' => $id_petugas
							);
							$this->Dokumen_model->insertData('tb_dokumen_petugas', $data_relasi);
						}
					}
				
					redirect('admin/Dokumen/dokumen');
				} else {
					$data['title'] = 'Tambah Dokumen';
					$data['pointer'] = 'dokumen/dokumen';
					$data['classicon'] = 'fa fa-book';
					$data['main_bread'] = 'Daftar Dokumen';
					$data['sub_bread'] = 'Tambah Dokumen';
					$data['desc'] = 'Form menambahkan data dokumen Perpustakaan';

					$data['data_kategori'] = $this->Dokumen_model->getAllData("tb_kategori");
					$data['data_penerbit'] = $this->Dokumen_model->getAllData("tb_penerbit");
					$data['data_instansi'] = $this->Dokumen_model->getAllData("tb_instansi");
					$data['data_nama_file'] = $this->Dokumen_model->getAllData("tb_nama_file");
					$data['data_id_petugas'] = $this->Dokumen_model->getAllData("tb_petugas");
					$data['data_sifat'] = $this->Dokumen_model->getAllData("tb_sifat");
					$data['data_berkas'] = $this->Dokumen_model->getAllData("tb_dokumen");
					$tmp['content'] = $this->load->view('admin/dokumen/C_dokumen', $data, TRUE);
					$this->load->view('admin/layout', $tmp);
				}
			}
		}
	} else {
		header('location:' . base_url() . 'web/log');
	}
}

public function check_file()
{
    if (empty($_FILES['berkas']['name'])) {
        $this->form_validation->set_message('check_file', 'Dokumen wajib diunggah.');
        return FALSE;
    }
    return TRUE;
}


	//edit buku
	public function edit_dokumen()
	{
		$data['log']=$this->db->get_where('tb_petugas',array('id_petugas' => $this->session->userdata('username')))->result();
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{	
			$id_dokumen = $this->input->get('id_dokumen', TRUE);	
				
			/*layout*/	
				$data['title']='Edit Dokumen';
				$data['pointer']="dokumen/dokumen";
				$data['classicon']="fa fa-book";
				$data['main_bread']="Daftar Dokumen";
				$data['sub_bread']="Edit Dokumen";
				$data['desc']="Form untuk melakukan edit data Dokumen Perpustakaan";

				/*data yang ditampilkan*/
				$data['data_kategori'] = $this->Dokumen_model->getAllData("tb_kategori");
				$data['data_penerbit'] = $this->Dokumen_model->getAllData("tb_penerbit");
				$data['data_instansi'] = $this->Dokumen_model->getAllData("tb_instansi");
				$data['data_nama_file'] = $this->Dokumen_model->getAllData("tb_nama_file");
				$data['data_sifat'] = $this->Dokumen_model->getAllData("tb_sifat");
				$data['data_id_petugas'] = $this->Dokumen_model->getAllData("tb_petugas");
				$data['dokumen'] = $this->Dokumen_model->get_detail('tb_dokumen','id_dokumen', $id_dokumen);
				
				/*masukan data kedalam view */
				$tmp['content']=$this->load->view('admin/dokumen/U_dokumen',$data, TRUE);
				$this->load->view('admin/layout',$tmp);		
		}
		else
		{
			header('location:'.base_url().'web/log');
		}
	}

	//update buku

	public function update_dokumen()
{
    $data['log'] = $this->db->get_where('tb_petugas', ['id_petugas' => $this->session->userdata('username')])->result();
    $cek = $this->session->userdata('logged_in');
    $stts = $this->session->userdata('stts');
    
    if (!empty($cek) && $stts == 'admin') {
        // Validasi form
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required|min_length[5]');
        $this->form_validation->set_rules('juduldok', 'Judul Dokumen', 'trim|required|min_length[5]');
        $this->form_validation->set_rules('kategori', 'Kategori', 'trim|required');
        $this->form_validation->set_rules('penerbit', 'Penerbit', 'trim|required');
        $this->form_validation->set_rules('instansi', 'Instansi', 'trim|required');
        $this->form_validation->set_rules('tgl', 'Tanggal', 'trim|required');
		$this->form_validation->set_rules('sifat', 'Sifat', 'trim|required');
		$this->form_validation->set_rules('id_petugas[]', 'ID Petugas');
		// $this->form_validation->set_rules('id_nama_file', 'Nama File', 'trim|required');
        $this->form_validation->set_rules('no_dok', 'No Dokumen', 'trim|required');
        
        $id_dokumen = $this->input->post('id');
        
        if ($this->form_validation->run() === FALSE) {
            // Jika form tidak valid
            $data['title'] = 'Edit Dokumen';
            $data['pointer'] = "dokumen/dokumen";
            $data['classicon'] = "fa fa-book";
            $data['main_bread'] = "Daftar Dokumen";
            $data['sub_bread'] = "Edit Dokumen";
            $data['desc'] = "Form untuk melakukan edit data dokumen Perpustakaan";
            
            $data['data_kategori'] = $this->Dokumen_model->getAllData("tb_kategori");
            $data['data_penerbit'] = $this->Dokumen_model->getAllData("tb_penerbit");
            $data['data_instansi'] = $this->Dokumen_model->getAllData("tb_instansi");
			$data['data_nama_file'] = $this->Dokumen_model->getAllData("tb_nama_file");
			$data['data_berkas'] = $this->Dokumen_model->getAllData("tb_dokumen");
			$data['data_sifat'] = $this->Dokumen_model->getAllData("tb_sifat");
			$data['data_id_petugas'] = $this->Dokumen_model->getAllData("tb_petugas");
            $data['dokumen'] = $this->Dokumen_model->get_detaill('tb_dokumen', 'id_dokumen', $id_dokumen);
            
            $tmp['content'] = $this->load->view('admin/dokumen/U_dokumen', $data, TRUE);
            $this->load->view('admin/layout', $tmp);
        } else {
            $dokumen_detail = $this->Dokumen_model->get_detaill('tb_dokumen', 'id_dokumen', $id_dokumen);
            $old_berkas = $dokumen_detail->berkas;
			$id_petugas_array = $this->input->post('id_petugas');
			$id_petugas_string = !empty($id_petugas_array) ? implode(',', $id_petugas_array) : '';
            $data_update = array(
                'deskripsi' => $this->input->post('deskripsi'),
                'juduldok' => $this->input->post('juduldok'),
                'id_kategori' => $this->input->post('kategori'),
                'id_penerbit' => $this->input->post('penerbit'),
                'id_instansi' => $this->input->post('instansi'),
				'id_nama_file' => $this->input->post('nama_file'),
				'id_sifat' => $this->input->post('sifat'),
                'tgl' => $this->input->post('tgl'),
                'no_dok' => $this->input->post('no_dok'),
				'id_petugas' => $id_petugas_string,
                'ket' => $this->input->post('ket')
            );

            if (!empty($_FILES['berkas']['name'])) {
                $config['upload_path'] = './uploads/upload';
                $config['allowed_types'] = 'pdf|doc|docx|jpg|png|mp4|mkv';
                $config['max_size'] = 51200;
                $this->upload->initialize($config);
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('berkas')) {
                    $upload_data = $this->upload->data();
                    $data_update['berkas'] = $upload_data['file_name'];
                    $old_path = './uploads/upload/' . $old_berkas;
                    if (!empty($old_berkas) && file_exists($old_path)) {
                        unlink($old_path); 
                    }
                } else {
					$this->session->set_flashdata('error', 'Upload gagal: ' . $this->upload->display_errors());
                    redirect('admin/Dokumen/edit_dokumen/' . $id_dokumen);
                }
            } else {
                $data_update['berkas'] = $old_berkas;
            }
            $this->Dokumen_model->update_berkas('tb_dokumen', $data_update, $id_dokumen, 'id_dokumen');
            $this->session->set_flashdata('success', 'Dokumen berhasil diperbarui.');
            redirect('admin/Dokumen/Dokumen');
        }
    } else {
        header('location:' . base_url() . 'web/log');
    }
}

	

	//menampilkan daftar detail stock buku
// 	public function detail_dokumen()
// {
//     $data['log'] = $this->db->get_where('tb_petugas', array('id_petugas' => $this->session->userdata('username')))->result();
//     $cek = $this->session->userdata('logged_in');
//     $stts = $this->session->userdata('stts');

//     /* Jika status login Yes dan status admin tampilkan */
//     if (!empty($cek) && $stts == 'admin') {
//         $id_dokumen = $this->input->get('id_dokumen');

//         /* Layout */
//         $data['title'] = 'Daftar Detail Dokumen';
//         $data['pointer'] = "dokumen/dokumen/";
//         $data['classicon'] = "fa fa-book";
//         $data['main_bread'] = "Data Dokumen";
//         $data['sub_bread'] = "Detail Dokumen";
//         $data['desc'] = "Data Detail Dokumen, Menampilkan Detail Dokumen Perpustakaan";

//         /* Data yang ditampilkan */
//         $data['data_detail_dokumen'] = $this->Dokumen_model->get_detail("tb_detail_dokumen", 'id_dokumen', $id_dokumen);
//         $data['data_kategori'] = $this->Dokumen_model->getAllData("tb_kategori");
//         $data['data_penerbit'] = $this->Dokumen_model->getAllData("tb_penerbit");
//         $data['data_pengarang'] = $this->Dokumen_model->getAllData("tb_instansi");
//         $data['data_nama_file'] = $this->Dokumen_model->getAllData("tb_nama_file");
//         $data['id'] = $id_dokumen;
//         $data['error'] = "";

//         /* Masukkan data ke dalam view */
//         $tmp['content'] = $this->load->view('admin/dokumen/R_detail_dokumen', $data, TRUE);
//         $this->load->view('admin/layout', $tmp);
//     } else {
//         /* Jika status login NO atau status bukan admin kembalikan ke login */
//         header('location:' . base_url() . 'web/log');
//     }
// }
public function detail_dokumen()
{
    $data['log'] = $this->db->get_where('tb_petugas', array('id_petugas' => $this->session->userdata('username')))->result();
    $cek = $this->session->userdata('logged_in');
    $stts = $this->session->userdata('stts');

    /* Jika status login Yes dan status admin tampilkan */
    if (!empty($cek) && $stts == 'admin') {
        $id_dokumen = $this->input->get('id_dokumen');

        /* Layout */
        $data['title'] = 'Daftar Detail Dokumen';
        $data['pointer'] = "dokumen/dokumen/";
        $data['classicon'] = "fa fa-book";
        $data['main_bread'] = "Data Dokumen";
        $data['sub_bread'] = "Detail Dokumen";
        $data['desc'] = "Data Detail Dokumen, Menampilkan Detail Dokumen Perpustakaan";

        /* Data yang ditampilkan */
        $data['data_detail_dokumen'] = $this->Dokumen_model->get_detail("tb_detail_dokumen", 'id_dokumen', $id_dokumen);
        $data['data_kategori'] = $this->Dokumen_model->getAllData("tb_kategori");
        $data['data_penerbit'] = $this->Dokumen_model->getAllData("tb_penerbit");
        $data['data_pengarang'] = $this->Dokumen_model->getAllData("tb_instansi");
        $data['data_nama_file'] = $this->Dokumen_model->getAllData("tb_nama_file");
        $data['id'] = $id_dokumen;
        $data['error'] = "";

        // Debugging: cek data yang dikirim
        // var_dump($data['data_detail_dokumen']);
        // exit;

        /* Masukkan data ke dalam view */
        $tmp['content'] = $this->load->view('admin/dokumen/R_detail_dokumen', $data, TRUE);
        $this->load->view('admin/layout', $tmp);
    } else {
        /* Jika status login NO atau status bukan admin kembalikan ke login */
        header('location:' . base_url() . 'web/log');
    }
}




	//hapus detail buku
	public function hapus_det_buku()
	{
		$data['log']=$this->db->get_where('tb_petugas',array('id_petugas' => $this->session->userdata('username')))->result();
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			
			$id_buku = $this->input->get('id_buku',TRUE);		
			$id_det_buku = $this->input->get('id_detail_buku',TRUE);	

			$hapus = array('id_detail_buku' => $id_det_buku);
			$status=$this->Buku_model->get_detail1('tb_detail_buku','id_detail_buku',$id_det_buku);
			//jika status buku tersedia, maka dapat dihapus. jika status dipinjamkan tidak dapat dihapus
			if($status['status']==1){
			$this->Buku_model->deletedetData('tb_detail_buku','id_detail_buku',$id_det_buku);
			$stok_sebelum=$this->Buku_model->get_stok($id_buku)->stok;
			$stok_sesudah=$stok_sebelum-1;
			$data2= array (
						'stok' => $stok_sesudah,
			);
			$this->Buku_model->updateData('tb_buku',$data2,$id_buku,'id_buku');
			header('location:'.base_url().'admin/buku/detail_stok/?id_buku='.$id_buku.'');
			}else{
				//tampilkan error
				 $this->session->set_flashdata("message","<div class='callout callout-info'>
                <h4>Info!</h4>
                <p>Data stok buku tidak dapat dihapus karena status dipinjamkan</p>
                </div>");
            header('location:'.base_url().'admin/buku/detail_stok/?id_buku='.$id_buku.'');
			}
		}
		else
		{
			header('location:'.base_url().'web/log');
		}
	}

	//tambah detail buku
	public function tambah_det_buku()
	{
		$data['log']=$this->db->get_where('tb_petugas',array('id_petugas' => $this->session->userdata('username')))->result();
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{	
			
			$this->form_validation->set_rules('no_buku1', 'no_buku1', 'required');
			$this->form_validation->set_rules('no_buku2', 'no_buku2', 'required');

			$id_buku = $this->input->get('id_buku', TRUE);		


			if ($this->form_validation->run() === FALSE)
			{
				/*layout*/	
				$data['title']='Tambah Detail Stok Buku';
				$data['pointer']='buku/detail_stok/?id_buku='.$id_buku.'';
				$data['classicon']="fa fa-book";
				$data['main_bread']="Detail Stok Buku";
				$data['sub_bread']="Tambah Detail Stok";
				$data['desc']="Form menambahkan data detail stok buku Perpustakaan";
				$data['id_buku']=$id_buku;
				/*masukan data kedalam view */
				$tmp['content']=$this->load->view('admin/buku/C_detail_stok',$data, TRUE);
				$this->load->view('admin/layout',$tmp);
			}
			else
			{
					//ambil id buku
					$id_buku = $this->input->post('id_buku');
					
					//ambil no awal dan no akhir buku (range)
					$no_awal=$this->input->post('no_buku1');
					$no_akhir=$this->input->post('no_buku2');

					//validasi no awal tidak boleh lebih besar dari no akhir
					if($no_awal>$no_akhir){
						//tampilkan error
						 $this->session->set_flashdata("message","<div class='callout callout-info'>
		                <h4>Info!</h4>
		                <p>No awal tidak boleh lebih besar dari No akhir</p>
		                </div>");
		            header('location:'.base_url().'admin/buku/tambah_det_buku/?id_buku='.$id_buku.'');
					}
					else{

					//deklarasi array
					$no_buku=array();
					$data=array();
					//masukan masing - masing no buku awal sampai akhir
					for ($i=$no_awal; $i <= $no_akhir  ; $i++) { 
						$no_buku[]=$i;
					}
					//hitung jumlah buku
					$jml=count($no_buku);
					//masukan no buku beserta id buku dan status nya
					for ($i=0; $i < $jml  ; $i++) { 
					$data[]= array (
							'id_buku' => $this->input->post('id_buku'),
							'no_buku' => $no_buku[$i],
							'status' => $this->input->post('status'),
						);
					}
					
					//insert buku dengan no buku secara berurutan sesuai range
					 	$this->Buku_model->insertData_batch('tb_detail_buku',$data);

					//update stock
					$stok_sebelum=$this->Buku_model->get_stok($id_buku)->stok;
					$stok_sesudah=$stok_sebelum+$jml;
					$data2= array (
							'stok' => $stok_sesudah,
						);
					$this->Buku_model->updateData('tb_buku',$data2,$id_buku,'id_buku');

					header('location:'.base_url().'admin/buku/detail_stok/?id_buku='.$id_buku.'');
					}
			
			}
		}
		else
		{
		
			header('location:'.base_url().'web/log');
		}
	}

	//edit buku
	public function edit_det_buku()
	{
		$data['log']=$this->db->get_where('tb_petugas',array('id_petugas' => $this->session->userdata('username')))->result();
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{	
			$id_det_buku = $this->input->get('id_detail_buku', TRUE);	
			$id_buku = $this->input->get('id_buku', TRUE);		

			/*layout*/	
				$data['title']='Edit Detail Stok Buku';
				$data['pointer']='buku/detail_stok/?id_buku='.$id_buku.'';
				$data['classicon']="fa fa-book";
				$data['main_bread']="Detail Stok Buku";
				$data['sub_bread']="Edit Stok Buku";
				$data['desc']="Form untuk melakukan edit detail stok buku Perpustakaan";
				$data['id_detail_buku']=$id_det_buku;
				$data['id_buku']=$id_buku;
				$data['det_buku'] = $this->Buku_model->get_detail('tb_detail_buku','id_detail_buku', $id_det_buku);
				
				/*masukan data kedalam view */
				$tmp['content']=$this->load->view('admin/buku/U_detail_stok',$data, TRUE);
				$this->load->view('admin/layout',$tmp);		
		}
		else
		{
			header('location:'.base_url().'web/log');
		}
	}

	//update buku
	public function update_det_buku()
	{
		$data['log']=$this->db->get_where('tb_petugas',array('id_petugas' => $this->session->userdata('username')))->result();
		$cek = $this->session->userdata('logged_in');
		$stts = $this->session->userdata('stts');
		if(!empty($cek) && $stts=='admin')
		{
			$id_det_buku = $this->input->get('id_det_buku', TRUE);		
			$id_buku = $this->input->get('id_buku', TRUE);

			$this->form_validation->set_rules('no_buku', 'no_buku', 'required');
					
			if ($this->form_validation->run() === FALSE)
			{
				$data['title']='Edit Detail Stok Buku';
				$data['pointer']='buku/detail_stok/?id_buku='.$id_buku.'';
				$data['classicon']="fa fa-book";
				$data['main_bread']="Detail Stok Buku";
				$data['sub_bread']="Edit Stok Buku";
				$data['desc']="Form untuk melakukan edit detail stok buku Perpustakaan";
				$data['det_buku'] = $this->Buku_model->get_detail('tb_detail_buku','id_detail_buku', $id_det_buku);
				
				/*masukan data kedalam view */
				$tmp['content']=$this->load->view('admin/buku/U_detail_stok',$data, TRUE);
				$this->load->view('admin/layout',$tmp);		
				
			}
			else
			{
				
					$id_buku = $this->input->post('id_buku');
					$data= array (
							'id_buku' => $this->input->post('id_buku'),
							'no_buku' => $this->input->post('no_buku'),
							'status' => $this->input->post('status'),
						);
				
					$this->Buku_model->updateData('tb_detail_buku',$data,$id_det_buku,'id_detail_buku');		
					header('location:'.base_url().'admin/buku/detail_stok/?id_buku='.$id_buku.'');
			
			}
			
		
		}
		else
		{
			header('location:'.base_url().'web/log');
		}
	}


}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */
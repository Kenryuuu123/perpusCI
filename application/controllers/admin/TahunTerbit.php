<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TahunTerbit extends CI_Controller {

	
	public function __construct()
    {
        parent::__construct();
        //$this->Security_model->login_check();
    }
	public function index()
    {
        $data['log']=$this->db->get_where('tb_petugas',array('id_petugas' => $this->session->userdata('username')))->result();
        $cek = $this->session->userdata('logged_in');
        $stts = $this->session->userdata('stts');
        /*jika status login Yes dan status admin tampilkan*/
        if(!empty($cek) && $stts=='admin')
        {
            /*layout*/  
            $data['title']='Daftar Tahun Terbit';
            $data['pointer']="Penerbit";
            $data['classicon']="fa fa-book";
            $data['main_bread']="Data Tahun Terbit";
            $data['sub_bread']="Daftar Tahun Terbit";
            $data['desc']="Data Master Tahun Terbit, Menampilkan data Tahun Terbit";

            /*data yang ditampilkan*/
            $data['data_tahunterbit'] = $this->Dokumen_model->getAllData("tb_tahunterbit");
            //$data['data_agama'] = $this->Buku_model->getAllData("tb_agama");
            //$data['isi']=$this->Anggota_model->get_all();
            //$data['js']=$this->load->view('admin/anggota/js');
            $tmp['content']=$this->load->view('admin/tahun/View_TahunTerbit',$data, TRUE);
            $this->load->view('admin/layout',$tmp);
        }
        else
        /*jika status login NO atau status bukan admin kembalikan ke login*/
        {
            header('location:'.base_url().'web/log');
        }
    }
    public function create()
    {
        $data['log']=$this->db->get_where('tb_petugas',array('id_petugas' => $this->session->userdata('username')))->result();
        $cek = $this->session->userdata('logged_in');
        $stts = $this->session->userdata('stts');
        if(!empty($cek) && $stts=='admin')
        {   
                $this->form_validation->set_rules('penerbit', 'penerbit', 'trim|required');
                $this->form_validation->set_rules('provinsi', 'provinsi', 'trim|required');
                if($this->form_validation->run()==FALSE)
                {
                    $data['title']='Tambah Tahun Terbit';
                    $data['pointer']="Penerbit";
                    $data['classicon']="fa fa-book";
                    $data['main_bread']="Data Tahun Terbit";
                    $data['sub_bread']="Tambah Tahun Terbit";
                    $data['desc']="form untuk Input data Tahun Terbit";

                    /*data yang ditampilkan*/
                    $data['data_provinsi'] = $this->Buku_model->getAllData("tb_provinsi");<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class tahunterbit extends CI_Controller {

	
	public function __construct()
    {
        parent::__construct();
        //$this->Security_model->login_check();
    }
	public function index()
    {
        $data['log']=$this->db->get_where('tb_petugas',array('id_petugas' => $this->session->userdata('username')))->result();
        $cek = $this->session->userdata('logged_in');
        $stts = $this->session->userdata('stts');
        /*jika status login Yes dan status admin tampilkan*/
        if(!empty($cek) && $stts=='admin')
        {
            /*layout*/  
            $data['title']='Daftar Tahun Terbit';
            $data['pointer']="Penerbit";
            $data['classicon']="fa fa-book";
            $data['main_bread']="Data Penerbit";
            $data['sub_bread']="Daftar Penerbit";
            $data['desc']="Data Master Penerbit, Menampilkan data Penerbit";

            /*data yang ditampilkan*/
            $data['data_penerbit'] = $this->Buku_model->getAllData("tb_penerbit");
            $data['data_provinsi'] = $this->Buku_model->getAllData("tb_provinsi");
            //$data['data_agama'] = $this->Buku_model->getAllData("tb_agama");
            //$data['isi']=$this->Anggota_model->get_all();
            //$data['js']=$this->load->view('admin/anggota/js');
            $tmp['content']=$this->load->view('admin/penerbit/View_penerbit',$data, TRUE);
            $this->load->view('admin/layout',$tmp);
        }
        else
        /*jika status login NO atau status bukan admin kembalikan ke login*/
        {
            header('location:'.base_url().'web/log');
        }
    }
    public function create()
    {
        $data['log']=$this->db->get_where('tb_petugas',array('id_petugas' => $this->session->userdata('username')))->result();
        $cek = $this->session->userdata('logged_in');
        $stts = $this->session->userdata('stts');
        if(!empty($cek) && $stts=='admin')
        {   
                $this->form_validation->set_rules('penerbit', 'penerbit', 'trim|required');
                $this->form_validation->set_rules('provinsi', 'provinsi', 'trim|required');
                if($this->form_validation->run()==FALSE)
                {
                    $data['title']='Tambah Penerbit';
                    $data['pointer']="Penerbit";
                    $data['classicon']="fa fa-book";
                    $data['main_bread']="Data Penerbit";
                    $data['sub_bread']="Tambah Penerbit";
                    $data['desc']="form untuk Input data Penerbit";

                    /*data yang ditampilkan*/
                    
                    $data['data_penerbit'] = $this->Dokumen_model->getAllData("tb_tahunterbit");
                    //$data['data_agama'] = $this->Buku_model->getAllData("tb_agama");
                    //$data['isi']=$this->Anggota_model->get_all();
                    //$data['js']=$this->load->view('admin/anggota/js');
                    $tmp['content']=$this->load->view('admin/penerbit/Create_penerbit',$data, TRUE);
                    $this->load->view('admin/layout',$tmp);
                }
                else
                {
                    $data = array('id_penerbit' => '',
                                  'nama_penerbit' => $this->input->post('penerbit'),
                                //   'id_provinsi' => $this->input->post('provinsi')
                                );
                    $quer=$this->Buku_model->insertData('tb_penerbit',$data);
                    redirect("admin/Penerbit","refresh");   
                }
        }
        else
        {
            header('location:'.base_url().'web/log');
        }
    }
    
    public function edit()
    { 
        $data['log']=$this->db->get_where('tb_petugas',array('id_petugas' => $this->session->userdata('username')))->result();
        $cek = $this->session->userdata('logged_in');
        $stts = $this->session->userdata('stts');
        if(!empty($cek) && $stts=='admin')
        {       
                $id = $this->input->get('id_tahun',true);    
                $this->form_validation->set_rules('penerbit', 'penerbit', 'trim|required');
                $this->form_validation->set_rules('provinsi', 'provinsi', 'trim|required');
                if($this->form_validation->run()==FALSE)
                {
                    //$data ['err'] = validation_errors();
                    $data['title']='Edit Tahun Terbit';
                    $data['pointer']="Penerbit";
                    $data['classicon']="fa fa-book";
                    $data['main_bread']="Data Tahun Terbit";
                    $data['sub_bread']="Edit Tahun Terbit";
                    $data['desc']="Form untuk melakukan edit data Penerbit Buku";

                    /*data yang ditampilkan*/
                    $data['penerbit'] = $this->Buku_model->get_detail1('tb_penerbit','id_penerbit',$id);
                    // $data['data_provinsi'] = $this->Buku_model->getAllData("tb_provinsi");
                    //$data['data_agama'] = $this->Buku_model->getAllData("tb_agama");
                    $tmp['content']=$this->load->view('admin/tahun/Edit_TahunTerbit',$data,true);
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
                $id = $this->input->post('id_tahunterbit');    
                // $this->form_validation->set_rules('provinsi', 'provinsi', 'trim|required');
                $this->form_validation->set_rules('penerbit', 'penerbit', 'trim|required');
                if($this->form_validation->run()==FALSE)
                {
                    //$data ['err'] = validation_errors();
                    $data['title']='Edit Tahun Terbit';
                    $data['pointer']="Penerbit";
                    $data['classicon']="fa fa-book";
                    $data['main_bread']="Data Tahun Terbit";
                    $data['sub_bread']="Edit Tahun Terbit";
                    $data['desc']="Form untuk melakukan edit Tahun Terbit";

                    /*data yang ditampilkan*/
                    $data['penerbit'] = $this->Dokumen_model->get_detail1('tb_penerbit','id_tahun',$id);
                    // $data['data_provinsi'] = $this->Dokumen_model->getAllData("tb_provinsi");
                    //$data['data_kelas'] = $this->Buku_model->getAllData("tb_kelas");
                    //$data['data_agama'] = $this->Buku_model->getAllData("tb_agama");
                    $tmp['content']=$this->load->view('admin/tahun/Edit_TahunTerbit',$data,true);
                    $this->load->view('admin/layout',$tmp);
                }
                else
                {
                    $id = $this->input->post('id_tahun');    
                    $field='id_tahun';
                    $data = array(
                                  'nama_penerbit' => $this->input->post('tahunpenerbit'),
                                //   'id_provinsi' => $this->input->post('provinsi')
                                );
                    $quer=$this->Buku_model->updateData1('tb_tahunterbit',$data,$field,$id);
                    redirect("admin/Penerbit","refresh");   
                }
        }
        else
        {
            header('location:'.base_url().'web/log');
        }
    }
    public function delete()
        {
            // $data['log']=$this->db->get_where('tb_petugas',array('id_petugas' => $this->session->userdata('username')))->result();
            $field='id_tahun';
            $id = $this->input->get('id_tahunterbit',true);    
            $query = $this->Buku_model->delete('tb_tahunterbit',$field,$id);                   
            if ($query)
                {
                    $this->session->set_flashdata("message","berhasil");
                    redirect("admin/Penerbit","refresh");
                }
            else
                {
                    $this->session->set_flashdata("message","gagal");
                    redirect("admin/Penerbit","refresh");
                }
        }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
                    $data['data_penerbit'] = $this->Buku_model->getAllData("tb_tahunterbit");
                    //$data['data_agama'] = $this->Buku_model->getAllData("tb_agama");
                    //$data['isi']=$this->Anggota_model->get_all();
                    //$data['js']=$this->load->view('admin/anggota/js');
                    $tmp['content']=$this->load->view('admin/tahun/Create_TahunTerbit',$data, TRUE);
                    $this->load->view('admin/layout',$tmp);
                }
                else
                {
                    $data = array('id_penerbit' => '',
                                  'nama_penerbit' => $this->input->post('penerbit'),
                                //   'id_provinsi' => $this->input->post('provinsi')
                                );
                    $quer=$this->Buku_model->insertData('tb_tahunterbit',$data);
                    redirect("admin/TahunTerbit","refresh");   
                }
        }
        else
        {
            header('location:'.base_url().'web/log');
        }
    }
    
    public function edit()
    { 
        $data['log']=$this->db->get_where('tb_petugas',array('id_petugas' => $this->session->userdata('username')))->result();
        $cek = $this->session->userdata('logged_in');
        $stts = $this->session->userdata('stts');
        if(!empty($cek) && $stts=='admin')
        {       
                $id = $this->input->get('id_tahunterbit',true);    
                $this->form_validation->set_rules('penerbit', 'penerbit', 'trim|required');
                $this->form_validation->set_rules('provinsi', 'provinsi', 'trim|required');
                if($this->form_validation->run()==FALSE)
                {
                    //$data ['err'] = validation_errors();
                    $data['title']='Edit Tahun Terbit';
                    $data['pointer']="Penerbit";
                    $data['classicon']="fa fa-book";
                    $data['main_bread']="Data Tahun Terbit";
                    $data['sub_bread']="Edit Tahun Terbit";
                    $data['desc']="Form untuk melakukan edit data Tahun Terbit";

                    /*data yang ditampilkan*/
                    $data['penerbit'] = $this->Buku_model->get_detail1('tb_tahunterbit','id_tahun',$id);
                    $data['data_provinsi'] = $this->Buku_model->getAllData("tb_provinsi");
                    //$data['data_agama'] = $this->Buku_model->getAllData("tb_agama");
                    $tmp['content']=$this->load->view('admin/tahun/Edit_TahunTerbit',$data,true);
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
                $id = $this->input->post('id_tahunterbit');    
                // $this->form_validation->set_rules('provinsi', 'provinsi', 'trim|required');
                $this->form_validation->set_rules('penerbit', 'penerbit', 'trim|required');
                if($this->form_validation->run()==FALSE)
                {
                    //$data ['err'] = validation_errors();
                    $data['title']='Edit Tahun Terbit';
                    $data['pointer']="Penerbit";
                    $data['classicon']="fa fa-book";
                    $data['main_bread']="Data Tahun Terbit";
                    $data['sub_bread']="Edit Tahun Terbit";
                    $data['desc']="Form untuk melakukan edit Penerbit";

                    /*data yang ditampilkan*/
                    $data['penerbit'] = $this->View_model->get_detail1('tb_tahunterbit','id_tahunterbit',$id);
                    $data['data_provinsi'] = $this->View_model->getAllData("tb_provinsi");
                    //$data['data_kelas'] = $this->Buku_model->getAllData("tb_kelas");
                    //$data['data_agama'] = $this->Buku_model->getAllData("tb_agama");
                    $tmp['content']=$this->load->view('admin/penerbit/Edit_penerbit',$data,true);
                    $this->load->view('admin/layout',$tmp);
                }
                else
                {
                    $id = $this->input->post('id_tahunterbit');    
                    $field='id_tahunterbit';
                    $data = array(
                                  'nama_penerbit' => $this->input->post('penerbit'),
                                //   'id_provinsi' => $this->input->post('provinsi')
                                );
                    $quer=$this->Buku_model->updateData1('tb_penerbit',$data,$field,$id);
                    redirect("admin/Penerbit","refresh");   
                }
        }
        else
        {
            header('location:'.base_url().'web/log');
        }
    }
    public function delete()
        {
            // $data['log']=$this->db->get_where('tb_petugas',array('id_petugas' => $this->session->userdata('username')))->result();
            $field='id_tahunterbit';
            $id = $this->input->get('id_tahunterbit',true);    
            $query = $this->Buku_model->delete('tb_penerbit',$field,$id);                   
            if ($query)
                {
                    $this->session->set_flashdata("message","berhasil");
                    redirect("admin/TahunTerbit","refresh");
                }
            else
                {
                    $this->session->set_flashdata("message","gagal");
                    redirect("admin/TahunTerbit","refresh");
                }
        }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logs extends MY_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Log_model');
    }

    //menampilkan daftar log aktivitas
    public function index()
    {
        $data['log']=$this->db->get_where('tb_petugas',array('id_petugas' => $this->session->userdata('username')))->result();
        $cek = $this->session->userdata('logged_in');
        $stts = $this->session->userdata('stts');
        
        /*jika status login Yes dan status admin tampilkan*/
        if(!empty($cek) && $stts=='admin')
        {
            /*layout*/  
            $data['title']='Log Aktivitas Dokumen';
            $data['pointer']="logs";
            $data['classicon']="fa fa-history";
            $data['main_bread']="Data Log";
            $data['sub_bread']="Daftar Log Aktivitas";
            $data['desc']="Data Log Aktivitas, Menampilkan riwayat akses dokumen oleh petugas";

            /*data yang ditampilkan*/
            $data['logs'] = $this->Log_model->get_all_logs();
            
            /*masukan data kedalam view */
            $tmp['content']=$this->load->view('admin/logs/index',$data, TRUE);
            $this->load->view('admin/layout',$tmp);
        }
        else
        /*jika status login NO atau status bukan admin kembalikan ke login*/
        {
            header('location:'.base_url().'web/log');
        }
    }

    //menampilkan log berdasarkan petugas
    public function by_petugas($id_petugas)
    {
        $cek = $this->session->userdata('logged_in');
        $stts = $this->session->userdata('stts');
        
        if(!empty($cek) && $stts=='admin')
        {
            /*layout*/
            $data['title']='Log Aktivitas Per Petugas';
            $data['pointer']="logs";
            $data['classicon']="fa fa-history";
            $data['main_bread']="Data Log";
            $data['sub_bread']="Log Per Petugas";
            $data['desc']="Menampilkan riwayat akses dokumen per petugas";

            /*data yang ditampilkan*/
            $data['logs'] = $this->Log_model->get_logs_by_petugas($id_petugas);
            $data['petugas'] = $this->db->get_where('tb_petugas', array('id_petugas' => $id_petugas))->row();
            
            /*masukan data kedalam view */
            $tmp['content']=$this->load->view('admin/logs/by_petugas',$data, TRUE);
            $this->load->view('admin/layout',$tmp);
        }
        else
        {
            header('location:'.base_url().'web/log');
        }
    }

    //menampilkan log berdasarkan dokumen
    public function by_document($id_dokumen)
    {
        $cek = $this->session->userdata('logged_in');
        $stts = $this->session->userdata('stts');
        
        if(!empty($cek) && $stts=='admin')
        {
            /*layout*/
            $data['title']='Log Aktivitas Per Dokumen';
            $data['pointer']="logs";
            $data['classicon']="fa fa-history";
            $data['main_bread']="Data Log";
            $data['sub_bread']="Log Per Dokumen";
            $data['desc']="Menampilkan riwayat akses per dokumen";

            /*data yang ditampilkan*/
            $data['logs'] = $this->Log_model->get_logs_by_document($id_dokumen);
            $data['dokumen'] = $this->db->get_where('tb_dokumen', array('id_dokumen' => $id_dokumen))->row();
            
            /*masukan data kedalam view */
            $tmp['content']=$this->load->view('admin/logs/by_document',$data, TRUE);
            $this->load->view('admin/layout',$tmp);
        }
        else
        {
            header('location:'.base_url().'web/log');
        }
    }

    public function view_dokumen($id_dokumen){
        $cek = $this->session->userdata('logged_in');
        $stts = $this->session->userdata('stts');

        if (!empty($cek) && $stts == 'admin') {
            /* layout */
            $data['title'] = 'Log Aktivitas Per Dokumen';
            $data['pointer'] = "logs";
            $data['classicon'] = "fa fa-history";
            $data['main_bread'] = "Data Log";
            $data['sub_bread'] = "Log Per Dokumen";
            $data['desc'] = "Menampilkan riwayat akses per dokumen";

            /* data yang ditampilkan */
            $data['logs'] = $this->Log_model->get_logs_by_document($id_dokumen);
            $data['dokumen'] = $this->db->get_where('tb_dokumen', array('id_dokumen' => $id_dokumen))->row();

            /* mencatat log view */
            $this->load->model('Log_model');
            $log_data = array(
                'id_dokumen' => $id_dokumen,
                'id_petugas' => $this->session->userdata('username'),
                'jenis_akses' => 'view'
            );
            $this->load->model('Log_model');
            $this->Log_model->create_log($log_data);

            /* masukan data kedalam view */
            $tmp['content'] = $this->load->view('admin/logs/by_document', $data, TRUE);
            $this->load->view('admin/layout', $tmp);
        } else {
            redirect('web/log');
        }
    }

    public function download_dokumen($id_dokumen){
        $cek = $this->session->userdata('logged_in');
        $stts = $this->session->userdata('stts');

        if (!empty($cek) && $stts == 'admin') {
            $data['title'] = 'Log Aktivitas Per Dokumen';
            $data['pointer'] = "logs";
            $data['classicon'] = "fa fa-history";
            $data['main_bread'] = "Data Log";
            $data['sub_bread'] = "Log Per Dokumen";
            $data['desc'] = "Menampilkan riwayat akses per dokumen";

            /* data yang ditampilkan */
            $data['logs'] = $this->Log_model->get_logs_by_document($id_dokumen);
            $data['dokumen'] = $this->db->get_where('tb_dokumen', array('id_dokumen' => $id_dokumen))->row();

            /* mencatat log download */
            $this->load->model('Log_model');
            $log_data = array(
                'id_dokumen' => $id_dokumen,
                'id_petugas' => $this->session->userdata('username'),
                'jenis_akses' => 'download'
            );
            $this->load->model('Log_model');
            $this->Log_model->create_log($log_data);

            /* proses download dokumen */
            $dokumen = $this->db->get_where('tb_dokumen', ['id_dokumen' => $id_dokumen])->row();
            if ($dokumen) {
                $filepath = './uploads/' . $dokumen->file_dokumen;
                if (file_exists($filepath)) {
                    header('Content-Description: File Transfer');
                    header('Content-Type: application/octet-stream');
                    header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
                    header('Expires: 0');
                    header('Cache-Control: must-revalidate');
                    header('Pragma: public');
                    header('Content-Length: ' . filesize($filepath));
                    readfile($filepath);
                    exit;
                } else {
                    show_404();
                }
            } else {
                show_404();
            }
        } else {
            redirect('web/log');
        }
    }

    //method untuk mencatat log (dipanggil dari controller lain)
    public function create_log($id_dokumen)
    {
        $data = array(
            'id_dokumen' => $id_dokumen,
            'id_petugas' => $this->session->userdata('username'),
            'diakses' => date('Y-m-d H:i:s')
        );
        
        $this->Log_model->create_log($data);
    }
}
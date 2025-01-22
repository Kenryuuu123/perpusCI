<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function create_log($data) {
        date_default_timezone_set('Asia/Jakarta');
        $log_data = array(
            'id_dokumen' => $data['id_dokumen'],
            'id_petugas' => $data['id_petugas'],
            'diakses' => date('Y-m-d H:i:s'),
            'jenis_akses' => $data['jenis_akses']
        );
        $this->db->insert('tb_log', $log_data);
        return $this->db->insert_id();
    }

    public function cleanup_log($max_log = 1000){
        $this->db->from('tb_log');
        $total_logs = $this->db->count_all_result();

        if($total_logs > $max_log){
            $this->db->order_by('diakses','ASC');
            $this->db->limit($total_logs - $max_log);
            $this->db->delete('tb_log');
        }
    }
    
    public function get_all_logs($limit = 1000, $offset = 0) {
        $this->db->select('tb_log.id_log, tb_log.diakses, tb_petugas.nama, tb_dokumen.juduldok, tb_dokumen.no_dok, tb_log.jenis_akses');
        $this->db->from('tb_log');
        $this->db->join('tb_petugas', 'tb_petugas.id_petugas = tb_log.id_petugas');
        $this->db->join('tb_dokumen', 'tb_dokumen.id_dokumen = tb_log.id_dokumen');
        $this->db->order_by('tb_log.diakses', 'DESC');
        return $this->db->get()->result();
    }
    
    public function get_logs_by_petugas($id_petugas) {
        $this->db->select('tb_log.*, tb_dokumen.juduldok, tb_dokumen.no_dok');
        $this->db->from('tb_log');
        $this->db->join('tb_dokumen', 'tb_dokumen.id_dokumen = tb_log.id_dokumen');
        $this->db->where('tb_log.id_petugas', $id_petugas);
        $this->db->order_by('tb_log.diakses', 'ASC');
        return $this->db->get()->result();
    }
    
    public function get_logs_by_document($id_dokumen) {
        $this->db->select('tb_log.*, tb_petugas.nama as nama');
        $this->db->from('tb_log');
        $this->db->join('tb_petugas', 'tb_petugas.id_petugas = tb_log.id_petugas');
        $this->db->where('tb_log.id_dokumen', $id_dokumen);
        $this->db->order_by('tb_log.diakses', 'ASC');
        return $this->db->get()->result();
    }
    
    public function count_all_logs() {
        return $this->db->count_all('tb_log');
    }
}

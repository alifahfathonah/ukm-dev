<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Notif_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->CI = get_instance();
    }

    function insert($data) {
        $this->db->insert('notifikasi', $data);
    }

    function delete($id) {
        $this->db->where('notifikasi_id', $id);
        $this->db->delete('notifikasi');
    }

    function deleteall() {
        $this->db->empty_table('notifikasi');   
    }

    function updateall($parameter,$data) {
        $this->db->where($parameter);
        $this->db->update('notifikasi', $data);
    }

    function selectone($id) {
        $this->db->select('*');
        $this->db->from('notifikasi');
        $this->db->where('notifikasi_id', $id);
        $query = $this->db->get();
        return $query;
    }

    function update($id, $data) {
        $this->db->where('notifikasi_id', $id);
        $this->db->update('notifikasi', $data);
    }

    function get_total($parameter) {
        if(!empty($parameter)){
            $this->db->select('count(*) AS Total');
            $this->db->from('notifikasi');
            $this->db->where($parameter);
            $query = $this->db->get();
            return (count($query->row_array()) > 0 ? $query->row()->Total : 0);
        }else{
            $this->db->select('count(*) AS Total');
            $this->db->from('notifikasi');
            $query = $this->db->get();
            return (count($query->row_array()) > 0 ? $query->row()->Total : 0);
        }
    }

    function get_daftartipe($parameter) {
        $this->db->select('*');
        $this->db->from('tipenotif');
        $this->db->where($parameter);
        $query = $this->db->get();
        return (count($query->num_rows()) > 0 ? $query->result() : NULL);
    }

    function get_notif($parameter,$limit = 0) {
        $this->db->select('notifikasi.*, tipenotif.tipe_nama AS tipe_nama, tipenotif.tipe_teks AS teks, ukm.ukm_name AS ukm_name, user.user_name AS user_name');
        $this->db->from('notifikasi');
        $this->db->join('tipenotif', 'notifikasi.notif_tipe = tipenotif.tipe_id');
        $this->db->join('ukm', 'notifikasi.ukm_id = ukm.ukm_id');
        $this->db->join('user', 'notifikasi.user_id = user.user_id');
        $this->db->where($parameter);
        $this->db->limit($limit);
        $this->db->order_by("notif_time","desc");
        $query = $this->db->get();
        return (count($query->num_rows()) > 0 ? $query->result() : NULL);
    }

    function get_count($tanggal = null) {
        if($tanggal == null) {
            $this->db->select('count(*) as Total');
            $this->db->from('notifikasi');
            $query = $this->db->get();
            return $query;
        } else {
            $this->db->select('count(*) as Total');
            $this->db->from('notifikasi');
            $this->db->where('notifikasi_time', $tanggal);
            $query = $this->db->get();
            return $query;
        }
    }

}

?>

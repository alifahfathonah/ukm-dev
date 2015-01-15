<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ukm_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_total($parameter) {
        if(!empty($parameter)){
            $this->db->select('count(*) AS Total');
            $this->db->from('ukm');
            $this->db->where($parameter);
            $query = $this->db->get();
            return (count($query->row_array()) > 0 ? $query->row()->Total : 0);
        }else{
            $this->db->select('count(*) AS Total');
            $this->db->from('ukm');
            $query = $this->db->get();
            return (count($query->row_array()) > 0 ? $query->row()->Total : 0);
        }
    }

    function insert($data) {
        $this->db->insert('ukm', $data);
    }

    function delete($id) {
        $this->db->where('ukm_id', $id);
        $this->db->delete('ukm');
    }

    function update($id, $data) {
        $this->db->where('ukm_id', $id);
        $this->db->update('ukm', $data);
    }
    
    function cek($parameter) {
        $this->db->select('*');
        $this->db->from('ukm');
        $this->db->where($parameter);
        $query = $this->db->get();
        return $query;
    }

    function get_ukm($parameter) {
        $this->db->select('*');
        $this->db->from('ukm');
        $this->db->where($parameter);
        $query = $this->db->get();
        return (count($query->num_rows()) > 0 ? $query : NULL);
    }

    function get_daftarukm($start, $rows, $search) {

        $sql = "SELECT
            `ukm`.`ukm_id` AS ID,
            `ukm`.`ukm_name` AS Nama,
            `ukm`.`user_id` AS User,
            `ukm`.`ukm_contact` AS Kontak,
            `ukm`.`ukm_created` AS Dibuat,
            `ukm`.`ukm_info` AS Info,
            REPLACE(REPLACE(`ukm`.`ukm_status`,'0','Nonaktif'),'1','Aktif') AS Status
        FROM `ukm`
        WHERE `ukm`.`ukm_id` != '0'
                AND (`ukm`.`ukm_id` LIKE '%".$search."%'
                OR `ukm`.`ukm_name` LIKE '%".$search."%'
                OR `ukm`.`ukm_contact` LIKE '%".$search."%'
                OR REPLACE(REPLACE(`ukm`.`ukm_status`,'0','Nonaktif'),'1','Aktif') LIKE '%".$search."%'
                OR `ukm`.`ukm_created` LIKE '%".$search."%'
                OR `ukm`.`ukm_info` LIKE '%".$search."%')
        ORDER BY `ukm`.`ukm_id` LIMIT ".$start.",".$rows."";

        return $this->db->query($sql);
    }

    function get_count_daftarukm($search) {

        $sql = "SELECT
            COUNT(*) AS Total
        FROM `ukm`
        WHERE `ukm`.`ukm_id` != '0'
                AND (`ukm`.`ukm_id` LIKE '%".$search."%'
                OR `ukm`.`ukm_name` LIKE '%".$search."%'
                OR `ukm`.`ukm_contact` LIKE '%".$search."%'
                OR REPLACE(REPLACE(`ukm`.`ukm_status`,'0','Nonaktif'),'1','Aktif') LIKE '%".$search."%'
                OR `ukm`.`ukm_created` LIKE '%".$search."%')";

        return $this->db->query($sql);
    }

}

?>

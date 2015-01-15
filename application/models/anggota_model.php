<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Anggota_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_total($parameter) {
        if(!empty($parameter)){
            $this->db->select('count(*) AS Total');
            $this->db->from('anggota');
            $this->db->where($parameter);
            $query = $this->db->get();
            return (count($query->row_array()) > 0 ? $query->row()->Total : 0);
        }else{
            $this->db->select('count(*) AS Total');
            $this->db->from('anggota');
            $query = $this->db->get();
            return (count($query->row_array()) > 0 ? $query->row()->Total : 0);
        }
    }

    function insert($data) {
        $this->db->insert('anggota', $data);
    }

    function delete($id) {
        $this->db->where('anggota_id', $id);
        $this->db->delete('anggota');
    }

    function update($id, $data) {
        $this->db->where('anggota_id', $id);
        $this->db->update('anggota', $data);
    }

    function get_anggota($id = 0) {
        if($id == 0) {
            $this->db->select('*');
            $this->db->from('anggota');
            $query = $this->db->get();
            return $query;
        } else {
            $this->db->select('*');
            $this->db->from('anggota');
            $this->db->where('anggota_id',$id);
            $query = $this->db->get();
            return $query->row();
        }

    }

    function get_daftaranggota($start, $rows, $search) {

        $sql = "SELECT
            `anggota`.`anggota_id` AS ID,
            `anggota`.`ukm_id` AS UKMid,
            `ukm`.`ukm_name` AS UKM,
            `anggota`.`anggota_name` AS Nama,
            `anggota`.`anggota_status` AS StatusID,
            `anggota`.`anggota_level` AS LevelID,
            REPLACE(REPLACE(REPLACE(`anggota`.`anggota_level`,'10','Anggota'),'11','Pengurus'),'12','Ketua') AS Level,
            REPLACE(REPLACE(`anggota`.`anggota_status`,'0','Nonaktif'),'1','Aktif') AS Status
        FROM `anggota`
        INNER JOIN `ukm` ON (`anggota`.`ukm_id` = `ukm`.`ukm_id`)
        WHERE `anggota`.`anggota_id` LIKE '%".$search."%'
                OR `anggota`.`anggota_name` LIKE '%".$search."%'
                OR REPLACE(REPLACE(`anggota`.`anggota_status`,'0','Nonaktif'),'1','Aktif') LIKE '%".$search."%'
                OR REPLACE(REPLACE(REPLACE(`anggota`.`anggota_level`,'10','Anggota'),'11','Pengurus'),'12','Ketua') LIKE '%".$search."%'
        ORDER BY `anggota`.`anggota_id` LIMIT ".$start.",".$rows."";

        return $this->db->query($sql);
    }

    function get_count_daftaranggota($search) {

        $sql = "SELECT
            COUNT(*) AS Total
        FROM `anggota`
        INNER JOIN `ukm` ON (`anggota`.`ukm_id` = `ukm`.`ukm_id`)
        WHERE `anggota`.`anggota_id` LIKE '%".$search."%'
                OR `anggota`.`anggota_name` LIKE '%".$search."%'
                OR REPLACE(REPLACE(`anggota`.`anggota_status`,'0','Nonaktif'),'1','Aktif') LIKE '%".$search."%'
                OR REPLACE(REPLACE(REPLACE(`anggota`.`anggota_level`,'10','Anggota'),'11','Pengurus'),'12','Ketua') LIKE '%".$search."%'";

        return $this->db->query($sql);
    }

}

?>

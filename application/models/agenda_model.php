<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Agenda_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_total($parameter) {
        if(!empty($parameter)){
            $this->db->select('count(*) AS Total');
            $this->db->from('agenda');
            $this->db->where($parameter);
            $query = $this->db->get();
            return (count($query->row_array()) > 0 ? $query->row()->Total : 0);
        }else{
            $this->db->select('count(*) AS Total');
            $this->db->from('agenda');
            $query = $this->db->get();
            return (count($query->row_array()) > 0 ? $query->row()->Total : 0);
        }
    }

    function insert($data) {
        $this->db->insert('agenda', $data);
    }

    function delete($id) {
        $this->db->where('agenda_id', $id);
        $this->db->delete('agenda');
    }

    function update($id, $data) {
        $this->db->where('agenda_id', $id);
        $this->db->update('agenda', $data);
    }

    function get_agenda($parameter,$limit = 0) {
        $this->db->select('agenda.*, tipenotif.tipe_nama AS tipe_nama, tipenotif.tipe_teks AS teks');
        $this->db->from('agenda');
        $this->db->join('tipenotif', 'agenda.agenda_status = tipenotif.tipe_id');
        $this->db->where($parameter);
        $this->db->limit($limit);
        $query = $this->db->get();
        return (count($query->num_rows()) > 0 ? $query->result() : NULL);
    }

    function get_daftaragenda($ukm, $start, $rows, $search) {

        $sql = "SELECT
            `agenda`.`agenda_id` AS ID,
            `agenda`.`ukm_id` AS UKMid,
            `ukm`.`ukm_name` AS UKM,
            `agenda`.`agenda_title` AS Title,
            `agenda`.`agenda_text` AS Teks,
            `agenda`.`agenda_time` AS Time,
            `agenda`.`agenda_timeto` AS Timeto,
            `agenda`.`agenda_status` AS StatusID,
            REPLACE(REPLACE(REPLACE(REPLACE(`agenda`.`agenda_status`,'0','Draft'),'1','Publish'),'2','Hapus'),'3','Selesai') AS Status
        FROM `agenda`
        INNER JOIN `ukm` ON (`agenda`.`ukm_id` = `ukm`.`ukm_id`)
        WHERE `agenda`.`ukm_id` = ". $ukm ." AND (`agenda`.`agenda_id` LIKE '%".$search."%'
                OR `agenda`.`agenda_title` LIKE '%".$search."%'
                OR `agenda`.`agenda_text` LIKE '%".$search."%'
                OR REPLACE(REPLACE(REPLACE(REPLACE(`agenda`.`agenda_status`,'0','Draft'),'1','Publish'),'2','Hapus'),'3','Selesai') LIKE '%".$search."%'
                OR `agenda`.`agenda_time` LIKE '%".$search."%'
                OR `agenda`.`agenda_timeto` LIKE '%".$search."%')
        ORDER BY `agenda`.`agenda_id` LIMIT ".$start.",".$rows."";

        return $this->db->query($sql);
    }

    function get_count_daftaragenda($ukm, $search) {

        $sql = "SELECT
            COUNT(*) AS Total
        FROM `agenda`
        WHERE `agenda`.`ukm_id` = ". $ukm ." AND (`agenda`.`agenda_id` LIKE '%".$search."%'
                OR `agenda`.`agenda_title` LIKE '%".$search."%'
                OR `agenda`.`agenda_text` LIKE '%".$search."%'
                OR REPLACE(REPLACE(REPLACE(REPLACE(`agenda`.`agenda_status`,'0','Draft'),'1','Publish'),'2','Hapus'),'3','Selesai') LIKE '%".$search."%'
                OR `agenda`.`agenda_time` LIKE '%".$search."%'
                OR `agenda`.`agenda_timeto` LIKE '%".$search."%')";

        return $this->db->query($sql);
    }

}

?>

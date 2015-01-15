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

    function get_daftaragenda($start, $rows, $search) {

        $sql = "SELECT
            `agenda`.`agenda_id` AS ID,
            `agenda`.`agenda_name` AS Username,
            `agenda`.`agenda_mail` AS Mail,
            `agenda`.`agenda_created` AS Dibuat,
            `role`.`role_name` AS Role,
            REPLACE(REPLACE(`agenda`.`agenda_status`,'0','OFF'),'1','ON') AS Status
        FROM `agenda`
        INNER JOIN `role` ON (`agenda`.`agenda_role` = `role`.`role_id`)
        WHERE `agenda`.`agenda_id` LIKE '%".$search."%'
                OR `agenda`.`agenda_name` LIKE '%".$search."%'
                OR `agenda`.`agenda_data` LIKE '%".$search."%'
                OR REPLACE(REPLACE(`agenda`.`agenda_status`,'0','OFF'),'1','ON') LIKE '%".$search."%'
                OR `agenda`.`agenda_created` LIKE '%".$search."%'
                OR `role`.`role_name` LIKE '%".$search."%'
        ORDER BY `agenda`.`agenda_id` LIMIT ".$start.",".$rows."";

        return $this->db->query($sql);
    }

    function get_count_daftaragenda($search) {

        $sql = "SELECT
            COUNT(*) AS Total
        FROM `agenda`
        INNER JOIN `role` ON (`agenda`.`agenda_role` = `role`.`role_id`)
        WHERE `agenda`.`agenda_id` LIKE '%".$search."%'
                OR `agenda`.`agenda_name` LIKE '%".$search."%'
                OR `agenda`.`agenda_mail` LIKE '%".$search."%'
                OR REPLACE(REPLACE(`agenda`.`agenda_status`,'0','OFF'),'1','ON') LIKE '%".$search."%'
                OR `agenda`.`agenda_created` LIKE '%".$search."%'
                OR `role`.`role_name` LIKE '%".$search."%'";

        return $this->db->query($sql);
    }

}

?>

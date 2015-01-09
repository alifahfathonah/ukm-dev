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
            $this->db->select('anggota.*, role.role_name AS rolename');
            $this->db->from('anggota');
            $this->db->join('role', 'anggota.anggota_role = role.role_id');
            $query = $this->db->get();
            return $query;
        } else {
            $this->db->select('anggota.*, role.role_name AS rolename');
            $this->db->from('anggota');
            $this->db->join('role', 'anggota.anggota_role = role.role_id');
            $this->db->where('anggota_id',$id);
            $query = $this->db->get();
            return $query->row();
        }

    }

    function get_daftaranggota($start, $rows, $search) {

        $sql = "SELECT
            `anggota`.`anggota_id` AS ID,
            `anggota`.`anggota_name` AS Username,
            `anggota`.`anggota_mail` AS Mail,
            `anggota`.`anggota_created` AS Dibuat,
            `role`.`role_name` AS Role,
            REPLACE(REPLACE(`anggota`.`anggota_status`,'0','OFF'),'1','ON') AS Status
        FROM `anggota`
        INNER JOIN `role` ON (`anggota`.`anggota_role` = `role`.`role_id`)
        WHERE `anggota`.`anggota_id` LIKE '%".$search."%'
                OR `anggota`.`anggota_name` LIKE '%".$search."%'
                OR `anggota`.`anggota_data` LIKE '%".$search."%'
                OR REPLACE(REPLACE(`anggota`.`anggota_status`,'0','OFF'),'1','ON') LIKE '%".$search."%'
                OR `anggota`.`anggota_created` LIKE '%".$search."%'
                OR `role`.`role_name` LIKE '%".$search."%'
        ORDER BY `anggota`.`anggota_id` LIMIT ".$start.",".$rows."";

        return $this->db->query($sql);
    }

    function get_count_daftaranggota($search) {

        $sql = "SELECT
            COUNT(*) AS Total
        FROM `anggota`
        INNER JOIN `role` ON (`anggota`.`anggota_role` = `role`.`role_id`)
        WHERE `anggota`.`anggota_id` LIKE '%".$search."%'
                OR `anggota`.`anggota_name` LIKE '%".$search."%'
                OR `anggota`.`anggota_mail` LIKE '%".$search."%'
                OR REPLACE(REPLACE(`anggota`.`anggota_status`,'0','OFF'),'1','ON') LIKE '%".$search."%'
                OR `anggota`.`anggota_created` LIKE '%".$search."%'
                OR `role`.`role_name` LIKE '%".$search."%'";

        return $this->db->query($sql);
    }

}

?>

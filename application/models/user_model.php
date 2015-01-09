<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_login_info($username) {
        $query = $this->db->query('SELECT
            user.user_id, user.user_name, user.user_pass, user.user_role, user.user_mail, user.ukm_id, role.role_name AS rolename
            FROM user
            INNER JOIN role ON (user.user_role = role.role_id)
            WHERE user.user_name = "' . $username . '"
            LIMIT 1');

        return ($query->num_rows() > 0) ? $query->row() : FALSE;
    }

    function get_menu($role) {
    		$sql = 'SELECT user_menu.* FROM user_akses INNER JOIN user_menu
    				ON (user_akses.akses_menu = user_menu.akses_menu) WHERE
    				user_akses.role_id="'.$role.'" AND user_menu.menu_tipe="0"
    				ORDER BY user_menu.menu_urutan';
    		$result = $this->db->query($sql);

    		$menu = '';
    		$menu_child = '';

    		if($result->num_rows()>0){
    			foreach ($result->result() as $parent){
    				$li_parent='';

    				$sql = 'SELECT user_menu.* FROM user_akses INNER JOIN user_menu
    						ON (user_akses.akses_menu = user_menu.akses_menu) WHERE
    						user_akses.role_id="'.$role.'" AND user_menu.menu_tipe="1" AND user_menu.menu_parent="'.$parent->akses_menu.' "
    						ORDER BY user_menu.menu_urutan';

                    $result_child=$this->db->query($sql);
    				if($result_child->num_rows()>0){
    				    $li_parent='class="treeview"';
    					$menu_child='<ul class="treeview-menu">';
    					foreach ($result_child->result() as $child){
    						$menu_child = $menu_child.'<li><a href="'.site_url()."dashboard".$child->menu_url.'"><i class="'.$child->menu_icon.'"></i> '.$child->menu_nama.'</a></li>';
    					}
    					$menu_child = $menu_child.'</ul>';
    				}

    				$menu = $menu.'
                                <li '.$li_parent.' id="li-'.$parent->akses_menu.'">
                                    <a href="'.site_url()."dashboard".$parent->menu_url.'">
                                        <i class="'.$parent->menu_icon.'"></i> <span>'.$parent->menu_nama.'</span>
                                        '.$menu_child.'
                                    </a>
                                </li>';
    			}
    		}

    		return $menu;
    }

    function get_total($parameter) {
        if(!empty($parameter)){
            $this->db->select('count(*) AS Total');
            $this->db->from('user');
            $this->db->where($parameter);
            $query = $this->db->get();
            return (count($query->row_array()) > 0 ? $query->row()->Total : 0);
        }else{
            $this->db->select('count(*) AS Total');
            $this->db->from('user');
            $query = $this->db->get();
            return (count($query->row_array()) > 0 ? $query->row()->Total : 0);
        }
    }

    function get_role() {
        $this->db->select('*');
        $this->db->from('role');
        $query = $this->db->get();
        return (count($query->num_rows()) > 0 ? $query->result() : NULL);
    }

    function cek($parameter) {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where($parameter);
        $query = $this->db->get();
        return $query;
    }

    function insert($data) {
        $this->db->insert('user', $data);
    }

    function delete($id) {
        $this->db->where('user_id', $id);
        $this->db->delete('user');
    }

    function reset($data) {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where($data);
        $query = $this->db->get();
        return (count($query->row_array()) > 0 ? $query : NULL);;
    }

    function update($id, $data) {
        $this->db->where('user_id', $id);
        $this->db->update('user', $data);
    }
    
    function get_user($parameter) {
        $this->db->select('user.*, role.role_name AS Role');
        $this->db->from('user');
        $this->db->join('role', 'user.user_role = role.role_id');
        $this->db->where($parameter);
        $query = $this->db->get();
        return (count($query->num_rows()) > 0 ? $query->result() : NULL);
    }

    function get_daftaruser($start, $rows, $search) {

        $sql = "SELECT
            `user`.`user_id` AS ID,
            `user`.`user_name` AS Username,
            `ukm`.`ukm_name` AS UKM,
            `user`.`user_created` AS Dibuat,
            `user`.`user_mail` AS Mail,
            `role`.`role_name` AS Role,
            REPLACE(REPLACE(`user`.`user_status`,'0','Nonaktif'),'1','Aktif') AS Status
        FROM `user`
        INNER JOIN `role` ON (`user`.`user_role` = `role`.`role_id`)
        INNER JOIN `ukm` ON (`user`.`ukm_id` = `ukm`.`ukm_id`)
        WHERE `user`.`user_id` LIKE '%".$search."%'
                OR `user`.`user_name` LIKE '%".$search."%'
                OR `ukm`.`ukm_name` LIKE '%".$search."%'
                OR REPLACE(REPLACE(`user`.`user_status`,'0','Nonaktif'),'1','Aktif') LIKE '%".$search."%'
                OR `user`.`user_created` LIKE '%".$search."%'
                OR `user`.`user_mail` LIKE '%".$search."%'
                OR `role`.`role_name` LIKE '%".$search."%'
        ORDER BY `user`.`user_created` DESC LIMIT ".$start.",".$rows."";

        return $this->db->query($sql);
    }

    function get_count_daftaruser($search) {

        $sql = "SELECT
            COUNT(*) AS Total
        FROM `user`
        INNER JOIN `role` ON (`user`.`user_role` = `role`.`role_id`)
        INNER JOIN `ukm` ON (`user`.`ukm_id` = `ukm`.`ukm_id`)
        WHERE `user`.`user_id` LIKE '%".$search."%'
                OR `user`.`user_name` LIKE '%".$search."%'
                OR `ukm`.`ukm_name` LIKE '%".$search."%'
                OR REPLACE(REPLACE(`user`.`user_status`,'0','Nonaktif'),'1','Aktif') LIKE '%".$search."%'
                OR `user`.`user_created` LIKE '%".$search."%'
                OR `user`.`user_mail` LIKE '%".$search."%'
                OR `role`.`role_name` LIKE '%".$search."%'";

        return $this->db->query($sql);
    }

}

?>

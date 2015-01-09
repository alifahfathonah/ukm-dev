<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Access {

    public $user;

    function __construct() {
        $this->CI = & get_instance();

        $this->CI->load->helper('cookie');
        //$this->CI->load->model('user_model');
        //$this->CI->load->model('model_notif');

        $this->user_model = & $this->CI->user_model;
        $this->log_model = & $this->CI->log_model;
    }

    /**
     * proses login
     * 0 = username tak ada
     * 1 = sukses
     * 2 = password salah
     * @param unknown_type $username
     * @param unknown_type $password
     * @return boolean
     */
    function login($username, $password) {
        $result = $this->user_model->get_login_info($username);
        if ($result) {
            $password = sha1($password);
            if ($password == $result->user_pass) {
                    $this->CI->session->set_userdata('ukm_user_id', $result->user_id);
                    $this->CI->session->set_userdata('ukm_username', $result->user_name);
                    $this->CI->session->set_userdata('ukm_role', $result->rolename);
                    $this->CI->session->set_userdata('ukm_usermail', $result->user_mail);
                    $this->CI->session->set_userdata('ukm_role_id', $result->user_role);
                    $this->CI->session->set_userdata('ukm_ukmid', $result->ukm_id);

                    $data = array(
                        'user_status' => "1",
                    );
                    $datalog = array(
                        'log_text' => "User " . $result->user_name . " login di SIM UKM",
                        'user_id' => $result->user_id
                    );
                    $this->user_model->update($result->user_id, $data);
                    $this->log_model->insert($datalog);

                    return 1;
            } else {
                return 2;
            }
        }
        return 0;
    }

    /**
     * cek apakah sudah login
     * @return boolean
     */
    function is_login() {
        return (($this->CI->session->userdata('ukm_user_id')) ? TRUE : FALSE);
    }

    function cek_akses($kode_menu) {
        $role_cookie = $this->CI->session->userdata('ukm_role_id');
        if ($this->user_model->get_akses($kode_menu, $role_cookie) > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function cek_akses_level($kode_menu, $role) {
        if ($this->user_model->get_akses($kode_menu, $role) > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function get_username() {
        return $this->CI->session->userdata('ukm_username');
    }

    function get_usermail() {
        return $this->CI->session->userdata('ukm_usermail');
    }

    function get_role() {
        return $this->CI->session->userdata('ukm_role');
    }

    function get_roleid() {
        return $this->CI->session->userdata('ukm_role_id');
    }

    function get_userid() {
        return $this->CI->session->userdata('ukm_user_id');
    }

    function get_ukmid() {
        return $this->CI->session->userdata('ukm_ukmid');
    }

    /**
     * logout
     */
    function logout() {
        $datalog = array(
            'log_text' => "User " . $this->get_username() . " logout di SIM UKM",
            'user_id' => $this->get_userid()
        );
        $this->user_model->update($this->get_userid(), array('user_status' => "0"));
        $this->log_model->insert($datalog);
        
        $this->CI->session->unset_userdata('ukm_user_id');
        $this->CI->session->unset_userdata('ukm_username');
        $this->CI->session->unset_userdata('ukm_role');
        $this->CI->session->unset_userdata('ukm_usermail');
        $this->CI->session->unset_userdata('ukm_role_id');
        $this->CI->session->unset_userdata('ukm_urlke');
        $this->CI->session->unset_userdata('ukm_pesan');
        $this->CI->session->unset_userdata('ukm_ukmid');
    }

}

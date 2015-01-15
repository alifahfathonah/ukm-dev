<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model', '', true);
        $this->load->model('log_model', '', true);
        $this->load->model('ukm_model', '', true);
        $this->load->model('data_model', '', true);
        $this->load->model('notif_model', '', true);
        $this->load->model('anggota_model', '', true);
        $this->load->model('agenda_model', '', true);
    }

    public function index() {
        $datah['title'] = 'Dashboard';
        $datah['menu'] = $this->user_model->get_menu($this->access->get_roleid());

        // memberikan salam ke user yg login
        $datestring = "%H:%i:%s";
        $tglstring = "%d-%m-%Y";
        $waktu = '';
        $jam = mdate($datestring, now());
        $tanggal = mdate($tglstring, now());
        if ($jam < 4) {
            $waktu = "Dini Hari ";
        } else if ($jam < 11) {
            $waktu = "Pagi ";
        } else if ($jam < 15) {
            $waktu = "Siang ";
        } else if ($jam < 18) {
            $waktu = "Sore ";
        } else if ($jam < 24) {
            $waktu = "Malam ";
        }

        $id = "";
        if($this->access->get_ukmid() == 0) {
          $id = $this->access->get_userid();
        } else {
          $id = $this->access->get_ukmid();
          $data['dataagenda'] = $this->agenda_model->get_agenda(array("ukm_id" => $id),5);
        }
        $data['welcome_message'] = "Selamat " . $waktu . ucfirst($this->access->get_username()) . ". Hari ini tanggal " . $tanggal;
        $data['datanotif'] = $this->notif_model->get_notif(array("notif_to" => $id, "notif_read !=" => 2),5);

        // generate view
        $this->load->view('header_view',$datah);
        $this->load->view('dashboard_view',$data);
    }

    public function logout() {
        $this->access->logout();
        redirect('login');
    }

    public function notifikasi() {
        $datah['title'] = 'Notifikasi';
        $datah['menu'] = $this->user_model->get_menu($this->access->get_roleid());

        $id = "";
        if($this->access->get_ukmid() == 0) { $id = $this->access->get_userid();
        } else { $id = $this->access->get_ukmid(); }

        $data['datanotif'] = $this->notif_model->get_notif(array("notif_to" => $id, "notif_read !=" => 2));

        // generate view
        $this->load->view('header_view',$datah);
        $this->load->view('notifikasi_view',$data);
    }

    public function reminder() {
        $datah['title'] = 'Reminder';
        $datah['menu'] = $this->user_model->get_menu($this->access->get_roleid());

        $id = "";
        if($this->access->get_ukmid() == 0) { $id = $this->access->get_userid();
        } else { $id = $this->access->get_ukmid(); }

        $data['datanotif'] = $this->notif_model->get_notif(array("notif_from" => $id));
        $data['dataukm'] = $this->ukm_model->get_ukm(array())->result();
        $data['datatiperem'] = $this->notif_model->get_daftartipe(array());

        // generate view
        $this->load->view('header_view',$datah);
        $this->load->view('reminder_view',$data);
    }

    public function laporan() {
        $datah['title'] = 'Laporan';
        $datah['menu'] = $this->user_model->get_menu($this->access->get_roleid());

        // generate view
        $this->load->view('header_view',$datah);
        $this->load->view('laporan_view');
    }

    public function log() {
        $datah['title'] = 'Log';
        $datah['menu'] = $this->user_model->get_menu($this->access->get_roleid());
        $data['datalog'] =  $this->log_model->get_log(array());

        // generate view
        $this->load->view('header_view',$datah);
        $this->load->view('log_view',$data);
    }

    public function user() {
        $datah['title'] = 'User';
        $datah['menu'] = $this->user_model->get_menu($this->access->get_roleid());
        $data['datarole'] = $this->user_model->get_role();
        $data['dataukm'] = $this->ukm_model->get_ukm(array())->result();

        // generate view
        $this->load->view('header_view',$datah);
        $this->load->view('user_view',$data);
    }
    
    public function ukm() {
        $datah['title'] = 'UKM';
        $datah['menu'] = $this->user_model->get_menu($this->access->get_roleid());
        $data['datauser'] = $this->user_model->get_user(array("user_role" => "42"));

        // generate view
        $this->load->view('header_view',$datah);
        $this->load->view('ukm_view',$data);
    }

    public function anggota() {
        $datah['title'] = 'Anggota';
        $datah['menu'] = $this->user_model->get_menu($this->access->get_roleid());
        //$data['datauser'] = $this->user_model->get_user(array("user_role" => "42"));

        // generate view
        $this->load->view('header_view',$datah);
        $this->load->view('anggota_view');
    }

    public function agenda() {
        $datah['title'] = 'Agenda';
        $datah['menu'] = $this->user_model->get_menu($this->access->get_roleid());

        // generate view
        $this->load->view('header_view',$datah);
        $this->load->view('agenda_view');
    }

    public function profil() {
        $datah['title'] = 'Profil';
        $datah['menu'] = $this->user_model->get_menu($this->access->get_roleid());

        // generate view
        $this->load->view('header_view',$datah);
        $this->load->view('profil_view');
    }

    public function get_databox() {
        $id = "";
        if($this->access->get_ukmid() == 0) {
          $id = $this->access->get_userid();
          $data['boxlaporan'] = $this->data_model->get_total(array());
        } else {
          $id = $this->access->get_ukmid();
          $data['boxlaporan'] = $this->data_model->get_total(array("ukm_id" => $id));
        }

        // data buat box
        $data['boxukm'] = $this->ukm_model->get_total(array("ukm_status" => "1"));
        $data['boxuser'] = $this->user_model->get_total(array());
        $data['boxlog'] = $this->log_model->get_total(array());
        $data['boxnotif'] = $this->notif_model->get_total(array("notif_to" => $id, "notif_read !=" => 2));
        $data['boxanggota'] = $this->anggota_model->get_total(array("ukm_id" => $id));
        $data['boxagenda'] = $this->agenda_model->get_total(array("ukm_id" => $id));
        $data['boxrem'] = $this->notif_model->get_total(array("notif_from" => $id));

        echo json_encode($data);
    }

}

?>

<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Reminder extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model', '', true);
        $this->load->model('log_model', '', true);
        $this->load->model('notif_model', '', true);
    }

    public function index() {
        $datah['title']='User';
        $datah['menu_user'] = TRUE;

        // generate view
        $this->load->view('header_view',$datah);
        $this->load->view('user_view',$data);
    }

    public function baru() {
        $this->load->library('form_validation');
        //$this->form_validation->set_rules('rem-ukm', 'UKM','required|strip_tags');
        $this->form_validation->set_rules('rem-teks', 'Teks','required|strip_tags');
        //$this->form_validation->set_rules('rem-tipe', 'Teks','required|strip_tags');

        if($this->form_validation->run() == TRUE){
                $iduser = $this->access->get_userid();
                $idukm = addslashes($this->input->post('rem-ukm', TRUE));
                $teks = addslashes($this->input->post('rem-teks', TRUE));
                $idtipe = addslashes($this->input->post('rem-tipe', TRUE));
                $this->notif_model->insert(array('user_id' => $iduser,'ukm_id' => $idukm,'notif_activity' => $teks,'notif_from' => $iduser,'notif_to' => $idukm,'notif_tipe' => $idtipe));

                $status['status'] = 1;
                $status['error'] = '';
        }else{
            $status['status'] = 0;
            $status['error'] = validation_errors();
        }

        echo json_encode($status);
    }

}

?>

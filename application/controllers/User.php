<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model', '', true);
        $this->load->model('log_model', '', true);
    }

    public function index() {

    }

    function tambahuser(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('tambah-email', 'Email','trim|required|strip_tags|valid_email');
        $this->form_validation->set_rules('tambah-ukm', 'UKM','required|strip_tags');
        $this->form_validation->set_rules('tambah-role', 'Role','required|strip_tags');
        $this->form_validation->set_rules('tambah-username', 'Username','trim|required|strip_tags|min_length[3]|callback_cek_uname');
        $this->form_validation->set_rules('tambah-pass', 'Password','trim|required|strip_tags|matches[tambah-passconf]|min_length[5]');
        $this->form_validation->set_rules('tambah-passconf', 'Konfirmasi Password','trim|required|strip_tags');

        if($this->form_validation->run() == TRUE){
            $data = array(
                'USER_NAME' => addslashes($this->input->post('tambah-username', TRUE)),
                'USER_PASS' => sha1(addslashes($this->input->post('tambah-pass', TRUE))),
                'USER_MAIL' => addslashes($this->input->post('tambah-email', TRUE)),
                'USER_ROLE' => addslashes($this->input->post('tambah-role', TRUE)),
                'UKM_ID' => addslashes($this->input->post('tambah-ukm', TRUE))
            );

            $this->user_model->insert($data);

            $status['status'] = 1;
            $status['pesan'] = 'User baru berhasil dibuat';
        }else{
            $status['status'] = 0;
            $status['pesan'] = validation_errors();
        }

        echo json_encode($status);
    }

    function edituser(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('edit-email', 'Email','trim|required|strip_tags|valid_email');
        $this->form_validation->set_rules('edit-ukm', 'UKM','required|strip_tags');
        $this->form_validation->set_rules('edit-role', 'Role','required|strip_tags');
        $this->form_validation->set_rules('edit-username', 'Username','trim|required|strip_tags|min_length[3]');
        $this->form_validation->set_rules('edit-id', 'User ID','required|strip_tags');

        if($this->form_validation->run() == TRUE){

          $idukm = addslashes($this->input->post('edit-ukm', TRUE));
          $iduser = addslashes($this->input->post('edit-id', TRUE));
          $idrole = addslashes($this->input->post('edit-role', TRUE));
          $username = addslashes($this->input->post('edit-username', TRUE));
          $email = addslashes($this->input->post('edit-email', TRUE));
          $tempuname = addslashes($this->input->post('edit-tempuname', TRUE));

          if($username != $tempuname) {
              $this->form_validation->set_rules('edit-username', 'Username','callback_cek_uname');
              if ($this->form_validation->run() == FALSE) {
                  $status['status'] = 0;
                  $status['pesan'] = validation_errors();
              } else {
                  $data = array(
                    'USER_NAME' => $username,
                    'USER_MAIL' => $email,
                    'USER_ROLE' => $idrole,
                    'UKM_ID' => $idukm
                  );

                  $this->user_model->update($iduser,$data);

                  $status['status'] = 1;
                  $status['pesan'] = "Perubahan pada user " . $tempuname . " berhasil disimpan";

                  if($iduser == $this->access->get_userid()) {
                      $this->session->set_userdata('ukm_username', $username);
                      $this->session->set_userdata('ukm_usermail', $email);
                      $this->session->set_userdata('ukm_role_id', $idrole);
                  }

              }
          } else {
              $data = array(
                'USER_MAIL' => $email,
                'USER_ROLE' => $idrole,
                'UKM_ID' => $idukm
              );

              $this->user_model->update($iduser,$data);

              $status['status'] = 1;
              $status['pesan'] = "Perubahan pada user " . $tempuname . " berhasil disimpan";

              if($iduser == $this->access->get_userid()) {
                $this->session->set_userdata('ukm_usermail', $email);
                $this->session->set_userdata('ukm_role_id', $idrole);
              }
          }
        }else{
          $status['status'] = 0;
          $status['pesan'] = validation_errors();
        }

        echo json_encode($status);
    }

    function hapususer(){
      $this->load->library('form_validation');
      $this->form_validation->set_rules('hapus-id', 'User ID','required|strip_tags');

      if($this->form_validation->run() == TRUE){
        $id = addslashes($this->input->post('hapus-id', TRUE));
        $this->user_model->delete($id);

        $status['status'] = 1;
        $status['pesan'] = 'User ' . addslashes($this->input->post('hapus-uname', TRUE)) . ' berhasil dihapus';
      }else{
        $status['status'] = 0;
        $status['pesan'] = validation_errors();
      }

      echo json_encode($status);
    }
    
    function gantipassword(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('pass-baru', 'Password Baru','trim|required|strip_tags|matches[pass-conf]|min_length[5]');
        $this->form_validation->set_rules('pass-conf', 'Konfirmasi Password Baru','trim|required|strip_tags');

        if($this->form_validation->run() == TRUE){
                $passbaru = addslashes($this->input->post('pass-baru', TRUE));
                $id = addslashes($this->input->post('pass-id', TRUE));
                
                $this->user_model->update($id,array('user_pass' => sha1($passbaru)));
                $status['status'] = 1;
                $status['pesan'] = 'Password user ' . addslashes($this->input->post('pass-name', TRUE)) . ' berhasil diubah';           
        }else{
            $status['status'] = 0;
            $status['pesan'] = validation_errors();
        }
        
        echo json_encode($status);
    }

    function cek_uname($str) {
        $c_nama = $this->user_model->cek(array('user_name' => $str));

        if($c_nama->num_rows() > 0){
            $this->form_validation->set_message('cek_uname', 'Username sudah digunakan, silakan coba yang lain !!');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function getuser() {
        // variable initialization
        $search = "";
        $start = 0;
        $rows = 10;

        // get search value (if any)
        if (isset($_GET['sSearch']) && $_GET['sSearch'] != "") {
            $search = $_GET['sSearch'];
        }

        // limit
        $start = $this->get_start();
        $rows = $this->get_rows();

        // run query to get user listing
        $query = $this->user_model->get_daftaruser($start, $rows, $search);
        $iFilteredTotal = $query->num_rows();
        $iTotal = $this->user_model->get_count_daftaruser($search)->row()->Total;

        $output = array(
            "sEcho" => intval($_GET['sEcho']),
            "iTotalRecords" => $iTotal,
            "iTotalDisplayRecords" => $iTotal,
            "aaData" => array()
        );

        // get result after running query and put it in array
        $i = $start;
        $counter = $query->result();
        foreach ($counter as $temp) {
            $record = array();
            $record[] = $temp->ID;
            $record[] = $temp->UKM;
            $record[] = $temp->Username;
            $record[] = $temp->Dibuat;
            $record[] = $temp->Role;
            $record[] = $temp->Status;
            $record[] = '<div class="btn-group">
                            <button type="button" class="btn btn-info btn-xs btn-flat" data-toggle="dropdown">Opsi
                                <span class="fa fa-caret-down"></span>
                            </button>
                            <ul class="dropdown-menu pull-right" role="menu">
                                <li><a href="#" onclick="modaledit(\''.$temp->ID.'\', \''.addslashes($temp->Username).'\', \''.addslashes($temp->UKM).'\', \''.addslashes($temp->Role).'\', \''.addslashes($temp->Dibuat).'\', \''.addslashes($temp->Mail).'\')" >Edit</a></li>
                                <li><a href="#" onclick="modalhapus(\''.$temp->ID.'\', \''.addslashes($temp->Username).'\', \''.addslashes($temp->Role).'\')" >Hapus</a></li>
                                <li><a href="#" onclick="modalpass(\''.$temp->ID.'\', \''.addslashes($temp->Username).'\')" >Password</a></li>
                            </ul>
                        </div>';
            //$record[] = '<a onclick="modaledit(\''.$temp->ID.'\', \''.addslashes($temp->Username).'\', \''.addslashes($temp->Nama).'\', \''.addslashes($temp->Role).'\', \''.addslashes($temp->Dibuat).'\')" class="btn btn-info btn-xs">Edit</a>
            //             <a onclick="modalhapus(\''.$temp->ID.'\', \''.addslashes($temp->Nama).'\', \''.addslashes($temp->Role).'\')" class="btn btn-danger btn-xs">Hapus</a>
            //             <a onclick="modalpass(\''.$temp->ID.'\', \''.addslashes($temp->Username).')" class="btn btn-success btn-xs">Password</a>';

            $output['aaData'][] = $record;
        }
        // format it to JSON, this output will be displayed in datatable
        echo json_encode($output);
    }

    /**
     * fungsi tambahan
     *
     *
     */
    function get_start() {
        $start = 0;
        if (isset($_GET['iDisplayStart'])) {
            $start = intval($_GET['iDisplayStart']);

            if ($start < 0)
                $start = 0;
        }

        return $start;
    }

    function get_rows() {
        $rows = 10;
        if (isset($_GET['iDisplayLength'])) {
            $rows = intval($_GET['iDisplayLength']);
            if ($rows < 5 || $rows > 500) {
                $rows = 10;
            }
        }

        return $rows;
    }

    function get_sort_dir() {
        $sort_dir = "ASC";
        $sdir = strip_tags($_GET['sSortDir_0']);
        if (isset($sdir)) {
            if ($sdir != "asc") {
                $sort_dir = "DESC";
            }
        }

        return $sort_dir;
    }

}

?>

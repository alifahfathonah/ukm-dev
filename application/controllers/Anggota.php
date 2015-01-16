<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Anggota extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('ukm_model', '', true);
        $this->load->model('log_model', '', true);
        $this->load->model('anggota_model', '', true);
    }

    public function index() {

    }

    function tambah(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('tambah-nama', 'Nama','required|strip_tags');
        $this->form_validation->set_rules('tambah-level', 'Level','required|strip_tags');

        if($this->form_validation->run() == TRUE){
            $data = array(
                'anggota_name' => addslashes($this->input->post('tambah-nama', TRUE)),
                'anggota_level' => addslashes($this->input->post('tambah-level', TRUE)),
                'ukm_id' => $this->access->get_ukmid()
            );

            $this->anggota_model->insert($data);

            $status['status'] = 1;
            $status['pesan'] = 'Anggota baru berhasil ditambahkan';
        }else{
            $status['status'] = 0;
            $status['pesan'] = validation_errors();
        }

        echo json_encode($status);
    }

    function edit(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('edit-nama', 'Nama','trim|required|strip_tags|min_length[3]');
        $this->form_validation->set_rules('edit-status', 'Status','required|strip_tags');
        $this->form_validation->set_rules('edit-level', 'Level','required|strip_tags');
        $this->form_validation->set_rules('edit-id', 'User ID','required|strip_tags');

        if($this->form_validation->run() == TRUE){

          $nama = addslashes($this->input->post('edit-nama', TRUE));
          $idstatus = addslashes($this->input->post('edit-status', TRUE));
          $idlevel = addslashes($this->input->post('edit-level', TRUE));
          $idanggota = addslashes($this->input->post('edit-id', TRUE));

          $data = array(
            'anggota_name' => $nama,
            'anggota_status' => $idstatus,
            'anggota_level' => $idlevel
          );

          $this->anggota_model->update($idanggota,$data);

          $status['status'] = 1;
          $status['pesan'] = "Perubahan pada Anggota berhasil disimpan";

        }else{
          $status['status'] = 0;
          $status['pesan'] = validation_errors();
        }

        echo json_encode($status);
    }

    function hapus(){
      $this->load->library('form_validation');
      $this->form_validation->set_rules('hapus-id', 'User ID','required|strip_tags');

      if($this->form_validation->run() == TRUE){
        $id = addslashes($this->input->post('hapus-id', TRUE));
        $this->anggota_model->delete($id);

        $status['status'] = 1;
        $status['pesan'] = 'Anggota ' . addslashes($this->input->post('hapus-uname', TRUE)) . ' berhasil dihapus';
      }else{
        $status['status'] = 0;
        $status['pesan'] = validation_errors();
      }

      echo json_encode($status);
    }

    public function getanggota() {
        // variable initialization
        $search = "";
        $start = 0;
        $rows = 6;

        // get search value (if any)
        if (isset($_GET['sSearch']) && $_GET['sSearch'] != "") {
            $search = $_GET['sSearch'];
        }

        // limit
        $start = $this->get_start();
        $rows = $this->get_rows();
        $ukmid = $this->access->get_ukmid();

        // run query to get user listing
        $query = $this->anggota_model->get_daftaranggota($ukmid, $start, $rows, $search);
        $iFilteredTotal = $query->num_rows();
        $iTotal = $this->anggota_model->get_count_daftaranggota($ukmid, $search)->row()->Total;

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
            $record[] = $temp->Nama;
            $record[] = $temp->Status;
            $record[] = $temp->Level;
            $record[] = '<button class="btn btn-xs btn-flat btn-danger" onclick="modalhapus(\''.$temp->ID.'\', \''.addslashes($temp->Nama).'\', \''.addslashes($temp->Level).'\')"><i class="fa fa-times"></i> Hapus</button>
                        <button class="btn btn-xs btn-flat btn-primary" onclick="modaledit(\''.$temp->ID.'\', \''.addslashes($temp->Nama).'\', \''.addslashes($temp->StatusID).'\', \''.addslashes($temp->LevelID).'\')"><i class="fa fa-pencil"></i> Edit</button>';

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
        $rows = 6;
        if (isset($_GET['iDisplayLength'])) {
            $rows = intval($_GET['iDisplayLength']);
            if ($rows < 5 || $rows > 500) {
                $rows = 6;
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

    public function get_databox() {
        $ukmid = $this->access->get_ukmid();
        // data buat box
        $data['boxanggota'] = $this->anggota_model->get_total(array("anggota_level" => 10, "ukm_id" => $ukmid));
        $data['boxpengurus'] = $this->anggota_model->get_total(array("anggota_level" => 11, "ukm_id" => $ukmid));
        $data['boxnon'] = $this->anggota_model->get_total(array("anggota_status" => 0, "ukm_id" => $ukmid));
        $data['boxaktif'] = $this->anggota_model->get_total(array("anggota_status" => 1, "ukm_id" => $ukmid));

        echo json_encode($data);
    }

}

?>
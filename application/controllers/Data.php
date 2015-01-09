<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Data extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model', '', true);
        $this->load->model('data_model', '', true);
        $this->load->model('ukm_model', '', true);
    }

    public function index() {

    }

    function tambahukm(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('tambah-kontak', 'Kontak','trim|required|strip_tags');
        $this->form_validation->set_rules('tambah-user', 'User','strip_tags');
        $this->form_validation->set_rules('tambah-nama', 'Nama UKM','trim|required|strip_tags|min_length[3]|callback_cek_uname');

        if($this->form_validation->run() == TRUE){
            if(addslashes($this->input->post('tambah-user', TRUE)) == 0) {
                $data = array(
                    'ukm_name' => addslashes($this->input->post('tambah-nama', TRUE)),
                    'ukm_contact' => addslashes($this->input->post('tambah-kontak', TRUE))
                );
            } else {
                $data = array(
                    'ukm_name' => addslashes($this->input->post('tambah-nama', TRUE)),
                    'user_id' => addslashes($this->input->post('tambah-user', TRUE)),
                    'ukm_contact' => addslashes($this->input->post('tambah-kontak', TRUE))
                );
            }
            
            $this->ukm_model->insert($data);

            $status['status'] = 1;
            $status['pesan'] = 'UKM baru berhasil dibuat';
        }else{
            $status['status'] = 0;
            $status['pesan'] = validation_errors();
        }

        echo json_encode($status);
    }

    function editukm(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('edit-kontak', 'Kontak','trim|required|strip_tags');
        $this->form_validation->set_rules('edit-nama', 'Nama UKM','required|strip_tags');
        $this->form_validation->set_rules('edit-user', 'User','required|strip_tags');
        $this->form_validation->set_rules('edit-id', 'UKM ID','required|strip_tags');

        if($this->form_validation->run() == TRUE){

          $idukm = addslashes($this->input->post('edit-id', TRUE));
          $iduser = addslashes($this->input->post('edit-user', TRUE));
          $nama = addslashes($this->input->post('edit-nama', TRUE));
          $kontak = addslashes($this->input->post('edit-kontak', TRUE));
          $tempnama = addslashes($this->input->post('edit-tempnama', TRUE));

          if($nama != $tempnama) {
              $this->form_validation->set_rules('edit-nama', 'Nama UKM','callback_cek_uname');
              if ($this->form_validation->run() == FALSE) {
                  $status['status'] = 0;
                  $status['pesan'] = validation_errors();
              } else {
                  if($iduser == 0) {
                      $data = array(
                        'ukm_name' => $nama,
                        'ukm_contact' => $kontak
                      );
                  } else {
                      $data = array(
                        'ukm_name' => $nama,
                        'user_id' => $iduser,
                        'ukm_contact' => $kontak
                      );
                  }
                  

                  $this->ukm_model->update($idukm,$data);

                  $status['status'] = 1;
                  $status['pesan'] = "Perubahan pada UKM " . $tempnama . " berhasil disimpan";
              }
          } else {
              if($iduser == 0) {
                  $data = array(
                    'ukm_contact' => $kontak
                  );
              } else {
                  $data = array(
                    'user_id' => $iduser,
                    'ukm_contact' => $kontak
                  );
              }

              $this->ukm_model->update($idukm,$data);

              $status['status'] = 1;
              $status['pesan'] = "Perubahan pada UKM " . $tempnama . " berhasil disimpan";
          }
        }else{
          $status['status'] = 0;
          $status['pesan'] = validation_errors();
        }

        echo json_encode($status);
    }
    
    function deleteFiles($path){
        $files = glob($path); // get all file names
        foreach($files as $file){ // iterate files
            if(file_exists($file)) {
                unlink($file) or die('Gagal menghapus: ' . $path); // delete file
                //echo $file.'file deleted';
            }
        }   
    }

    function hapusdata(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('hapus-id', 'Data ID','required|strip_tags');

        if($this->form_validation->run() == TRUE){
            $id = addslashes($this->input->post('hapus-id', TRUE));
            $opfile = addslashes($this->input->post('hapus-file', TRUE));
            $path = $_SERVER['DOCUMENT_ROOT'].'/uploads/';
            
            if($opfile == "hapusfile") {
                $data = $this->data_model->get_data(array("data_id" => $id))->row();
                $dpath = $path . $data->DATA_FILE;
                $this->deleteFiles($dpath);
                $this->data_model->delete($id);
                $pesan = 'Data ' . addslashes($this->input->post('hapus-nama', TRUE)) . ' beserta filenya berhasil dihapus ';
            } else {
                $pesan = 'Data ' . addslashes($this->input->post('hapus-nama', TRUE)) . ' berhasil dihapus';
                $this->data_model->update($id,array("data_status" => "2"));
            }

            $status['status'] = 1;
            $status['pesan'] = $pesan;
        }else{
            $status['status'] = 0;
            $status['pesan'] = validation_errors();
        }

        echo json_encode($status);
    }

    function hapusemua(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('semua-id', 'Role ID','required|strip_tags');

        if($this->form_validation->run() == TRUE){
            $id = addslashes($this->input->post('semua-id', TRUE));
            $opfile = addslashes($this->input->post('semua-file', TRUE));
            $path = $_SERVER['DOCUMENT_ROOT'].'/uploads/';
            
            if($id == 40) {
                if($opfile == "hapusfile") {
                    $data = $this->data_model->get_data(array("data_id" => $id))->row();
                    $dpath = $path . "*";
                    $this->deleteFiles($dpath);
                    $this->data_model->deleteall();
                    $pesan = 'Semua data beserta filenya berhasil dihapus ';
                } else {
                    $pesan = 'Semua data berhasil dihapus';
                    $this->data_model->updateall(array("data_status" => "2"));
                }

                $status['status'] = 1;
                $status['pesan'] = $pesan;
            } else {
                $status['status'] = 0;
                $status['pesan'] = "Anda tidak bisa mempunyai hak akses untuk menghapus file";
            }
            
        }else{
            $status['status'] = 0;
            $status['pesan'] = validation_errors();
        }

        echo json_encode($status);
    }

    function undodata(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('undo-id', 'Data ID','required|strip_tags');

        if($this->form_validation->run() == TRUE){
            $id = addslashes($this->input->post('undo-id', TRUE));
            $nama = addslashes($this->input->post('undo-nama', TRUE));
            $this->data_model->update($id,array("data_status" => "1"));

            $status['status'] = 1;
            $status['pesan'] = 'Data ' . $nama . ' berhasil dikembalikan';
        }else{
            $status['status'] = 0;
            $status['pesan'] = validation_errors();
        }

        echo json_encode($status);
    }
    
    function updateinfo(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('info-id', 'UKM ID','required|strip_tags');
        $this->form_validation->set_rules('info-teks', 'Info Teks','required|strip_tags|trim|max_length[100]');

        if($this->form_validation->run() == TRUE){
            $id = addslashes($this->input->post('info-id', TRUE));
            $teks = addslashes($this->input->post('info-teks', TRUE));
            
            $this->ukm_model->update($id,array('ukm_info' => $teks));

            $status['status'] = 1;
            $status['pesan'] = 'Info UKM berhasil diperbarui';
        }else{
            $status['status'] = 0;
            $status['pesan'] = validation_errors();
        }

        echo json_encode($status);
    }
    
    function cek_uname($str) {
        $c_nama = $this->ukm_model->cek(array('ukm_name' => $str));

        if($c_nama->num_rows() > 0){
            $this->form_validation->set_message('cek_uname', 'Nama UKM sudah digunakan, silakan coba yang lain !!');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function getdata() {
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
        $query = $this->data_model->get_daftardata($start, $rows, $search);
        $iFilteredTotal = $query->num_rows();
        $iTotal = $this->data_model->get_count_daftardata($search)->row()->Total;

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
            $shap = $temp->StatusID != 2 ? "" : "disabled";
            $sund = $temp->StatusID == 2 ? "" : "disabled";
            $record = array();
            $record[] = $temp->ID;
            $record[] = $temp->UKM;
            $record[] = $temp->Pesan;
            $record[] = $temp->Dikirim;
            $record[] = $temp->Nama;
            $record[] = $temp->Status;
            $record[] = '<button class="btn btn-xs btn-flat btn-danger '. $shap .'" onclick="modalhapus(\''.$temp->ID.'\', \''.addslashes($temp->UKM).'\', \''.addslashes($temp->File).'\')"><i class="fa fa-times"></i> Hapus</button>
                        <button class="btn btn-xs btn-flat btn-warning '. $sund .'" onclick="modalundo(\''.$temp->ID.'\', \''.addslashes($temp->UKM).'\', \''.addslashes($temp->File).'\')"><i class="fa fa-undo"></i> Undo</button>';
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

<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('agenda_model', '', true);
  }

  public function index()
  {
    $data['dataagenda'] = $this->agenda_model->view_agenda();
    $this->load->view('blog_view',$data);
  }
}

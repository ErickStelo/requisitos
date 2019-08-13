<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Relatorio extends CI_Controller {

    public function __construct() {

        parent::__construct();
    }

    public function index() {
        $this->load->model('relatorio_model');
        $data['regs'] = $this->relatorio_model->listar();
  
        $sessao = $this->session->all_userdata();
        if (isset($sessao['usuario']['usu_nome'])) {

        $this->template->load('template/template', 'relatorio/lista_relatorio', $data);
        } else {
            $data['not_logged'] = true;
            $this->load->view('login/login.php', $data);
        }
    }


}

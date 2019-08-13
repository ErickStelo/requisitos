<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    
    
     public function __construct() {    
        parent::__construct();
    }
    
    public function index() {

        $this->load->view('login/login.php');
    }

    public function teste() {
        
        $sql = "SELECT * FROM usuarios ";
        $result = $this->db->query($sql)->row_array();
        print_r($result);
    }
    
    public function logout() {
        
	$this->session->unset_userdata('usuario');
        redirect(base_url(), "refresh");
    }

    public function autenticar() {
        $this->load->model('login_model');

        $arr = $this->input->post();
        $b = false;
        $c = array('=', 'or', 'OR', 'and', 'AND', ',', ';', '#', '@', '!', '\'', '\"');

        foreach ($c as $v) {
            str_replace($v, '', $arr['login']);
            str_replace($v, '', $arr['senha']);
        }

        $this->load->model('login_model');
        $retorno = $this->login_model->autentica($arr['login'], $arr['senha'])->row_array();
        
        if(count($retorno) >0){          
            $retorno['usuario'] = $retorno;
            $this->session->set_userdata($retorno);
            redirect("home","refresh");
        }else {
             $data['error'] = true;
             $this->load->view('login/login.php', $data);
        }
    }
    
    

}

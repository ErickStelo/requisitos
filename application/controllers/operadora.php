<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Operadora extends CI_Controller {

    public function __construct() {

        parent::__construct();
    }

    public function index() {
        $this->load->model('operadora_model');
        $data['operadora'] = $this->operadora_model->getOperadora()->result_array();
        
        $this->template->load('template/template', 'operadora/lista_operadora', $data);
    }
        
    
    public function edt($id = false) {
        $this->load->model('operadora_model');
        $data["estados"] = $this->db->get("ufs")->result_array();
       
        if ($id == "") {
            $this->operadora_model->getOperadora()->result_array();
            $this->template->load('template/template', 'operadora/formulario_operadora', $data);
        } else {
            $data['operadora'] = $this->operadora_model->getOperadora($id)->row_array();
            $this->template->load('template/template', 'operadora/formulario_operadora', $data);
        }
    }

    public function gravar() {
        $this->load->model('operadora_model');
        $dados = $this->input->post();
        if ($dados['ope_id'] == "") {
            $result = $this->operadora_model->inserir($dados);
            if ($result == 1) {
                echo '<script>alert("Registro Inserido com sucesso!");</script>';
                redirect("operadora", "refresh");
            } else {
                echo '<script>alert("Erro ao inserir!");</script>';
                redirect("operadora", "refresh");
            }
        } else {
            
            $result = $this->operadora_model->alterar($dados);
            
            if ($result == 1) {
                
                echo "<script>alert('Registro alterado com sucesso!');window.location.href='".base_url()."/operadora';</script>";
                
            } else {
                echo "<script>alert('Problema ao alter!');window.location.href='".base_url()."/operadora';</script>";
                
            }
        }
        
    }
    
    public function excluir(){
        $arr = $this->input->post();
        $this->db->where("ope_id",$arr["id"]);
        $result = $this->db->delete("operadoras");
        if(count($result) > 0){
            echo 1;
        }else 
            echo 2;
        
    }

}

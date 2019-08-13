<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Projeto extends CI_Controller {

    public function __construct() {

        parent::__construct();
    }

    public function index() {
        $this->load->model('projeto_model');
        $data['projeto'] = $this->projeto_model->getProjeto()->result_array();
        $sessao = $this->session->all_userdata();
        if (isset($sessao['usuario']['usu_nome'])) {

            $this->template->load('template/template', 'projeto/lista_projeto', $data);
        } else {
            $data['not_logged'] = true;
            $this->load->view('login/login.php', $data);
        }
    }
    public function imprimir($codigo = null){
        $this->load->model('projeto_model');
        $sql = "
        SELECT * FROM `projetos` p
            WHERE p.pro_id = ".$codigo."; ";

        $data['projeto'] = $this->db->query($sql)->row_array();
        $sql2 = " SELECT * FROM requisitos_funcionais WHERE pro_id =".$codigo." ;";
        $data['requisitos_funcionais'] = $this->db->query($sql2)->result_array();

        $sql3 = " SELECT * FROM requisitos_nao_funcionais rn
                     INNER JOIN requisitos_funcionais rf on rn.req_id = rf.req_id
                     WHERE rf.pro_id =".$codigo." ;";
        $data['requisitos_nao_funcionais'] = $this->db->query($sql3)->result_array();

        $sessao = $this->session->all_userdata();
        if (isset($sessao['usuario']['usu_nome'])) {

            $this->load->view('projeto/imprimir_projeto', $data);
        } else {
            $data['not_logged'] = true;
            $this->load->view('login/login.php', $data);
        }
    }
    function buscar_cidade() {
        header("Content-Type: text/json");
        $arr = $this->input->post();
        $sql = "
                SELECT 
                    cid_codigo,
                    cid_nome
                FROM cidades 
                    WHERE uf_codigo = " . $arr['uf_codigo'] . " 
                ORDER BY cid_nome ASC
        ";
        $query = $this->db->query($sql);
        $regs = $query->result_array();
        $retorno = "";
        $retorno .= "<option value='' selected>Selecione a Cidade:</option>";
        foreach ($regs as $reg) {
            $sel = "";
            if ($arr['cid_codigo'] == $reg['cid_codigo'])
                $sel = "selected";
            $retorno .= "<option value='" . $reg['cid_codigo'] . "' " . $sel . ">" . $reg['cid_nome'] . "</option>";
        }
        echo json_encode($retorno);
    }

    function removerRequisito(){
        $arr = $this->input->post();
        $this->db->where('req_id', $arr['codigo']);
        $result = $this->db->delete('requisitos_projetos'); 
        
            if (count($result) >0) {
                echo "1";

            }else {
                echo "2";
            }
    }
    function addRequisito() {
        header("Content-Type: text/json");
        
        $arr = $this->input->post();

        if ($arr['req_id'] == '') {
            $result = $this->db->insert('requisitos_projetos', $arr);
           
            if (count($result) >0) {
                echo "1";

            }else {
                echo "2";
            }  
        }else {
            $this->db->where('req_id', $arr['req_id']);
           $result = $this->db->update('requisitos_projetos', $arr);
            if (count($result) >0) {
                echo "1"; 

            }else {
                echo "2";
            }   
        }

         
    }

    public function edt($id = false) {
        
        $this->load->model('projeto_model');
        $data["estados"] = $this->db->get("clientes")->result_array();
        $sessao = $this->session->all_userdata();
        if (isset($sessao['usuario']['usu_nome'])) {



            if ($id == "") {
                $this->projeto_model->getProjeto()->result_array();
                $this->template->load('template/template', 'projeto/formulario_projeto', $data);
            } else {

                $data['projeto'] = $this->projeto_model->getProjeto($id)->row_array();
                
                if ($_SESSION['usu_codigo'] == $data['projeto']['usu_id'] ) {
                $this->template->load('template/template', 'projeto/formulario_projeto', $data);
                }else {
                    echo "<script>alert('Você não tem permissão neste projeto!');window.location.href='" . base_url() . "/projeto';</script>";
                }
            }
        } else {
            $data['not_logged'] = true;
            $this->load->view('login/login.php', $data);
        }
    }

    public function gravar() {
        $this->load->model('projeto_model');
        $dados = $this->input->post();
        $sessao = $this->session->all_userdata();
        if (isset($sessao['usuario']['usu_nome'])) {

            if ($dados['pro_id'] == "") {
                $result = $this->projeto_model->inserir($dados);
                if ($result == 1) {
                    echo '<script>alert("Registro Inserido com sucesso!");</script>';
                    redirect("projeto", "refresh");
                } else {
                    echo '<script>alert("Erro ao inserir!");</script>';
                    redirect("projeto", "refresh");
                }
            } else {
                $result = $this->projeto_model->alterar($dados);
                if ($result == 1) {

                    echo "<script>alert('Registro alterado com sucesso!');window.location.href='" . base_url() . "/projeto';</script>";
                } else {
                    echo "<script>alert('Problema ao alter!');window.location.href='" . base_url() . "/projeto';</script>";
                }
            }
        } else {
            $data['not_logged'] = true;
            $this->load->view('login/login.php', $data);
        }
    }

    public function excluir() {
        $arr = $this->input->post();
        $this->db->where("pro_id", $arr["id"]);
        $result = $this->db->delete("projetos");
        if (count($result) > 0) {
            echo 1;
        } else
            echo 2;
    }

}

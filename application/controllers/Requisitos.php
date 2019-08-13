<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Requisitos extends CI_Controller {

    public function __construct() {

        parent::__construct();
    }

    public function index() {
        $this->load->model('requisitos_model');
        $data['requisito'] = $this->requisitos_model->getRequisitos()->result_array();
        $sessao = $this->session->all_userdata();
        if (isset($sessao['usuario']['usu_nome'])) {

            $this->template->load('template/template', 'requisitos/lista_requisito', $data);
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
        $this->load->model('requisitos_model');
        $arr = $this->input->post();
        $this->db->where('reqn_id', $arr['codigo']);
        $result = $this->db->delete('requisitos_nao_funcionais'); 
               
        if (count($result) >0) {
            echo "1";

        }else {
            echo "2";
        } 
    }
    function addRequisito() {
        header("Content-Type: text/json");
        $this->load->model('requisitos_model');
        $arr = $this->input->post();
// echo "<pre>";
//            print_r($arr);
//            echo "<aaaaa";exit;
           //print_r($result);
        if ($arr['reqn_id'] == '') {
            $result = $this->db->insert('requisitos_nao_funcionais', $arr);
            $result = $this->requisitos_model->getRequisitosAjax($arr['req_id']);
           
            if (count($result) >0) {
                echo json_encode($result);

            }else {
                echo "2";
            }  
        }else {
           $this->db->where('reqn_id', $arr['reqn_id']);
           $result = $this->db->update('requisitos_nao_funcionais', $arr);
           $result = $this->requisitos_model->getRequisitosAjax($arr['req_id']);
          
            if (count($result) >0) {
                echo json_encode($result);

            }else {
                echo "2";
            }   
        }

         
    }

    public function edt($id = false) {

        $this->load->model('projeto_model');
        $this->load->model('requisitos_model');
        $this->db->where("usu_id", $_SESSION['usu_codigo']);
        $data["projetos"] = $this->db->get("projetos")->result_array();
        $sessao = $this->session->all_userdata();
        if (isset($sessao['usuario']['usu_nome'])) {


            if ($id == "") {
                $this->requisitos_model->getRequisitos()->result_array();
                $this->template->load('template/template', 'requisitos/formulario_requisito', @$data);
            } else {
                $data['requisito'] = $this->requisitos_model->getRequisitos($id)->row_array();
                $this->template->load('template/template', 'requisitos/formulario_requisito', $data);
            }
        } else {
            $data['not_logged'] = true;
            $this->load->view('login/login.php', $data);
        }
    }
    public function verificaQtd(){
         header("Content-Type: text/json");
        $this->load->model('requisitos_model');
        $arr = $this->input->post();
        $this->db->where("pro_id",$arr['codigo']);
        $result = $this->db->get("requisitos_funcionais")->result_array();
        echo count($result);exit;

        if (count($result) >0) {
                echo json_encode(count($result));

        }
        // if ($arr['reqn_id'] == '') {
        //     $result = $this->db->insert('requisitos_nao_funcionais', $arr);
        //     $result = $this->requisitos_model->getRequisitosAjax($arr['req_id']);
           
        //     if (count($result) >0) {
        //         echo json_encode($result);

        //     }else {
        //         echo "2";
        //     }  
        // }else {
        //    $this->db->where('reqn_id', $arr['reqn_id']);
        //    $result = $this->db->update('requisitos_nao_funcionais', $arr);
        //    $result = $this->requisitos_model->getRequisitosAjax($arr['req_id']);
          
        //     if (count($result) >0) {
        //         echo json_encode($result);

        //     }else {
        //         echo "2";
        //     }   
        // }

    }
    public function gravar() {
        $this->load->model('requisitos_model');
        $dados = $this->input->post();
        $sessao = $this->session->all_userdata();
        if (isset($sessao['usuario']['usu_nome'])) {

            if ($dados['req_id'] == "") {
//                echo "<pre>";print_r($dados);exit;
                $result = $this->requisitos_model->inserir($dados);
                if ($result == 1) {
                    echo '<script>alert("Registro Inserido com sucesso!");</script>';
                    redirect("requisitos", "refresh");
                } else {
                    echo '<script>alert("Erro ao inserir!");</script>';
                    redirect("requisitos", "refresh");
                }
            } else {
                $result = $this->requisitos_model->alterar($dados);
                if ($result == 1) {

                    echo "<script>alert('Registro alterado com sucesso!');window.location.href='" . base_url() . "/requisitos';</script>";
                } else {
                    echo "<script>alert('Problema ao alter!');window.location.href='" . base_url() . "/requisitos';</script>";
                }
            }
        } else {
            $data['not_logged'] = true;
            $this->load->view('login/login.php', $data);
        }
    }

    public function excluir() {
        $arr = $this->input->post();
        $this->db->where("req_id", $arr["id"]);
        $result = $this->db->delete("requisitos_funcionais");
        $this->db->where("req_id", $arr["id"]);
        $result = $this->db->delete("requisitos_nao_funcionais");
        if (count($result) > 0) {
            echo 1;
        } else
            echo 2;
    }

}

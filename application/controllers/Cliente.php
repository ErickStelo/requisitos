<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends CI_Controller {

    public function __construct() {

        parent::__construct();
    }

    public function index() {
        $this->load->model('cliente_model');
        $data['cliente'] = $this->cliente_model->getCliente()->result_array();
        $sessao = $this->session->all_userdata();
        if (isset($sessao['usuario']['usu_nome'])) {
            $this->template->load('template/template', 'cliente/lista_cliente', $data);
        } else {
            $data['not_logged'] = true;
            $this->load->view('login/login.php', $data);
        }
    }

   


    function buscar_bairro() {
        header("Content-Type: text/json");
        $arr = $this->input->post();
        $sql = "
                SELECT 
                    bai_codigo,
                    bai_nome
                FROM bairros 
                    WHERE cid_codigo = " . $arr['cid_codigo'] . " 
                ORDER BY bai_nome ASC
        ";
        $query = $this->db->query($sql);
        $regs = $query->result_array();
        $retorno = "";
        $retorno .= "<option value='' selected>Selecione o bairro:</option>";
        foreach ($regs as $reg) {
            $sel = "";
            if ($arr['bai_codigo'] == $reg['bai_codigo'])
                $sel = "selected";
            $retorno .= "<option value='" . $reg['bai_codigo'] . "' " . $sel . ">" . $reg['bai_nome'] . "</option>";
        }
        echo json_encode($retorno);
    }

    public function verificaAparelhos() {
        $arr = $this->input->post();
        print_r($arr);
        exit;
        $this->db->where('aparelhos_cli_id', $arr['codigos'][]);
        $result = $this->db->get("funcionarios_aparelhos")->result_array();
    }

    public function edt($id = false) {

        $this->load->model('cliente_model');
       // $data["estados"] = $this->db->get("ufs")->result_array();
        //$data["aparelho"] = $this->db->get("aparelhos")->result_array();
        $this->db->where('cli_id', $id);
        $data["aparelhos"] = $this->db->get("clientes")->result_array();
        $sessao = $this->session->all_userdata();
        if (isset($sessao['usuario']['usu_nome'])) {

            if ($id == "") {
                $this->cliente_model->getCliente()->result_array();
                $this->template->load('template/template', 'cliente/formulario_cliente', $data);
            } else {
                $data['cliente'] =$this->cliente_model->getCliente($id)->row_array();
                $this->template->load('template/template', 'cliente/formulario_cliente', $data);
            }
        } else {
            $data['not_logged'] = true;
            $this->load->view('login/login.php', $data);
        }
    }

    public function gravar() {
        $this->load->model('cliente_model');
        $dados = $this->input->post();
        $sessao = $this->session->all_userdata();
        if (isset($sessao['usuario']['usu_nome'])) {

            if ($dados['cli_id'] == "") {
                $result = $this->cliente_model->inserir($dados);
                if ($result == 1) {
                    echo '<script>alert("Registro Inserido com sucesso!");</script>';
                    redirect("cliente", "refresh");
                } else {
                    echo '<script>alert("Erro ao inserir!");</script>';
                    redirect("cliente", "refresh");
                }
            } else {
                $result = $this->cliente_model->alterar($dados);
                if ($result == 1) {

                    echo "<script>alert('Registro alterado com sucesso!');window.location.href='" . base_url() . "/cliente';</script>";
                } else {
                    echo "<script>alert('Problema ao alter!');window.location.href='" . base_url() . "/cliente';</script>";
                }
            }
        } else {
            $data['not_logged'] = true;
            $this->load->view('login/login.php', $data);
        }
    }

    public function excluir() {
        $arr = $this->input->post();

        $this->db->where("cli_id", $arr["id"]);
        $result = $this->db->delete("clientes");

        if (count($result) > 0) {
            echo 1;
        } else
            echo 2;
    }

}

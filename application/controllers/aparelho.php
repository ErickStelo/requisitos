<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Aparelho extends CI_Controller {

    public function __construct() {

        parent::__construct();
    }

    public function index() {
        $this->load->model('aparelho_model');
        $sessao = $this->session->all_userdata();
        if (isset($sessao['usuario']['usu_nome'])) {
            $data['aparelho'] = $this->aparelho_model->getAparelho()->result_array();

            $this->template->load('template/template', 'aparelho/lista_aparelho', $data);
        } else {
            $data['not_logged'] = true;
            $this->load->view('login/login.php', $data);
        }
    }

    public function edt($id = false) {
        $sessao = $this->session->all_userdata();
        if (isset($sessao['usuario']['usu_nome'])) {
            $this->load->model('aparelho_model');
            $data["empresas"] = $this->db->get("empresa")->result_array();
            $data["operadora"] = $this->db->get("operadoras")->result_array();

            if ($id == "") {
                $data['aparelho'] = $this->aparelho_model->getAparelho()->result_array();
                $this->template->load('template/template', 'aparelho/formulario_aparelho', $data);
            } else {
                $data['aparelho'] = $this->aparelho_model->getAparelho($id)->row_array();
                $this->template->load('template/template', 'aparelho/formulario_aparelho', $data);
            }
        } else {
            $data['not_logged'] = true;
            $this->load->view('login/login.php', $data);
        }
    }

    public function gravar() {



        $this->load->model('aparelho_model');
        $dados = $this->input->post();
        $sessao = $this->session->all_userdata();
        $dados['apa_senha'] = md5($dados['apa_senha']);
        if (isset($sessao['usuario']['usu_nome'])) {

            if ($dados['apa_tipoativo'] == "on") {
                $dados['apa_tipoativo'] = 1;
            } else {
                $dados['apa_tipoativo'] = 0;
            }

            if ($dados['apa_id'] == "") {
                $result = $this->aparelho_model->inserir($dados);
                if ($result == 1) {
                    echo '<script>alert("Registro Inserido com sucesso!");</script>';
                    redirect("aparelho", "refresh");
                } else {
                    echo '<script>alert("Erro ao inserir!");</script>';
                    redirect("aparelho", "refresh");
                }
            } else {

                $result = $this->aparelho_model->alterar($dados);

                if ($result == 1) {

                    echo "<script>alert('Registro alterado com sucesso!');window.location.href='" . base_url() . "/aparelho';</script>";
                } else {
                    echo "<script>alert('Problema ao alter!');window.location.href='" . base_url() . "/aparelho';</script>";
                }
            }
        } else {
            $data['not_logged'] = true;
            $this->load->view('login/login.php', $data);
        }
    }

    public function excluir() {
        $arr = $this->input->post();
        $this->db->where("apa_id", $arr["id"]);
        $result = $this->db->delete("aparelhos");
        if (count($result) > 0) {
            echo 1;
        } else
            echo 2;
    }

}

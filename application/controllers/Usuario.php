<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

    public function __construct() {

        parent::__construct();
    }

    public function index() {
        $this->load->model('usuario_model');
        $sessao = $this->session->all_userdata();
        if (isset($sessao['usuario']['usu_nome'])) {

            $data['usuario'] = $this->usuario_model->getUser()->result_array();

            $this->template->load('template/template', 'usuarios/lista_usuario', $data);
        } else {
            $data['not_logged'] = true;
            $this->load->view('login/login.php', $data);
        }
    }

    public function edt($id = false) {
        $sessao = $this->session->all_userdata();
        if (isset($sessao['usuario']['usu_nome'])) {
            $this->load->model('usuario_model');
            $data["usuarios"] = $this->db->get("usuarios")->result_array();
            //$data["cidades"] = $this->db->get("cidades")->result_array();
            if ($id == "") {

                $this->usuario_model->getUser()->result_array();
                $this->template->load('template/template', 'usuarios/formulario_usuario', $data);
            } else {
                $data['usuario'] = $this->usuario_model->getUser($id)->row_array();
                $this->template->load('template/template', 'usuarios/formulario_usuario', $data);
            }
        } else {
            $data['not_logged'] = true;
            $this->load->view('login/login.php', $data);
        }
    }

    public function gravar() {
        $sessao = $this->session->all_userdata();
        $dados['apa_senha'] = md5($dados['usu_senha']);
        if (isset($sessao['usuario']['usu_nome'])) {
            $this->load->model('usuario_model');
            $dados = $this->input->post();
            if ($dados['usu_codigo'] == "") {
                $result = $this->usuario_model->inserir($dados);
                if ($result == 1) {
                    echo '<script>alert("Registro Inserido com sucesso!");</script>';
                    redirect("usuario", "refresh");
                } else {
                    echo '<script>alert("Erro ao inserir!");</script>';
                    redirect("usuario", "refresh");
                }
            } else {

                $result = $this->usuario_model->alterar($dados);

                if ($result == 1) {

                    echo "<script>alert('Registro alterado com sucesso!');window.location.href='" . base_url() . "/usuario';</script>";
                } else {
                    echo "<script>alert('Problema ao alter!');window.location.href='" . base_url() . "/usuario';</script>";
                }
            }
        } else {
            $data['not_logged'] = true;
            $this->load->view('login/login.php', $data);
        }
    }

    public function excluir() {
        $arr = $this->input->post();
        $this->db->where("usu_codigo", $arr["id"]);
        $result = $this->db->delete("usuarios");
        if (count($result) > 0) {
            echo 1;
        } else
            echo 2;
    }

}

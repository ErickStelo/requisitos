<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model {

    public function getUser($id = false) {
        if ($id == "") {
            return $this->db->query("select * from usuarios");
        } else {
            $this->db->where("usu_codigo", $id);
            return $this->db->get("usuarios");
        }
    }

    public function inserir($dados) {

        $result = $this->db->insert('usuarios', $dados);
        
        return $result;
    }
     public function alterar($dados) {
        $this->db->where('usu_codigo', $dados['usu_codigo']);
        $result = $this->db->update('usuarios', $dados);
        
        return $result;
    }

}

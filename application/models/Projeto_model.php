<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Projeto_model extends CI_Model {

    public function getProjeto($id = false) {
        if ($id == "") {
            return $this->db->query("select * from projetos where usu_id = ".$_SESSION['usu_codigo']);
        } else {
            $this->db->where("pro_id", $id);
            return $this->db->get("projetos");
        }
    }

    public function getRequisitos($id = false) {
       
            $this->db->where("pro_id", $id);
            return $this->db->get("requisitos_projetos");
       
    }


    

    public function inserir($dados) {

        $result = $this->db->insert('projetos', $dados);
        
        return $result;
    }
     public function alterar($dados) {
        $this->db->where('pro_id', $dados['pro_id']);
        $result = $this->db->update('projetos', $dados);
        
        return $result;
    }

}

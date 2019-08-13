<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Operadora_model extends CI_Model {

    public function getOperadora($id = false) {
        if ($id == "") {
            return $this->db->query("select * from operadoras");
        } else {
            $this->db->where("ope_id", $id);
            return $this->db->get("operadoras");
        }
    }

    public function inserir($dados) {

        $result = $this->db->insert('operadoras', $dados);

        return $result;
    }

    public function alterar($dados) {
        $this->db->where("ope_id", $dados['ope_id']);
        $atual = $this->db->get("operadoras")->row_array();
        
       
        $this->db->where('ope_id', $dados['ope_id']);
        $result = $this->db->update('operadoras', $dados);

        return $result;
    }

}

<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Aparelho_model extends CI_Model {

    public function getAparelho($id = false) {
        if ($id == "") {
            return $this->db->query("select * from aparelhos");
        } else {
            $this->db->where("apa_id", $id);
            return $this->db->get("aparelhos");
        }
    }

    public function inserir($dados) {

        $result = $this->db->insert('aparelhos', $dados);

        return $result;
    }

    public function alterar($dados) {
        $this->db->where("apa_id", $dados['apa_id']);
        $atual = $this->db->get("aparelhos")->row_array();
        
        if ($dados['apa_senha'] === '' || $dados['apa_senha'] == null) {
           
            unset($dados['apa_senha']);
        }
        $this->db->where('apa_id', $dados['apa_id']);
        $result = $this->db->update('aparelhos', $dados);

        return $result;
    }

}

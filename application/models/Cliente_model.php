<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente_model extends CI_Model {

    public function getCliente($id = false) {
        if ($id == "") {
            return $this->db->query("select * from clientes");
        } else {
            $this->db->where("cli_id", $id);
            return $this->db->get("clientes");
        }
    }
    
//    public function inserirAparelhos($arr, $i, $insert){
//        
//        $data['clientes_cli_id'] = $insert;
//        $data['aparelhos_apa_id'] = $arr['apa_id'][$i];
//        $this->db->insert('clientes_aparelhos', $data);
//    }
//    

    public function inserir($dados) {

        $result = $this->db->insert('clientes', $dados);
        
        return $result;
    }
     public function alterar($dados) {
         $this->db->where("cli_id", $dados['cli_id']);
         $atual = $this->db->get("clientes")->row_array();
     
//         print_r($dados);
        $this->db->where('cli_id', $dados['cli_id']);
        $result = $this->db->update('clientes', $dados);
        
        return $result;
    }

}

<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Requisitos_model extends CI_Model {

    public function getProjeto($id = false) {
        if ($id == "") {
            return $this->db->query("select * from requi");
        } else {
            $this->db->where("pro_id", $id);
            return $this->db->get("projetos");
        }
    }

    public function getRequisitos($id = false) {
       
        if ($id == "") {
            $sql = "select * from requisitos_funcionais rf inner join projetos p on rf.pro_id = p.pro_id WHERE p.usu_id = ".$_SESSION['usu_codigo'].";";
            return $this->db->query($sql);
        } else {
            $this->db->where("req_id", $id);
            return $this->db->get("requisitos_funcionais");
        }
    }

 public function getRequisitosAjax($id = false) {
             
             $sql = "SELECT * FROM requisitos_nao_funcionais"                    
                    . " WHERE req_id = ". $id;
            
            
           $query = $this->db->query($sql);
           $regs = $query->result_array();
           // echo "<pre>";
           // print_r($regs);
           $result = "";
           foreach ($regs as $u) { 

            if($u["reqn_categoria"] == 'i'){
                $u["reqn_categoria2"] = "Interface";
            }else if($u["reqn_categoria"] == 'p') {
                $u["reqn_categoria2"] = "Performance";
            }else if($u["reqn_categoria"] == 'e') {
                $u["reqn_categoria2"] = "Estrutural";
            }else if($u["reqn_categoria"] == 's') {
                $u["reqn_categoria2"] = "Segurança";
            }
            $result .='
            <tr id="id_'. $u["reqn_id"].'">
                <td width="33px">'.  $u["reqn_id"] .'</td>
                <td width="33px">'.  $u["reqn_nome"] .'</td>
                <td width="33px">'. $u["reqn_categoria2"]  .'</td>
                <td width="33px">'.  $u["reqn_obg"] .'</td>
                <td width="33px">'.  $u["reqn_permanente"] .'</td>
                <td width="33px">
                    <section></section>
                    <button class="btn btn-primary btn-xs alterarReq" descricao="'.$u["reqn_descricao"].'" obg="'. $u["reqn_obg"] .'"  permanente="'. $u["reqn_permanente"] .'" categoria="'. $u["reqn_categoria"] .'" nome="'. $u["reqn_nome"] .'" codigo="'. $u["reqn_id"].'"><i class="icon-pencil"></i></button>
                    <button  codigo="'.$u["reqn_id"].'" class="btn btn-danger btn-xs excluirReq"><i class="icon-trash"></i></button>
                    </section>
                </td>   
            </tr> 
            ';
           }
            return $result;
       
    }


    

    public function inserir($dados) {

        $result = $this->db->insert('requisitos_funcionais', $dados);

        return $result;
    }
     public function alterar($dados) {
        $this->db->where('req_id', $dados['req_id']);
        $result = $this->db->update('requisitos_funcionais', $dados);
        
        return $result;
    }

}

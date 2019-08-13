<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Relatorio_model extends CI_Model {

    public function getFuncionario($id = false) {
        if ($id == "") {
            return $this->db->query("select * from funcionarios");
        } else {
            $this->db->where("func_id", $id);
            return $this->db->get("funcionarios");
        }
    }
    
    public function busca_nome_classificadora($clas_id){
        
        $sql = "SELECT emp_nome FROM empresa WHERE emp_id = " . $clas_id;
        $query = $this->db->query($sql);
        $regs = $query->result_array();
        if (isset($regs))
            return $regs[0]['emp_nome'];
        
    }

    public function listar() {
        //print_r($this->data['dados']['config']);
//        $filtro = $this->filtro(); // Busca filtro
        $dataAtual = date("Y-m-d");
//        if($filtro == ""){
//		$filtro = " AND DATE(g.gps_pos_datahoracoleta_ini) BETWEEN '".$dataAtual."' AND '".$dataAtual."'";
//		}
		
        $sql =" SELECT 
                    * 
                FROM 
                  aparelhos a 
                        INNER JOIN 
                  empresa e on e.emp_id = a.emp_id 
                        INNER JOIN 
                  gps_posicao g on g.apa_id = a.apa_id 
                        INNER JOIN
                  funcionarios_aparelhos 
                        on  a.apa_id =  funcionarios_aparelhos.aparelhos_apa_id 
                        INNER JOIN 
                  funcionarios
                        on funcionarios.func_id = funcionarios_aparelhos.funcionarios_func_id
                ORDER BY 
                gps_pos_codigo ASC";
        $query = $this->db->query($sql); // Executa SQL
//        echo $sql;
        if ($query) {
            // Enviar o array
            return $regs = $query->result_array();
        } else {
            return false;
        }
    } 

}

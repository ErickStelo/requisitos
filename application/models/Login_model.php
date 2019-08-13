<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	public function getUser(){
		return $this->db->get("usuarios");
	}
        
	public function autentica($usuario, $senha){
            $sql = "SELECT * FROM usuarios where usu_email ='".$usuario."' and usu_senha = '".md5($senha)."'";
//            echo $sql;
            $result = $this->db->query($sql);
            return $result;
            
	}
}
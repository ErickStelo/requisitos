<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$this->load->model('home_model');
		$retorno = $this->home_model->getUser();
                $retorno = $retorno->result();
		//print_r($retorno);
                $atual = date('Y-m-d');

               	$this->db->where('DATE(gps_pos_datahoracoleta_ini)', $atual);
                $data['gps'] = "Aquee";
           
				$this->template->load('template/template','home_view', $data);
	}
	
	public function filtro(){
		
		//print_r($retorno);
        $atual = date('Y-m-d');

       	
       	$data['gps'] = $this->db->query("select * from gps_posicao WHERE DATE(gps_pos_datahoracoleta_ini) between $atual AND '2016-10-18'")->result_array();

         
		$this->template->load('template/template','home_view', $data);
	}
}

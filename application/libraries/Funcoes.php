<?php

class Funcoes {

    public $CI = ''; //variavel para instaciar o CodeEgnitor
    public $data = '';
    public $model = ''; // Define model
    public $tabela = '';

    public function __construct() {
        $this->CI = & get_instance(); //Instacia do framework       		
    }

    function buscar_nome_empresa() {
        $this->CI->db->select('emp_nome');
        $this->CI->db->from('empresas');
        $this->CI->db->where('emp_codigo', '1');
        $query = $this->CI->db->get();
        $regs = $query->result_array();
        return $regs[0]['emp_nome'];
    }

    function buscar_email_empresa() {
        $this->CI->db->select('emp_email');
        $this->CI->db->from('empresas');
        $this->CI->db->where('emp_codigo', '1');
        $query = $this->CI->db->get();
        $regs = $query->result_array();
        return $regs[0]['emp_email'];
    }

    function buscar_empresa() {
        $sql = " SELECT empresas.*,  
                        cidades.cid_nome,
                        ufs.uf_nome,
                        bairros.bai_nome
                    FROM empresas 
                        LEFT JOIN ufs USING(uf_codigo)
                        LEFT JOIN cidades USING(cid_codigo)
                        LEFT JOIN bairros USING(bai_codigo)
                   WHERE emp_codigo = 1
               ";
        $query = $this->CI->db->query($sql);
        $regs = $query->result_array();

        return $regs[0];
    }

    function buscarUfEmpresa() {
        $this->CI->db->select('uf_codigo');
        $this->CI->db->from('empresas');
        $this->CI->db->where('emp_codigo', '1');
        $query = $this->CI->db->get();
        $regs = $query->result_array();
        return $regs[0]['uf_codigo'];
    }


    function buscar_permissao_pai($regs) {

        $retorno = 'N';
        foreach ($regs as $reg) {
            if ($reg['mod_codigo']) {
                if ($this->buscar_permissao($reg['mod_controlador'], $reg['men_link']) == 'S') {
                    $retorno = 'S';
                }
            }
        }
        return $retorno;
    }

    function buscar_permissao($mod_controlador, $men_link) {
        $retorno = '';
        $sql = " SELECT * FROM modulos WHERE  mod_tabela = '" . $mod_controlador . "' ";

        $query = $this->CI->db->query($sql);

        $regs = $query->result_array();

        if ($query->num_rows() == 0) {
            $sql = " SELECT * FROM modulos WHERE  mod_controlador = '" . $mod_controlador . "' ";

            $query = $this->CI->db->query($sql);

            $regs = $query->result_array();
        }

        $retorno = $this->validar_permissao($regs[0]['mod_codigo'], 'per_listar');
        if ($men_link == '/adicionar/') {
            //echo "Entrou Adicionar";
            $retorno = $this->validar_permissao($regs[0]['mod_codigo'], 'per_adicionar');
        } else if ($men_link == '/alterar/') {
            //echo "Entrou Alterar";
            $retorno = $this->validar_permissao($regs[0]['mod_codigo'], 'per_alterar');
        }
        return $retorno;
    }

    function buscar_info($table) {

        $retorno = '';

        $sql = " SELECT * FROM modulos WHERE  mod_tabela = '" . $table . "' ";

        $query = $this->CI->db->query($sql);

        $regs = $query->result_array();

        if ($query->num_rows() == 0) {
            $sql = " SELECT * FROM modulos WHERE  mod_controlador like '%" . $table . "%' ";

            $query = $this->CI->db->query($sql);

            $regs = $query->result_array();
        }


        if ($regs) {

            $retorno['modulo'] = $regs[0]['mod_controlador'];

            $retorno['chave_primaria'] = $regs[0]['mod_chave_primaria'];

            if ($regs[0]['mod_ordem'] != '' || $regs[0]['mod_ordem_adicional'] != '')
                $retorno['ordem'] = $regs[0]['mod_ordem'] . ' ' . $regs[0]['mod_ordem_adicional'];
            else
                $retorno['ordem'] = 1;

            $retorno['nome'] = $regs[0]['mod_nome'];

            $retorno['tabela'] = $regs[0]['mod_tabela'];

            $retorno['codigo'] = $regs[0]['mod_codigo'];

            $retorno['descricao'] = $regs[0]['mod_descricao'];

            $retorno['foto'] = $regs[0]['mod_foto'];

            $retorno['foto_caminho'] = $regs[0]['mod_foto_caminho'];

            $retorno['arquivo'] = $regs[0]['mod_arquivo'];

            $retorno['arquivo_caminho'] = $regs[0]['mod_arquivo_caminho'];

            $retorno['tipo'] = $regs[0]['mod_tipo'];

            $retorno['exclusao_cascata'] = $regs[0]['mod_exclusao_cascata'];

            $retorno['manter_filtro'] = $regs[0]['mod_manter_filtro'];

            if (($this->CI->session->userdata('gru_codigo') != '')) {
                $retorno['listar'] = $this->validar_permissao($retorno['codigo'], 'per_listar');
                $retorno['adicionar'] = $this->validar_permissao($retorno['codigo'], 'per_adicionar');
                $retorno['alterar'] = $this->validar_permissao($retorno['codigo'], 'per_alterar');
                $retorno['excluir'] = $this->validar_permissao($retorno['codigo'], 'per_excluir');
                //echo $retorno['alterar'];exit;
            }
        }

        return $retorno;
    }

    function validar_sessao() {
        if ($this->CI->session->userdata('gru_codigo') == '') {
            //Seta a mensagem
            $this->CI->session->set_userdata('mensagem', MENSAGEM_SESSAO_EXPIROU);
            //Seta o tipo da mensagem //PODE SER : LIMPAR,ALTERAR,ADICIONAR,DELETAR
            $this->CI->session->set_userdata('mensagem_tipo', TIPO_EXCLUIR);
            //location para inicial
            header('Location: ' . base_url() . '');
            die();
        }
    }

    function validar_permissao_acesso($permissao) {
        if ($permissao == 'N') {
            //location para pagina de erro
            header('Location: ' . base_url() . 'erro');
            //echo Modules::run('modelo/erro', $this->data);
            die();
			
        }
    }

    function validar_permissao($MOD_CODIGO, $TIPO) {


        $sql = 'SELECT *
                  FROM permissoes
                  JOIN modulos USING  (mod_codigo)
                  JOIN grupos USING (gru_codigo)
                 WHERE mod_codigo = ' . $MOD_CODIGO . '
                   AND permissoes.gru_codigo = ' . $this->CI->session->userdata('gru_codigo') . '';

        
        $query = $this->CI->db->query($sql);
        $data = $query->result_array();
        
        if ($query->num_rows() == 0) {
            $data[0]['per_listar'] = 'N';
            $data[0]['per_adicionar'] = 'N';
            $data[0]['per_alterar'] = 'N';
            $data[0]['per_excluir'] = 'N';
        } else {
            
           // echo '<br>';
            //print_r($this->retornarValidacoesGrupoAdministrador($data[0]));
           // echo '<br>';

            $this->retornarValidacoesGrupoAdministrador($data[0]);
        }

        if ($TIPO == 'per_listar') {
            return $data[0]['per_listar'];
        }
        if ($TIPO == 'per_adicionar') {
            return $data[0]['per_adicionar'];
        }
        if ($TIPO == 'per_alterar') {
            return $data[0]['per_alterar'];
        }
        if ($TIPO == 'per_excluir') {
            return $data[0]['per_excluir'];
        }
        //echo 'final' . $data[0]['per_alterar'];
    }


    function Total() {
        $sql = "SELECT FOUND_ROWS() AS COUNT ;";
        $query = $this->CI->db->query($sql);
        $regs = $query->result_array();
        return $regs[0]['COUNT'];
    }

    function converter_data($dataentra, $tipo) {
        $datass = '';
        if ($dataentra == '') {
            return '';
        }
        if ($tipo == "mtn") {
            $datasentra = explode("-", $dataentra);
            $indice = 2;
            while ($indice != -1) {
                $datass[$indice] = $datasentra[$indice];
                $indice--;
            }

            $datasaida = implode("/", $datass);
        } elseif ($tipo == "ntm") {
            $datasentra = explode("/", $dataentra);
            $indice = 2;
            while ($indice != -1) {
                $datass[$indice] = $datasentra[$indice];
                $indice--;
            }
            $datasaida = implode("-", $datass);
        } else {
            $datasaida = "erro";
        }
        return $datasaida;
    }

    /*
     * Esta função transforma um timestamp (campo do banco de dados YYYY-mm-dd hh:ii:ss) para uma data no formato dd/mm/YYYY às hh:mm:ss
     */
    function formataDataeHora($data) {
        $datasentra = explode(" ", $data);
        
        return $this->converter_data($datasentra[0], "mtn") . " às " . $datasentra[1];
    }
  
   
   

//    public function gerarSelect($mod_controlador, $padrao, $ativo) {
//        $retorno = '';
//        //Busca todas configura��es do modulos
//        $this->tabela = $mod_controlador;
//        $this->data['dados'] = $this->setar_dados();
//
//        $sql = "
//                SELECT 
//                    " . $this->data['dados']['config']['chave_primaria'] . " as codigo,
//                    '" . $this->data['dados']['config']['foto'] . "' as foto,
//                    " . $this->data['dados']['config']['descricao'] . " as nome ,
//                    '" . $this->data['dados']['config']['foto_caminho'] . "'  as caminho,
//                    " . $padrao . "  as padrao
//                FROM " . $this->data['dados']['config']['tabela'] . "
//                    WHERE " . $this->data['dados']['config']['tipo'] . " = '" . $this->data['dados']['config']['modulo'] . "'
//                    AND " . $ativo . " = 'S' 
//                ORDER BY " . $this->data['dados']['config']['ordem'] . "
//        ";
//        $query = $this->CI->db->query($sql);
//        $regs = $query->result_array();
//        //$retorno .= "<option value = '' selected>Selecione:</option>";
//        foreach ($regs as $reg) {
//            $sel = "";
//            if ($reg['padrao'] == 'S')
//                $sel = "selected";
//            $retorno .= "<option value = '" . $reg['codigo'] . "' " . $sel . ">" . $reg['nome'] . "</option>";
//        }
//
//        //$query = $this->CI->db->query($sql); // Executa SQL
//        //$regs = $query->result_array();
//        return $retorno;
//    }

    
      public function getRequisitos($id = false) {
             
             $sql = "SELECT * FROM requisitos_nao_funcionais"                    
                    . " WHERE req_id = ". $id;
            
            
           $query = $this->CI->db->query($sql);
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
                <td width="33px">'.  $u["reqn_categoria2"] .'</td>
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

     public function getResp($id = false) {
             
             $sql = "SELECT cli_nome FROM clientes"                    
                    . " WHERE cli_id = ". $id;
            
            
           $query = $this->CI->db->query($sql);
           $regs = $query->row_array();
           
           
            return $regs['cli_nome'];
       
    }
     public function getPro($id = false) {
             
             $sql = "SELECT pro_nome FROM projetos"                    
                    . " WHERE pro_id = ". $id;
            
            
           $query = $this->CI->db->query($sql);
           $regs = $query->row_array();
           
           
            return $regs['pro_nome'];
       
    }



    public function funcionario($apa_id){
        
        $sql = "SELECT * FROM "
                . "aparelhos a "
                . "INNER JOIN funcionarios_aparelhos on a.apa_id = funcionarios_aparelhos.aparelhos_apa_id "
                . "INNER JOIN funcionarios on funcionarios.func_id = funcionarios_aparelhos.funcionarios_func_id"
                . " WHERE a.apa_id = ". $apa_id;
//        echo $sql;
        
        $query = $this->CI->db->query($sql);
        $regs = $query->row_array();
        print_r($regs['func_nome']);
    }

   

     public function retorna_coordenada($cord, $type = NULL){
        $stringurl = "http://maps.googleapis.com/maps/api/geocode/json?latlng=".$cord."&sensor=true_or_false";
        $url = file_get_contents($stringurl);
        $get = json_decode($url);
    
       if(count($get->results) > 0){   

        switch($type){
            case 'city': $return = $get->results[0]->address_components[4]->long_name; break;
            case 'cityuf': $return = $get->results[0]->address_components[4]->long_name.' - '.$get->results[0]->address_components[5]->short_name; break;
            default : $return = $get->results[0]->formatted_address; break;
         }
         return $return;
         }else{
         return '';
         }
    }

}

?>
<script type="text/javascript">
    $(document).ready(function() {
        $("#uf_codigo").change(function() {
            var uf_codigo = $(this).val();
            var cid_codigo = $("#uf_codigo").attr("codigoCid");

            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: base_url + "projeto/buscar_cidade/",
                data: {uf_codigo: uf_codigo, cid_codigo: cid_codigo},
                beforeSend: function(s) {
                    txt = '<option>Carregando...</option>';
                    $('#cid_codigo').html($(txt));
                },
                success: function(txt) {
                    console.log(txt);
                    // notify('Carregamento de Cidade', 'Completado!');
                    $('#cid_codigo').html($(txt));
                }
            });
        });
         $( function() {
            $( "#tabs" ).tabs();
          } );
       
         $('body').on('click', '.alterarReq', function () {

             $(".reqn_id").val($(this).attr('codigo'));
             $(".reqn_nome").val($(this).attr('nome'));
             $(".reqn_descricao").val($(this).attr('descricao'));
             $(".reqn_categoria").val($(this).attr('categoria'));
             $(".reqn_obg").val($(this).attr('obg'));            
             $(".reqn_permanente").val($(this).attr('permanente'));            
        });

        $('body').on('click', '.excluirReq', function () {
            var codigo = $(this).attr('codigo');
            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: base_url + "requisitos/removerRequisito/",
                data:{codigo:codigo},
                beforeSend: function(s) {
                    txt = '<option>Carregando...</option>';
                    
                },
                success: function(txt) {
                    
                     $(".reqn_id").val("");
                     $(".reqn_nome").val("");
                     $(".reqn_descricao").val("");
                     $(".reqn_categoria").val("");
                     $(".reqn_obg").val("");  
                     $(".reqn_permanente").val("");  
                    $("#id_"+codigo).remove();
                    // notify('Carregamento de Cidade', 'Completado!');
                    alert('Requisito excluido com sucesso!')
                    // console.log(retorno)
                    // $('#dataReq').html(retorno);
                }
            });
        });
        
        $('body').on('change', '.projeto_codigo', function () {
            var projeto = $(this).val();
            
            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: base_url + "requisitos/verificaQtd",
                data: {codigo: projeto},
                beforeSend: function(s) {
                    txt = '<option>Carregando...</option>';
                    
                },
                success: function(txt) {
                    
                    
                    if (txt >= 10) {
                        $("#message_projeto").html('<div class="alert error-block ">Você já cadastrou '+txt+' requisitos funcionais para este projeto, não é possível cadastrar mais! </div>')     
                        $(".btn-group").css("display", "none");
                    }else {
                        $("#message_projeto").html('<div class="alert alert-block ">Você já cadastrou '+txt+' requisitos funcionais para este projeto, vá em frente jovem kakaroto! </div>')     
                        $(".btn-group").css("display", "block");
                    }
                    setTimeout(function(){ $("#message_projeto").html("  ") }, 3000);
                    
                    
                    
                }
            });
        });   
        $('body').on('click', '#enviaReq', function () {        
            var pro_id = $("#req_req_id").val();
            var form = $('#req_form');
            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: base_url + "requisitos/addRequisito/",
                data: form.serialize(),
                beforeSend: function(s) {
                    txt = '<option>Carregando...</option>';
                    
                },
                success: function(txt) {
                    
                     $(".reqn_id").val("");
                     $(".reqn_nome").val("");
                     $(".reqn_descricao").val("");
                     $(".reqn_categoria").val("");
                     $(".reqen_obg").val("");  
                     $(".reqen_permanente").val("");  
                    
                    // notify('Carregamento de Cidade', 'Completado!');
                    alert('Operação realizada com sucesso!')
                    $('#dataReq').html(" ")
                    $('#dataReq').html(txt);
                }
            });
        });

    });

</script>
<style>
    .modal {
        margin-left:  -80px;
    }
    
</style>


<div class="panel-body" style="background-color: #fff;">
    <div id="tabs">
      <ul>
        <li><a href="#cadastro">Cadastro</a></li>
        <?php if(@$requisito['req_id'] != ''){ ?><li><a href="#requisitos">Requisitos não Funcionais</a></li> <?php } ?> 
      </ul>
      
      
      <div id="cadastro" style="z-index: 1042;">
          <form role="form" name="frm_projeto" id="frm_projeto" action="<?php echo base_url() ?>requisitos/gravar" method="post" enctype="multipart/form-data">
            <div class="widget">   
                <div class="block-fluid">  
                    <div class="row-fluid">
                        <div class="span12">      

                            <div class="widget">
                                <div class="box-header" data-original-title="">
                                    <h2  style="border-bottom: solid 1px #ccc;   margin-top: -10px; "><i class="halflings-icon edit"></i><span class="break"></span>Cadastro de Requisitos funcionais</h2>
                                <div style="float:right;  top: -9px !important;    position: relative;"> 
                                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Dúvidas?</button>    
                                </div>
                                
                                </div>

                            </div>
                            <input type="hidden" name="req_id" value="<?php echo @$requisito['req_id'] ?>">
                            <div class="block-fluid">
                                <div class="row-form">
                                    <div class="span2">Nome:</div>
                                    <div class="span10">
                                        <input type="text" name="req_nome" class="form-control validate[required]" value="<?php echo @$requisito['req_nome'] ?>"/>
                                        <span class="bottom">Obrigatório</span>
                                    </div>
                                </div>
                                 <div class="row-form">
                                    <div class="span2">Descrição:</div>
                                    <div class="span10">
                                        <textarea name="req_descricao" class="form-control"><?php echo @$requisito['req_descricao'] ?></textarea>
                                    </div>
                                </div>
                                <div class="row-form">
                                    <div class="span2">Categoria:</div>
                                    <div class="span10">
                                        <select  name="req_categoria" class="form-control">
                                            <option value="">Selecione a categoria</option>
                                            <option value="evidente" <?php if(@$requisito['req_categoria'] == "evidente"){ ?> selected <?php } ?> >Evidente</option>
                                            <option value="oculto" <?php if(@$requisito['req_categoria'] == "oculto"){ ?> selected <?php } ?> >Oculto</option>
                                        </select>
                                        
                                    </div> 
                                </div>
                                
                                <div class="row-form"> 
                                    <div class="span2">Projeto:</div>
                                    <div class="span10">
                                        <input type="hidden" id="pro_codigo_auxiliar" value="<?php echo @$requisito['pro_id']; ?>">
                                        <select name="pro_id" class="projeto_codigo" id="pro_id">
                                            <option value="">Selecione o projeto</option>
                                            <?php
                                            foreach ($projetos as $reg) {
                                                $sel = "";
                                                echo $requisito['pro_id'];
                                                echo $reg['pro_id'];
                                                if ($reg['pro_id'] == $requisito['pro_id'] ) 
                                                    $sel = "selected";
                                                
                                                ?>
                                                <option value='<?php echo $reg['pro_id']; ?>' <?php echo $sel; ?> ><?php echo $reg['pro_nome']; ?></option>
                                            <?php }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row-form">
                                    <div class="span12"> 
                                        <div id="message_projeto"></div>
                                    </div>
                                </div>

                            </div>                
                        </div>                    
                        <div class="row-fluid ">
                            <div class=" offset4 span8">
                                <div class="btn-group">
                                    <button class="form-control btn btn-danger btn-large" type="button" onclick="location = '<?php echo base_url(); ?>requisitos';" ><span class="icon-stop icon-white"></span> Cancelar</button>

                                    <button class="btn  btn-success btn-large" type="submit"><span class="icon-ok icon-white"></span> Salvar</button>
                                </div>
                            </div>
                        </div>
                    </div>  
                </div> 
            </div> 
        </form>
      </div>
      <?php if(@$requisito['req_id'] != ''){ ?>
          <div id="requisitos">
            <div class="row-fluid ">
                <form role="form"  name="frm_projeto" id="req_form" >
                    <div class="widget">
                                <div class="box-header" data-original-title="">
                                    <h2  style="border-bottom: solid 1px #ccc;   margin-top: -10px; "><i class="halflings-icon edit"></i><span class="break"></span>Cadastro de Requisitos não funcionais</h2>
                                <div style="float:right;  top: -9px !important;    position: relative;"> 
                                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal2">Dúvidas?</button>    
                                </div>
                                
                                </div>

                            </div>
                    <input type="hidden" name="req_id" id="req_req_id" value="<?php echo @$requisito['req_id'] ?>">
                    <input type="hidden" name="reqn_id" class="reqn_id" value="">
                    <div class="row-form">
                        <div class="span2">Nome:</div>
                        <div class="span10">
                            <input type="text" name="reqn_nome"  class="form-control validate[required] reqn_nome" value=""/>
                            <span class="bottom">Obrigatório</span>
                        </div>
                    </div>
                    <div class="row-form">
                        <div class="span2">Descrição:</div>
                        <div class="span10">
                            <textarea name="reqn_descricao"  class="form-control reqn_descricao"></textarea>
                        </div>
                    </div>
        
                    <div class="row-form">
                        <div class="span2">Obrigatório:</div>
                        <div class="span10">
                            <select name="reqn_obg" class="reqn_obg form-control validate[required]" >
                                <option value="">Selecione o Tipo</option>
                                <option value="s">Sim</option>
                                <option value="N">Não</option>
                                
                            </select>
                        </div>
                    </div>
                     <div class="row-form">
                        <div class="span2">Permanente:</div>
                        <div class="span10">
                            <select name="reqn_permanente" class="reqn_permanente form-control validate[required]" >
                                <option value="">Selecione o Tipo</option>
                                <option value="s">Sim</option>
                                <option value="N">Não</option>
                                
                            </select>
                        </div>
                    </div>                    
                    <div class="row-form">
                        <div class="span2">Tipo de requisito:</div>
                        <div class="span10"> 
                            <select name="reqn_categoria" class=" reqn_categoria form-control validate[required]" >
                                <option value="">Selecione o Tipo</option>
                                <option value="s">Segurança</option>
                                <option value="i">Interface</option>
                                <option value="p">Performace</option>
                                <option value="e">Especificação</option>
                            </select>
                            <span class="bottom">Obrigatório</span>
                        </div>
                    </div>
                    <div class="row-fluid ">
                            <div class=" offset4 span8">
                                <div class="btn-group">
                                    <button class="btn  btn-success btn-large" id="enviaReq" type="button"><span class="icon-ok icon-white"></span> Salvar</button>
                                </div>
                            </div>
                        </div>
                </form>
                <div class="box span12">
                        <div class="box-header" data-original-title="">
                            <h2><i class="halflings-icon user"></i><span class="break"></span>Requisitos do projeto</h2>
                              <div style="float:right;  top: -9px !important;    position: relative;"> 
                                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal3">Como fazer um bom levantamento de RF e RFN?</button>    
                                </div>
                        </div>
                            <div class="box-content">
                            <table class="table table-striped table-bordered bootstrap-datatable datatable dataTable" id="dataTable_usuario" aria-describedby="DataTables_Table_0_info">      
                               <thead>
                                <tr class="hidden-phone">
                                    <th width="25px">Código</th>
                                    <th width="20px">Nome</th>            
                                    <th width="20px">Categoria</th>
                                    <th width="20px">Obrigatório</th>
                                    <th width="20px">Permanente</th>
                                    <th width="20px">Ações</th>
                                </tr> 
                              </thead>   
                            <tbody role="alert" aria-live="polite" id="dataReq" aria-relevant="all">
                                <?php echo $this->funcoes->getRequisitos($requisito['req_id']); ?>
                            </tbody>
                            </table>                            
                        </div>
                    </div>
            </div>
          </div>
        <div class="row-fluid ">
         <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
            
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Requisitos Funcionais</h4>
                </div>
                <div class="modal-body">
                     <ul>
                     <li>
                     Correspondem à listagem de todas as coisas que o sistema deve fazer, ou seja, as funcionalidades que o sistema deve possuir.
                      </li>
                     </ul>

                     <ul>
                     <li>Requisitos funcionais evidentes são efetuados com conhecimento do usuário. Ex.: </li>
                      <ul>
                          <li>
                           O software deve permitir o cadastro de clientes 
                          </li>
                          <li>
                          O software deve permitir a geração de relatórios sobre as vendas do mês / trimestre. 
                          </li>
                      </ul>
                     </ul>

                     <ul>
                     <li>Requisitos funcionais ocultos são efetuados pelo sistema sem o conhecimento explícito do usuário. Ex.:</li>
                      <ul>
                          <li>
                           O software deve permitir o cadastro de clientes 
                          </li>
                          <li>
                          O software deve calcular desconto nos empréstimos em função da política da empresa. 
                          </li>
                      </ul>
                     </ul>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
              
            </div>
          </div>
          <div class="modal fade" id="myModal2" role="dialog">
            <div class="modal-dialog">
            
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Requisitos de Qualidade ou não Funcionais</h4>
                </div>
                <div class="modal-body">
                     <ul>
                     <li>
                     São atributos de qualidade ou restrições que se colocam sobre como o sistema deve realizar seus requisitos funcionais;
                      </li>
                      <li>
                          Definem os atributos do sistema enquanto ele executa seu trabalho. 
                      </li>
                     </ul>

                     <ul>
                     <li>Exemplos:</li>
                      <ul>
                          <li>
                            O Software deve ser compatível com o Windows Media Player versão x ou superior; 
                          </li>
                          <li>
                           O Software deve exibir mensagem de alerta quando o usuário executar uma operação indevida.
                          </li>
                      </ul>
                     </ul>

                     <ul>
                     <li> Onde mais aparecem os RNF: </li>
                      <ul>
                        <li>Critérios de Usabilidade; </li>
                        <li>Desempenho; </li>
                        <li>Segurança; </li>
                        <li>Restrições de Hardware e Software; </li>
                        <li>Questões sobre padronização e normatização; </li>
                        <li>Questões de Distribuição e instalação.</li>
                      </ul>
                     </ul>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
              
            </div>
          </div>

          <div class="modal fade" id="myModal3" role="dialog">
            <div class="modal-dialog">
            
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Técnicas de Levantamento de Requisitos </h4>
                </div>
                <div class="modal-body">
                     
                     <ul>
                        <li>Entrevistas </li>
                        <li>Workshop de requisitos </li>
                        <li>Brainstorm </li>
                        <li>Storyboards </li>
                        <li>Casos de uso </li>
                        <li>Role playing ou Etnografia </li>
                        <li>Prototipagem </li>
                        <li>Análise de documentos e softwares existentes</li>
                     </ul>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
              
            </div>
          </div>
          </div>
      <?php } ?> 
    </div>

    

</div>
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
        $(".alterarReq").click(function() {
             $("#req_id").val($(this).attr('codigo'));
             $("#req_nome").val($(this).attr('nome'));
             $("#req_descricao").val($(this).attr('descricao'));
             $("#req_tipo").val($(this).attr('tipo'));
             $("#req_tempo").val($(this).attr('tempo'));            
        });


        $(".excluirReq").click(function() {
            var codigo = $(this).attr('codigo');

            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: base_url + "projeto/removerRequisito/",
                data:{codigo:codigo},
                beforeSend: function(s) {
                    txt = '<option>Carregando...</option>';
                    
                },
                success: function(txt) {
                    
                     $("#req_id").val("");
                     $("#req_nome").val("");
                     $("#req_descricao").val("");
                     $("#req_tipo").val("");
                     $("#req_tempo").val("");  
                    
                    // notify('Carregamento de Cidade', 'Completado!');
                    alert('Requisito excluido com sucesso!')
                    $('#dataReq').html(retorno);
                }
            });
        });
        $("#enviaReq").click(function() {
            var pro_id = $("#req_pro_id").val();
            var form = $('#req_form');
            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: base_url + "projeto/addRequisito/",
                data: form.serialize(),
                beforeSend: function(s) {
                    txt = '<option>Carregando...</option>';
                    
                },
                success: function(txt) {
                    
                     $("#req_id").val("");
                     $("#req_nome").val("");
                     $("#req_descricao").val("");
                     $("#req_tipo").val("");
                     $("#req_tempo").val("");  
                    
                    // notify('Carregamento de Cidade', 'Completado!');
                    alert('Operação realizada com sucesso!')
                    $('#dataReq').html(retorno);
                }
            });
        });

    });

</script>
<style>
    .modal {
        margin-left:  70px;
    }
    
</style>

<div class="panel-body" style="background-color: #fff;">
    <div id="tabs">
      <ul>
        <li><a href="#cadastro">Cadastro</a></li>
        
      </ul>
      <div id="cadastro">
          <form role="form" name="frm_projeto" id="frm_projeto" action="<?php echo base_url() ?>projeto/gravar" method="post" enctype="multipart/form-data">
            <div class="widget">   
                <div class="block-fluid">  
                    <div class="row-fluid">
                        <div class="span12">      

                            <div class="widget">
                                <div class="box-header" data-original-title="">
                                    <h2  style="border-bottom: solid 1px #ccc;   margin-top: -10px;"><i class="halflings-icon edit"></i><span class="break"></span>Informações Básicas</h2>
                                    <div style="float:right;  top: -9px !important;    position: relative;"> 
                                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Algumas dicas!</button>    
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="pro_id" value="<?php echo @$projeto['pro_id'] ?>">
                            <input type="hidden" name="usu_id" value="<?php echo @$_SESSION['usu_codigo'] ?>">
                            <div class="block-fluid">
                                <div class="row-form">
                                    <div class="span2">Nome:</div>
                                    <div class="span10">
                                        <input type="text" name="pro_nome" class="form-control validate[required]" value="<?php echo @$projeto['pro_nome'] ?>"/>
                                        <span class="bottom">Obrigatório</span>
                                    </div>
                                </div>
                                 <div class="row-form">
                                    <div class="span2">Descrição Propósito do Sistema:</div>
                                    <div class="span10">
                                        <textarea name="pro_descricao" class="form-control"><?php echo @$projeto['pro_descricao'] ?></textarea>
                                    </div>
                                </div>
                                <div class="row-form">
                                    <div class="span2">Descrição Mini-Mundo:</div>
                                    <div class="span10">
                                        <textarea name="pro_minimundo" class="form-control"><?php echo @$projeto['pro_minimundo'] ?></textarea>
                                    </div>
                                </div>
                                <div class="row-form"> 
                                    <div class="span2">Responsável:</div>
                                    <div class="span10">
                                        <input type="hidden" id="cli_codigo_auxiliar" value="<?php echo @$projeto['cli_id']; ?>">
                                        <select name="cli_id" id="cli_id">
                                            <?php
                                            foreach ($estados as $reg) {
                                                $sel = "";
                                                echo $projeto['cli_id'];
                                                echo $reg['cli_id'];
                                                if ($reg['cli_id'] == $projeto['cli_id'] ) 
                                                    $sel = "selected";
                                                
                                                ?>
                                                <option value='<?php echo $reg['cli_id']; ?>' <?php echo $sel; ?> ><?php echo $reg['cli_nome']; ?></option>
                                            <?php }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                            </div>                
                        </div>                    
                        <div class="row-fluid ">
                            <div class=" offset4 span8">
                                <div class="btn-group">
                                    <button class="form-control btn btn-danger btn-large" type="button" onclick="location = '<?php echo base_url(); ?>projeto';" ><span class="icon-stop icon-white"></span> Cancelar</button>

                                    <button class="btn  btn-success btn-large" type="submit"><span class="icon-ok icon-white"></span> Salvar</button>
                                </div>
                            </div>
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
                  <h4 class="modal-title">Elaboração dos Requisitos </h4>
                </div>
                <div class="modal-body">
                     <ul>
                     <li>
                     “A parte mais difícil na construção de um sistema de software é decidir precisamente o que construir. Nenhuma outra parte do trabalho inutiliza o sistema resultante caso desenvolvida de forma errada. Nenhuma outra parte do sistema é mais difícil de retificar.”

                      </li>
                     </ul>

                     <ul>
                     <li>O que são requisitos?</li>
                      <ul>
                          <li>
                           Qualquer função ou característica que um sistema deve ter, e as restrições que deve atender ou outras propriedades que devem ser fornecidas, de forma a resolver um conjunto de problemas
                          </li>
                          <li>
                           Definem o que o sistema deve fazer e as circunstâncias sobre as quais deve operar; 
                          </li>
                          <li>
                           Definem os serviços que o sistema deve fornecer e dispõem sobre as restrições à operação do mesmo.
                          </li>
                      </ul>
                     </ul>

                     <ul>
                     <li> Papel do alanista de requisitos</li>
                      <ul>
                          <li>
                           Realizar o levantamento de requisitos e especificação de projetos de TI, desenvolvendo soluções para processos, mapeamento e análise de negócio; 
                          </li>
                          <li>
                           Elaborar a documentação técnica de especificação de requisitos de software e status report para gestão de projetos
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
        </form>
      </div>
      <!-- <?php if(@$projeto['pro_id'] != ''){ ?>
          <div id="requisitos">
            <div class="row-fluid ">
                <form role="form"  name="frm_projeto" id="req_form" >
                    <input type="hidden" name="pro_id" id="req_pro_id" value="<?php echo @$projeto['pro_id'] ?>">
                    <input type="hidden" name="req_id" id="req_id" value="">
                    <div class="row-form">
                        <div class="span2">Nome:</div>
                        <div class="span10">
                            <input type="text" name="req_nome" id="req_nome" class="form-control validate[required]" value=""/>
                            <span class="bottom">Obrigatório</span>
                        </div>
                    </div>
                    <div class="row-form">
                        <div class="span2">Descrição:</div>
                        <div class="span10">
                            <textarea name="req_descricao" id="req_descricao"  class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="row-form">
                        <div class="span2">Tempo:</div>
                        <div class="span10">
                            <input type="text" name="req_tempo" id="req_tempo"  class="form-control validate[required]" value=""/>
                            <span class="bottom">Obrigatório</span>
                        </div>
                    </div>
                    
                    <div class="row-form">
                        <div class="span2">Tipo de requisito:</div>
                        <div class="span10">
                            <select name="req_tipo" id="req_tipo"class="form-control validate[required]" >
                                <option value="">Selecione o Tipo</option>
                                <option value="F">Funcional</option>
                                <option value="NF">Não Funcional</option>
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
                        </div>
                            <div class="box-content">
                            <table class="table table-striped table-bordered bootstrap-datatable datatable dataTable" id="dataTable_usuario" aria-describedby="DataTables_Table_0_info">      
                               <thead>
                                <tr class="hidden-phone">
                                    <th width="25px">Código</th>
                                    <th width="20px">Nome</th>            
                                    <th width="20px">Tipo</th>
                                    <th width="20px">Tempo</th>
                                    <th width="20px">Ações</th>
                                </tr> 
                              </thead>   
                            <tbody role="alert" aria-live="polite" id="dataReq" aria-relevant="all">
                                <?php //echo $this->funcoes->getRequisitos($projeto['pro_id']); ?>
                            </tbody>
                            </table>                            
                        </div>
                    </div>
            </div>
          </div>
      <?php } ?> -->
    </div>
    

</div>
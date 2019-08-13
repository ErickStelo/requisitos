    <script type="text/javascript">
        $(document).ready(function() {
            $("#uf_codigo").change(function() {
                var uf_codigo = $(this).val();
                var cid_codigo = $("#uf_codigo").attr("codigoCid");

                $.ajax({
                    type: 'POST',
                    dataType: 'JSON',
                    url: base_url + "empresa/buscar_cidade/",
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

            $("#cid_codigo").change(function() {
                var cid_codigo = $(this).val();
                var bai_codigo = $("#bai_codigo").attr("codigoBai");

                $.ajax({
                    type: 'POST',
                    dataType: 'JSON',
                    url: base_url + "empresa/buscar_bairro/",
                    data: {cid_codigo: cid_codigo, bai_codigo: bai_codigo},
                    beforeSend: function(s) {
                        txt = '<option>Carregando...</option>';
                        $('#bai_codigo').html($(txt));
                    },
                    success: function(txt) {
                        console.log(txt);
                        // notify('Carregamento de Cidade', 'Completado!');
                        $('#bai_codigo').html($(txt));
                    }
                });
            });

        });

    </script>


    <div class="panel-body" style="background-color: #fff;">

        <form role="form" name="frm_usuario" id="frm_usuario" action="<?php echo base_url() ?>usuario/gravar" method="post" enctype="multipart/form-data">
    <div class="widget">   
            <div class="block-fluid">  
                <div class="row-fluid">
                    <div class="span6">      

                        <!-- <div class="widget">

                            <div class="head">
                                <div class="icon"><i class="icosg-bookmark1"></i></div>
                                <h2>Informações Básicas</h2>
                            </div>                                               
                            
                        </div> -->
                        <div class="widget">
                            <div class="box-header" data-original-title="">
                                <h2  style="border-bottom: solid 1px #ccc;   margin-top: -10px;"><i class="halflings-icon edit"></i><span class="break"></span>Informações Básicas</h2>
                            </div>
                        </div>
                        <input type="hidden" name="usu_codigo" value="<?php echo @$usuario['usu_codigo'] ?>">
                        <div class="block-fluid">
                                <div class="row-form">
                                    <div class="span2">Nome:</div>
                                    <div class="span10">
                                        <input type="text" name="usu_nome" class="form-control validate[required]" value="<?php echo @$usuario['usu_nome'] ?>"/>
                                        <span class="bottom">Obrigatório</span>
                                    </div>
                                </div>

                                <div class="row-form">
                                    <div class="span2">E-mail:</div>
                                    <div class="span10">
                                        <input type="text" name="usu_email" id="usu_email" class="form-control validate[required,custom[email]" value="<?php echo @$usuario['usu_email'] ?>"/>
                                        <span class="bottom">Obrigatório</span>
                                    </div>
                                </div>
                                <div class="row-form">
                                    <div class="span2">Senha:</div>
                                    <div class="span10">
                                        <input type="password" class="form-control" name="usu_senha" value="" id="password"/>
                                        <span class="bottom">Obrigatório</span>
                                    </div>
                                </div>                    
                                <div class="row-form">
                                    <div class="span2">Confirme a senha:</div>
                                    <div class="span10">
                                        <input type="password"  value="" class="form-control"/>
                                        <span class="bottom">Obrigatório, repita a senha</span>
                                    </div>
                                </div>
                                <div class="row-form">
                                    <div class="span2">Ativo:</div>
                                    <div class="span10">
                                        <input type="checkbox" name="usu_ativo" class="form-control" <?php if (@$usuario['usu_ativo'] == 'S' || @$usuario['usu_ativo'] == '') { ?> checked="checked" <?php } ?> class="ibtn"/>
                                    </div>
                                </div>
                            </div> 
                            <div class="row-fluid ">
                        <div class=" offset4 span8">
                            <div class="btn-group">
                                <button class="form-control btn btn-danger btn-large" type="button" onclick="location = '<?php echo base_url(); ?>usuario';" ><span class="icon-stop icon-white"></span> Cancelar</button>
                                
                                <button class="btn  btn-success btn-large" type="submit"><span class="icon-ok icon-white"></span> Salvar</button>
                            </div>
                        </div>
                    </div>
                </div>                 
                        </div>

        </div> 
            
        </form>
        
    </div>
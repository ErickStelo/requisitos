
<script type="text/javascript">

    $(document).ready(apation() {
        $("#uf_codigo").change(function() {
            var uf_codigo = $(this).val();
            var cid_codigo = $("#uf_codigo").attr("codigoCid");

            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: base_url + "aparelho/buscar_cidade/",
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
                url: base_url + "aparelho/buscar_bairro/",
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
    <form role="form" name="frm_aparelho" id="frm_aparelho" action="<?php echo base_url() ?>aparelho/gravar" method="post" enctype="multipart/form-data">
        <div class="widget">   
            <div class="block-fluid">  
                <div class="row-fluid">
                    <div class="span12">      
                        <div class="widget">
                            <div class="box-header" data-original-title="">
                                <h2  style="border-bottom: solid 1px #ccc;   margin-top: -10px;"><i class="halflings-icon edit"></i><span class="break"></span>Informações Básicas</h2>
                            </div>
                        </div>
                        <input type="hidden" name="apa_id" value="<?php echo @$aparelho['apa_id'] ?>">
                        <input type="hidden" name="apa_user_habilitador" value="<?php echo @$aparelho['apa_id'] ?>">
                        <div class="block-fluid">
                            <div class="row-form">
                                <div class="span2">Descrição:</div>
                                <div class="span10">
                                    <input type="text" name="apa_descricao" class="form-control validate[required]" value="<?php echo @$aparelho['apa_descricao'] ?>"/>
                                    <span class="bottom">Obrigatório</span>
                                </div>
                            </div>
                            <div class="row-form">
                                <div class="span2">Empresa:</div>
                                <div class="span10">
                                    <input type="hidden" id="emp_codigo_auxiliar" value="<?php echo @$aparelho['emp_id']; ?>">
                                    <select name="emp_id" id="emp_id">
                                        <?php
                                        foreach ($empresas as $reg) {
                                            $sel = "";
                                            if (isset($aparelho['emp_id']) == $reg['emp_id'])
                                                $sel = "selected";
                                            ?>
                                            <option value='<?php echo $reg['emp_id']; ?>' <?php echo $sel; ?> ><?php echo $reg['emp_nome']; ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row-form">
                                <div class="span2">Operadora:</div>
                                <div class="span10">
                                    <input type="hidden" id="emp_codigo_auxiliar" value="<?php echo @$aparelho['ope_id']; ?>">
                                    <select name="ope_id" id="ope_id">
                                        <?php
                                        foreach ($operadora as $reg) {
                                            $sel = "";
                                            if ($aparelho['ope_id'] == $reg['ope_id'])
                                                $sel = "selected";
                                            ?>
                                            <option value='<?php echo $reg['ope_id']; ?>' <?php echo $sel; ?> ><?php echo $reg['ope_descricao']; ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row-form">
                                <div class="span2">Data:</div>
                                <div class="span10">
                                    <input type="date" name="apa_dtcadastro" id="apa_dtcadastro" class="form-control validate[required]" value="<?php echo @$aparelho['apa_dtcadastro'] ?>"/>
                                    <span class="bottom">Obrigatório</span>
                                </div>
                            </div>

                            <div class="row-form">
                                <div class="span2">Telefone:</div>
                                <div class="span10">
                                    <input type="text" name="apa_fone" class="form-control" value="<?php echo @$aparelho['apa_fone'] ?>"/>
                                    <span class="bottom">Ex fone: (54)3045-6514</span>
                                </div>
                            </div>
                            <div class="row-form">
                                <div class="span2">IMEI:</div>
                                <div class="span10">
                                    <input type="text" name="apa_imei" class="" value="<?php echo @$aparelho['apa_imei'] ?>" />
                                </div>
                            </div>
                           
                             <div class="row-form">
                                <div class="span2">Senha:</div>
                                <div class="span10">
                                    <input type="password" class="form-control" name="apa_senha" value="" id="password"/>
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
                                    <input type="checkbox" name="apa_tipoativo" class="form-control checkbox inline" <?php if (@$aparelho['apa_tipoativo'] == 1 || @$aparelho['apa_tipoativo'] != '') { ?> checked="checked" <?php } ?> id="inlineCheckbox1"/>
                                </div>
                            </div>
                        </div>                
                    </div>
                    <div class="row-fluid ">
                        <div class=" offset4 span8">
                            <div class="btn-group">
                                <button class="form-control btn btn-danger btn-large" type="button" onclick="location = '<?php echo base_url(); ?>aparelho';" ><span class="icon-stop icon-white"></span> Cancelar</button>

                                <button class="btn  btn-success btn-large" type="submit"><span class="icon-ok icon-white"></span> Salvar</button>
                            </div>
                        </div>
                    </div>
                </div>  
            </div> 
        </div> 

    </form>

</div>
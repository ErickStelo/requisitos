
<script type="text/javascript">

    $(document).ready(apation() {
        $("#uf_codigo").change(function() {
            var uf_codigo = $(this).val();
            var cid_codigo = $("#uf_codigo").attr("codigoCid");

            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: base_url + "operadora/buscar_cidade/",
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
                url: base_url + "operadora/buscar_bairro/",
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
    <form role="form" name="frm_operadora" id="frm_operadora" action="<?php echo base_url() ?>operadora/gravar" method="post" enctype="multipart/form-data">
        <div class="widget">   
            <div class="block-fluid">  
                <div class="row-fluid">
                    <div class="span12">      
                        <div class="widget">
                            <div class="box-header" data-original-title="">
                                <h2  style="border-bottom: solid 1px #ccc;   margin-top: -10px;"><i class="halflings-icon edit"></i><span class="break"></span>Informações Básicas</h2>
                            </div>
                        </div>
                        <input type="hidden" name="ope_id" value="<?php echo @$operadora['ope_id'] ?>">
                        <div class="block-fluid">
                            <div class="row-form">
                                <div class="span2">Descrição:</div>
                                <div class="span10">
                                    <input type="text" name="ope_descricao" class="form-control validate[required]" value="<?php echo @$operadora['ope_descricao'] ?>"/>
                                    <span class="bottom">Obrigatório</span>
                                </div>
                            </div>
                        </div>                
                    </div>
                    <div class="row-fluid ">
                        <div class=" offset4 span8">
                            <div class="btn-group">
                                <button class="form-control btn btn-danger btn-large" type="button" onclick="location = '<?php echo base_url(); ?>operadora';" ><span class="icon-stop icon-white"></span> Cancelar</button>

                                <button class="btn  btn-success btn-large" type="submit"><span class="icon-ok icon-white"></span> Salvar</button>
                            </div>
                        </div>
                    </div>
                </div>  
            </div> 
        </div> 

    </form>

</div>
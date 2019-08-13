<script type="text/javascript">
    function requisitar(codigo)
    {
        //requisição ajax
        $.ajax({
            url: '<?php echo base_url() ?>operadora/excluir',
            dataType: 'json',
            type: 'POST',
            timeout: 4000,
            data: {id: codigo},
            success: function(xml) {
                if (xml == 1) {
                    alert("Registro deletado com sucesso!");
                    location.reload();
                } else {
                    console.log("Problema ao deletar");
                    location.reload();
                }
            },
            error: function(requisicaoAjax, erro) {
                if (erro == 'timeout') {
                    alert('Ops! Ocorreu um erro de timeout');
                } else {
                    var msgErro = "Erro: " + erro + "\n";
                    msgErro += "Codigo: " + requisicaoAjax.status + "\n";
                    msgErro += "Mensagem: Registro esta sendo usado !" ;

                    alert(msgErro);
                }
            }
        }); //fecha ajax

    }
    $(document).ready(function() {
        $(".excluir").click(function() {
            
            var codigo = $(this).attr("codigo");
            if (confirm("Deseja excluir o registro!")) {
                requisitar(codigo);
            }
        });

    });
</script>
<div class="panel-body" style="background-color: #fff;">
    <h2> Cadastro operadoras </h2>
    <h2 align="right">
        <a href="<?php echo base_url() ?>operadora/edt/" class="btn btn-success"> Novo Registro </a> <br>
    </h2>
    <div class="row-fluid sortable ui-sortable">        
        <div class="box span12">
            <div class="box-header" data-original-title="">
                <h2><i class="halflings-icon user"></i><span class="break"></span>Operadoras</h2>
            </div>
            <div class="box-content">
                <table class="table table-striped table-bordered bootstrap-datatable datatable dataTable" id="dataTable_operadora" aria-describedby="DataTables_Table_0_info">      
                    <thead>
                        <tr width="33px" class="hidden-phone">
                            <th width="33px">Código</th>
                            <th width="33px">Descição</th>
                            <th width="33px">Aççoes</th>
                        </tr> 
                    </thead>   
                    <tbody role="alert" aria-live="polite" aria-relevant="all">
                    <?php foreach ($operadora as $u) { ?>

                        <tr>
                            <td width="33px"><?php echo $u['ope_id'] ?></td>
                            <td width="33px"><?php echo $u['ope_descricao'] ?></td>
                            <td>
                                <section></section>
                                <a href="<?php echo base_url() ?>operadora/edt/<?php echo $u['ope_id']; ?>"><button class="btn btn-primary btn-xs"><i class="icon-pencil"></i></button></a>
                                <button  codigo="<?php echo $u['ope_id']; ?>" class="btn btn-danger btn-xs excluir"><i class="icon-trash"></i></button>
                                </section>
                            </td>   
                        </tr> 
                    <?php } ?>
                    </tbody>
                </table>

            </div>
        </div><!--/span-->

    </div>
</div>
<div class="panel-body" style="background-color: #fff;">
    <div class="row-fluid sortable ui-sortable">        
        <!-- <div class="box span12">
            <form role="form" name="frm_operadora" id="frm_operadora" action="<?php echo base_url() ?>operadora/gravar" method="post" enctype="multipart/form-data">
                <div class="box-content">
                    Data:
                    <input type="date" class="datapicker" value="">

                </div>
            </form>
        </div> -->
        <div class="box span12">
            <div class="box-header" data-original-title="">
                <h2><i class="halflings-icon user"></i><span class="break"></span>Relatórios</h2>
                <br />
            </div>
            <div class="box-content">
                <table class="table table-striped table-bordered bootstrap-datatable datatable dataTable" id="dataTable_operadora" aria-describedby="DataTables_Table_0_info">      

                    <thead>
                        <tr>
							<th width="15%">ID</th>
                            <th width="15%">Data Início</th>
                            <th width="15%">Data Fim</th>
                            <th width="20%">Local</th>
                            <th width="15%" class="TAC">Funcionario</th>
                            <th width="15%" class="TAC">Aparelho</th>

                        </tr>
                    </thead>
                    <tbody role="alert" aria-live="polite" aria-relevant="all">
                        <?php foreach ($regs as $key => $value) { ?>
                            <tr>
								<td class="TAC"><?php echo $value['gps_pos_codigo']; ?></td>                        
                                <td><?php echo $this->funcoes->formataDataeHora($value['gps_pos_datahoracoleta_ini']); ?></td>
                                <td><?php if(isset($value['gps_pos_datahoracoleta_fim'])){echo $this->funcoes->formataDataeHora($value['gps_pos_datahoracoleta_fim']);} ?></td>
                                <td><?php echo $this->funcoes->retorna_coordenada($value['gps_pos_coordenada_ini']); ?></td>
                                <td class="TAC"><?php echo $value['func_nome']; ?></td>                        
                                <td class="TAC"><?php echo $value['apa_fone']; ?></td>                        

            <!--<td class="TAC"><?php echo $value['apa_user_habilitador']; ?></td>-->
                            </tr>
                        <?php } ?>                        
                    </tbody>
                </table>                    
            </div>    
        </div>  
    </div>
</div>
<script type="text/javascript">

</script>
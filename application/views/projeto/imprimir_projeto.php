<script type="text/javascript">
   
</script>
<div class="row-fluid sortable ui-sortable">
                <div class="box span12">
                    <div class="box-header">
                        <h2><i class="halflings-icon font"></i><span class="break"></span>Imprimir</h2>
                    </div>
                    <div class="box-content">
                          <div class="page-header">
                              <h1>APSE <br><small>Documento de Especificação de Requisitos</small></h1>
                          </div>     
                          <div class="row-fluid">            
                              <div class="span12">
                                <h3><?php echo $projeto['pro_nome'] ?></h3>
                                <h2>Descrição do propósito do sistema</h2>
                                <p>
                                    <?php echo $projeto['pro_descricao'] ?>
                                </p>
                                <h2>Descrição do Mini Mundo</h2>
                                <p>
                                    <?php echo $projeto['pro_minimundo'] ?>
                                </p>
                                <h2>Requisitos Funcionais</h2>
                                <?php foreach ($requisitos_funcionais as $key => $value) { ?>
                                    
                                    <p><?php echo $value['req_nome'] ?> . <?php echo $value['req_descricao'] ?></p>
                                <? } ?>
                                
                                <h2>Requisitos não Funcionais</h2>
                                <?php foreach ($requisitos_nao_funcionais as $key => $value) { ?>
                                    <p><?php echo $value['reqn_nome'] ?> . <?php echo $value['reqn_descricao'] ?></p>
                                <? } ?>
                                <br>
                                <br>
                                <br>
                                <?php foreach ($requisitos_funcionais as $key => $value) { ?>
                                <table width="70%" border="1">
                                    
                                    <tr align="center"><td colspan="5" style="font-weight:600;"> Requisitos Funcionais</td></tr>
                                    <tr>
                                        <td colspan="2" width="65%">
                                            <?php echo $value['req_nome'] ?>
                                        </td>
                                        <td colspan="3" width="25%">
                                            <?php echo $value['req_categoria'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="5"><?php echo $value['req_descricao'] ?></td>
                                    </tr>

                                    <tr  align="center"><td colspan="5" style="font-weight:600;">Requisitos não Funcionais</td></tr>
                                    <tr>
                                        <td width="25%">Nome</td>
                                        <td width="15%">Restrição</td>
                                        <td width="15%">Categoria</td>
                                        <td width="11%">Obrigatório</td>
                                        <td width="11%">Permanente</td>
                                    </tr>
                                    
                                    <?php foreach ($requisitos_nao_funcionais as $key2 => $value2) { ?>
                                        <?php if ($value['req_id'] == $value2['req_id']) { ?>   
                                            <tr>
                                            <td><?php echo $value2['reqn_nome'];?></td>
                                            <td><?php echo $value2['reqn_descricao'];?></td>
                                            <td>
                                            <?php 
                                             if($value2['reqn_categoria'] == 's'){
                                                echo "Segurança";
                                             }else if ($value2['reqn_categoria'] == 'i') {
                                                 echo "Interface";
                                             }else if ($value2['reqn_categoria'] == 'e') {
                                                 echo "Especificação";
                                             }else if ($value2['reqn_categoria'] == 'p') {
                                                 echo "Performance";
                                             }
                                            ?></td>
                                            <td><?php if($value2['reqn_obg'] == "s"){ echo "SIM"; }else {echo "NÃO"; }?></td>
                                            <td><?php if($value2['reqn_permanente'] == "s"){ echo "SIM"; } else {echo "NÃO"; } ?>
                                            </tr>
                                        <? }  ?>
                                    <? } ?>
                                    
                                </table>
                                <?php } ?>
                              </div>
                          </div>
                      </div><!--/row -->                           
                        
                        <?php //echo  "<pre>"; print_r($projeto); ?>
                        <?php //echo  "<pre>"; print_r($requisitos_funcionais); ?>
                        <?php //echo  "<pre>"; print_r($requisitos_nao_funcionais); ?>
                </div><!--/span
                
                <div class="box span3">
                    <div class="box-header" data-original-title="">
                        <h2><i class="halflings-icon list"></i><span class="break"></span>Unordered List</h2>
                    </div>
                    <div class="box-content">
                        <ul>
                          <li>Lorem ipsum dolor sit amet</li>
                          <li>Consectetur adipiscing elit</li>
                          <li>Integer molestie lorem at massa</li>
                          <li>Facilisis in pretium nisl aliquet</li>
                          <li>Nulla volutpat aliquam velit
                            <ul>
                              <li>Phasellus iaculis neque</li>
                              <li>Purus sodales ultricies</li>
                              <li>Vestibulum laoreet porttitor sem</li>
                              <li>Ac tristique libero volutpat at</li>
                            </ul>
                          </li>
                          <li>Faucibus porta lacus fringilla vel</li>
                          <li>Aenean sit amet erat nunc</li>
                          <li>Eget porttitor lorem</li>
                        </ul>            
                    </div>
                </div>
                
                <div class="box span3">
                    <div class="box-header" data-original-title="">
                        <h2><i class="halflings-icon list"></i><span class="break"></span>Ordered List</h2>
                    </div>
                    <div class="box-content">
                        <ol>
                          <li>Lorem ipsum dolor sit amet</li>
                          <li>Consectetur adipiscing elit</li>
                          <li>Integer molestie lorem at massa</li>
                          <li>Facilisis in pretium nisl aliquet</li>
                          <li>Nulla volutpat aliquam velit</li>
                          <li>Faucibus porta lacus fringilla vel</li>
                          <li>Aenean sit amet erat nunc</li>
                          <li>Eget porttitor lorem</li>
                        </ol>           
                    </div>
                </div>
                
                <div class="box span3">
                    <div class="box-header" data-original-title="">
                        <h2><i class="halflings-icon list"></i><span class="break"></span>Description List</h2>
                    </div>
                    <div class="box-content">
                        <dl>
                          <dt>Description lists</dt>
                          <dd>A description list is perfect for defining terms.</dd>
                          <dt>Euismod</dt>
                          <dd>Vestibulum id ligula porta felis euismod semper eget lacinia odio sem nec elit.</dd>
                          <dd>Donec id elit non mi porta gravida at eget metus.</dd>
                          <dt>Malesuada porta</dt>
                          <dd>Etiam porta sem malesuada magna mollis euismod.</dd>
                        </dl>            
                    </div>
                </div><!--/span-->
                 
                
            
            </div>
<!DOCTYPE html>
<html lang="en">
    <head>

        <!-- start: Meta -->
        <meta charset="utf-8">

        <title>Administrativo</title>

        <!-- Bootstrap core CSS -->
        <meta name="description" content="Bootstrap Metro Dashboard">
        <meta name="author" content="Dennis Ji">
        <meta name="keyword" content="Metro, Metro UI, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
        <!-- end: Meta -->

        <!-- start: Mobile Specific -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- end: Mobile Specific -->
        <!-- start: JavaScript-->

<!--<script src="<?php echo base_url() ?>assets/js/jquery-1.9.1.min.js"></script>-->	
        <script src='<?php echo base_url() ?>assets/js/jquery-1.12.3.js'></script>
         <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url() ?>assets/js/jquery.multi-select.js"></script>
        <script src='<?php echo base_url() ?>assets/js/jquery.mask.min.js'></script>
        <script src='https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js'></script>
        <script src='<?php echo base_url() ?>assets/js/notify.js'></script>
        
        <!-- end: JavaScript-->
        <!-- start: CSS -->
        <link id="bootstrap-style" href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>assets/css/bootstrap-responsive.min.css" rel="stylesheet">
<!--	<link id="base-style" href="<?php echo base_url() ?>assets/css/datatable-bootstrap.css" rel="stylesheet">-->
        <link id="base-style" href="<?php echo base_url() ?>assets/css/datatable.css" rel="stylesheet">
        <link id="base-style" href="<?php echo base_url() ?>assets/css/jquery.dataTables.min.css" rel="stylesheet">
        <link id="base-style-responsive" href="<?php echo base_url() ?>assets/css/style.css" rel="stylesheet">
        <link id="base-style-responsive" href="<?php echo base_url() ?>assets/css/multi-select.css" rel="stylesheet">
        <link id="base-style-responsive" href="<?php echo base_url() ?>assets/css/style-responsive.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>
        <link rel="shortcut icon" href="img/favicon.ico">
        <!-- end: Favicon -->
        <script type="text/javascript">
            var base_url = '<?php echo base_url(); ?>';
            var constants = <?php echo @json_encode((get_defined_constants() == '') ? get_defined_constants() : 0); ?>;
            $(document).ready(function() {
                $('.dataTable').DataTable({
                    "pagingType": "full_numbers",
                    language:{
                        "decimal":"","emptyTable":     "No data available in table","info":           "Mostrando _START_ de _END_ de _TOTAL_ registros","infoEmpty":      "Mostrando 0 de 0 de 0 registros","infoFiltered":   "(filtered from _MAX_ total entries)","infoPostFix":    "","thousands":      ",","lengthMenu":     "Mostrando _MENU_ registros","loadingRecords": "Loading...","processing":     "Processando...","search":         "Pesquisa:","zeroRecords":    "Resultados não encontrados",
                        "paginate": {
                            "first":      "Primeiro","last":       "Último","next":       "Próximo","previous":   "Anterior"
                        },"aria": {"sortAscending":  ": activate to sort column ascending","sortDescending": ": activate to sort column descending"}

                    }
                });
            });
                
            
        </script>

        <script type="text/javascript" >

            $(document).ready(function() {
                $('.date').mask('00/00/0000');
                $('.date_time').mask('00/00/0000 00:00:00');
                $('.cep').mask('00000-000');
                $('.phone_with_ddd').mask('(00) 0000-0000');
                $('.mixed').mask('AAA 000-S0S');
                $('.cpf').mask('000.000.000-00', {reverse: true});
                $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
                $('.money').mask('000.000.000.000.000,00', {reverse: true});
                $('.money2').mask("#.##0,00", {reverse: true});
            })
        </script>
    </head>

    <body>

        <?php
        $sessao = $this->session->all_userdata();
        ?>
        <!-- start: Header -->
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="index.html"><span>Paintel Requisitos Online</span></a>

                    <!-- start: Header Menu -->
                    <div class="nav-no-collapse header-nav">
                        <ul class="nav pull-right">
                            <!-- start: User Dropdown -->
                            <li class="dropdown">
                                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="halflings-icon white user"></i><?php echo $sessao['usuario']['usu_nome']; ?>
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="dropdown-menu-title">
                                        <span>Dados do usuário</span>
                                    </li>
                                    <li><a href="<?php echo base_url() ?>usuario/edt/<?php echo $sessao['usuario']['usu_codigo']; ?>"><i class="halflings-icon user"></i> Perfil</a></li>
                                    <li><a href="<?php echo base_url() ?>/login/logout"><i class="halflings-icon off"></i> Sair</a></li>
                                </ul>
                            </li>
                            <!-- end: User Dropdown -->
                        </ul>
                    </div>
                    <!-- end: Header Menu -->
                </div>
            </div>
        </div>
        <!-- start: Header -->

        <div class="container-fluid-full">
            <div class="row-fluid">

                <!-- start: Main Menu -->
                <div id="sidebar-left" class="span2">
                    <div class="nav-collapse sidebar-nav">
                        <ul class="nav nav-tabs nav-stacked main-menu">
                            <li><a href="<?php echo base_url() ?>home"> Dashboard </a></li>	
                            <li> <a href="<?php echo base_url() ?>usuario"> Usuarios <i style="    margin-left: 10%;" class="icon-user"></i>  </a></li>
                            <li> <a href="<?php echo base_url() ?>projeto"> Projeto <i style="    margin-left: 10%;" class="icon-briefcase"></i>  </a></li>
                            <li> <a href="<?php echo base_url() ?>requisitos"> Requisitos <i style="    margin-left: 10%;" class="icon-briefcase"></i>  </a></li>
                            <li> <a href="<?php echo base_url() ?>cliente"> Responsável <i style=" margin-left: 10%;" class="icon-flag"></i>  </a></li>
                            <!-- <li>
                                <a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Relatórios</span>  &nbsp;<span class="label"> 1 </span></a>
                                <ul style="display: block;">
                                    <li><a class="submenu" href="<?php echo base_url() ?>relatorio"><i class="icon-file-alt"></i><span class="hidden-tablet"> Horários Registrados</span></a></li>
                                </ul>	
                            </li> -->
                        </ul>
                    </div>
                </div>
                <!-- end: Main Menu -->

                <noscript>
                <div class="alert alert-block span10">
                    <h4 class="alert-heading">Warning!</h4>
                    <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
                </div>
                </noscript>

                <!-- start: Content -->
                <div id="content" style=" min-height: 664px !important;" class="span10">
                    <div class="main-content">
                        <ul class="breadcrumb">
                            <li>
                                <i class="icon-home"></i>
                                <a href="index.html">Home</a> 
                                <i class="icon-angle-right"></i>
                            </li>
                            <li><a href="#">Dashboard</a></li>
                        </ul>
                        <?php echo $contents; ?>
                    </div> 

                    <!-- end: Content -->
                </div><!--/#content.span10-->
            </div><!--/fluid-row-->
        </div>
        <div class="clearfix"></div>

        <footer>

            <p>
                <span style="text-align:left;float:right">&copy; 2013 <a href="http://jiji262.github.io/Bootstrap_Metro_Dashboard/" alt="Bootstrap_Metro_Dashboard">Bootstrap Metro Dashboard</a></span>

            </p>

        </footer>   


        <script>
            var resizeHandler = function() {
                var $contentHeight = $(window).height();
                
                $(".container-fluid-full").css({
                    'min-height': $contentHeight + 45
                });

            }

            resizeHandler();


            $(window).resize(function() {
                resizeHandler();
            });

        </script>


    </body>
</html>

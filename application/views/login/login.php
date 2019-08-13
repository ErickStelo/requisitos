<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="keyword" content="Vinicius Maciel">
        <link rel="shortcut icon" href="img/favicon.png">

        <title>Requisitos Online</title>

        <script src="<?php echo base_url() ?>assets/js/jquery.js"></script>
        <script src="<?php echo base_url() ?>assets/js/jquery-1.8.3.min.js"></script>
        <meta name="description" content="Bootstrap Metro Dashboard">
        <meta name="author" content="Dennis Ji">
        <meta name="keyword" content="Metro, Metro UI, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
        <link id="bootstrap-style" href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>assets/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link id="base-style" href="<?php echo base_url() ?>assets/css/style.css" rel="stylesheet">
        <link id="base-style-responsive" href="<?php echo base_url() ?>assets/css/style-responsive.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>

        <!-- end: Meta -->


        <script src="<?php echo base_url() ?>assets/js/jquery-1.9.1.min.js"></script>
        <script src="<?php echo base_url() ?>assets/js/jquery-migrate-1.0.0.min.js"></script>

        <script src="<?php echo base_url() ?>assets/js/jquery-ui-1.10.0.custom.min.js"></script>

        <script src="<?php echo base_url() ?>assets/js/jquery.ui.touch-punch.js"></script>

        <script src="<?php echo base_url() ?>assets/js/modernizr.js"></script>

        <script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>

        <script src="<?php echo base_url() ?>assets/js/jquery.cookie.js"></script>

        <script src='js/fullcalendar.min.js'></script>

        <script src='js/jquery.dataTables.min.js'></script>
        <script src="<?php echo base_url() ?>assets/js/excanvas.js"></script>
        <script src="<?php echo base_url() ?>assets/js/jquery.flot.js"></script>
        <script src="<?php echo base_url() ?>assets/js/jquery.flot.pie.js"></script>
        <script src="<?php echo base_url() ?>assets/js/jquery.flot.stack.js"></script>
        <script src="<?php echo base_url() ?>assets/js/jquery.flot.resize.min.js"></script>
        <script src="<?php echo base_url() ?>assets/js/jquery.chosen.min.js"></script>
        <script src="<?php echo base_url() ?>assets/js/jquery.uniform.min.js"></script>
        <script src="<?php echo base_url() ?>assets/js/jquery.cleditor.min.js"></script>
        <script src="<?php echo base_url() ?>assets/js/jquery.noty.js"></script>
        <script src="<?php echo base_url() ?>assets/js/jquery.elfinder.min.js"></script>
        <script src="<?php echo base_url() ?>assets/js/jquery.raty.min.js"></script>
        <script src="<?php echo base_url() ?>assets/js/jquery.iphone.toggle.js"></script>
        <script src="<?php echo base_url() ?>assets/js/jquery.uploadify-3.1.min.js"></script>
        <script src="<?php echo base_url() ?>assets/js/jquery.gritter.min.js"></script>
        <script src="<?php echo base_url() ?>assets/js/jquery.imagesloaded.js"></script>
        <script src="<?php echo base_url() ?>assets/js/jquery.masonry.min.js"></script>
        <script src="<?php echo base_url() ?>assets/js/jquery.knob.modified.js"></script>
        <script src="<?php echo base_url() ?>assets/js/jquery.sparkline.min.js"></script>	
        <script src="<?php echo base_url() ?>assets/js/counter.js"></script>
        <script src="<?php echo base_url() ?>assets/js/retina.js"></script>
        <script src="<?php echo base_url() ?>assets/js/custom.js"></script>
        <!-- start: Mobile Specific -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="shortcut icon" href="img/favicon.ico">
        <!-- end: Favicon -->

        <style type="text/css">
            body { background: url(<?php echo base_url(); ?>/assets/img/bg-login.jpg?<?php time(); ?>) !important; }
        </style>

    </head>
    <body>
        <div class="container-fluid-full">
            <?php if(isset($error)){ ?>
            <div class="col-lg-12">
                <div class="alert alert-danger fade in">
                    <button type="button" class="close close-sm" data-dismiss="alert">
                        <i class="icon-remove"></i>
                    </button>
                    Dados de Login Inválidos
                </div>
            </div>
            <?php } ?>
            <?php if(isset($not_logged)){ ?>
            <div class="col-lg-12">
                <div class="alert alert-danger fade in">
                    <button type="button" class="close close-sm" data-dismiss="alert">
                        <i class="icon-remove"></i>
                    </button>
                    Usuário não autenticado
                </div>
            </div>
            <?php } ?>
            
            <div class="row-fluid">

                <div class="row-fluid">
                    <div class="login-box">
                        <div class="icons">
                            <a href="index.html"><i class="halflings-icon home"></i></a>
                            <a href="#"><i class="halflings-icon cog"></i></a>
                        </div>
                        <h2>PÁGINA DE ACESSO</h2>
                        <form class="form-horizontal" action="<?php echo base_url(); ?>login/autenticar" method="post">
                            <fieldset>

                                <div class="input-prepend" title="Usuário">
                                    <span class="add-on"><i class="halflings-icon user"></i></span>
                                    <input class="input-large span10"  name="login" id="username" type="text" placeholder="type username"/>
                                </div>
                                <div class="clearfix"></div>

                                <div class="input-prepend" title="Senha">
                                    <span class="add-on"><i class="halflings-icon lock"></i></span>
                                    <input class="input-large span10" name="senha" id="password" type="password" placeholder="type password"/>
                                </div>
                                <div class="clearfix"></div>
                                <div class="button-login">	
                                    <button type="submit" class="btn btn-primary">Login</button>
                                </div>
                                <div class="clearfix"></div>
                        </form>
                        
                    </div><!--/span-->
                </div><!--/row-->


            </div><!--/.fluid-container-->

        </div><!--/fluid-row-->

        <!-- start: JavaScript-->

        <!-- end: JavaScript-->

    </body>
</html>

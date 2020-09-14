<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script type="text/javascript" src="<?php echo base_url('public/js/solicitud.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('public/js/comision.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('public/js/mensajero.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('public/js/actividad.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('public/js/ruta.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('public/js/close.js') ?>"></script>



    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/estilo.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/chosen/chosen.min.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/confirm/jquery-confirm.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/cssmante.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/main.css') ?>">

    <script type="text/javascript" src="<?php echo base_url('public/js/jquerypro.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('public/chosen/chosen.jquery.min.js'); ?>"></script>
    <script tyoe="text/javascript" src="<?php echo base_url('public/confirm/jquery-confirm.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('public/js/mensajero.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('public/bootstrap/js/bootstrap.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('public/js/jquery-ui.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('public/js/notify.js') ?>"></script>


    <title>Mensajeria</title>
</head>

<body>
    <nav class="navbar navbar-default navbar-fixed-top" style="box-shadow: 0 0 8px rgba(0,0,0,0.3);">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"
                    style="color:#565656;"><?php if(isset($navtext)) { echo $navtext;} ?></a>
            </div>
            <?php if (isset($form)): 
    
    ?>
            <?php $this->load->view($form); ?>
            <?php endif ?>


        </div>
    </nav>


    <br>

    <?php
if (isset($vista)) {
  
	$this->load->view($vista);
}
?>
   

</body>

</html>
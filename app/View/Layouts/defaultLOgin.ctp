<!DOCTYPE html>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pol-ka</title>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/excanvas.min.js"></script><![endif]-->
<?php
	//Cargando archivos nuestros');

	echo $this->Html->script('operacionesBasicas');
	echo $this->Html->script('mootools.js');
	echo $this->Html->script('Render');
	echo $this->Html->script('RenderTranslator');
	echo $this->Html->script('ComponentTranslator');
	echo $this->Html->script('ServerManager');
	echo $this->Html->script('SideBarController');
	//Cargando archivos del template');
	echo $this->Html->css('style.default');
	echo $this->Html->script('jsTemplate/prettify/prettify');
	echo $this->Html->script('jsTemplate/jquery-1.9.1.min');
	echo $this->Html->script('jsTemplate/jquery-migrate-1.1.1.min');
	echo $this->Html->script('jsTemplate/jquery-ui-1.9.2.min');
	echo $this->Html->script('jsTemplate/jquery.uniform.min');
	echo $this->Html->script('jsTemplate/jquery.cookie');
	echo $this->Html->script('jsTemplate/bootstrap.min');
	echo $this->Html->script('jsTemplate/jquery.flot.min');
	echo $this->Html->script('jsTemplate/jquery.flot.resize.min');
	echo $this->Html->script('jsTemplate/jquery.dataTables.min');
	echo $this->Html->script('jsTemplate/jquery.notifications');
	//echo $this->Html->css('demo_table');
	//echo $this->Html->css('demo_page');

	echo $this->Html->script('jsTemplate/custom');
	echo $this->Html->script('jsTemplate/uploadForm');
	echo $this->Html->script('jsTemplate/forms');


	echo $this->Html->css('styleTest');
	echo $this->Html->script('jsTemplate/modernizr.custom.26887');
	echo $this->Html->script('jsTemplate/jquery.imgslider');
	echo $this->Html->script('jsTemplate/jquery.growl');
	echo $this->Html->css('jquery.growl');
	echo $this->Html->script('jsTemplate/jquery.validate');

	echo $this->fetch('css');
	echo $this->fetch('script');

?>

<body>
<div class="users form">
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('Usuario'); ?>
    <fieldset>
        <legend><?php echo __('Please enter your username and password'); ?></legend>
        <?php echo $this->Form->input('username');
        echo $this->Form->input('password');
    ?>
    </fieldset>
    <li class="active animate5 fadeInUp"><a href="/InvenPolka/Usuario/login"><span class="icon-align-justify"></span> Inicio</a></li>    
    <a id="/InvenPolka/Usuarios/Login" class="option"><span class="icon-th-list"></span> Proyectos</a>
<button class="btn btn-primary edit">Guardar</button>
    
<?php echo $this->Form->end(); ?>
</div>

</body>


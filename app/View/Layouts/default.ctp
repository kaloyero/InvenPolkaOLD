<!DOCTYPE html>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pol-ka</title>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/excanvas.min.js"></script><![endif]-->
<?php

        echo $this->Html->script('operacionesBasicas');
        echo $this->Html->script('mootools.js');
        echo $this->Html->script('Render');
        echo $this->Html->script('RenderTranslator');
        echo $this->Html->script('Articulo');
        echo $this->Html->script('Pedido');
        echo $this->Html->script('PedidoSalida');
        echo $this->Html->script('PedidoHisto');
        echo $this->Html->script('Deposito');
        echo $this->Html->script('MovimientoInventario');
        echo $this->Html->script('Inventario');
        echo $this->Html->script('Proyecto');

        echo $this->Html->script('Categoria');
        echo $this->Html->script('Usuario');
        echo $this->Html->script('Material');
        echo $this->Html->script('Estilo');
        echo $this->Html->script('Objeto');
        echo $this->Html->script('Decorado');
        echo $this->Html->script('Dimension');
        echo $this->Html->script('Proyecto');
        echo $this->Html->script('Deposito');
        echo $this->Html->script('Inventario');
        echo $this->Html->script('Message');

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
		//echo $this->Html->script('jsTemplate/forms');

        echo $this->Html->css('styleTest');
        echo $this->Html->script('jsTemplate/modernizr.custom.26887');
        echo $this->Html->script('jsTemplate/jquery.imgslider');
        echo $this->Html->script('jsTemplate/jquery.growl');
        echo $this->Html->css('jquery.growl');
        echo $this->Html->script('jsTemplate/jquery.validate');
        echo $this->Html->script('libs/md5');

        echo $this->fetch('css');
        echo $this->fetch('script');?>

<link id="skinstyle" rel="stylesheet" href="css/style.dark.css" type="text/css" />

</head>

<body>

<div id="principal" class="loginwrapper">

	<div class="loginwrap zindex100 animate2 bounceInDown">
	<h1 class="logintitle"><span class="iconfa-lock"></span> LOGIN <span class="subtitle">Bienvenido al sistema de inventarios de POL-KA</span></h1>
        <div class="loginwrapperinner">
<?php echo $this->Form->create('Usuario',array('id'=>'loginform' ,'class' => 'stdform stdform2','inputDefaults' => array(
        'div' => array('class' => 'field'))));
?>
                <p class="animate4 bounceIn"><input type="text" id="username" name="username" placeholder="Usuario" /></p>
                <p class="animate5 bounceIn"><input type="password" id="password" name="password" placeholder="Contraseña" /></p>
                <p class="animate6 bounceIn"><button class="btn btn-default btn-block">Entrar</button></p>
<?php echo $this->Form->end()?>
        </div><!--loginwrapperinner-->
    </div>
    <div class="loginshadow animate3 fadeInUp"></div>
</div><!--loginwrapper-->

<script type="text/javascript">
jQuery.noConflict();

jQuery(document).ready(function(){
    this.type="usuario";
	jQuery('head').append('<link id="skinstyle" rel="stylesheet" href="css/style.dark.css" type="text/css" />');
	var anievent = (jQuery.browser.webkit)? 'webkitAnimationEnd' : 'animationend';
	jQuery('.loginwrap').bind(anievent,function(){
		jQuery(this).removeClass('animate2 bounceInDown');
	});

	jQuery('#username,#password').focus(function(){
		if(jQuery(this).hasClass('error')) jQuery(this).removeClass('error');
	});
	jQuery('#loginform button').click(function(){

		if(!jQuery.browser.msie) {
			if(jQuery('#username').val() == '' || jQuery('#password').val() == '') {
				if(jQuery('#username').val() == '') jQuery('#username').addClass('error'); else jQuery('#username').removeClass('error');
				if(jQuery('#password').val() == '') jQuery('#password').addClass('error'); else jQuery('#password').removeClass('error');
				jQuery('.loginwrap').addClass('animate0 wobble').bind(anievent,function(){
					jQuery(this).removeClass('animate0 wobble');
				});
			} else {
				jQuery('.loginwrapper').addClass('animate0 fadeOutUp').bind(anievent,function(){

				});
				translator.loginUser(self.type,jQuery('#loginform'));
			}
			return false;
		}
	});
});
</script>
</body>
</html>

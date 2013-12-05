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
	echo $this->Html->script('Articulo');
	echo $this->Html->script('Pedido');
	echo $this->Html->script('PedidoSalida');
	echo $this->Html->script('PedidoHisto');
	echo $this->Html->script('Deposito');
	echo $this->Html->script('MovimientoInventario');
	echo $this->Html->script('Inventario');
	echo $this->Html->script('Proyecto');

	echo $this->Html->script('Categoria');
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
	echo $this->Html->script('jsTemplate/forms');




	echo $this->fetch('css');
	echo $this->fetch('script');
?>
<link rel="stylesheet" type="text/css" href="/invenPolka/css/styleTest.css">
<script type="text/javascript" src="/invenPolka/js/jsTemplate/modernizr.custom.26887.js"></script>
<script type="text/javascript" src="/invenPolka/js/jsTemplate/jquery.imgslider.js"></script>
<script src="/invenPolka/js/jsTemplate/jquery.growl.js" type="text/javascript"></script>
<link href="/invenPolka/css/jquery.growl.css" rel="stylesheet" type="text/css" />
<script src="/invenPolka/js/jsTemplate/jquery.validate.js"></script>



</head>

<body>

<div class="mainwrapper" style="background-position: 0px 0px;">

    <!-- START OF LEFT PANEL -->
    <div class="leftpanel" style="margin-left: 0px;">

        <div class="logopanel animate0 fadeInUp">
        	<h1><a href="dashboard.html">Pol-ka <span>v1.0</span></a></h1>
        </div><!--logopanel-->

        <div class="datewidget animate1 fadeInUp">Hoy es es Martes, Dec 25, 2012 5:30pm</div>

    	<div class="searchwidget animate2 fadeInUp">
        	<form action="results.html" method="post">
            	<div class="input-append">
                    <input type="text" class="span2 search-query" placeholder="Busqueda general(?Sirve?)...">
                    <button type="submit" class="btn"><span class="icon-search"></span></button>
                </div>
            </form>
        </div><!--searchwidget-->

        <div class="plainwidget animate3 fadeInUp">
        	<small>Cantidad de articulos disponibles: </small>
        	<div class="progress progress-info">
                <div class="bar" style="width: 20%"></div>
            </div>
            <small><strong>38% full</strong></small>
        </div><!--plainwidget-->

        <div class="leftmenu">
            <ul class="nav nav-tabs nav-stacked">
            	<li class="nav-header animate4 fadeInUp">Navegacion</li>
                <li class="active animate5 fadeInUp"><a href="/invenPolka"><span class="icon-align-justify"></span> Inicio</a></li>
                <li class="active  animate8 fadeInUp"><a id="articulo" class="option"><span class="icon-th-list"></span> Articulos</a>
	            <li class="active  animate8 fadeInUp"><a id="articulo" class="search"><span class="icon-th-list"></span> Buscador Articulos</a>

                	<ul>
                    	<li><a href="/invenPolka/articulos/add">Agregar</a></li>
                    </ul>

                </li>
				<li class="active  animate8 fadeInUp"><a id="proyecto" class="option"><span class="icon-th-list"></span> Proyectos</a>
				<li class="active  animate8 fadeInUp"><a id="deposito" class="option"><span class="icon-th-list"></span> Deposito</a>
				<li class="active  animate8 fadeInUp"><a id="inventario" class="option"><span class="icon-th-list"></span>Inventario</a>
				<li class="active  animate8 fadeInUp"><a id="pedido" class="option"><span class="icon-th-list"></span>Pedidos - Entrada</a>
				<li class="active  animate8 fadeInUp"><a id="pedidoSalida" class="option"><span class="icon-th-list"></span>Pedidos - Salida</a>
				<li class="active  animate8 fadeInUp"><a id="pedidoHisto" class="option"><span class="icon-th-list"></span>Pedidos - Historico</a>
				<li class="active  animate8 fadeInUp"><a id="movimientoInventario" class="option"><span class="icon-th-list"></span>Movimientos</a>

                <li class="dropdown animate13 fadeInUp"><a href=""><span class="icon-pencil"></span> Configuraciones</a>
                	<ul>
                    	<li><a id="categoria" class="option">Categorias</a></li>
                        <li><a id="objeto" class="option">Objetos</a></li>
                        <li><a id="decorado" class="option">Decorados</a></li>
                        <li><a id="material" class="option">Materiales</a></li>
						<li><a id="dimension" class="option">Dimensiones</a></li>
                        <li><a id="estilo" class="option">Estilos</a></li>
                    </ul>
                </li>
				 <li class="dropdown animate13 fadeInUp"><a class="buscador" href=""><span class="icon-pencil"></span> Buscador</a>
	                	<ul>
	                    	<li style="padding-left: 1px;background:white"><form action="/InvenPolka/articulos/find" class=" formBuscador" id="ArticuloSearchFindForm" enctype="multipart/form-data" method="post" accept-charset="utf-8"><div style="display:none;"><input type="hidden" name="_method" value="POST"></div><div class="field" style="padding-left: 33px;"><label for="ArticuloSearchCodigoArticulo">Codigo Articulo</label><input name="data[ArticuloSearch][CodigoArticulo]" type="text" id="ArticuloSearchCodigoArticulo"></div><p>
	<?php	echo $this->Form->input('ArticuloSearch.IdCategoria',array('type'=>'select','options'=>$categorias,'empty'=>true,'class'=>'uniformselect categoria'																								,'div'=>false,'label'=>false,'before'=>'<p><span class="field" style="padding-left: 33px;""> Categoria : '));?><p>
								<span class="field" style="padding-left: 33px;">Objeto : <select name="data[ArticuloSearch][IdObjeto]" class="uniformselect" id="ArticuloIdObjeto" style="opacity: 0;">

															</select></span><p></p>
															<p>	<span class="field" style="padding-left: 33px;">Decorado : <select name="data[ArticuloSearch][IdDecorado]" class="uniformselect" id="ArticuloIdDecorado" style="opacity: 0;">

															</select></span></p>
														<p><span class="field" style="padding-left: 33px;">	Material : <span></span><select name="data[ArticuloSearch][IdMaterial]" class="uniformselect" id="ArticuloIdMaterial" style="opacity: 0;">

															</select></span></p>
														<p><span class="field" style="padding-left: 33px;">	Dimension : <span></span><select name="data[ArticuloSearch][IdDimension]" class="uniformselect" id="ArticuloIdDimension" style="opacity: 0;">

															</select></span></p>
														<p><span class="field" style="padding-left: 33px;">	 Estilo : <select name="data[ArticuloSearch][IdEstilo]" class="uniformselect" id="ArticuloIdEstilo" style="opacity: 0;">

															</select></span></p>
							</p><p class="stdformbutton"><button class="btn btn-primary saveBuscador">Buscar</button></p></form></li></ul>

	                </li>






            </ul>
        </div><!--leftmenu-->

    </div><!--mainleft-->
    <!-- END OF LEFT PANEL -->

    <!-- START OF RIGHT PANEL -->
    <div class="rightpanel" style="margin-left: 260px;">
    	<div class="headerpanel animate1 fadeInUp">
        	<a href="" class="showmenu"></a>

            <div class="headerright">
            	<div class="dropdown notification">
                    <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="/page.html">
                    	<span class="iconsweets-globe iconsweets-white"></span>
                    </a>
                    <ul class="dropdown-menu">
                    	<li class="nav-header">Notificaciones</li>
                        <li>

                </div><!--dropdown-->

    			<div class="dropdown userinfo">
                    <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="/page.html">Hola, Usuario! <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#"><span class="icon-edit"></span> Editar Perfil</a></li>
						<li><a href="#"><span class="icon-edit"></span> Enviar Mensaje</a></li>
                        <li class="divider"></li>
                        <li><a href="#"><span class="icon-off"></span> Salir</a></li>
                    </ul>
                </div><!--dropdown-->

            </div><!--headerright-->

    	</div><!--headerpanel-->
<div class="contenidoDinamico">
	<div class="breadcrumbwidget animate2 fadeInUp">
		<ul class="skins">
	        <li><a href="default" class="skin-color default"></a></li>
	        <li><a href="orange" class="skin-color orange"></a></li>
	        <li><a href="dark" class="skin-color dark"></a></li>
	        <li>&nbsp;</li>
	        <li class="fixed"><a href="" class="skin-layout fixed"></a></li>
	        <li class="wide"><a href="" class="skin-layout wide"></a></li>
	    </ul><!--skins-->
		<ul class="breadcrumb">
	        <li><a href="dashboard.html">Home</a> <span class="divider">/</span></li>
	        <li class="active activeBreadcrum">Dashboard</li>
	    </ul>
	</div><!--breadcrumbwidget-->
	<div class="pagetitle animate3 fadeInUp">
		<h1 class="headerBig">Dashboard</h1> <span class="headerDescription">Gestion General...</span>
	</div><!--pagetitle-->

	<div class="maincontent animate4 fadeInUp">
	<div class="contentinner">


	</div>
	</div>
</div>


    </div><!--mainright-->
    <!-- END OF RIGHT PANEL -->

    <div class="clearfix"></div>

    <div class="footer">
    	<div class="footerleft">Inventario Polka v1.0</div>
    	<div class="footerright" style="margin-left: 260px;">© Version Beta - <a href="#s">Polka</a> - <a href="#"></a></div>
    </div><!--footer-->


</div><!--mainwrapper-->
<script type="text/javascript">


		sideBarController.bindMenuOptionsEvents();

		articuloRender.bindFinderStaticEvents();

/**/

</script>


<div id="ui-datepicker-div" class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"></div></body></html>
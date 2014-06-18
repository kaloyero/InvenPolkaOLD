<!DOCTYPE html>
<html><head>

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
		echo $this->Html->script('jsTemplate/jquery.elevatezoom');
		echo $this->Html->script('jsTemplate/jquery.fileDownload');

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



        echo $this->fetch('css');
        echo $this->fetch('script');?>

<link id="skinstyle" rel="stylesheet" href="css/style.dark.css" type="text/css" />

</head>



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
                <li class="active animate5 fadeInUp"><a href="/InvenPolka"><span class="icon-align-justify"></span> Inicio</a></li>
                <li class="active  animate8 fadeInUp"><a id="articulo" class="option"><span class="icon-th-list"></span> Articulos</a></li>


                        <ul>
                            <li><a href="/InvenPolka/articulos/add">Agregar</a></li>
                    </ul>

                </li>
                                <li class="active  animate8 fadeInUp"><a id="proyecto" class="option"><span class="icon-th-list"></span> Proyectos</a></li>
                                <li class="active  animate8 fadeInUp"><a id="deposito" class="option"><span class="icon-th-list"></span> Deposito</a></li>
                                <li class="active  animate8 fadeInUp"><a id="inventario" class="option"><span class="icon-th-list"></span>Inventario</a></li>
                                <li class="active  animate8 fadeInUp"><a id="pedido" class="option"><span class="icon-th-list"></span>Pedidos - Entrada</a></li>
                                <li class="active  animate8 fadeInUp"><a id="pedidoSalida" class="option"><span class="icon-th-list"></span>Pedidos - Salida</a></li>
                                <li class="active  animate8 fadeInUp"><a id="pedidoHisto" class="option"><span class="icon-th-list"></span>Pedidos - Historico</a></li>
                                <li class="active  animate8 fadeInUp"><a id="movimientoInventario" class="option"><span class="icon-th-list"></span>Movimientos</a></li>
                                <li class="active  animate8 fadeInUp"><a id="usuario" class="option"><span class="icon-th-list"></span>Usuarios</a></li>

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


                                        <li class="dropdown animate7 fadeInUp">
                                                            <a href="#">
                                                              <span class="icon-search"></span>Buscador de Articulos
                                                            </a>
                                                            <ul style="display: block;">
                                                              <li>
                                                                                        <form action="/InvenPolka/articulos/find" class=" formBuscador" id="ArticuloSearchFindForm" enctype="multipart/form-data" method="post" accept-charset="utf-8"><div style="display:none;"><input type="hidden" name="_method" value="POST"></div><div class="field" style="margin:5px 5px 5px 20px;"><label for="ArticuloSearchCodigoArticulo">Codigo Articulo</label><input name="data[ArticuloSearch][CodigoArticulo]" type="text" id="ArticuloSearchCodigoArticulo"></div><p>
<div class="field" style="margin:5px 5px 5px 20px;">
<label for="ArticuloSearchIdCategoria">Categoria</label>
                                                <?php        echo $this->Form->input('ArticuloSearch.IdCategoria',array('type'=>'select','options'=>$categorias,'empty'=>true,'div'=>false,'label'=>false,'class'=>'categoria'                                                                                                                                                                                                ));?>
                                                </div>
                                                <div class="field" style="margin:5px 5px 5px 20px;">
                                                <label for="ArticuloIdObjeto">Objeto</label>
                                                                <select name="data[ArticuloSearch][IdObjeto]" id="ArticuloIdObjeto" >

                                                                </select>
                                        </div>                                                <div class="field" style="margin:5px 5px 5px 20px;">
                                                                                        <label for="ArticuloIdDecorado">Decorado</label>
                                                                <select name="data[ArticuloSearch][IdDecorado]" id="ArticuloIdDecorado">

                                                                </select></div>
                                                                                        <div class="field" style="margin:5px 5px 5px 20px;">
                                                                                        <label for="ArticuloIdMaterial">Material</label>
                                                                <select name="data[ArticuloSearch][IdMaterial]" id="ArticuloIdMaterial">

                                                                </select></div>
                                                                                        <div class="field" style="margin:5px 5px 5px 20px;">
                                                                                        <label for="ArticuloIdDimension">Dimension</label>
                                                                <select name="data[ArticuloSearch][IdDimension]" id="ArticuloIdDimension" >

                                                                </select></div>
                                                                                                <div class="field" style="margin:5px 5px 5px 20px;">
                                                                                                <label for="ArticuloIdEstilo">Estilo</label>
                                                                <select name="data[ArticuloSearch][IdEstilo]" id="ArticuloIdEstilo" >

                                                                </select></div>

                                                                <button class="btn btn-primary btn-block saveBuscador">Buscar</button></form>
                                                              </li>
                                                            </ul>
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
            <div class="footerright" style="margin-left: 260px;">
            <a href="http://www.belasoft.com.ar" target="_blank" >BelaSoft - disign&webApp </a> - <a href="#s">Polka</a> - <a href="#"></a></div>
    </div><!--footer-->


</div><!--mainwrapper-->



<div id="ui-datepicker-div" class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"></div>

<script type="text/javascript">
jQuery.noConflict();

jQuery(document).ready(function(){
	sideBarController.bindMenuOptionsEvents();
	articuloRender.bindFinderStaticEvents();
	});
	</script>
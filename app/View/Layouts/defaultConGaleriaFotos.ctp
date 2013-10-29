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
	echo $this->Html->script('Deposito');
	echo $this->Html->script('Estudio');
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
	echo $this->Html->script('Estudio');
	echo $this->Html->script('Inventario');

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
	//echo $this->Html->css('demo_table');
	//echo $this->Html->css('demo_page');

	echo $this->Html->script('jsTemplate/custom');
	echo $this->Html->script('jsTemplate/uploadForm');
	echo $this->Html->script('jsTemplate/forms');




	echo $this->fetch('css');
	echo $this->fetch('script');
?>
<script src="js/jsTemplate/bgpos.js"></script>
    <script src="js/jsTemplate/jquery.bubbleSlideshow.js"></script>

	<link rel="stylesheet" href="css/styles.css" />

        <!-- The plugin stylehseet -->
        <link rel="stylesheet" href="css/jquery.bubbleSlideshow.css" />
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
				<li class="active  animate8 fadeInUp"><a id="estudio" class="option"><span class="icon-th-list"></span> Estudio</a>
				<li class="active  animate8 fadeInUp"><a id="inventario" class="option"><span class="icon-th-list"></span>Inventario</a>
				<li class="active  animate8 fadeInUp"><a id="pedido" class="option"><span class="icon-th-list"></span>Pedidos</a>
				<li class="active  animate8 fadeInUp"><a id="movimientoInventario" class="option"><span 		  class="icon-th-list"></span>Movimientos</a>
                <li class="dropdown animate13 fadeInUp"><a href=""><span class="icon-pencil"></span> Configuraciones</a>
                	<ul>
                    	<li><a id="categoria" class="option">Categorias</a></li>
                        <li><a id="material" class="option">Materiales</a></li>
                        <li><a id="estilo" class="option">Estilos</a></li>
						<li><a id="objeto" class="option">Objetos</a></li>
						<li><a id="dimension" class="option">Dimensiones</a></li>
						<li><a id="decorado" class="option">Decorados</a></li>
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
                    	<li class="nav-header">Notifications</li>
                        <li>
                        	<a href="">
                        	<strong>3 people viewed your profile</strong><br>
						<?php echo $this->Html->image('thumbs/thumb1.png', array('alt' => 'CakePHP'));?>
						<?php echo $this->Html->image('thumbs/thumb2.png', array('alt' => 'CakePHP'));?>
						<?php echo $this->Html->image('thumbs/thumb3.png', array('alt' => 'CakePHP'));?>

                            </a>
                        </li>
                        <li><a href=""><span class="icon-envelope"></span> New message from <strong>Jack</strong> <small class="muted"> - 19 hours ago</small></a></li>
                        <li><a href=""><span class="icon-envelope"></span> New message from <strong>Daniel</strong> <small class="muted"> - 2 days ago</small></a></li>
                        <li><a href=""><span class="icon-user"></span> <strong>Bruce</strong> is now following you <small class="muted"> - 2 days ago</small></a></li>
                        <li class="viewmore"><a href="">View More Notifications</a></li>
                    </ul>
                </div><!--dropdown-->

    			<div class="dropdown userinfo">
                    <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="/page.html">Hola, Usuario! <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="editprofile.html"><span class="icon-edit"></span> Edit Profile</a></li>
                        <li><a href=""><span class="icon-wrench"></span> Account Settings</a></li>
                        <li><a href=""><span class="icon-eye-open"></span> Privacy Settings</a></li>
                        <li class="divider"></li>
                        <li><a href="index.html"><span class="icon-off"></span> Sign Out</a></li>
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
	        <li class="active">Dashboard</li>
	    </ul>
	</div><!--breadcrumbwidget-->
	<div class="pagetitle animate3 fadeInUp">
		<h1>Dashboard</h1> <span>Gestion General...</span>
	</div><!--pagetitle-->
			<ul id="slideShow" class="opa"></ul>

	        <p class="credit"><a href="http://www.flickr.com/photos/zanthia/"></a><br />
	        	<i>
	                <a href="http://www.flickr.com/photos/zanthia/5713923079/"></a>
	                <a href="http://www.flickr.com/photos/zanthia/5542165153/"></a>
	                <a href="http://www.flickr.com/photos/zanthia/5822520546/"></a>
	                <a href="http://www.flickr.com/photos/zanthia/4341260799/"></a><br />
	                <a href="http://www.flickr.com/photos/zanthia/5047301420/"> </a>
	                <a href="http://www.flickr.com/photos/zanthia/4305139726/"></a>
	            </i>
	        </p>
	<div class="maincontent animate4 fadeInUp">
	<div class="contentinner">

	<?php echo $this->fetch('content'); ?>
	</div>
	</div>
</div>


    </div><!--mainright-->
    <!-- END OF RIGHT PANEL -->

    <div class="clearfix"></div>

    <div class="footer">
    	<div class="footerleft">Katniss Premium Admin Template v1.0</div>
    	<div class="footerright" style="margin-left: 260px;">© ThemePixels - <a href="http://twitter.com/themepixels">Follow me on Twitter</a> - <a href="http://dribbble.com/themepixels">Follow me on Dribbble</a></div>
    </div><!--footer-->


</div><!--mainwrapper-->
<script type="text/javascript">

	jQuery(".btn").bind("click", function (event, pos, item) {
		if (jQuery(".search-query").val() == "silchu"){
			jQuery(".contentinner").empty()
 			jQuery(".contentinner").append("IMPORTANTE:Frases de tu idolo Sartre para que te vueles mas la cabeza: ");
			jQuery(".contentinner").append("<p></p>");
			jQuery(".contentinner").append("<p>Soñar en teoría, es vivir un poco, pero vivir soñando es no existir</p>");
			jQuery(".contentinner").append("<p>No perdamos nada de nuestro tiempo; quizá los hubo más bellos, pero este es el nuestro</p>");
			jQuery(".contentinner").append("<p>El hombre nace libre, responsable y sin excusas.</p>");
			jQuery(".contentinner").append("<p>La conciencia sólo puede existir de una manera, y es teniendo conciencia de que existe.</p>");


		}	if (jQuery(".search-query").val() == "osten"){
			jQuery(".contentinner").empty()
 			jQuery(".contentinner").append("Alguien me debe contar algo con lujos de detalle.Ya que me quede sin el premio de la apuesta ");
			jQuery(".contentinner").append("<p></p>");
			jQuery(".contentinner").append("<p>Por ahi podes llegar a levantar la mala actitud del dia de ayer ,gal.</p>");
		}
		return false

 	})
		sideBarController.bindMenuOptionsEvents();
		// basic chart
		var flash = [[0, 2], [1, 6], [2,3], [3, 8], [4, 5], [5, 13], [6, 8]];
		var html5 = [[0, 5], [1, 4], [2,4], [3, 1], [4, 9], [5, 10], [6, 13]];

		function showTooltip(x, y, contents) {
			jQuery('<div id="tooltip" class="tooltipflot">' + contents + '</div>').css( {
				position: 'absolute',
				display: 'none',
				top: y + 5,
				left: x + 5
			}).appendTo("body").fadeIn(200);
		}
//console.log("JAJA", jQuery.plot(jQuery("#chartplace2")) )
if (jQuery("#chartplace2").length) {
		console.log("SDsad",jQuery("#chartplace2"))
		var plot = jQuery.plot(jQuery("#chartplace2"),
			   [ { data: flash, label: "Flash(x)", color: "#fb6409"}, { data: html5, label: "HTML5(x)", color: "#096afb"} ], {
				   series: {
					   lines: { show: true, fill: true, fillColor: { colors: [ { opacity: 0.05 }, { opacity: 0.15 } ] } },
					   points: { show: true }
				   },
				   legend: { position: 'nw'},
				   grid: { hoverable: true, clickable: true, borderColor: '#ccc', borderWidth: 1, labelMargin: 10 },
				   yaxis: { min: 0, max: 15 }
				 });

		var previousPoint = null;

		jQuery("#chartplace2").bind("plothover", function (event, pos, item) {
			jQuery("#x").text(pos.x.toFixed(2));
			jQuery("#y").text(pos.y.toFixed(2));

			if(item) {
				if (previousPoint != item.dataIndex) {
					previousPoint = item.dataIndex;

					jQuery("#tooltip").remove();
					var x = item.datapoint[0].toFixed(2),
					y = item.datapoint[1].toFixed(2);

					showTooltip(item.pageX, item.pageY,
									item.series.label + " of " + x + " = " + y);
				}

			} else {
			   jQuery("#tooltip").remove();
			   previousPoint = null;
			}

		});

		jQuery("#chartplace2").bind("plotclick", function (event, pos, item) {
			if (item) {
				jQuery("#clickdata").text("You clicked point " + item.dataIndex + " in " + item.series.label + ".");
				plot.highlight(item.series, item.datapoint);
			}
		});

	}
	if (jQuery("#bargraph2").length) {
		// bar graph
		var d2 = [];
		for (var i = 0; i <= 10; i += 1)
			d2.push([i, parseInt(Math.random() * 30)]);

		var stack = 0, bars = true, lines = false, steps = false;
		jQuery.plot(jQuery("#bargraph2"), [ d2 ], {
			series: {
				stack: stack,
				lines: { show: lines, fill: true, steps: steps },
				bars: { show: bars, barWidth: 0.6 }
			},
			grid: { hoverable: true, clickable: true, borderColor: '#bbb', borderWidth: 1, labelMargin: 10 },
			colors: ["#06c"]
		});
    }
		// calendar
		jQuery('#calendar').datepicker();


		var photos = [
				'http://farm6.static.flickr.com/5230/5822520546_dd2b6d7e24_z.jpg',
				'http://farm5.static.flickr.com/4014/4341260799_b466a1dfe4_z.jpg',
				'http://farm6.static.flickr.com/5138/5542165153_86e782382e_z.jpg',
				'http://farm5.static.flickr.com/4040/4305139726_829be74e29_z.jpg',
				'http://farm4.static.flickr.com/3071/5713923079_60f53b383f_z.jpg',
				'http://farm5.static.flickr.com/4108/5047301420_621d8a7912_z.jpg'
			];
			var slideshow = jQuery('#slideShow').bubbleSlideshow(photos);

			jQuery(window).load(function(){
				slideshow.autoAdvance(5000);
			});






/**/

</script>


<div id="ui-datepicker-div" class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"></div></body></html>
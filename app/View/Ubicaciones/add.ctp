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
        <li class="active">Ubicaciones</li>
    </ul>
</div><!--breadcrumbwidget-->
<div class="pagetitle animate3 fadeInUp">
	<h1>Ubicaciones</h1> <span>Gestion de Ubicaciones...</span>
</div><!--pagetitle-->

<div class="maincontent animate4 fadeInUp">
<div class="contentinner">
<?php
echo '<h4 class="widgettitle nomargin shadowed">Ubicaciones</h4>';
echo '<div class="widgetcontent bordered shadowed nopadding">';

echo $this->Form->create('Ubicacione',array('class' => 'stdform stdform2','inputDefaults' => array(
        'div' => array('class' => 'field'))));
echo $this->Form->input('CodigoUbicacion',array('class'=>'input-medium','div'=>false,'label'=>false,'before'=>'<p>
											<label>Codigo Ubicacion</label>
										    <span class="field">',
											'after'=>'</span></p>'));
echo $this->Form->input('Descripcion'									,array('class'=>'input-medium','div'=>false,'label'=>false,'before'=>'<p><label>Descripcion</label><span class="field">','after'=>'</span></p>'));

echo $this->Form->input('FechaFin',array('empty'=>false,'class'=>'uniformselect','div'=>false,'label'=>false,'before'=>'<p><label>Fecha Fin</label><span class="field">','after'=>'</span></p>'));

echo $this->Form->input('Ubicacione.IdDeposito',array('type'=>'select','options'=>$depositos,'empty'=>false,'class'=>'uniformselect','div'=>false,'label'=>false,'before'=>'<p><label>Decorado</label><span class="field">','after'=>'</span></p>'));

//echo $this->Form->end('Guardar');
echo '<p class="stdformbutton"><button class="btn btn-primary">Guardar</button><button type="reset" class="btn">Limpiar Formulario</button></p>';
?>
</div>
</div>
</div>


<?php echo $this->Html->script('jsTemplate/forms');?>
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
        <li class="active">Inventario</li>
    </ul>
</div><!--breadcrumbwidget-->
<div class="pagetitle animate3 fadeInUp">
	<h1>Inventarios</h1> <span>Gestion de Inventarios...</span>
</div><!--pagetitle-->

<div class="maincontent animate4 fadeInUp">
<div class="contentinner">
<?php
echo '<h4 class="widgettitle nomargin shadowed">Inventario</h4>';
echo '<div class="widgetcontent bordered shadowed nopadding">';
echo $this->Form->create('Inventario',array('action' => 'edit','class' => 'stdform stdform2','inputDefaults' => array(
        'div' => array('class' => 'field')
    )));
echo $this->Form->input('Disponibilidad');
echo $this->Form->input('Inventario.IdArticulo',array('type'=>'select','options'=>$articulos,'empty'=>false,'class'=>'uniformselect','div'=>false,'label'=>false,'before'=>'<p><label>Articulo</label><span class="field">','after'=>'</span></p>'));
echo $this->Form->input('Inventario.IdDeposito',array('type'=>'select','options'=>$depositos,'empty'=>false,'class'=>'uniformselect','div'=>false,'label'=>false,'before'=>'<p><label>Deposito</label><span class="field">','after'=>'</span></p>'));
echo $this->Form->input('Inventario.IdUbicacion',array('type'=>'select','options'=>$ubicaciones,'empty'=>false,'class'=>'uniformselect','div'=>false,'label'=>false,'before'=>'<p><label>Ubicacion</label><span class="field">','after'=>'</span></p>'));
echo $this->Form->input('Inventario.IdProyecto',array('type'=>'select','options'=>$proyectos,'empty'=>false,'class'=>'uniformselect','div'=>false,'label'=>false,'before'=>'<p><label>Proyecto</label><span class="field">','after'=>'</span></p>'));
echo $this->Form->input('id', array('type' => 'hidden'));

echo '<p class="stdformbutton"><button class="btn btn-primary">Guardar</button><button type="reset" class="btn">Limpiar Formulario</button></p>';
?>
</div>
</div>
</div>
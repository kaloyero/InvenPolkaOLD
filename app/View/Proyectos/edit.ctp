<h4 class="widgettitle nomargin shadowed">Proyectos<button class="volver glyphicon" style="float:right;" type="button" title="Volver atras"><img src="app/webroot/img/icon-back.png" alt="Volver atras" /></button></h4>
<div class="widgetcontent bordered shadowed nopadding">
<?php


echo $this->Form->create('Proyecto',array('class' => 'stdform ','inputDefaults' => array(
        'div' => array('class' => 'field'))));

?>
<div class="conteinerPrinc-1">
<?php
echo $this->Form->input('Nombre',array('class'=>'input-medium','div'=>false,'label'=>false,'before'=>'<p><label style="float: left;">Nombre</label><span class="field float">','after'=>'</span>'));

echo $this->Form->input('FechaIni',array('class'=>'input-medium fecha','div'=>false,'label'=>false,'before'=>'<label style="float: left;">Fecha Inicio</label><span class="field float">','after'=>'<small class="field"><em>año / mes / dia</em></small></span>','type' => 'text'));

echo $this->Form->input('FechaFin',array('class'=>'input-medium fecha','div'=>false,'label'=>false,'before'=>'<label style="float: left;">Fecha Fin</label><span class="field float">','after'=>'<small class="field"><em>año / mes / dia</em></small></span></p>','type' => 'text'));

?>
</div>
<div class="conteinerPrinc-2">
<?php
echo $this->Form->input('Descripcion',array('type' => 'textarea','class'=>'span5','div'=>false,'label'=>false,'before'=>'<label style="float: left;">Descripcion</label><span class="field float">','after'=>'</span></p>'));

echo $this->Form->input('Director',array('class'=>'input-medium','div'=>false,'label'=>false,'before'=>'<p><label style="float: left;">Director</label><span class="field float">','after'=>'</span>'));


echo $this->Form->input('id', array('type' => 'hidden'));

?>
</div>
</div>

<div class="botonera widgettitle">
	<p class="stdformbutton">
        <button class="btn btn-primary edit" style="margin-left: 10px;">Guardar</button>
    </p>
</div>

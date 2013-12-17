<?php
echo '<h4 class="widgettitle nomargin shadowed">Proyectos</h4>';
echo '<div class="widgetcontent bordered shadowed nopadding">';
echo $this->Form->create('Proyecto',array('class' => 'stdform stdform2','inputDefaults' => array(
        'div' => array('class' => 'field'))));
echo $this->Form->input('Nombre',array('class'=>'input-medium','div'=>false,'label'=>false,'before'=>'<p><label style="float: left;">Nombre</label><span class="field float">','after'=>'</span>'));

echo $this->Form->input('Descripcion',array('type' => 'textarea','class'=>'span5','div'=>false,'label'=>false,'before'=>'<label style="float: left;">Descripcion</label><span class="field float">','after'=>'</span></p>'));

echo $this->Form->input('Director',array('class'=>'input-medium','div'=>false,'label'=>false,'before'=>'<p><label style="float: left;">Director</label><span class="field float">','after'=>'</span>'));

echo $this->Form->input('FechaIni',array('class'=>'input-medium fecha','div'=>false,'label'=>false,'before'=>'<label style="float: left;">Fecha Inicial</label><span class="field float">','after'=>'<small class="field"><em>yyyy / mm / dd</em></small></span>','type' => 'text'));

echo $this->Form->input('FechaFin',array('class'=>'input-medium fecha','div'=>false,'label'=>false,'before'=>'<label style="float: left;">Fecha Fin</label><span class="field float">','after'=>'<small class="field"><em>yyyy / mm / dd</em></small></span></p>','type' => 'text'));

echo $this->Form->input('id', array('type' => 'hidden'));

//echo $this->Form->end('Guardar');
echo '<p class="stdformbutton"><button class="btn btn-primary edit">Guardar</button></p>';

?>
</div>
<button class="btn btn-primary volver" type="button">Volver</button>

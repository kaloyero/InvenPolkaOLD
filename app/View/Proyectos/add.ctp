<?php
echo '<h4 class="widgettitle nomargin shadowed">Proyecto</h4>';
echo '<div class="widgetcontent bordered shadowed nopadding">';
echo $this->Form->create('Proyecto',array('class' => 'stdform stdform2','inputDefaults' => array(
        'div' => array('class' => 'field'))));
echo $this->Form->input('Nombre',array('class'=>'input-medium','div'=>false,'label'=>false,'before'=>'<p><label>Nombre</label><span 			class="field">','after'=>'</span></p>'));

echo $this->Form->input('Descripcion',array('class'=>'input-medium','div'=>false,'label'=>false,'before'=>'<p><label>Descripcion</label><span 			class="field">','after'=>'</span></p>'));
echo $this->Form->input('Director',array('class'=>'input-medium','div'=>false,'label'=>false,'before'=>'<p><label>Director</label><span 			class="field">','after'=>'</span></p>'));
echo $this->Form->input('FechaIni',array('empty'=>false,'class'=>'uniformselect','div'=>false,'label'=>false,'before'=>'<p><label>Fecha Ini</label><span class="field">','after'=>'</span></p>'));
echo $this->Form->input('FechaFin',array('empty'=>false,'class'=>'uniformselect','div'=>false,'label'=>false,'before'=>'<p><label>Fecha Fin</label><span class="field">','after'=>'</span></p>'));


echo '<p class="stdformbutton"><button class="btn btn-primary save">Guardar</button><button type="reset" class="btn">Limpiar Formulario</button></p>';
?>
<?php
echo $this->Form->end();
?>
<?php
echo '<h4 class="widgettitle nomargin shadowed">Proyectos</h4>';
echo '<div class="widgetcontent bordered shadowed nopadding">';
echo $this->Form->create('Proyecto',array('class' => 'stdform stdform2','inputDefaults' => array(
        'div' => array('class' => 'field'))));
echo $this->Form->input('Nombre',array('class'=>'input-medium','div'=>false,'label'=>false,'before'=>'<p><label>Nombre</label><span 			class="field">','after'=>'</span></p>'));

echo $this->Form->input('Descripcion',array('type' => 'textarea','class'=>'span5','div'=>false,'label'=>false,'before'=>'<p><label>Descripcion</label><span 			class="field">','after'=>'</span></p>'));

echo $this->Form->input('Director',array('class'=>'input-medium','div'=>false,'label'=>false,'before'=>'<p><label>Director</label><span 			class="field">','after'=>'</span></p>'));

echo '<p><label>Fecha Inicial</label><span class="field"><input class="input-small fecha" type="text" name="data[Proyecto][FechaIni]" required="required" /><small class="field"><em>   año / mes / dia</em></small></span></p>';

echo '<p><label>Fecha Fin</label><span class="field"><input class="input-small fecha" type="text" name="data[Proyecto][Fechafin]" required="required" /><small class="field"><em>   año / mes / dia</em></small></span></p>';

echo '<p class="stdformbutton"><button class="btn btn-primary save">Guardar</button><button type="reset" class="btn">Limpiar Formulario</button></p>';

?>
</div>
<label>Guardar y Seguir</label>
<span class="field"><input type="checkbox"class='seguir' name="check2" style="opacity: 0;"></span>
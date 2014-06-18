<h4 class="widgettitle nomargin shadowed">Depositos<button class="volver glyphicon" style="float:right;" type="button" title="Volver atras"><img src="app/webroot/img/icon-back.png" alt="Volver atras" /></button></h4>
<div class="widgetcontent bordered shadowed nopadding">
<?php

echo $this->Form->create('Deposito',array('class' => 'stdform stdform2','inputDefaults' => array(
        'div' => array('class' => 'field'))));
echo $this->Form->input('Nombre');

echo '<p><label>Fecha Fin</label><span class="field"><input class="input-small fecha" type="text" name="data[Deposito][FechaFin]" required="required" /><small class="field"><em> yyyy / mm / dd</em></small></span></p>';
/* FIn Seguir agregando*/
//echo $this->Html->link('Cancelar', '/categorias');

//echo $this->Form->end();
echo '<p class="stdformbutton"><button class="btn btn-primary save">Guardar</button><button type="reset" class="btn">Limpiar Formulario</button></p>';
?>


</div>
<label>Guardar y Seguir</label>
<span class="field"><input type="checkbox"class='seguir' name="check2" style="opacity: 0;"></span>



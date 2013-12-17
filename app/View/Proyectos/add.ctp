<?php
echo '<h4 class="widgettitle nomargin shadowed">Proyectos</h4>';
echo '<div class="widgetcontent bordered shadowed nopadding">';
echo $this->Form->create('Proyecto',array('class' => 'stdform stdform2','inputDefaults' => array(
        'div' => array('class' => 'field'))));
echo $this->Form->input('Nombre',array('class'=>'input-medium','div'=>false,'label'=>false,'before'=>'<p><label style="float: left;">Nombre</label><span  class="field float">','after'=>'</span>'));

echo $this->Form->input('Descripcion',array('type' => 'textarea','class'=>'span5','div'=>false,'label'=>false,'before'=>'<label style="float: left;">Descripcion</label><span class="field float">','after'=>'</span></p>'));

echo $this->Form->input('Director',array('class'=>'input-medium','div'=>false,'label'=>false,'before'=>'<p><label style="float: left;">Director</label><span class="field float">','after'=>'</span>'));

echo '<label style="float: left;">Fecha Comienzo</label><span class="field float"><input class="input-small fecha" type="text" name="data[Proyecto][FechaIni]" required="required" /><small><em> yyyy / mm / dd</em></small></span>';

echo '<label style="float: left;">Fecha Cierre</label><span class="field float"><input class="input-small fecha" type="text" name="data[Proyecto][FechaFin]" required="required" /><small><em>   yyyy / mm / dd</em></small></span></p>';


echo '<p class="stdformbutton"><button class="btn btn-primary save">Guardar</button><button type="reset" class="btn">Limpiar Formulario</button></p>';

?>
</div>
<button class="btn btn-primary volver" type="button">Volver</button>
<input type="checkbox" class="seguir" name="check2" > Guardar y Seguir

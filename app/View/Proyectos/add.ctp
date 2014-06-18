<h4 class="widgettitle nomargin shadowed">Proyectos<button class="volver glyphicon" style="float:right;" type="button" title="Volver atras"><img src="app/webroot/img/icon-back.png" alt="Volver atras" /></button></h4>
<div class="widgetcontent bordered shadowed nopadding">


	<?php
    echo $this->Form->create('Proyecto',array('class' => 'stdform','inputDefaults' => array(
            'div' => array('class' => 'field'))));
	?>
<div class="conteinerPrinc-1">

	<?php
    echo $this->Form->input('Nombre',array('class'=>'input-medium','div'=>false,'label'=>false,'before'=>'<p><label>Nombre</label><span  class="field float">','after'=>'</span></p>'));
    ?>
    <p>
        <label class="items-header2">Fecha Inicio</label>
        <span class="field float"><input class="input-small fecha" type="text" name="data[Proyecto][FechaIni]" required="required" /><small><em>año / mes / dia</em></small></span>
    </p>
    
    <p>
        <label class="items-header2">Fecha Cierre</label><span class="field float"><input class="input-small fecha" type="text" name="data[Proyecto][FechaFin]" required="required" /><small><em>año / mes / dia</em></small></span>
    </p>
	<BR><BR>
</div>

<div class="conteinerPrinc-2">
	<?php
        echo $this->Form->input('Director',array('class'=>'input-medium','div'=>false,'label'=>false,'before'=>'<p><label>Director</label><span class="field float">','after'=>'</span></p>'));
        echo $this->Form->input('Descripcion',array('type' => 'textarea','class'=>'span5','div'=>false,'label'=>false,'before'=>'<p><label>Comentarios</label><span class="field float">','after'=>'</span></p>'));
    ?>
</div>

</div>

<div class="botonera widgettitle">
	<p class="stdformbutton">
        <button class="btn btn-primary save" style="margin-left: 10px;">Guardar</button>
        <input type="checkbox" class="seguir" name="check2" > Guardar y Seguir</input>    
        <button type="reset" class="btn" style="float:right; margin-right: 10px;">Limpiar Formulario</button>
    </p>
</div>


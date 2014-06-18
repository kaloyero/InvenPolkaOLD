
<h4 class="widgettitle nomargin shadowed">Proyectos<button class="volver glyphicon" style="float:right;" type="button" title="Volver atras"><img src="app/webroot/img/icon-back.png" alt="Volver atras" /></button></h4>
<div class="widgetcontent bordered shadowed nopadding">

<?php
echo $this->Form->create('Usuario',array('class' => 'stdform2 stdform','inputDefaults' => array(
        'div' => array('class' => 'field'))));

?>
	<div class="conteinerPrinc-1">
<?php

echo $this->Form->input('username',array('class'=>'input-medium','div'=>false,'label'=>false,'before'=>'<p><label style="float: left;">Usuario</label><span  class="field float">','after'=>'</span>'));

echo $this->Form->input('password',array('class'=>'input-medium','maxlength'=>'16','div'=>false,'label'=>false,'before'=>'<p><label style="float: left;">Clave</label><span  class="field float">','after'=>'</span></p>'));

echo $this->Form->input('Nombre',array('class'=>'input-medium','div'=>false,'label'=>false,'before'=>'<p><label style="float: left;">Nombre</label><span  class="field float">','after'=>'</span></p>'));

echo $this->Form->input('Apellido',array('class'=>'input-medium','div'=>false,'label'=>false,'before'=>'<p><label style="float: left;">Apellido</label><span  class="field float">','after'=>'</span></p>'));

echo $this->Form->input('Legajo',array('class'=>'input-medium','div'=>false,'label'=>false,'before'=>'<p><label style="float: left;">Legajo</label><span  class="field float">','after'=>'</span></p>'));

echo $this->Form->input('Email',array('class'=>'input-medium','div'=>false,'label'=>false,'before'=>'<p><label style="float: left;">Correo</label><span  class="field float">','after'=>'</span></p>'));

?>
    </div>
    <div class="conteinerPrinc-2">
<?php

echo $this->Form->input('Descripcion',array('type' => 'textarea','class'=>'span5','div'=>false,'label'=>false,'before'=>'<p><label style="float: left;">Comentario</label><span class="field float">','after'=>'</span></p>'));

echo $this->Form->input('TipoRol',array('type'=>'select','options'=>$rolesList,'empty'=>false,'div'=>false,'label'=>false,'before'=>'<p><label style="float: left;" >Tipo Usuario</label><span class="field float">','after'=>'</span></p>'));

echo $this->Form->input('IdProyecto',array('type'=>'select','disabled' => 'disabled','id'=>'proyectoId','options'=>$proyectos,'empty'=>true,'div'=>false,'label'=>false,'before'=>'<p><label style="float: left;" >Proyecto</label><span class="field float">','after'=>'<small><em> * Sol para usuarios de tipo \'Arte\'</em></small></span></p>'));

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

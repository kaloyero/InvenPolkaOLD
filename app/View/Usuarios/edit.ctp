<h4 class="widgettitle nomargin shadowed">Usuario<button class="volver glyphicon" style="float:right;" type="button" title="Volver atras"><img src="app/webroot/img/icon-back.png" alt="Volver atras" /></button></h4>
<div class="widgetcontent bordered shadowed nopadding">

<?php
echo $this->Form->create('Usuario',array('class' => 'stdform stdform2','inputDefaults' => array(
        'div' => array('class' => 'field'))));

?>
	<div class="conteinerPrinc-1">
<?php

echo $this->Form->input('username',array('class'=>'input-medium','div'=>false,'label'=>false,'before'=>'<p><label style="float: left;">Usuario</label><span  class="field float">','after'=>'</span></p>'));

echo $this->Form->input('Nombre',array('class'=>'input-medium','div'=>false,'label'=>false,'before'=>'<p><label style="float: left;">Nombre</label><span  class="field float">','after'=>'</span></p>'));

echo $this->Form->input('Apellido',array('class'=>'input-medium','div'=>false,'label'=>false,'before'=>'<p><label style="float: left;">Apellido</label><span  class="field float">','after'=>'</span></p>'));

echo $this->Form->input('Legajo',array('class'=>'input-medium','div'=>false,'label'=>false,'before'=>'<p><label style="float: left;">Legajo</label><span  class="field float">','after'=>'</span></p>'));

echo $this->Form->input('Email',array('class'=>'input-medium','div'=>false,'label'=>false,'before'=>'<p><label style="float: left;">Correo</label><span  class="field float">','after'=>'</span></p>'));

?>
    </div>
    <div class="conteinerPrinc-2">
<?php

echo $this->Form->input('Descripcion',array('type' => 'textarea','class'=>'span5','div'=>false,'label'=>false,'before'=>'<p><label style="float: left;">Comentario</label><span class="field float">','after'=>'</span></p>'));

echo $this->Form->input('TipoRol',array('type'=>'select','options'=>$rolesList,'empty'=>false,'class'=>'uniformselect','div'=>false,'label'=>false,'before'=>'<p><label style="float: left;" >Tipo Usuario</label><span class="field float">','after'=>'</span></p>'));

//Si es usuario ARTE
if ($this->request->data['Usuario']['TipoRol'] == '3'){
	echo $this->Form->input('IdProyecto',array('type'=>'select','id'=>'proyectoId','options'=>$proyectos,'empty'=>true,'class'=>'uniformselect','div'=>false,'label'=>false,'before'=>'<p><label style="float: left;" >Proyecto</label><span class="field float">','after'=>'<small><em> Solo para usuarios de tipo \'Arte\'</em></small></span></p>'));	
} else {
	echo $this->Form->input('IdProyecto',array('type'=>'select','disabled' => 'disabled','id'=>'proyectoId','options'=>$proyectos,'empty'=>true,'class'=>'uniformselect','div'=>false,'label'=>false,'before'=>'<p><label style="float: left;" >Proyecto</label><span class="field float">','after'=>'<small><em> Solo para usuarios de tipo \'Arte\'</em></small></span></p>'));
}

echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->input('Usuario.IdUsuarioProyecto', array('type' => 'hidden'));

//echo $this->Form->end('Guardar');
echo '';

?>
	</div>
</div>

<div class="botonera widgettitle">
	<p class="stdformbutton">
	    <button class="btn btn-primary edit" style="margin-left: 10px;">Guardar</button>
	</p>
</div>

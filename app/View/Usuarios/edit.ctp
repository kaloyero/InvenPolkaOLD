<?php
echo '<h4 class="widgettitle nomargin shadowed">Usuario</h4>';
echo '<div class="widgetcontent bordered shadowed nopadding">';
echo $this->Form->create('Usuario',array('class' => 'stdform stdform2','inputDefaults' => array(
        'div' => array('class' => 'field'))));

echo $this->Form->input('username',array('class'=>'input-medium','div'=>false,'label'=>false,'before'=>'<p><label style="float: left;">Usuario</label><span  class="field float">','after'=>'</span>'));

echo $this->Form->input('Nombre',array('class'=>'input-medium','div'=>false,'label'=>false,'before'=>'<p><label style="float: left;">Nombre</label><span  class="field float">','after'=>'</span>'));

echo $this->Form->input('Apellido',array('class'=>'input-medium','div'=>false,'label'=>false,'before'=>'<p><label style="float: left;">Apellido</label><span  class="field float">','after'=>'</span>'));

echo $this->Form->input('Legajo',array('class'=>'input-medium','div'=>false,'label'=>false,'before'=>'<p><label style="float: left;">Legajo</label><span  class="field float">','after'=>'</span>'));

echo $this->Form->input('Email',array('class'=>'input-medium','div'=>false,'label'=>false,'before'=>'<p><label style="float: left;">Correo</label><span  class="field float">','after'=>'</span>'));

echo $this->Form->input('Descripcion',array('type' => 'textarea','class'=>'span5','div'=>false,'label'=>false,'before'=>'<label style="float: left;">Comentario</label><span class="field float">','after'=>'</span></p>'));

echo $this->Form->input('TipoRol',array('type'=>'select','options'=>$rolesList,'empty'=>false,'class'=>'uniformselect','div'=>false,'label'=>false,'before'=>'<label style="float: left;" >Tipo Usuario</label><span class="field float">','after'=>'</span></p>'));

echo $this->Form->input('id', array('type' => 'hidden'));

//echo $this->Form->end('Guardar');
echo '<p class="stdformbutton"><button class="btn btn-primary edit">Guardar</button></p>';

?>
</div>
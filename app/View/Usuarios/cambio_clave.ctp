<?php
echo '<h4 class="widgettitle nomargin shadowed">Usuario</h4>';
echo '<div class="widgetcontent bordered shadowed nopadding">';
echo $this->Form->create('Usuario',array('class' => 'stdform stdform2','inputDefaults' => array(
        'div' => array('class' => 'field'))));

echo $this->Form->input('passwordViejo',array('type'=>'password','class'=>'input-medium','required','div'=>false,'label'=>false,'before'=>'<p><label style="float: left;">Clave Anterior</label><span  class="field float">','after'=>'</span>'));

echo $this->Form->input('password',array('class'=>'input-medium','div'=>false,'label'=>false,'before'=>'<p><label style="float: left;">Clave Nueva</label><span  class="field float">','after'=>'</span>'));

echo $this->Form->input('passwordConfirm',array('type'=>'password','class'=>'input-medium','required','div'=>false,'label'=>false,'before'=>'<p><label style="float: left;">Confirmar Clave</label><span  class="field float">','after'=>'</span>'));

echo $this->Form->input('id', array('type' => 'hidden'));

//echo $this->Form->end('Guardar');
echo '<p class="stdformbutton"><button class="btn btn-primary cambioClave">Cambiar</button></p>';

?>
<div class= "errorDiv">
<?php echo $errorClave ?>
</div>

</div>
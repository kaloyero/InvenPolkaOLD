<h4 class="widgettitle nomargin shadowed">Cambio de Clave</h4>
<div class="widgetcontent bordered shadowed nopadding">

<?php
echo $this->Form->create('Usuario',array('class' => 'stdform stdform2','inputDefaults' => array(
        'div' => array('class' => 'field'))));
?>
<div class="conteinerPrinc-1">

<?php
echo $this->Form->input('passwordViejo',array('type'=>'password','class'=>'input-medium','required','div'=>false,'label'=>false,'before'=>'<p><label style="float: left;">Clave Anterior</label><span  class="field float">','after'=>'</span>'));

?>
<br><br><br>
</div>
<div class="conteinerPrinc-2">
<?php
echo $this->Form->input('password',array('class'=>'input-medium','div'=>false,'label'=>false,'before'=>'<p><label style="float: left;">Clave Nueva</label><span  class="field float">','after'=>'</span>'));

echo $this->Form->input('passwordConfirm',array('type'=>'password','class'=>'input-medium','required','div'=>false,'label'=>false,'before'=>'<p><label style="float: left;">Confirmar Clave</label><span  class="field float">','after'=>'</span>'));

echo $this->Form->input('id', array('type' => 'hidden'));
?>
</div>
<?php

?>
<div class= "errorDiv">
<?php echo $errorClave ?>
</div>

</div>

<div class="botonera widgettitle">
	<p class="stdformbutton">
	    <button class="btn btn-primary cambioClave" style="margin-left: 10px;">Cambiar</button>
	</p>
</div>
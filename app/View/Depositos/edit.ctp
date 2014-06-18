<h4 class="widgettitle nomargin shadowed">Deposito</h4>
<div class="widgetcontent bordered shadowed nopadding">


<?php
echo $this->Form->create('Deposito',array('class' => 'stdform stdform2','inputDefaults' => array(
        'div' => array('class' => 'field'))));
?>
<div class="conteinerPrinc-1">		

<?php
echo $this->Form->input('Nombre',array('class'=>'input-medium','div'=>false,'label'=>false,'before'=>'<p>
                                <label style="float: left;">Nombre</label>
                                <span class="field float">',
								'after'=>'</span></p>'));
echo $this->Form->input('id', array('type' => 'hidden'));
?>
</div>
<div class="conteinerPrinc-2">		
</div>
</div>

<div class="botonera widgettitle">
	<p class="stdformbutton">
        <button class="btn btn-primary edit" style="margin-left: 10px;">Guardar</button>
    </p>
</div>


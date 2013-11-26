<?php
echo '<h4 class="widgettitle nomargin shadowed">Deposito</h4>';
echo '<div class="widgetcontent bordered shadowed nopadding">';
echo $this->Form->create('Deposito',array('class' => 'stdform stdform2','inputDefaults' => array(
        'div' => array('class' => 'field'))));
		
echo $this->Form->input('Nombre',array('class'=>'input-medium','div'=>false,'label'=>false,'before'=>'<p>
                                <label style="float: left;">Nombre del Deposito</label>
                                <span class="field float">',
								'after'=>'</span>'));
echo $this->Form->input('id', array('type' => 'hidden'));
//echo $this->Form->submit('Guardar');
/* Seguir agregando*/
/* FIn Seguir agregando*/
//echo $this->Html->link('Cancelar', '/categorias');

//echo $this->Form->end();
echo '<p class="stdformbutton"><button class="btn btn-primary edit">Guardar</button></p>';
?>
</div>
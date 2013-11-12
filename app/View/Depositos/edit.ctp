<?php
echo '<h4 class="widgettitle nomargin shadowed">Deposito</h4>';
echo '<div class="widgetcontent bordered shadowed nopadding">';
echo $this->Form->create('Deposito',array('class' => 'stdform stdform2','inputDefaults' => array(
        'div' => array('class' => 'field'))));
echo $this->Form->input('Nombre');
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->input('FechaFin',array('empty'=>true,'class'=>'uniformselect fecha','div'=>false,'label'=>false,'before'=>'<p><label>Fecha Fin</label><span class="field">','after'=>'<small class="field"><em> yyyy / mm / dd</em></small></span></p>','type' => 'text'));
//echo $this->Form->submit('Guardar');
/* Seguir agregando*/
/* FIn Seguir agregando*/
//echo $this->Html->link('Cancelar', '/categorias');

//echo $this->Form->end();
echo '<p class="stdformbutton"><button class="btn btn-primary edit">Guardar</button></p>';
?>
</div>
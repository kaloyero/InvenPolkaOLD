<?php
echo '<h4 class="widgettitle nomargin shadowed">Depositos</h4>';
echo '<div class="widgetcontent bordered shadowed nopadding">';
echo $this->Form->create('Deposito',array('class' => 'stdform stdform2','inputDefaults' => array(
        'div' => array('class' => 'field'))));
echo $this->Form->input('Nombre');
echo $this->Form->input('FechaFin',array('empty'=>false,'class'=>'uniformselect','div'=>false,'label'=>false,'before'=>'<p><label>Fecha Fin</label><span class="field">','after'=>'</span></p>'));
echo $this->Form->input('guardaryseguir', array('label'=>'Guardar y seguir', 'type'=>'checkbox' ));
/* FIn Seguir agregando*/
//echo $this->Html->link('Cancelar', '/categorias');

//echo $this->Form->end();
echo '<p class="stdformbutton"><button class="btn btn-primary save">Guardar</button><button type="reset" class="btn">Limpiar Formulario</button></p>';
?>
</div>



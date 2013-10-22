<?php
echo '<h4 class="widgettitle nomargin shadowed">Material</h4>';
echo '<div class="widgetcontent bordered shadowed nopadding">';
echo $this->Form->create('Materiale',array('type' => 'file','class' => 'stdform stdform2','inputDefaults' => array(
        'div' => array('class' => 'field'))));
echo $this->Form->input('Nombre');
//echo $this->Form->submit('Guardar');
/* Seguir agregando*/
echo $this->Form->input('guardaryseguir', array('label'=>'Guardar y seguir', 'type'=>'checkbox' ));
/* FIn Seguir agregando*/
//echo $this->Html->link('Cancelar', '/categorias');

//echo $this->Form->end();
echo '<p class="stdformbutton"><button class="btn btn-primary save">Guardar</button><button type="reset" class="btn">Limpiar Formulario</button></p>';
?>
</div>
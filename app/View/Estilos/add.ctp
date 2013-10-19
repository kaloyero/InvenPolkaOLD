<h1>Agregar</h1>
<?php
echo $this->Form->create('Estilo');
echo $this->Form->input('Nombre');
echo $this->Form->submit('Guardar');
/* Seguir agregando*/
echo $this->Form->input('guardaryseguir', array('label'=>'Guardar y seguir', 'type'=>'checkbox' )); 
/* FIn Seguir agregando*/
echo $this->Html->link('Cancelar', '/estilos');

echo $this->Form->end();
?>
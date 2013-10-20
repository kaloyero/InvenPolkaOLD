<h1>Agregar</h1>
<?php
echo $this->Form->create('Dimensione');
echo $this->Form->input('Nombre');
echo $this->Form->submit('Guardar');
/* Seguir agregando*/
echo $this->Form->input('guardaryseguir', array('label'=>'Guardar y seguir', 'type'=>'checkbox' )); 
/* FIn Seguir agregando*/
echo $this->Html->link('Cancelar', '/dimensiones');

echo $this->Form->end();
?>
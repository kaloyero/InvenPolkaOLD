<h1>Agregar</h1>
<?php
echo $this->Form->create('Deposito');
echo $this->Form->input('Nombre');
echo $this->Form->input('FechaFin');
echo $this->Form->end('Guardar');
?>
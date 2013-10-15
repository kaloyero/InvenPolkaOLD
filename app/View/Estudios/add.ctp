<h1>Agregar</h1>
<?php
echo $this->Form->create('Estudio');
echo $this->Form->input('Nombre');
echo $this->Form->input('Descripcion');
echo $this->Form->input('FechaFin');
echo $this->Form->end('Guardar');
?>
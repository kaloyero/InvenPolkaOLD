<h1>Agregar</h1>
<?php
echo $this->Form->create('Articulo');


echo $this->Form->input('CodigoArticulo');

echo $this->Form->end('Guardar');
?>
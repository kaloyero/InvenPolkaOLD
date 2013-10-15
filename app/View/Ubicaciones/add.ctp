<h1>Agregar</h1>
<?php
echo $this->Form->create('Ubicacione');



echo $this->Form->input('CodigoUbicacion');
echo $this->Form->input('Descripcion');
echo $this->Form->input('FechaFin');

echo $this->Form->input('Ubicacione.IdDeposito',array('type'=>'select','options'=>$depositos,'empty'=>false,'label'=>'Deposito'));

echo $this->Form->end('Guardar');
?>


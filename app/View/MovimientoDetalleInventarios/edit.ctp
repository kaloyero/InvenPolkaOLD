<h1>Editar</h1>
<?php
    echo $this->Form->create('Inventario', array('action' => 'edit'));
	echo $this->Form->input('Disponibilidad');
	echo $this->Form->input('Inventario.IdArticulo',array('type'=>'select','options'=>$articulos,'empty'=>false,'label'=>'Articulo'));
	echo $this->Form->input('Inventario.IdDeposito',array('type'=>'select','options'=>$depositos,'empty'=>false,'label'=>'Deposito'));
	echo $this->Form->input('Inventario.IdUbicacion',array('type'=>'select','options'=>$ubicaciones,'empty'=>false,'label'=>'Ubicacion'));
	echo $this->Form->input('Inventario.IdProyecto',array('type'=>'select','options'=>$proyectos,'empty'=>false,'label'=>'Proyecto'));
    echo $this->Form->input('id', array('type' => 'hidden'));
    echo $this->Form->end('Guardar');

?>
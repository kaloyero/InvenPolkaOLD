<h1>Editar Pedido</h1>
<?php
    echo $this->Form->create('Pedido', array('action' => 'edit'));
	echo $this->Form->input('Numero');
	echo $this->Form->input('Descripcion');
	echo $this->Form->input('Fecha');
	echo $this->Form->input('Pedido.IdProyecto',array('type'=>'select','options'=>$proyectos,'empty'=>false,'label'=>'Proyecto'));
    echo $this->Form->input('id', array('type' => 'hidden'));

	echo $this->Form->submit('Guardar');
	echo $this->Form->end();
?>
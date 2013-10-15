<h1>Editar</h1>
<?php
    echo $this->Form->create('Estilo', array('action' => 'edit'));
    echo $this->Form->input('Nombre');
    echo $this->Form->input('id', array('type' => 'hidden'));
	
    echo $this->Form->end('Guardar');
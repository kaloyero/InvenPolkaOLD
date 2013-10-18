<h1>Editar</h1>
<?php
    echo $this->Form->create('Proyecto', array('action' => 'edit'));
    echo $this->Form->input('Nombre');
    echo $this->Form->input('Descripcion');
    echo $this->Form->input('Director');
    echo $this->Form->input('FechaIni');
    echo $this->Form->input('FechaFin');
    echo $this->Form->input('id', array('type' => 'hidden'));
    echo $this->Form->end('Guardar');
	
?>
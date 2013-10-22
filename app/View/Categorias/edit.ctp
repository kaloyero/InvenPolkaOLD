<?php
	echo '<h4 class="widgettitle nomargin shadowed">Categoria</h4>';
	echo '<div class="widgetcontent bordered shadowed nopadding">';
    echo $this->Form->create('Categoria', array('action' => 'edit','class' => 'stdform stdform2','inputDefaults' => array(
	        'div' => array('class' => 'field'))));
    echo $this->Form->input('Nombre');
    echo $this->Form->input('id', array('type' => 'hidden'));

    //echo $this->Form->end('Guardar');
	echo '<p class="stdformbutton"><button class="btn btn-primary">Guardar</button><button type="reset" class="btn">Limpiar 			  	Formulario</button></p>';
?>
</div>
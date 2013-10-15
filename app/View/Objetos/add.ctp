<h1>Agregar</h1>
<?php
echo $this->Form->create('Objeto');
echo $this->Form->input('Nombre');
echo $this->Form->submit('Guardar');
/* Seguir agregando*/
//Esta variable se usa para saber para donde va redireccionar
echo $this->Form->input('RedirectAction', array('type' => 'hidden','id' => 'RedirectAction','value' => ''));
echo $this->Form->button('Guardar y seguir', 
array('type' => 'button','onclick' => "javascript: document.getElementById('RedirectAction').value='siguiente';submit();"));
/* FIn Seguir agregando*/
echo $this->Html->link('Cancelar', '/objetos');

echo $this->Form->end();
?>
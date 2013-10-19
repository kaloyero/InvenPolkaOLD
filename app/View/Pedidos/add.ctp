<h1>Agregar</h1>
<?php
echo $this->Html->charset('ISO-8859-1');

echo $this->Html->script('libs/jquery-1.6.2.min');
echo $this->Html->script('mylibs/jquery-ui-1.8.15.custom.min');
echo $this->Html->script('libs/jquery.visualize');
echo $this->Html->script('mylibs/jquery.validate');
echo $this->Html->script('mylibs/jquery.dataTables.min');
echo $this->Html->script('mylibs/jquery.notifications');

echo $this->Html->script('pedidoJS');
echo $this->Html->script('agregarArticulos');	
echo $this->Html->css(array('forms', 'tables', 'menu'));
echo $this->Html->css('DebugKit.toolbar.css');
echo $this->Html->css('Blog.common.css', null, array('plugin' => false));

//  <link rel="stylesheet" href="resources/css/jquery-ui-1.8.15.custom.css"> <!-- jQuery UI, optional -->



echo $this->Form->create('Pedido');
echo $this->Form->input('Numero');
echo $this->Form->input('Descripcion');
echo $this->Form->input('Fecha');
echo $this->Form->input('Pedido.IdProyecto',array('type'=>'select','options'=>$proyectos,'empty'=>false,'label'=>'Proyecto'));
echo $this->Form->submit('Guardar');

?>
<?php 	
echo $this->Form->input('Articulo.Cantidad',array('id'=>'Articulo.Cantidad','type'=>'number')); 
echo $this->Form->input('Articulo.Articulo',array('id'=>'Articulo.Articulo','type'=>'select','options'=>$articulos,'empty'=>false,'label'=>'Articulo'));
//		        <input type="text" name="mitexto[0]" id="campo_1" placeholder="Texto 1"/><a href="#" class="eliminar">&times;</a>		?>
		<a id="agregarCampo" class="btn btn-info" href="#">Agregar Campo</a>
<div id="contenedor">
    <div class="added">


    </div>
</div>

<?php echo $this->Form->end();?>
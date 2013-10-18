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
<tbody>
  	<tr>
<?php
	echo $this->Form->input('Cantidad',array('name'=>'PedidoCantidad'));
//	echo $this->Form->input('Articulo',array('type'=>'select','options'=>$articulos,'empty'=>false,'label'=>'Articulo'));
?>
	</tr>
</tbody>
<?php 
	echo $this->Html->link('go back',"javascript:alert()"); 
?>
<table>
    <tbody>
  <tr>
    <td><div class="input text"><input name="data[OrderDetail][0][product_code]" maxlength="100" type="text"/></div></td>
    <td><div class="input text"><input name="data[OrderDetail][0][product_name]" maxlength="255" type="text"/></div></td>
    <td><div class="input number"><input name="data[OrderDetail][0][product_qty]" step="any" type="number"/></div></td>
    <td><div class="input number"><input name="data[OrderDetail][0][product_price]" step="any" maxlength="24" type="number"/></div></td>
          </tr>
    </tbody>
</table>
<?php 
	echo $this->Html->link('go back',"javascript:alert()"); 
?>

<input type="button" id="boton" value="new row">

<a id="agregarCampo" class="btn btn-info" href="#">Agregar Campo</a>
<div id="contenedor">
    <div class="added">
        <input type="text" name="mitexto[0]" id="campo_1" placeholder="Texto 1"/><a href="#" class="eliminar">&times;</a>
    </div>
</div>

<?php echo $this->Form->end();?>
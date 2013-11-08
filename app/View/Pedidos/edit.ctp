<?php
echo $this->Form->create('Pedido',array('class' => 'stdform stdform2','inputDefaults' => array(
        'div' => array('class' => 'field') )));

foreach ($Pedido as $Pe){
?>
		<label>Numero Pedido</label>
		<span class="field"><input name="Numero" value="<?php echo $Pe['pedidos_vista']['Numero'];?>" class="input-medium" readonly="readonly"  required="required"/></span>
		<label>Fecha</label>
		<span class="field"><input name="fecha" value="<?php echo $Pe['pedidos_vista']['Fecha'];?>" class="input-medium" readonly="readonly" maxlength="100" type="text" required="required"></span>
		<label>Descripcion</label>
		<span class="field"><input name="descripcion" value="<?php echo $Pe['pedidos_vista']['Descripcion'];?>" class="input-medium" readonly="readonly" maxlength="100" type="text" required="required"></span>
		<label>Proyecto</label>
		<span class="field"><input name="Proyecto" value="<?php echo $Pe['pedidos_vista']['proyecto'];?>" class="input-medium" readonly="readonly" type="text"  required="required"/></span>
		<label>Estudio</label>
		<span class="field"><input name="Estudio" value="<?php echo $Pe['pedidos_vista']['estudio'];?>" class="input-medium" readonly="readonly" type="text" required="required"/></span>

<?php
		if ($Pe['pedidos_vista']['estado'] == 'abierto'){
				echo '<p class="stdformbutton"><button class="btn btn-primary save">Confirmar</button></p>';
		}

}

?>
LISTA DE ARTICULOS
<table  id="listaArticulos" class ="table table-bordered" width="100%"  style="width: 100%;">
	<thead>
					<tr>
                        <th>Codigo Articulo</th>
                        <th>Cantidad</th>
                        <th>Descripcion</th>
                        <th>Imagen</th>
		            </tr>
	</thead>
	<tbody>
<?php
	foreach ($Detalles as $De){

?>			<tr>
				<td><?php echo $De['det']['idArticulo'] ;?></td>
				<td><?php echo $De['art']['Descripcion'] ;?></td>
				<td><?php echo $De['det']['Cantidad'] ;?></td>
   				<td><img style="width:250px; height:150px;border-style:solid;border-width:3px;" src="/InvenPolka/app/webroot/files/articulo/IdFoto/<?php echo $De['det']['idArticulo']; ?>/<?php echo $De['art']['idFoto']; ?>"></td>
            </tr>
<?php
			}
?>

	</tbody>
</table>


<?php
echo '<h4 class="widgettitle nomargin shadowed">Despacho Pedido</h4>';
echo '<div class="widgetcontent bordered shadowed nopadding">';
echo $this->Form->create('Pedido',array('class' => 'stdform stdform2','inputDefaults' => array(
        'div' => array('class' => 'field') )));


?>
<p>
		<label style="float: left;">Numero Pedido</label>
		<span class="field float"><input name="Numero" value="<?php echo $Pe['Numero'];?>" class="input-medium" readonly="readonly"  required="required"/></span>
		<label style="float: left;">Fecha</label>
		<span class="field float"><input name="fecha" value="<?php echo $Pe['Fecha'];?>" class="input-medium" readonly="readonly" maxlength="100" type="text" required="required"></span></p>
			<p>
		<label style="float: left;">Descripcion</label>
		<span class="field float"><textarea name="descripcion"  class="span5" readonly="readonly" cols="30" rows="6"><?php echo $Pe['Descripcion'];?></textarea></span>

		<label style="float: left;">Proyecto</label>
		<span class="field float"><input name="Proyecto" value="<?php echo $Pe['proyecto'];?>" class="input-medium" readonly="readonly" type="text"  required="required"/></span>
		</p>

		<label style="float: left;">Estado</label>
		<span class="field float"><input name="Estado" value="<?php echo $Pe['estado'];?>" class="input-medium" readonly="readonly" type="text"  required="required"/></span>
		</p>

<?php


?>
<p><h5 style="color:#3366FF;padding-left:0.5em;">Lista de Articulos</h5></p>
<table  id="listaArticulos" class ="table table-bordered" width="100%"  style="width: 100%;">
	<thead>
					<tr>
                        <th>Codigo Articulo</th>
                        <th>Descripcion</th>
                        <th>Cantidad</th>                        
                        <th>Imagen</th>
		            </tr>
	</thead>
	<tbody>
<?php
	foreach ($Detalles as $De){

?>			<tr>
				<td><?php echo $De['art']['codigo'] ;?></td>
				<td><?php echo $De['art']['Descripcion'] ;?></td>
				<td><?php echo $De['det']['Cantidad'] ;?></td>
   				<td><img style="width:150px; height:150px;border-style:solid;border-width:3px;" src="/InvenPolka/app/webroot/files/articulo/idFoto/<?php echo $De['det']['IdArticulo']; ?>/small_<?php echo $De['art']['idFoto']; ?>"></td>
            </tr>
<?php
			}
?>

	</tbody>
</table>
</div>
<br>
<button class="btn btn-primary volver" type="button">Volver</button>



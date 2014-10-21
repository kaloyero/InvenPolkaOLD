
<h4 class="widgettitle nomargin shadowed">Despacho Pedido<button class="volver glyphicon" style="float:right;" type="button" title="Volver atras"><img src="app/webroot/img/icon-back.png" alt="Volver atras" /></button></h4>
<div class="widgetcontent bordered shadowed nopadding">
<?php

echo $this->Form->create('Pedido',array('class' => 'stdform','inputDefaults' => array(
	'div' => array('class' => 'field') )));
?>

<div class="conteinerPrinc-1">
	<p>
		<label class="items-header2">Numero Pedido</label>
		<span class="field float"><input name="Numero" value="<?php echo $Pe['Numero'];?>" class="input-medium" readonly="readonly"  required="required"/></span>
	</p>        
    <p>
		<label class="items-header2">Proyecto</label>
		<span class="field float"><input name="Proyecto" value="<?php echo $Pe['proyecto'];?>" class="input-medium" readonly="readonly" type="text"  required="required"/></span>
	</p>
    <p>
		<label class="items-header2">Fecha Salida</label>
		<span class="field float" ><input name="fecha" value="<?php echo $Pe['Fecha'];?>" class="input-medium" readonly="readonly" maxlength="100" type="text" required="required"></span>
	</p>        
    <p>        
		<label>Devolución Aproximada</label>
		<span class="field float" ><input name="fecha" value="<?php echo $Pe['FechaDev'];?>" class="input-medium" readonly="readonly" maxlength="100" type="text" required="required"></span>
	</p>   
    
</div>

<div class="conteinerPrinc-2">
	<p>
		<label class="items-header2">Descripcion</label>
		<span class="field float"><textarea name="descripcion" class="span5" readonly="readonly" cols="30" rows="6"><?php echo $Pe['Descripcion'];?></textarea></span>
	</p>
</div>	


		<div class="listaArticulos widgettitle nomargin shadowed"><h4> Lista de Articulos</h4></div>
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
<div class="botonera widgettitle">
</div>

</div>

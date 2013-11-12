<?php
echo '<h4 class="widgettitle nomargin shadowed">Asignar articulos a proyecto</h4>';
echo '<div class="widgetcontent bordered shadowed nopadding">';

echo $this->Form->create('MovimientoInventario',array('class' => 'stdform stdform2','inputDefaults' => array(
        'div' => array('class' => 'field') )));

?>
<?php 	foreach ($pedido as $pe): ?>
<p>
    <label style="float: left;">Numero de Pedido</label>
	<span class="field float">
    	<input class="input-medium" maxlength="100" type="text" value="<?php echo $pe['pedidos_vista']['Numero'] ?>" required="required">
    </span>
</p>								
<p>
    <label style="float: left;">Fecha de Emisión</label>
	<span class="field float">
    	<input class="input-medium" maxlength="100" type="text" value="<?php echo $pe['pedidos_vista']['Fecha'] ?>" required="required">
    </span>
</p>								
<p>
    <label style="float: left;">Comentarios</label>
	<span class="field float">
    	<input class="input-medium" maxlength="100" type="text" value="<?php echo $pe['pedidos_vista']['Descripcion'] ?>" required="required">
    </span>
</p>								
<p>
    <label style="float: left;">Proyecto</label>
	<span class="field float">
    	<input class="input-medium" maxlength="100" type="text" value="<?php echo $pe['pedidos_vista']['estudio'] ?>" required="required">
    </span>
</p>								
<p>
    <label style="float: left;">Estudio</label>
	<span class="field float">
    	<input class="input-medium" maxlength="100" type="text" value="<?php echo $pe['pedidos_vista']['estudio'] ?>" required="required">
    </span>
</p>								
<input type="hidden" value="<?php echo $pe['pedidos_vista']['id'] ?>" name="data[MovimientoInventario][IdPedido]"/>
<input type="hidden" value="<?php echo $pe['pedidos_vista']['id_proyecto'] ?>" name="data[MovimientoInventario][IdProyecto]"/>
<input type="hidden" value="<?php echo $pe['pedidos_vista']['id_estudio'] ?>" name="data[MovimientoInventario][IdEstudio]"/>
<?php endforeach; ?>
<?php 
echo $this->Form->input('Fecha',array('class'=>'input-medium','div'=>false,'label'=>false,'before'=>'<p>
                                <label style="float: left;">Fecha Empaquetado</label>
                                <span class="field float">',
								'after'=>'</span>'));
echo $this->Form->input('Descripcion',array('class'=>'input-medium','div'=>false,'label'=>false,'before'=>'<p>
                                <label style="float: left;">Comentarios</label>
                                <span class="field float">',
								'after'=>'</span>'));
?>
<input type="hidden" value="P" name="data[MovimientoInventario][TipoMovimiento]"/>
<?php
echo $this->Form->input('MovimientoInventario.IdDepositoOrig',array('id'=>'depositoOriginal','type'=>'select','options'=>$depositos,'empty'=>true,'class'=>'input-medium','div'=>false,'label'=>false,'before'=>'<p>
                                <label style="float: left;">Deposito</label>
                                <span class="field float">',
								'after'=>'</span>'));
?>

LISTA DE ARTICULOS
<table  id="listaArticulos" class ="table table-bordered" width="100%"  style="width: 100%;">
	<thead>
        <tr>
            <th>Codigo Articulo</th>
            <th>Descripcion</th>
            <th>Cantidad solicitada</th>
            <th>Cantidad enviada</th>
            <th>Imagen</th>
            <th>Acciones</th>
        </tr>
	</thead>
	<tbody>
		<?php
		//Cuenta las filas
		$cont = 0;
		//Itera la lista de articulos recibida
		foreach ($artis as $articulo):
			$cont= $cont + 1;
		?>
        <tr id ="<?php echo $articulo['det']['IdArticulo']?>">
            <td>
	            <input name="data[Detalle][<?php echo $cont ?>][IdArticulo]" type="hidden" value="<?php echo $articulo['det']['IdArticulo']; ?>" readonly="readonly" />
	            <input name="data[Detalle][<?php echo $cont ?>][IdPedidoDetalle]" type="hidden" value="<?php echo $articulo['det']['IdDetalle']; ?>" readonly="readonly" /> 
				<?php echo $articulo['art']['codigo']; ?>
            </td>
            <td><?php echo $articulo['art']['Descripcion']; ?></td>
            <td><?php echo $articulo['det']['Cantidad']; ?></td>
			<td><input name="data[Detalle][<?php echo $cont ?>][Cantidad]"  class="input-medium valid" value="0" min="0" type="number" /></td>            
            <td><img style="width:250px; height:150px;border-style:solid;border-width:3px;" src="/InvenPolka/app/webroot/files/articulo/IdFoto/<?php echo $articulo['art']['dir']; ?>/<?php echo $articulo['art']['idFoto']; ?>" alt="CakePHP" ></td>
<td><img class="desactiva" src="/InvenPolka/app/webroot/files/gif/desactivar.png"></td>
        </tr>
        <?php endforeach; ?>

	</tbody>
</table>



<?php
echo '<p class="stdformbutton"><button class="btn btn-primary save">Asignar</button></p>';
?>
<?php echo $this->Form->end();?>
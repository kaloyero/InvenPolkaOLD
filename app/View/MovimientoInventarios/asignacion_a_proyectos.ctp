<?php
echo '<h4 class="widgettitle nomargin shadowed">Asignar articulos a proyecto</h4>';
echo '<div class="widgetcontent bordered shadowed nopadding">';

echo $this->Form->create('MovimientoInventario',array('class' => 'stdform stdform2','inputDefaults' => array(
        'div' => array('class' => 'field') )));

?>

<p>
    <label style="float: left;">Numero de Pedido</label>
	<span class="field float">
    	<input  readonly="readonly" class="input-medium pedido" maxlength="100" type="text" value="<?php echo $pe['Numero'] ?>" required="required">
    </span>

    <label style="float: left;">Fecha de Emisión</label>
	<span class="field float">
    	<input readonly="readonly" class="input-medium" maxlength="100" type="text" value="<?php echo $pe['Fecha'] ?>" required="required">
    </span>

	<label style="float: left;">Proyecto</label>
	<span class="field float">
    	<input  readonly="readonly" class="input-medium" maxlength="100" type="text" value="<?php echo $pe['proyecto'] ?>" required="required">
    </span>

</p>
<p>
	<label style="float: left;">Comentarios</label>
	<span class="field float">
    	<textarea  readonly="readonly" name="data[Articulo][Descripcion]" class="span5" pattern=".*\S+.*" cols="30" rows="6"  required="required"><?php echo $pe['Descripcion'] ?></textarea>
    </span>
</p>
<input type="hidden" value="<?php echo $pe['id'] ?>" name="data[MovimientoInventario][IdPedido]"/>
<input type="hidden" value="<?php echo $pe['id_proyecto'] ?>" name="data[MovimientoInventario][IdProyecto]"/>

<p><h5 style="color:#3366FF;padding-left:0.5em;">Datos del Despacho</h5></p>

<?php
echo '<label style="float: left;">Fecha Empaquetado</label><span class="field float"><input  id ="fechaDespacho" class="input-small fecha" type="text" name="data[MovimientoInventario][Fecha]" required="required" /><small><em>   año / mes / dia</em></small></span>';

echo $this->Form->input('Descripcion',array('type' => 'textarea','class'=>'span5','div'=>false,'label'=>false,'before'=>'<p>
                                <label style="float: left;">Comentarios</label>
                                <span class="field float">',
                                                                'after'=>'</span>'));

?>

<input type="hidden" value="P" name="data[MovimientoInventario][TipoMovimiento]"/>
<?php
echo $this->Form->input('MovimientoInventario.IdDepositoOrig',array('id'=>'depositoOriginal','type'=>'select','options'=>$depositos,'empty'=>false,'class'=>'uniformselect','div'=>false,'label'=>false,'before'=>'
                                <label style="float: left;">Deposito</label>
                                <span class="field float">',
								'after'=>'</span>'));
?>
</p>
<p><h5 style="color:#3366FF;padding-left:0.5em;">Lista de Articulos</h5></p>
<table  id="listaArticulos" class ="table table-bordered" width="100%"  style="width: 100%;">
	<thead>
        <tr>
            <th>Codigo Articulo</th>
            <th>Descripcion</th>
            <th>Cantidad solicitada</th>
            <th>Cantidad enviada</th>
            <th>Imagen</th>
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
			<td><input name="data[Detalle][<?php echo $cont ?>][Cantidad]"  class="input-medium valid" value="0" min="0" max="<?php echo $articulo['det']['Cantidad']; ?>" type="number" /></td>
            <td><img style="width:150px; height:150px;border-style:solid;border-width:3px;" src="/InvenPolka/app/webroot/files/articulo/idFoto/<?php echo $articulo['art']['dir']; ?>/small_<?php echo $articulo['art']['idFoto']; ?>" alt="CakePHP" ></td>
        </tr>
        <?php endforeach; ?>

	</tbody>
</table>



<?php
echo '<p class="stdformbutton"><button class="btn btn-primary asignar">Aceptar</button></p>';
?>
<?php echo $this->Form->end();?>

</div>
<button class="btn btn-primary volver" type="button">Volver</button>
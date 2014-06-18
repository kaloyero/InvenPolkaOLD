<h4 class="widgettitle nomargin shadowed">Datos del Pedido<button class="volver glyphicon" style="float:right;" type="button" title="Volver atras"><img src="app/webroot/img/icon-back.png" alt="Volver atras" /></button></h4>
<div class="widgetcontent bordered shadowed nopadding">

<?php
echo $this->Form->create('MovimientoInventario',array('class' => 'stdform stdform2','inputDefaults' => array(
        'div' => array('class' => 'field') )));

?>

<div class="conteinerPrinc-1">
    <p>
        <label style="float: left;">Nro. Pedido</label>
        <span class="field float">
            <input  readonly="readonly" class="input-medium pedido" maxlength="100" type="text" value="<?php echo $pe['Numero'] ?>" required="required">
        </span>
    </p>
    <p>
        <label style="float: left;">Fecha Emisión</label>
        <span class="field float">
            <input readonly="readonly" class="input-medium" maxlength="100" type="text" value="<?php echo $pe['Fecha'] ?>" required="required">
        </span>
    </p>
    <p>
        <label style="float: left;">Proyecto</label>
        <span class="field float">
            <input  readonly="readonly" class="input-medium" maxlength="100" type="text" value="<?php echo $pe['proyecto'] ?>" required="required">
        </span>
    </p>
</div>
<div class="conteinerPrinc-2">
    <p>
        <label style="float: left;">Comentarios</label>
        <span class="field float">
            <textarea  readonly="readonly" name="data[Articulo][Descripcion]" class="span5" pattern=".*\S+.*" cols="30" rows="6"  required="required"><?php echo $pe['Descripcion'] ?></textarea>
        </span>
    </p>
    <input type="hidden" value="<?php echo $pe['id'] ?>" name="data[MovimientoInventario][IdPedido]"/>
    <input type="hidden" value="<?php echo $pe['id_proyecto'] ?>" name="data[MovimientoInventario][IdProyecto]"/>
</div>

<div class="listaArticulos widgettitle nomargin shadowed"><h4> Datos del Envio</h4></div>

<div class="conteinerPrinc-1">
	<p>
	<label style="float: left;">Fecha Envío</label><span class="field float"><input  id ="fechaDespacho" class="input-small fecha" type="text" name="data[MovimientoInventario][Fecha]" required="required" /><small><em>   año / mes / dia</em></small></span>
    </p>
    <input type="hidden" value="P" name="data[MovimientoInventario][TipoMovimiento]"/>
<?php
echo $this->Form->input('MovimientoInventario.IdDepositoOrig',array('id'=>'depositoOriginal','type'=>'select','options'=>$depositos,'empty'=>false,'class'=>'uniformselect','div'=>false,'label'=>false,'before'=>'
                                <p><label>Deposito</label>
                                <span class="field float">',
								'after'=>'</span></p>'));
?>
	<br><br>
</div>
<div class="conteinerPrinc-2">
	<?php
    echo $this->Form->input('Descripcion',array('type' => 'textarea','class'=>'span5','div'=>false,'label'=>false,'before'=>'<p>
                                    <label style="float: left;">Comentarios</label>
                                    <span class="field float">',
                                                                    'after'=>'</span>'));
    ?>
</div>

<div class="listaArticulos widgettitle nomargin shadowed"><h4>Lista de Articulos</h4></div>
<table  id="listaArticulos" class ="table table-bordered" width="100%"  style="width: 100%;">
	<thead>
        <tr>
            <th>Codigo Articulo</th>
            <th>Descripcion</th>
            <th>Stock Disponible</th>
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
            <td><?php echo $articulo['inv']['CantidadStock']; ?></td>
            <td><?php echo $articulo['det']['Cantidad']; ?></td>
		<?php if ($articulo['det']['Cantidad'] > $articulo['inv']['CantidadStock'] ){ ?>
			<td><input name="data[Detalle][<?php echo $cont ?>][Cantidad]"  class="input-medium valid" value="0" min="0" max="<?php echo $articulo['inv']['CantidadStock']; ?>" type="number" /></td>
		<?php } else { ?>
			<td><input name="data[Detalle][<?php echo $cont ?>][Cantidad]"  class="input-medium valid" value="0" min="0" max="<?php echo $articulo['det']['Cantidad']; ?>" type="number" /></td>
		<?php } ?>
            <td><img style="width:150px; height:150px;border-style:solid;border-width:3px;" src="/InvenPolka/app/webroot/files/articulo/idFoto/<?php echo $articulo['art']['dir']; ?>/small_<?php echo $articulo['art']['idFoto']; ?>" alt="CakePHP" ></td>
        </tr>
        <?php endforeach; ?>

	</tbody>
</table>



<?php
echo '';
?>
<?php echo $this->Form->end();?>

</div>
<div class="botonera widgettitle">
	<p class="stdformbutton">
    	<button class="btn btn-primary asignar" style="margin-left: 10px;">Aceptar</button>
    </p>
</div>

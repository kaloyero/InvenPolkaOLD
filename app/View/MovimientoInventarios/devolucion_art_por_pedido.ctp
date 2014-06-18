<h4 class="widgettitle nomargin shadowed">Datos del Pedido<button class="volver glyphicon" style="float:right;" type="button" title="Volver atras"><img src="app/webroot/img/icon-back.png" alt="Volver atras" /></button></h4>
<div class="widgetcontent bordered shadowed nopadding">

<?php

echo $this->Form->create('MovimientoInventario',array('class' => 'stdform stdform2','inputDefaults' => array(
        'div' => array('class' => 'field') )));

?>

<div class="conteinerPrinc-1">
<p>
    <label style="float: left;">Nro Pedido</label>
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

<div class="listaArticulos widgettitle nomargin shadowed"><h4>Datos de la Devolución</h4></div>
<div class="conteinerPrinc-1">
<p><label  style="float: left;">Fecha Devolución</label><span class="field float"><input class="input-small fecha" type="text" name="data[MovimientoInventario][Fecha]" required="required" /><small class="field"><em>   año / mes / dia</em></small></span></p>

<?php
echo $this->Form->input('MovimientoInventario.IdDepositoOrig',array('id'=>'depositoOriginal','type'=>'select','options'=>$depositos,'empty'=>false,'class'=>'uniformselect','div'=>false,'label'=>false,'before'=>'
                                <label style="float: left;">Deposito</label>
                                <span class="field float">',
								'after'=>'</span></p>'));
?>
<BR><BR>
</div>
<div class="conteinerPrinc-2">
<?php

echo $this->Form->input('Descripcion',array('type' => 'textarea','class'=>'span5','div'=>false,'label'=>false,'before'=>'
								                                <p><label style="float: left;">Comentarios</label>
								                                <span class="field float">',
																'after'=>'</span></p>','pattern' => '.*\S+.*'));
?>
<input type="hidden" value="D" name="data[MovimientoInventario][TipoMovimiento]"/>

</div>
<div class="listaArticulos widgettitle nomargin shadowed"><h4>Lista de Articulos</h4></div>
<table  id="listaArticulos" class ="table table-bordered" width="100%"  style="width: 100%;">
	<thead>
        <tr>
            <th>Codigo Articulo</th>
            <th>Descripcion</th>
            <th>Cantidad Solicitada</th>
            <th>Cantidad Recibida</th>
            <th>Cantidad Disponible</th>            
            <th>Cantidad a Devolver</th>
            <th>Imagen</th>
        </tr>
	</thead>
	<tbody>
		<?php
		//Cuenta las filas
		$cont = 0;
		//Itera la lista de articulos recibida
		foreach ($artis as $articulo):
			
		?>
			<?php
        //Solo voy a mostrar articulos que pueden ser devueltos. Osea que en el proyecto tengan stock
            if ($articulo['inv']['CantidadStock'] > 0){
				$cont= $cont + 1;
            ?>
        <tr id ="<?php echo $articulo['det']['IdArticulo']?>">
            <td>
                <input name="data[Detalle][<?php echo $cont ?>][IdArticulo]" type="hidden" value="<?php echo $articulo['det']['IdArticulo']; ?>" readonly="readonly" />
                <?php echo $articulo['art']['codigo']; ?>
            </td>
            <td><?php echo $articulo['art']['Descripcion']; ?></td>
            <td><?php echo $articulo['pdt']['CantidadPedido']; ?></td>            
            <td><?php echo $articulo['det']['CantidadEntregada']; ?></td>
            <td>(<?php echo $articulo['inv']['CantidadStock']; ?>)</td>            
            <td>
                <?php //El tope maximo de articuos a devolver
                    $max = $articulo['det']['CantidadEntregada'];
                    //Si la cantidad entregada es mayor al stock disponible el tope maximoa  devolver sera el stock disponible
                    if ($articulo['det']['CantidadEntregada'] > $articulo['inv']['CantidadStock'] ){
                        $max = $articulo['inv']['CantidadStock'];
                    } 
                
                ?>
                <input name="data[Detalle][<?php echo $cont ?>][Cantidad]"  class="input-medium valid" 
                value="0" min="0" max="<?php echo $max; ?>" type="number" />
             </td>
            <td><img style="width:150px; height:150px;border-style:solid;border-width:3px;" src="/InvenPolka/app/webroot/files/articulo/idFoto/<?php echo $articulo['art']['dir']; ?>/small_<?php echo $articulo['art']['idFoto']; ?>" alt="CakePHP" ></td>
        </tr>
	        <?php } ?>
        <?php endforeach; ?>

	</tbody>
</table>
		<?php
        //Para asegurarme que existe al menos un articulo a devolver.
        if ($cont < 1){
            echo '<p class="stdformbutton">Este pedido no contiene articulos para ser devueltos</p>';
        }
        ?>
</div>
<div class="botonera widgettitle">
	<p class="stdformbutton">
		<?php
        //Para asegurarme que existe al menos un articulo a devolver.
        if ($cont > 0){
            ?><button class="btn btn-primary save" style="margin-left: 10px;">Aceptar</button><?php
        } else {
            echo '<p class="stdformbutton">Este pedido no contiene articulos para ser devueltos</p>';
        }
        ?>
    </p>
</div>

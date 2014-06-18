<h4 class="widgettitle nomargin shadowed">Ingreso de Articulos<button class="volver glyphicon" style="float:right;" type="button" title="Volver atras"><img src="app/webroot/img/icon-back.png" alt="Volver atras" /></button></h4>
<div class="widgetcontent bordered shadowed nopadding">

<?php

echo $this->Form->create('MovimientoInventario',array('class' => 'stdform stdform2','inputDefaults' => array(
        'div' => array('class' => 'field') )));
?>
<div class="conteinerPrinc-1">
<p><label style="float: left;">Fecha Ingreso</label><span class="field float"><input class="input-small fecha" type="text" 	name="data[MovimientoInventario][Fecha]" required="required" /><small><em> año / mes / dia</em></small></span></p>

<?php
echo $this->Form->input('MovimientoInventario.IdDepositoOrig',array('id'=>'depositoOriginal','type'=>'select','options'=>$depositos,'empty'=>false,'class'=>'uniformselect','div'=>false,'label'=>false,'before'=>'
                                <p><label style="float: left;">Deposito</label>
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
																'after'=>'</span></p>','pattern' => '.*\S+.*'));

?>
</div>


<input type="hidden" value="I" name="data[MovimientoInventario][TipoMovimiento]"/>


<div class="listaArticulos widgettitle nomargin shadowed"><h4>Lista de Articulos</h4></div>
<table  id="listaArticulos" class ="table table-bordered" width="100%"  style="width: 100%;">
	<thead>
					<tr>
                        <th>Codigo Articulo</th>
                        <th>Descripcion</th>
                        <th>Cantidad</th>
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
        <tr id ="<?php echo $articulo['articulos']['id']?>">
            <td>
	            <input name="data[Detalle][<?php echo $cont ?>][IdArticulo]" type="hidden" value="<?php echo $articulo['articulos']['id']; ?>" readonly="readonly" />
				<?php echo $articulo['articulos']['CodigoArticulo']; ?>
            </td>
            <td><?php echo $articulo['articulos']['Descripcion']; ?></td>
			<td><input name="data[Detalle][<?php echo $cont ?>][Cantidad]"  class="input-medium valid" value="1" min="1" type="number" /></td>
            <td><img style="width:150px; height:150px;border-style:solid;border-width:3px;" src="/InvenPolka/app/webroot/files/articulo/idFoto/<?php echo $articulo['articulos']['dir'].'/small_'.$articulo['articulos']['idFoto']; ?> "alt="CakePHP" ></td>
<td><img class="desactiva" src="/InvenPolka/app/webroot/files/gif/desactivar.png"></td>
        </tr>
        <?php endforeach; ?>

	</tbody>
</table>
</div>

<div class="botonera widgettitle">
	<p class="stdformbutton">
    	<button class="btn btn-primary save" style="margin-left: 10px;">Aceptar</button>
    </p>
</div>




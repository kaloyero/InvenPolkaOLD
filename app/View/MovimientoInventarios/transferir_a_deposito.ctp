<?php
echo '<h4 class="widgettitle nomargin shadowed">Articulo</h4>';
echo '<div class="widgetcontent bordered shadowed nopadding">';

echo $this->Form->create('MovimientoInventario',array('class' => 'stdform stdform2','inputDefaults' => array(
        'div' => array('class' => 'field') )));

echo $this->Form->input('Fecha',array('class'=>'input-medium','div'=>false,'label'=>false,'before'=>'<p>
                                <label style="float: left;">Fecha Empaquetado</label>
                                <span class="field float">',
								'after'=>'</span>'));
echo $this->Form->input('Descripcion',array('class'=>'input-medium','div'=>false,'label'=>false,'before'=>'<p>
                                <label style="float: left;">Comentarios</label>
                                <span class="field float">',
								'after'=>'</span>'));
?>
<input type="hidden" value="T" name="data[MovimientoInventario][TipoMovimiento]"/>
<?php
echo $this->Form->input('MovimientoInventario.IdDepositoOrig',array('id'=>'depositoOriginal','type'=>'select','options'=>$depositos,'empty'=>true,'class'=>'input-medium','div'=>false,'label'=>false,'before'=>'<p>
                                <label style="float: left;">Deposito Origen</label>
                                <span class="field float">',
								'after'=>'</span>'));
?>
<?php
echo $this->Form->input('MovimientoInventario.IdDepositoDest',array('id'=>'depositoOriginal','type'=>'select','options'=>$depositos,'empty'=>true,'class'=>'input-medium','div'=>false,'label'=>false,'before'=>'<p>
                                <label style="float: left;">Deposito Destino</label>
                                <span class="field float">',
								'after'=>'</span>'));
?>

LISTA DE ARTICULOS
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
			<td><input name="data[Detalle][<?php echo $cont ?>][Cantidad]"  class="input-medium valid" value="0" min="0" type="number" /></td>
            <td><img style="width:150px; height:150px;border-style:solid;border-width:3px;" src="/InvenPolka/app/webroot/files/articulo/IdFoto/<?php echo $articulo['articulos']['dir']; ?>/<?php echo $articulo['articulos']['idFoto']; ?>" alt="CakePHP" ></td>
<td><img class="desactiva" src="/InvenPolka/app/webroot/files/gif/desactivar.png"></td>
        </tr>
        <?php endforeach; ?>

	</tbody>
</table>



<?php
echo '<p class="stdformbutton"><button class="btn btn-primary save">Asignar</button><button type="reset" class="btn">Limpiar Formulario</button></p>';
?>
<?php echo $this->Form->end();?>



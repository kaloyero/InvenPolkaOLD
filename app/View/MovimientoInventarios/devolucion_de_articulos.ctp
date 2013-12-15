<?php
echo '<h4 class="widgettitle nomargin shadowed">Devolución de Articulos</h4>';
echo $this->Form->create('MovimientoInventario',array('class' => 'stdform stdform2','inputDefaults' => array(
        'div' => array('class' => 'field') )));

echo '<p><label  style="float: left;">Fecha</label><span class="field float"><input class="input-small fecha" type="text" name="data[MovimientoInventario][Fecha]" required="required" /><small class="field"><em>   año / mes / dia</em></small></span>';

echo $this->Form->input('Descripcion',array('type' => 'textarea','class'=>'span5','div'=>false,'label'=>false,'before'=>'
								                                <label style="float: left;">Comentarios</label>
								                                <span class="field float">',
																'after'=>'</span></p>','pattern' => '.*\S+.*'));
?>
<input type="hidden" value="D" name="data[MovimientoInventario][TipoMovimiento]"/>


<?php
echo $this->Form->input('MovimientoInventario.IdProyecto',array('type'=>'select','options'=>$proyectos,'empty'=>true,'required'=>true,'class'=>'uniformselect','div'=>false,'label'=>false,'before'=>'<p><label  style="float: left;">Proyecto</label><span class="field float">','after'=>'</span>'));

echo $this->Form->input('MovimientoInventario.IdDepositoOrig',array('id'=>'depositoOriginal','type'=>'select','options'=>$depositos,'empty'=>false,'class'=>'uniformselect','div'=>false,'label'=>false,'before'=>'
                                <label style="float: left;">Deposito</label>
                                <span class="field float">',
								'after'=>'</span></p>'));
?>


<p><h5 style="color:#3366FF;padding-left:0.5em;">Lista de Articulos</h5></p>


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
            <td><img style="width:250px; height:150px;border-style:solid;border-width:3px;" src="/InvenPolka/app/webroot/files/articulo/IdFoto/<?php echo $articulo['articulos']['dir']; ?>/<?php echo $articulo['articulos']['idFoto']; ?>" alt="CakePHP" ></td>
<td><img class="desactiva" src="/InvenPolka/app/webroot/files/gif/desactivar.png"></td>
        </tr>
        <?php endforeach; ?>

	</tbody>
</table>

<?php
echo '<p class="stdformbutton"><button class="btn btn-primary save">Aceptar</button></p>';
?>
<?php echo $this->Form->end();?>



<?php
echo '<h4 class="widgettitle nomargin shadowed">Pedido</h4>';
echo '<div class="widgetcontent bordered shadowed nopadding">';

echo $this->Form->create('Pedido',array('class' => 'stdform stdform2','inputDefaults' => array(
        'div' => array('class' => 'field') )));
echo $this->Form->input('Descripcion',array('type' => 'textarea','class'=>'span5','div'=>false,'label'=>false,'before'=>'<p>
								                                <label style="float: left;">Comentarios</label>
								                                <span class="field float">',
																'after'=>'</span></p>','pattern' => '.*\S+.*'));

//echo $this->Form->input('Fecha',array('class'=>'input-medium','div'=>false,'label'=>false,'before'=>'<p>
//								                                <label>Fecha</label>

echo '<label style="float: left;">Fecha</label><span class="field float"><input class="input-small fecha" type="text" name="data[Pedido][Fecha]" required="required" /><small><em> yyyy / mm / dd</em></small></span>';
echo $this->Form->input('Pedido.IdProyecto',array('type'=>'select','options'=>$proyectos,'empty'=>false,'class'=>'uniformselect','div'=>false,'label'=>false,'before'=>'<p>
                                <label>Proyecto</label>
                                <span class="field">',
								'after'=>'</span></p>'));
?>
<span style="padding-left:1em;">LISTA DE ARTICULOS
</span>
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
		foreach ($articulos as $articulo):
			$cont= $cont + 1;

		?>
        <tr id ="<?php echo $articulo['articulos_vista']['id']?>">
            <td>
	            <input name="data[Detalle][<?php echo $cont ?>][IdArticulo]" type="hidden" value="<?php echo $articulo['articulos_vista']['id']; ?>" readonly="readonly" />
				<?php echo $articulo['articulos_vista']['CodigoArticulo']; ?>
            </td>
            <td><?php echo $articulo['articulos_vista']['Descripcion']; ?></td>
			<td><input name="data[Detalle][<?php echo $cont ?>][Cantidad]"  class="input-medium valid" value="1" min="0" max="<?php echo $articulo['articulos_vista']['stock_dispo']; ?>"type="number" /></td>
            <td><img style="width:150px; height:150px;border-style:solid;border-width:3px;" src="/InvenPolka/app/webroot/files/articulo/idFoto/<?php echo $articulo['articulos_vista']['dir']; ?>/small_<?php echo $articulo['articulos_vista']['idFoto']; ?>" alt="CakePHP" ></td>
<td><img class="desactiva" src="/InvenPolka/app/webroot/files/gif/desactivar.png"></td>
        </tr>
        <?php endforeach; ?>

	</tbody>
</table>


<?php
echo '<p class="stdformbutton"><button class="btn btn-primary agregarOtro">Agregar Otro Articulo</button>&nbsp;<button class="btn btn-primary save">Enviar Pedido</button></p>';
?>


<?php echo $this->Form->end();?>
</div>
<button class="btn btn-primary volver" type="button">Volver</button>

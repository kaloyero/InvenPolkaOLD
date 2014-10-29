<h4 class="widgettitle nomargin shadowed">Datos del Pedido<button class="volver glyphicon" style="float:right;" type="button" title="Volver atras"><img src="app/webroot/img/icon-back.png" alt="Volver atras" /></button></h4>
<div class="widgetcontent bordered shadowed nopadding">

<?php

echo $this->Form->create('Pedido',array('class' => 'stdform stdform2','inputDefaults' => array(
        'div' => array('class' => 'field') )));
?>
<div class="conteinerPrinc-1">
<?php
	//Obtengo datos del usuario
	$usuario = $this->Session->read("usuario");
	if ($usuario['Rol'] == '3'){
		echo $this->Form->input('Pedido.IdProyecto',array('type' => 'hidden'));
	} else {
		echo $this->Form->input('Pedido.IdProyecto',array('type'=>'select','options'=>$proyectos,'empty'=>false,'class'=>'uniformselect','div'=>false,'label'=>false,'before'=>'<p>
                                <label>Proyecto</label>
                                <span class="field">',
								'after'=>'</span></p>'));
	}
?>

<p><label style="float: left;">Fecha Salida</label><span class="field float"><input class="input-small fecha " type="text" 	name="data[Pedido][Fecha]" required="required" /><small><em> año / mes / dia</em></small></span></p>

<p><label style="float: left;">Devolución Aproximada</label><span class="field float"><input class="input-small fecha " type="text" 	name="data[Pedido][FechaDev]" required="required" /><small><em> año / mes / dia</em></small></span></p>

</div>
<div class="conteinerPrinc-2">
<?php
echo $this->Form->input('Descripcion',array('type' => 'textarea','placeholder'=>'Ingresar lugar y hora de entrega.','class'=>'span5','div'=>false,'label'=>false,'before'=>'<p>
								                                <label style="float: left;">Comentarios</label>
								                                <span class="field float">',
																'after'=>'</span></p>','pattern' => '.*\S+.*'));

?>

</div>
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

</div>

<div class="botonera widgettitle">
	<p class="stdformbutton">
	    <button class="btn btn-primary agregarOtro" style="margin-left: 10px;">Agregar Otro Articulo</button>
    	<button class="btn btn-primary save" style="margin-left: 10px;">Enviar Pedido</button>
    </p>
</div>

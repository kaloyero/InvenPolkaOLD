<?php
echo '<h4 class="widgettitle nomargin shadowed">Detalle de Movimiento</h4>';
echo '<div class="widgetcontent bordered shadowed nopadding">';
echo $this->Form->create('MovimientoInventario',array('class' => 'stdform stdform2','inputDefaults' => array(
        'div' => array('class' => 'field') )));

		$tiposMovs = array(	'A' =>'Alta de Articulo',
								  	'D' =>'Devolucion de Articulo(s)',
								  	'I' =>'Ingreso de Articulo(s)',
								  	'P' =>'Asignacion de Articulo(s) a Proyecto',
								  	'B' =>'Baja de Articulo(s)',
								  	'T' =>'Transferencia de Articulo(s)',
			  							);
foreach ($movimiento as $mov){
?> <p>
		<label style="float: left;" >Tipo de Movimiento</label>
		<span class="field float"><input name="Numero" value="<?php echo $tiposMovs[$mov['movimientos_vista']['TipoMovimiento']];?>" class="input-medium" readonly="readonly"  required="required"/></span>
		<label style="float: left;" >Deposito Origen</label>
		<span class="field float"><input name="Numero" value="<?php echo $mov['movimientos_vista']['deposito_orig'];?>" class="input-medium" readonly="readonly"  required="required"/></span>

		<?php

		}

		?>

		<p><h5 style="color:#3366FF;padding-left:0.5em;">Lista de Articulos</h5></p>

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
			foreach ($detalles as $det){

		?>			<tr>
						<td><?php echo $det['art']['codigo'] ;?></td>
						<td><?php echo $det['art']['Descripcion'] ;?></td>
						<td><?php echo $det['mov']['Cantidad'] ;?></td>
		   				<td><img style="width:150px; height:150px;border-style:solid;border-width:3px;" src="/InvenPolka/app/webroot/files/articulo/idFoto/<?php echo $det['mov']['IdArticulo']; ?>/small_<?php echo $det['art']['idFoto']; ?>"></td>
		            </tr>
		<?php
					}
		?>

			</tbody>
		</table>

</div>

<br>
<button class="btn btn-primary volver" type="button">Volver</button>




<h4 class="widgettitle nomargin shadowed">Detalle de Movimiento<button class="volver glyphicon" style="float:right;" type="button" title="Volver atras"><img src="app/webroot/img/icon-back.png" alt="Volver atras" /></button></h4>
<div class="widgetcontent bordered shadowed nopadding">

<?php
echo $this->Form->create('MovimientoInventario',array('class' => 'stdform stdform2','inputDefaults' => array(
        'div' => array('class' => 'field') )));

		$tiposMovs = array(			'A' =>'Alta de Articulo',
								  	'D' =>'Devolucion de Articulo(s)',
								  	'I' =>'Ingreso de Articulo(s)',
								  	'P' =>'Asignacion de Articulo(s) a Proyecto',
								  	'B' =>'Baja de Articulo(s)',
								  	'T' =>'Transferencia de Articulo(s)',
			  							);
foreach ($movimiento as $mov){
?> 
<div class="conteinerPrinc-1">
        <p>
                <label style="float: left;" >Tipo de Movimiento</label>
                <span class="field float"><input name="Numero" value="<?php echo $tiposMovs[$mov['movimientos_vista']['TipoMovimiento']];?>" class="input-medium" readonly="readonly"  required="required"/>
                </span>
        </p>
</div>
<div class="conteinerPrinc-2">
        <p>
                <label style="float: left;" >Deposito Origen</label>
                <span class="field float"><input name="Numero" value="<?php echo $mov['movimientos_vista']['deposito_orig'];?>" class="input-medium" readonly="readonly"  required="required"/></span>
        </p>
</div>
<?php

}

?>

<div class="listaArticulos widgettitle nomargin shadowed"><h4> Lista de Articulos</h4></div>

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

    <div class="botonera widgettitle">
    </div>

</div>


<?php
echo '<h4 class="widgettitle nomargin shadowed">Articulo</h4>';
echo '<div class="widgetcontent bordered shadowed nopadding">';

echo $this->Form->create('MovimientoInventario');
echo $this->Form->input('Numero');
echo $this->Form->input('Fecha');
echo $this->Form->input('Descripcion');
?>
<div class="input text">
<label for="comboInventario">Tipo de Movimiento</label>
<select name="data[MovimientoInventario][TipoMovimiento]" id="comboInventario" >
  <option value="I">Ingreso de Articulos</option>LISTO
  <option value="B">Baja de Articulos</option>LISTO
  <option value="P">Asignacion de Articulos a proyectos</option>
  <option value="D">Devolucion de Articulos de proyectos</option>
  <option value="T">Transferencia de Articulos entre depósitos</option>LISTO
</select>

</div>
<?php
echo $this->Form->input('MovimientoInventario.IdDepositoOrig',array('id'=>'depositoOriginal','type'=>'select','options'=>$depositos,'empty'=>false,'label'=>'Deposito Original'));
?>

<div id="divDepositoDest" style="display: none;">
<?php
echo $this->Form->input('MovimientoInventario.IdDepositoDest',array('type'=>'select','options'=>$depositos,'empty'=>false,'label'=>'Deposito Destino'));
?>
</div>

<div id="divProyecto" style="display: none;">
<?php
echo $this->Form->input('MovimientoInventario.IdProyecto',array('type'=>'select','options'=>$proyectos,'empty'=>false,'class'=>'uniformselect','div'=>false,'label'=>false,'before'=>'<p>
                                <label>Proyecto</label>
                                <span class="field">',
								'after'=>'</span></p>'));
echo $this->Form->input('MovimientoInventario.IdEstudio',array('type'=>'select','options'=>$estudios,'empty'=>false,'class'=>'uniformselect','div'=>false,'label'=>false,'before'=>'<p>
                                <label>Estudio</label>
                                <span class="field">',
								'after'=>'</span></p>'));
?>
</div>

<BR>
<b>Agregar articulo</b>
<?php 	
//Agregar Articulos al pedido (detalle pedido)
echo $this->Form->input('ArtArticulo',array('id'=>'ArtArticulo','type'=>'select','options'=>$articulos,'empty'=>false,'class'=>'uniformselect','div'=>false,'label'=>false,'before'=>'<p>
                                <label>Articulo</label>
                                <span class="field">',
								'after'=>'</span></p>'));
echo $this->Form->input('ArtCantidad',array('id'=>'ArtCantidad','label'=>'Cantidad','value'=>'0','type'=>'number')); 
//echo $this->Form->input('MovimientoInventario.IdUbicacionOrig',array('type'=>'select','options'=>$ubicaciones,'empty'=>false,'label'=>'Ubicacion Original'));
?>

<a id="agregarArticulo" class="btn btn-info" href="#">Agregar Campo</a>
<BR>
<div id="contenedor">
    <div class="added">
	</div>
</div>
<BR>

<?php
echo '<p class="stdformbutton"><button class="btn btn-primary save">Guardar</button><button type="reset" class="btn">Limpiar Formulario</button></p>';
?>
<?php echo $this->Form->end();?>


<h1>Agregar</h1>
<?php
echo $this->Html->charset('ISO-8859-1');

echo $this->Html->script('libs/jquery-1.6.2.min');
echo $this->Html->script('mylibs/jquery-ui-1.8.15.custom.min');
echo $this->Html->script('libs/jquery.visualize');
echo $this->Html->script('mylibs/jquery.validate');
echo $this->Html->script('mylibs/jquery.dataTables.min');
echo $this->Html->script('mylibs/jquery.notifications');

echo $this->Html->css(array('forms', 'tables', 'menu'));

echo $this->Form->create('MovimientoInventario');
echo $this->Html->script('movimientosJS');
echo $this->Html->script('agregarArticulos');
echo $this->Form->input('Numero');
echo $this->Form->input('Fecha');
echo $this->Form->input('Descripcion');
//echo $this->Form->input('TipoMovimiento');
?>
<select name="data[MovimientoInventario][TipoMovimiento]" id="comboInventario" onchange="javascript:selectMovementType();">
  <option value="SE">Seleccione el tipo de Movimiento</option>
  <option value="AS">Asignacion de Articulos a proyectos</option>
  <option value="DE">Devolucion de Articulos de proyectos</option>  
  <option value="IN">Ingreso de Articulos</option>
  <option value="BA">Baja de Articulos</option>
  <option value="TR">Transferencia de Articulos entre depósitos</option>
</select>

<div id="divAS" style="display: none;">
<?php 
echo $this->Form->input('MovimientoInventario.IdProyecto',array('type'=>'select','options'=>$proyectos,'empty'=>false,'label'=>'Proyecto'));
echo $this->Form->input('MovimientoInventario.IdUbicacionDest',array('type'=>'select','options'=>$ubicaciones,'empty'=>false,'label'=>'Ubicacion Destino'));

?>
</div>

<div id="divDE" style="display: none;">
<?php 
echo $this->Form->input('MovimientoInventario.IdProyecto',array('type'=>'select','options'=>$proyectos,'empty'=>false,'label'=>'Proyecto'));
echo $this->Form->input('MovimientoInventario.IdUbicacionOrig',array('type'=>'select','options'=>$ubicaciones,'empty'=>false,'label'=>'Ubicacion Original'));
?>
</div>

<div id="divIN" style="display: none;">
<?php
echo $this->Form->input('MovimientoInventario.IdDepositoOrig',array('type'=>'select','options'=>$depositos,'empty'=>false,'label'=>'Deposito Original'));
?>

</div>

<div id="divBA" style="display: none;">

</div>

<div id="divTR" style="display: none;">
<?php
echo $this->Form->input('MovimientoInventario.IdDepositoOrig',array('type'=>'select','options'=>$depositos,'empty'=>false,'label'=>'Deposito Original'));
echo $this->Form->input('MovimientoInventario.IdDepositoDest',array('type'=>'select','options'=>$depositos,'empty'=>false,'label'=>'Deposito Destino'));
?>
</div>


<?php 	
echo $this->Form->input('Articulo.Articulo',array('id'=>'Articulo.Articulo','type'=>'select','options'=>$articulos,'empty'=>false,'label'=>'Articulo'));
echo $this->Form->input('Articulo.Cantidad',array('id'=>'Articulo.Cantidad','type'=>'number')); 
?>
		<a id="agregarCampo" class="btn btn-info" href="#">Agregar Campo</a>
<div id="contenedor">
    <div class="added">


    </div>
</div>
<?php
echo $this->Form->submit('Guardar');
?>
<?php echo $this->Form->end();?>
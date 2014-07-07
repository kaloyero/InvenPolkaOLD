<h4 class="widgettitle nomargin shadowed">
	<?php $privis = $this->Session->read("privilegios"); ?>

	<?php if (! empty($privis['addArticulo'])) { ?>
		<button id="addArticulo" class="btn" tooltip = "<?php echo $privis['addArticulo']['ayuda'] ?>"><?php echo $privis['addArticulo']['nombre'] ?></button>
	<?php } ?>
	<?php if (! empty($privis['addCrearPed'])) { ?>
		<button class="btn btn-primary crearPedido " disabled="true" tooltip = "<?php echo $privis['addCrearPed']['ayuda'] ?>"><?php echo $privis['addCrearPed']['nombre'] ?></button>
	<?php } ?>
	<?php if (! empty($privis['addAsignarDepo'])) { ?>
		<button class="btn btn-primary asignarDepo" disabled="true" tooltip = "<?php echo $privis['addAsignarDepo']['ayuda'] ?>"><?php echo $privis['addAsignarDepo']['nombre'] ?></button>
	<?php } ?>
	<?php if (! empty($privis['addDevolucion'])) { ?>
		<button class="btn btn-primary devolucionArt" disabled="true" tooltip = "<?php echo $privis['addDevolucion']['ayuda'] ?>"><?php echo $privis['addDevolucion']['nombre'] ?></button>
	<?php } ?>
	<?php if (! empty($privis['addBajaArt'])) { ?>
		<button class="btn btn-primary deleteArt" disabled="true" tooltip = "<?php echo $privis['addBajaArt']['ayuda'] ?>"><?php echo $privis['addBajaArt']['nombre'] ?></button>
	<?php } ?>
	<a class="btn btn-primary comandaArtSel " href="33">Descargar Selección</a>

</h4>
<h4 class="widgettitle nomargin shadowed">Listado de Articulos</h4>

<table  id="configurationTable" class ="table table-bordered" width="100%"  style="width: 100%;">
	<thead>
	     <tr>
			<th style="display:none;">Id</th>
         </tr>
	</thead>
	<tbody>
	</tbody>
</table>
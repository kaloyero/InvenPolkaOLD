<h4 class="widgettitle nomargin shadowed">

	<?php $privis = $this->Session->read("privilegios"); ?>

	<?php if (! empty($privis['addProyecto'])) { ?>
		<button id="add" class="btn">Agregar</button>
	<?php } ?>
</h4>
<h4 class="widgettitle nomargin shadowed">Listado de Proyectos</h4>

<table  id="configurationTable" class ="table table-bordered" width="100%"  style="width: 100%;">
        <thead>
                <tr>
                <th style="display:none;">Id</th>
 				<th>Nombre</th>
				<th>Director</th>
				<th>Acciones</th>

		</tr>
        </thead>
        <tbody>
      	</tbody>

</table>
<div class="botonera widgettitle">
</div>

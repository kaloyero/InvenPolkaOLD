<?php
echo '<h4 class="widgettitle nomargin shadowed">Listado de Inventario</h4>';
echo '<div class="widgetcontent bordered shadowed nopadding">';
?>

<p>
<label style="float: left;">Inventario:	</label>

<span class="field float">
	<div class="selector" id="uniform-InventarioIdDeposito">
		<span>warnes5</span>
		<select name="data[Inventario][Filtro]" class="uniformselect valid filtroDepo" id="InventarioIdDeposito" style="opacity: 0;">
			<option value="-2">TODOS</option>
			<option value="-1">warnes5</option>
			<?php foreach($proyectos as $proyecto){ ?>
				<option value="<?php echo $proyecto['proyectos']['id']; ?>"><?php echo $proyecto['proyectos']['Nombre']; ?></option>
			<?php } ?>
		</select>
	</div>
</span>
</p>
<table  id="configurationTable" class ="table table-bordered" width="100%"  style="width: 100%;">
	<thead>
	     <tr>
		                <th style="display:none;">Id</th>
		                <th>Codigo </th>
                        <th>Foto Articulo</th>
                        <th>Stock</th>
                        <th>Proyecto</th>
		            </tr>
	</thead>
	<tbody>
	</tbody>
</table>

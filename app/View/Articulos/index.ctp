<p><a id="add">Agregar</a></p>
<table  id="browserList" width="100%"  style="width: 100%;">
	<thead>
	        <tr>

                <th>Codigo Articulo</th>
                <th>idFoto</th>
                <th>Acciones</th>
            </tr>
	</thead>
	<tbody>
	</tbody>
</table>

<table class="table">
    <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Acciones</th>
    </tr>

    <?php foreach ($articulos as $articulo): ?>
    <tr>
        <td><?php echo $articulo['Articulo']['id']?></td>
        <td><?php echo $articulo['Articulo']['CodigoArticulo']?></td>
                <td><?php $test= "/app/webroot/files/articulo/IdFoto/".$articulo['Articulo']['dir'].'/'.$articulo['Articulo']['idFoto'];
                        echo $this->Html->image($test, array('alt' => 'CakePHP','width'=>'200px'))?></td>
                        <td><?php echo $this->Html->link('Edit', array('action' => 'edit', $articulo['Articulo']['id']),array('class' => 'edit'));?></td>


    </tr>
<?php endforeach; ?>
</table>
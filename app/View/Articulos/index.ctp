<h1>Listado</h1>
<p><?php echo $this->Html->link('Agregar', array('action' => 'add')); ?></p>

<table>
    <tr>
        <th>Id</th>
        <th>Nombre</th>
    </tr>

    <?php foreach ($articulos as $articulo): ?>
    <tr>
        <td><?php echo $articulo['Articulo']['id']?></td>
        <td><?php echo $articulo['Articulo']['CodigoArticulo']?></td>
		<td><?php $test= "/app/webroot/files/articulo/IdFoto/".$articulo['Articulo']['dir'].'/'.$articulo['Articulo']['idFoto'];
			echo $this->Html->image($test, array('alt' => 'CakePHP','width'=>'200px'))?></td>
			<td><?php echo $this->Html->link('Edit', array('action' => 'edit', $articulo['Articulo']['id']));?></td>


    </tr>
<?php endforeach; ?>
</table>

<?php
     // $this->Paginator->options(array('url' => $this->passedArgs));
 ?>
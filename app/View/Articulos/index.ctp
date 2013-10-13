<h1>Listado</h1>
<p><?php echo $this->Html->link('Agregar', array('action' => 'add')); ?></p>

<table>
    <tr>
        <th>Id</th>
        <th>Nombre</th>
    </tr>

    <?php foreach ($articulos as $articulo): ?>
    <tr>
        <td><?php echo $articulo['Articulo']['id']; ?></td>
        <td><?php echo $articulo['Articulo']['CodigoArticulo']; ?></td>
    </tr>
    <?php endforeach; ?>

</table>
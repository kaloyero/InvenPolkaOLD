<h1>Listado</h1>
<p><?php echo $this->Html->link('Agregar', array('action' => 'add')); ?></p>
<table>
    <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Acciones</th>
    </tr>

    <?php foreach ($categorias as $categoria): ?>
    <tr>
        <td><?php echo $categoria['Categoria']['id']; ?></td>
        <td>
            <?php echo $this->Html->link($categoria['Categoria']['Nombre'],
		array('controller' => 'categorias', 'action' => 'view', $categoria['Categoria']['id'])); ?>
        </td>
		<td><?php echo $this->Html->link('Editar', array('action' => 'edit', $categoria['Categoria']['id']));?>    </td>        
    </tr>
    <?php endforeach; ?>

</table>


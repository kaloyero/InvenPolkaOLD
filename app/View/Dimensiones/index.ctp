<h1>Listado</h1>
<p><?php echo $this->Html->link('Agregar', array('action' => 'add')); ?></p>
<table>
    <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Acciones</th>
    </tr>

    <?php foreach ($dimensiones as $dimension): ?>
    <tr>
        <td><?php echo $dimension['Dimensione']['id']; ?></td>
        <td>
            <?php echo $dimension['Dimensione']['Nombre']; ?></td>
        </td>
		<td><?php echo $this->Html->link('Editar', array('action' => 'edit', $dimension['Dimensione']['id']));?>    </td>        
    </tr>
    <?php endforeach; ?>

</table>
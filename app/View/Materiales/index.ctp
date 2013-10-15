<h1>Listado</h1>
<p><?php echo $this->Html->link('Agregar', array('action' => 'add')); ?></p>
<table>
    <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Acciones</th>
    </tr>

    <?php foreach ($materiales as $material): ?>
    <tr>
        <td><?php echo $material['Materiale']['id']; ?></td>
        <td>
            <?php echo $material['Materiale']['Nombre']; ?></td>
        </td>
		<td><?php echo $this->Html->link('Editar', array('action' => 'edit', $material['Materiale']['id']));?>    </td>        
    </tr>
    <?php endforeach; ?>

</table>
<h1>Listado</h1>
<p><?php echo $this->Html->link('Agregar', array('action' => 'add')); ?></p>
<table>
    <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Acciones</th>
    </tr>

    <?php foreach ($objetos as $objeto): ?>
    <tr>
        <td><?php echo $objeto['Objeto']['id']; ?></td>
        <td>
            <?php echo $objeto['Objeto']['Nombre']; ?></td>
        </td>
		<td><?php echo $this->Html->link('Editar', array('action' => 'edit', $objeto['Objeto']['id']));?>    </td>        
    </tr>
    <?php endforeach; ?>

</table>
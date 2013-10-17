<h1>Listado</h1>
<p><?php echo $this->Html->link('Agregar', array('action' => 'add')); ?></p>
<table>
    <tr>
        <th>Id</th>
        <th>Disponibilidad</th>
        <th>Acciones</th>
    </tr>

    <?php foreach ($inventarios as $inventario): ?>
    <tr>
        <td><?php echo $inventario['Inventario']['id']; ?></td>
        <td><?php echo $inventario['Inventario']['Disponibilidad']; ?></td>
        <td><?php echo $this->Html->link('Editar', array('action' => 'edit', $inventario['Inventario']['id']));?>    </td>        
    </tr>
    <?php endforeach; ?>

</table>
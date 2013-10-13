<h1>Listado</h1>
<p><?php echo $this->Html->link('Agregar', array('action' => 'add')); ?></p>
<table>
    <tr>
        <th>Id</th>
        <th>Nombre</th>
    </tr>

    <?php foreach ($materiales as $material): ?>
    <tr>
        <td><?php echo $material['Materiale']['IdMaterial']; ?></td>
        <td>
            <?php echo $material['Materiale']['Nombre']; ?></td>
        </td>
    </tr>
    <?php endforeach; ?>

</table>
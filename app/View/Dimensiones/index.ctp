<h1>Listado</h1>
<p><?php echo $this->Html->link('Agregar', array('action' => 'add')); ?></p>
<table>
    <tr>
        <th>Id</th>
        <th>Nombre</th>
    </tr>

    <?php foreach ($dimensiones as $dimension): ?>
    <tr>
        <td><?php echo $dimension['Dimensione']['id']; ?></td>
        <td>
            <?php echo $dimension['Dimensione']['Nombre']; ?></td>
        </td>
    </tr>
    <?php endforeach; ?>

</table>
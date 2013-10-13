<h1>Listado</h1>
<p><?php echo $this->Html->link('Agregar', array('action' => 'add')); ?></p>
<table>
    <tr>
        <th>Id</th>
        <th>Nombre</th>
    </tr>

    <?php foreach ($decorados as $decorado): ?>
    <tr>
        <td><?php echo $decorado['Decorado']['IdDecorado']; ?></td>
        <td>
            <?php echo $decorado['Decorado']['Nombre']; ?></td>
        </td>
    </tr>
    <?php endforeach; ?>

</table>
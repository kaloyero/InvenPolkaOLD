<h1>Listado</h1>
<p><?php echo $this->Html->link('Agregar', array('action' => 'add')); ?></p>
<table>
    <tr>
        <th>Id</th>
        <th>Nombre</th>
    </tr>

    <?php foreach ($estilos as $estilo): ?>
    <tr>
        <td><?php echo $estilo['Estilo']['id']; ?></td>
        <td>
            <?php echo $estilo['Estilo']['Nombre']; ?></td>
        </td>
    </tr>
    <?php endforeach; ?>

</table>
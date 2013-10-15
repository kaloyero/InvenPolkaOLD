<h1>Listado</h1>
<p><?php echo $this->Html->link('Agregar', array('action' => 'add')); ?></p>
<table>
    <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Acciones</th>
    </tr>

    <?php foreach ($estilos as $estilo): ?>
    <tr>
        <td><?php echo $estilo['Estilo']['id']; ?></td>
        <td>
            <?php echo $estilo['Estilo']['Nombre']; ?></td>
        </td>
		<td><?php echo $this->Html->link('Editar', array('action' => 'edit', $estilo['Estilo']['id']));?>    </td>
    </tr>
    <?php endforeach; ?>

</table>
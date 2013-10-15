<h1>Listado</h1>
<p><?php echo $this->Html->link('Agregar', array('action' => 'add')); ?></p>
<table>
    <tr>
        <th>Nombre</th>
        <th>Descripcion</th>        
        <th>Fecha Fin</th>
        <th>Acciones</th>
    </tr>

    <?php foreach ($estudios as $estudio): ?>
    <tr>
		<td><?php echo $this->Html->link($estudio['Estudio']['Nombre'], array('action' => 'view', $estudio['Estudio']['id']));?>    </td>
        <td><?php echo $estudio['Estudio']['Descripcion']; ?></td>        
        <td><?php echo $estudio['Estudio']['FechaFin']; ?></td>        
		<td><?php echo $this->Html->link('Editar', array('action' => 'edit', $estudio['Estudio']['id']));?>    </td>
    </tr>
    <?php endforeach; ?>

</table>
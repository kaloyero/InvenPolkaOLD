<h1>Listado</h1>
<p><?php echo $this->Html->link('Agregar', array('action' => 'add')); ?></p>
<table>
    <tr>
        <th>Nombre</th>
        <th>Descripcion</th>        
        <th>Director</th>        
        <th>Fecha Inicio</th>
        <th>Fecha Fin</th>        
        <th>Acciones</th>
    </tr>

    <?php foreach ($proyectos as $proyecto): ?>
    <tr>
		<td><?php echo $this->Html->link($proyecto['Proyecto']['Nombre'], array('action' => 'view', $proyecto['Proyecto']['id']));?>    </td>
        <td><?php echo $proyecto['Proyecto']['Descripcion']; ?></td>        
        <td><?php echo $proyecto['Proyecto']['Director']; ?></td>
        <td><?php echo $proyecto['Proyecto']['FechaIni']; ?></td>
        <td><?php echo $proyecto['Proyecto']['FechaFin']; ?></td>        
		<td><?php echo $this->Html->link('Editar', array('action' => 'edit', $proyecto['Proyecto']['id']));?>    </td>
    </tr>
    <?php endforeach; ?>

</table>
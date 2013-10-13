<h1>Listado</h1>
<table>
    <tr>
        <th>Id</th>
        <th>Nombre</th>
    </tr>

    <?php foreach ($proyectos as $proyecto): ?>
    <tr>
        <td><?php echo $proyecto['Proyecto']['IdProyecto']; ?></td>
        <td><?php echo $proyecto['Proyecto']['Nombre']; ?></td>
    </tr>
    <?php endforeach; ?>

</table>
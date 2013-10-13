<h1>Listado</h1>
<table>
    <tr>
        <th>Id</th>
        <th>Descripcion</th>
    </tr>

    <?php foreach ($ubicaciones as $ubicacion): ?>
    <tr>
        <td><?php echo $ubicacion['Ubicacion']['IdUbicacion']; ?></td>
        <td><?php echo $ubicacion['Ubicacion']['Descripcion']; ?></td>
    </tr>
    <?php endforeach; ?>

</table>
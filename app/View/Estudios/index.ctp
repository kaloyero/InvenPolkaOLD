<h1>Listado</h1>
<table>
    <tr>
        <th>Id</th>
        <th>Nombre</th>
    </tr>

    <?php foreach ($estudios as $estudio): ?>
    <tr>
        <td><?php echo $estudio['Estudio']['IdEstudio']; ?></td>
        <td>
            <?php echo $estudio['Estudio']['Nombre']; ?></td>
        </td>
    </tr>
    <?php endforeach; ?>

</table>
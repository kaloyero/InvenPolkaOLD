<h1>Listado</h1>
<table>
    <tr>
        <th>Id</th>
        <th>Disponibilidad</th>
    </tr>

    <?php foreach ($inventarios as $inventario): ?>
    <tr>
        <td><?php echo $inventario['Inventario']['IdInventario']; ?></td>
        <td>
            <?php echo $inventario['Inventario']['Disponibilidad']; ?></td>
        </td>
    </tr>
    <?php endforeach; ?>

</table>
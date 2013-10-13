<h1>Listado</h1>
<table>
    <tr>
        <th>Id</th>
        <th>Nombre</th>
    </tr>

    <?php foreach ($movimientos as $movimiento): ?>
    <tr>
        <td><?php echo $movimiento['MovimientoInventario']['IdMovimientoInventario']; ?></td>
        <td>
            <?php echo $movimiento['MovimientoInventario']['Numero']; ?></td>
        </td>
    </tr>
    <?php endforeach; ?>

</table>
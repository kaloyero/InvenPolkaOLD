<h1>Listado</h1>
<table>
    <tr>
        <th>Id</th>
        <th>Nombre</th>
    </tr>

    <?php foreach ($detalles as $detalle): ?>
    <tr>
        <td><?php echo $detalle['MovimientoDetalleInventario']['id']; ?></td>
        <td>
            <?php echo $detalle['MovimientoDetalleInventario']['Cantidad']; ?></td>
        </td>
    </tr>
    <?php endforeach; ?>

</table>
movimientodetalleinventarios
<div class="contentinner">
<table class="table">
    <tr>
        <th>Id</th>
        <th>Nombre</th>
    </tr>

    <?php foreach ($movimientos as $movimiento): ?>
    <tr>
        <td><?php echo $movimiento['MovimientoInventario']['id']; ?></td>
        <td>
            <?php echo $movimiento['MovimientoInventario']['Numero']; ?></td>
        </td>
    </tr>
    <?php endforeach; ?>

</table>
</div>
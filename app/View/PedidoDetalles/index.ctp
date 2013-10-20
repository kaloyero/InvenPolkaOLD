<div class="contentinner">
<table class="table">
    <tr>
        <th>Id</th>
        <th>Nombre</th>
    </tr>

    <?php foreach ($pedidoDetalles as $pedidoDetalle): ?>
    <tr>
        <td><?php echo $pedidoDetalle['PedidoDetalle']['id']; ?></td>
        <td><?php echo $pedidoDetalle['PedidoDetalle']['Cantidad']; ?></td>
    </tr>
    <?php endforeach; ?>

</table>
</div>
<div class="contentinner">
<table class="table">
    <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Acciones</th>
    </tr>

    <?php foreach ($detalles as $detalle): ?>
    <tr>
        <td><?php echo $detalle['MovimientoDetalleInventario']['id']; ?></td>
        <td><?php echo $detalle['MovimientoDetalleInventario']['Cantidad']; ?></td>
		<td><?php echo $this->Html->link('Editar', array('action' => 'edit', $categoria['Categoria']['id']));?>    </td>
    </tr>
    <?php endforeach; ?>

</table>
</div>

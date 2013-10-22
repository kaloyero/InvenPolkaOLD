<div class="contentinner">
<table class="table">
<h1>Listado</h1>
<p><?php echo $this->Html->link('Agregar', array('action' => 'add')); ?></p>
<table>
    <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Acciones</th>
    </tr>

    <?php foreach ($movimientos as $movimiento): ?>
    <tr>
        <td><?php echo $movimiento['MovimientoInventario']['id']; ?></td>
        <td><?php echo $movimiento['MovimientoInventario']['Numero']; ?></td>
        <td>
			<?php echo $this->Html->link('Editar', array('action' => 'edit', $movimiento['MovimientoInventario']['id']));?>
        </td>
    </tr>
    <?php endforeach; ?>

</table>
</div>

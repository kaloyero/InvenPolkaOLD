<h1>Listado</h1>
<p><?php echo $this->Html->link('Agregar', array('action' => 'add')); ?></p>
<table>
    <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Acciones</th>        
    </tr>

    <?php foreach ($pedidos as $pedido): ?>
    <tr>
        <td><?php echo $pedido['Pedido']['id']; ?></td>
        <td><?php echo $pedido['Pedido']['Numero']; ?></td>
        <td>
			<?php echo $this->Html->link('Editar', array('action' => 'edit', $pedido['Pedido']['id']));?>    
            <?php echo $this->Html->link('Confirmar', array('action' => 'edit', $pedido['Pedido']['id']));?>
        </td>
    </tr>
    <?php endforeach; ?>

</table>
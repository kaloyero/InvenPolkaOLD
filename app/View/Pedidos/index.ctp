<h1>Listado</h1>
<table>
    <tr>
        <th>Id</th>
        <th>Nombre</th>
    </tr>

    <?php foreach ($pedidos as $pedido): ?>
    <tr>
        <td><?php echo $pedido['Pedido']['id']; ?></td>
        <td><?php echo $pedido['Pedido']['Numero']; ?></td>
    </tr>
    <?php endforeach; ?>

</table>
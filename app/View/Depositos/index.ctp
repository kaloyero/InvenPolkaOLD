<h1>Listado</h1>
<table>
    <tr>
        <th>Id</th>
        <th>Nombre</th>
    </tr>

    <?php foreach ($depositos as $deposito): ?>
    <tr>
        <td><?php echo $deposito['Deposito']['id']; ?></td>
        <td>
            <?php echo $deposito['Deposito']['Nombre']; ?></td>
        </td>
		<td>
            <?php echo $deposito['Deposito']['FechaFin']; ?></td>

        </td>
			<td>
	            <?php echo $this->Html->link('Edit', array('action' => 'edit', $deposito['Deposito']['id']));?>
				</td>

	        </td>
    </tr>
    <?php endforeach; ?>

</table>
<script type="text/javascript">
    $(document).ready(function() {
    deposito.hacerTablaEditable();
    });
</script>
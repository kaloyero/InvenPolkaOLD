<h1>Listado</h1>
<p><?php echo $this->Html->link('Agregar', array('action' => 'add')); ?></p>
<table>
    <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Acciones</th>
    </tr>

    <?php foreach ($decorados as $decorado): ?>
    <tr>
        <td><?php echo $decorado['Decorado']['id']; ?></td>
        <td>
            <?php echo $decorado['Decorado']['Nombre']; ?></td>
        </td>
		<td><?php echo $this->Html->link('Editar', array('action' => 'edit', $decorado['Decorado']['id']));?>    </td>
    </tr>
    <?php endforeach; ?>

</table>
<script type="text/javascript">
    $(document).ready(function() {
    decorado.hacerTablaEditable();
    });
</script>
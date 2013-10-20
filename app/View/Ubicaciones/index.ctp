<div class="contentinner">
<table class="table">
    <tr>
        <th>Id</th>
        <th>Descripcion</th>
    </tr>

    <?php foreach ($ubicaciones as $ubicacion): ?>
    <tr>
        <td><?php echo $ubicacion['Ubicacione']['id']; ?></td>
        <td><?php echo $ubicacion['Ubicacione']['Descripcion']; ?></td>
		<td><?php echo $this->Html->link('Edit', array('action' => 'edit', $ubicacion['Ubicacione']['id']));?></td>

    </tr>


    <?php endforeach; ?>

</table>

<script type="text/javascript">
    $(document).ready(function() {
    categoria.hacerTablaEditable();
    });
</script>
</div>
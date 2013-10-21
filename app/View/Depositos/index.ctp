<div class="breadcrumbwidget animate2 fadeInUp">
	<ul class="skins">
        <li><a href="default" class="skin-color default"></a></li>
        <li><a href="orange" class="skin-color orange"></a></li>
        <li><a href="dark" class="skin-color dark"></a></li>
        <li>&nbsp;</li>
        <li class="fixed"><a href="" class="skin-layout fixed"></a></li>
        <li class="wide"><a href="" class="skin-layout wide"></a></li>
    </ul><!--skins-->
	<ul class="breadcrumb">
        <li><a href="dashboard.html">Home</a> <span class="divider">/</span></li>
        <li class="active">Depositos</li>
    </ul>
</div><!--breadcrumbwidget-->
<div class="pagetitle animate3 fadeInUp">
	<h1>Depositos</h1> <span>Gestion de Depositos...</span>
</div><!--pagetitle-->

<div class="maincontent animate4 fadeInUp">
<div class="contentinner"><p><?php echo $this->Html->link('Agregar', array('action' => 'add')); ?></p><table class="table">
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
</div>
</div>
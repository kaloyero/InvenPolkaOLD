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
        <li class="active">Ubicaciones</li>
    </ul>
</div><!--breadcrumbwidget-->
<div class="pagetitle animate3 fadeInUp">
	<h1>Ubicaciones</h1> <span>Gestion de Ubicaciones...</span>
</div><!--pagetitle-->

<div class="maincontent animate4 fadeInUp">
<div class="contentinner"><p><?php echo $this->Html->link('Agregar', array('action' => 'add')); ?></p>
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
</div>
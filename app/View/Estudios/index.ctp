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
        <li class="active">Estudios</li>
    </ul>
</div><!--breadcrumbwidget-->
<div class="pagetitle animate3 fadeInUp">
	<h1>Estudio</h1> <span>Gestion de Estudios...</span>
</div><!--pagetitle-->

<div class="maincontent animate4 fadeInUp">
<div class="contentinner"><p><?php echo $this->Html->link('Agregar', array('action' => 'add')); ?></p>
<table class="table">
    <tr>
        <th>Nombre</th>
        <th>Descripcion</th>
        <th>Fecha Fin</th>
        <th>Acciones</th>
    </tr>

    <?php foreach ($estudios as $estudio): ?>
    <tr>
		<td><?php echo $this->Html->link($estudio['Estudio']['Nombre'], array('action' => 'view', $estudio['Estudio']['id']));?>    </td>
        <td><?php echo $estudio['Estudio']['Descripcion']; ?></td>
        <td><?php echo $estudio['Estudio']['FechaFin']; ?></td>
		<td><?php echo $this->Html->link('Editar', array('action' => 'edit', $estudio['Estudio']['id']));?>    </td>
    </tr>
    <?php endforeach; ?>

</table>
</div>
</div>
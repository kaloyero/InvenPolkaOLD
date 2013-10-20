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
        <li class="active">Proyectos</li>
    </ul>
</div><!--breadcrumbwidget-->
<div class="pagetitle animate3 fadeInUp">
	<h1>Proyectos</h1> <span>Gestion de Proyectos...</span>
</div><!--pagetitle-->

<div class="maincontent animate4 fadeInUp">
<div class="contentinner"><p><?php echo $this->Html->link('Agregar', array('action' => 'add')); ?></p>
<table class="table">
    <tr>
        <th>Nombre</th>
        <th>Descripcion</th>
        <th>Director</th>
        <th>Fecha Inicio</th>
        <th>Fecha Fin</th>
        <th>Acciones</th>
    </tr>

    <?php foreach ($proyectos as $proyecto): ?>
    <tr>
		<td><?php echo $this->Html->link($proyecto['Proyecto']['Nombre'], array('action' => 'view', $proyecto['Proyecto']['id']));?>    </td>
        <td><?php echo $proyecto['Proyecto']['Descripcion']; ?></td>
        <td><?php echo $proyecto['Proyecto']['Director']; ?></td>
        <td><?php echo $proyecto['Proyecto']['FechaIni']; ?></td>
        <td><?php echo $proyecto['Proyecto']['FechaFin']; ?></td>
		<td><?php echo $this->Html->link('Editar', array('action' => 'edit', $proyecto['Proyecto']['id']));?>    </td>
    </tr>
    <?php endforeach; ?>

</table>
</div>
</div>
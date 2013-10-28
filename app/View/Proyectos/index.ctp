<p><a id="add">Agregar</a></p><table class="table">
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
		<td><?php echo $proyecto['Proyecto']['id']; ?></td>
		<td><?php echo $this->Html->link($proyecto['Proyecto']['Nombre'], array('action' => 'view', $proyecto['Proyecto']['id']));?>    </td>
		<td><?php echo $proyecto['Proyecto']['Descripcion']; ?></td>
        <td><?php echo $proyecto['Proyecto']['Director']; ?></td>
        <td><?php echo $proyecto['Proyecto']['FechaIni']; ?></td>
        <td><?php echo $proyecto['Proyecto']['FechaFin']; ?></td>
		<td><?php echo $this->Html->link('Editar', array('action' => 'edit', $proyecto['Proyecto']['id']),array('class' => 'edit'));?>    </td>
    </tr>
    <?php endforeach; ?>

</table>
<?php
     // $this->Paginator->options(array('url' => $this->passedArgs));
$paginator = $this->Paginator;
// pagination section
    echo "<div class='paging'>";

        // the 'first' page button
        echo $paginator->first("First");

        // 'prev' page button,
        // we can check using the paginator hasPrev() method if there's a previous page
        // save with the 'next' page button
        if($paginator->hasPrev()){
            echo $paginator->prev("Prev");
        }

        // the 'number' page buttons
        echo $paginator->numbers(array('modulus' => 2));

        // for the 'next' button
        if($paginator->hasNext()){
            echo $paginator->next("Next");
        }

        // the 'last' page button
        echo $paginator->last("Last");

    	echo "</div>";


 ?>

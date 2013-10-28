<p><a id="add">Agregar</a></p><table class="table">
    <tr>
        <th>Codigo</th>
        <th>Articulo</th>
        <th>Disponibilidad</th>
        <th>Deposito</th>
        <th>Proyecto</th>        
        <th>Acciones</th>
    </tr>

    <?php foreach ($inventarios as $inventario): ?>
    <tr>
        <td><?php echo $inventario['Inventario']['id']; ?></td>
        <td><?php echo $inventario['Articulo']['CodigoArticulo']; ?></td>
        <td><?php echo $inventario['Inventario']['Disponibilidad']; ?></td>
        <td><?php echo $inventario['Deposito']['Nombre']; ?></td>
        <td><?php echo $inventario['Proyecto']['Nombre']; ?></td>
        <td><?php echo $this->Html->link('Editar', array('action' => 'edit', $inventario['Inventario']['id']));?>    </td>
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
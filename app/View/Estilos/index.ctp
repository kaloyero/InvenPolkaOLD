<p><a id="add">Agregar</a></p><table class="table">

<table class="table">
    <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Que ponemos?</th>
    </tr>

    <?php foreach ($estilos as $estilo): ?>
    <tr>
        <td><?php echo $estilo['Estilo']['id']; ?></td>
        <td>
            <?php echo $estilo['Estilo']['Nombre']; ?></td>
        </td>
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
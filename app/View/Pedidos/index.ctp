<p><a id="add">Agregar</a></p>

<table class="table">
    <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Acciones</th>        
    </tr>

    <?php foreach ($pedidos as $pedido): ?>
    <tr>
        <td><?php echo $pedido['Pedido']['id']; ?></td>
        <td><?php echo $pedido['Pedido']['Numero']; ?></td>
        <td>
			<?php 
			if ($pedido['Pedido']['estado'] == 'abierto'){
				echo $this->Html->link('Editar', array('action' => 'edit', $pedido['Pedido']['id']));
                echo $this->Html->link('Confirmar', array('action' => 'confirmarPedido', $pedido['Pedido']['id']));
            }
			?>	
				
            
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

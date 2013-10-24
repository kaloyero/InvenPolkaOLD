<p><a id="add">Agregar</a></p>

<table class="table">
    <tr>
        <th>Codigo</th>
        <th>Numero</th>
		<th>Fecha</th>
        <th>Tipo Movimiento</th>
        <th>Deposito</th>
        <th>Acciones</th>        
    </tr>

    <?php foreach ($movimientos as $movimiento): ?>
    <tr>
        <td><?php echo $movimiento['MovimientoInventario']['id']; ?></td>
        <td><?php echo $movimiento['MovimientoInventario']['Numero']; ?></td>
        <td><?php echo $movimiento['MovimientoInventario']['Fecha']; ?></td>
        <td><?php 
		switch ($movimiento['MovimientoInventario']['TipoMovimiento']) {
			case 'P':
				echo "Asignacion de Articulos a proyectos" ; 
				break;
			case 'D':
				echo "Devolucion de Articulos de proyectos"; 
				break;
			case 'I':
				echo "Ingreso de Articulos"; 
				break;
			case 'B':
				echo "Baja de Articulos"; 
				break;
			case 'T':
				echo "Transferencia de Articulos entre depósitos"; 
				break;
		} ?>
		</td>        
        <td><?php echo $movimiento['Deposito']['Nombre']; ?></td>        

        <td>
			<?php echo $this->Html->link('Editar', array('action' => 'edit', $movimiento['MovimientoInventario']['id']));?>
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


<?php
echo $this->Form->input('Inventario.IdProyecto',array('type'=>'select','options'=>$proyectos,'empty'=>true,'class'=>'uniformselect filtroDepo','div'=>false,'label'=>false,'before'=>'<label style="float: left;" >Filtrar Proyecto</label><span class="field float">','after'=>'</span></p>'));

?>

<?php if ($_GET['isSearch'] == "DEPOSITO"){ ?>
	<input type="checkbox" class="filtroDeposito" id="checkFiltro" checked="checked"> Filtrar por deposito
<?php } else { ?>
	<input type="checkbox" class="filtroDeposito" id="checkFiltro" > Filtrar por deposito
<?php } ?>

<table  id="configurationTable" class ="table table-bordered" width="100%"  style="width: 100%;">
	<thead>
	     <tr>
		                <th style="display:none;">Id</th>
		                <th>Codigo </th>
                        <th>Foto Articulo</th>
                        <th>Stock</th>
                        <th>Proyecto</th>
		            </tr>
	</thead>
	<tbody>
	</tbody>
</table>

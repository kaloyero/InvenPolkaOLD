<?php
echo $this->Form->input('Inventario.IdProyecto',array('type'=>'select','options'=>$proyectos,'empty'=>true,'class'=>'uniformselect','div'=>false,'label'=>false,'before'=>'<label style="float: left;" >Proyecto</label><span class="field float">','after'=>'</span></p>'));
?>

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

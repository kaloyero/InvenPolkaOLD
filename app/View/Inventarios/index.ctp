<style type="text/css">
p.search { width: 300px;}
span.search { padding: 7px 0 0 3%; font-weight: bold; color: #333;}
label.search { font-weight: bold; color: #333; margin-right: 3%; margin-top: 5px;}

input[type="radio"], input[type="checkbox"] {margin: 0 !important;}

</style>


<div class="listaArticulos widgettitle nomargin shadowed"><h4> Filtros de Búsqueda</h4></div>
<div class="conteinerPrinc-1" style="height: 40px;">
	<?php if ($_GET['isSearch'] == "DEPOSITO"){ ?>
        <p class="search"><input type="checkbox" class="filtroDeposito" id="checkFiltro" checked="checked"><span class="search"> Filtrar por Deposito</span></p>
    <?php } else { ?>
        <p class="search"><input type="checkbox" class="filtroDeposito" id="checkFiltro" ><span class="search"> Filtrar por Deposito</span>
    <?php } ?></p>
</div>
<div class="conteinerPrinc-2" style="height: 40px;">
<?php
echo $this->Form->input('Inventario.IdProyecto',array('type'=>'select','options'=>$proyectos,'empty'=>true,'class'=>'uniformselect filtroDepo','div'=>false,'label'=>false,'before'=>'<p><label class="search" style="float: left;" >Filtrar por Proyecto</label><span class="field float">','after'=>'</span></p>'));

?>
</div>
.
<table  id="configurationTable" class ="table table-bordered" width="100%"  style="width: 100%; ">
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


<div class="botonera widgettitle">
</div>

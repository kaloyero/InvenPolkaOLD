<?php
echo '<h4 class="widgettitle nomargin shadowed">Articulo</h4>';
echo '<div class="widgetcontent bordered shadowed nopadding">';

echo $this->Form->create('Articulo',array('type' => 'file','class' => 'stdform stdform2','inputDefaults' => array(
        'div' => array('class' => 'field')
    )));
//echo $this->Form->create('Articulo', array('type' => 'file'));
//echo $this->Form->input('filename',array('type'=>'file'));

?>
<p>
    <label style="float: left;">Codigo Articulo</label>
	<span class="field float">
	    <?php echo $articulo['articulos_vista']['CodigoArticulo'] ?>
    </span>
</p>
<p>
    <label style="float: left;"></label>
    	<table class="field float">
        	<tr>
            	<td width="100px"><b>Categoria:</b></td>
                <td width="150px"><?php echo $articulo['articulos_vista']['categoria'] ?></td>
            	<td width="100px"><b>Objeto:</b></td>
                <td width="150px"><?php echo $articulo['articulos_vista']['objeto'] ?></td>
            	<td width="100px"><b>Decorado:</b></td>
                <td width="150px"><?php echo $articulo['articulos_vista']['decorado'] ?></td>
            </tr>
        	<tr>
            	<td><b>Material:</b></td>
                <td><?php echo $articulo['articulos_vista']['material'] ?></td>
            	<td><b>Tamaño:</b></td>
                <td><?php echo $articulo['articulos_vista']['dimension'] ?></td>
            	<td><b>Estilo:</b></td>
                <td><?php echo $articulo['articulos_vista']['estilo'] ?></td>
            </tr>
		</table>


</p>
<p>
    <label style="float: left;">Descripcion:</label>
</p>
<p>
    <span class="field float">
	    <?php echo $articulo['articulos_vista']['Descripcion'] ?>
   	</span>
</p>
<p>
	<label style="float: left;">Stock Total</label>
	<span class="field float">
	    <?php echo $articulo['articulos_vista']['stock_total'] ?>
   	</span>
	<label style="float: left;">Stock Disponible</label>
	<span class="field float">
	    <?php echo $articulo['articulos_vista']['stock_dispo'] ?>
   	</span>
</p>
<p>
    <label style="float: left;"></label>
    	<table class="field float">
            <tr>
                <th align="left"><b>Ubicacion</b></th>
                <th><b>Cantidad</b></th>
            </tr>
<?php		foreach ($inventario as $inv){ ?>
                <tr>
                    <?php if (is_null($inv['inventarios_vista']['proyecto'])){ ?>
	                    <td align="left" width="150px"><?php echo $inv['inventarios_vista']['deposito'] ?></td>
                    <?php } else { ?>
	                    <td align="left" width="150px"><?php echo $inv['inventarios_vista']['proyecto'] ?></td>
                    <?php } ?>
                    <td align="center"width="80px"><?php echo $inv['inventarios_vista']['Disponibilidad'] ?></td>
                </tr>
<?php		} ?>

		</table>
</p>
<label style="float: left;">Imagen</label>
<span class="field">

<img src="/InvenPolka/app/webroot/files/articulo/idFoto/<?php echo $articulo['articulos_vista']['dir'] ?>/<?php echo $articulo['articulos_vista']['idFoto'] ?>" alt="CakePHP" height="800px" width="800px">
</span>
</div>

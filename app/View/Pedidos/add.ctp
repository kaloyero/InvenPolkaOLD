<?php
echo '<h4 class="widgettitle nomargin shadowed">Pedido</h4>';
echo '<div class="widgetcontent bordered shadowed nopadding">';

echo $this->Form->create('Pedido',array('class' => 'stdform stdform2','inputDefaults' => array(
        'div' => array('class' => 'field') )));
echo $this->Form->input('Numero',array('class'=>'input-medium','min'=>'0','value'=>'0','div'=>false,'label'=>false,'before'=>'<p>
								                                <label>Numpero de Pedido</label>
								                                <span class="field">',
																'after'=>'</span></p>'));
echo $this->Form->input('Descripcion',array('class'=>'input-medium','div'=>false,'label'=>false,'before'=>'<p>
								                                <label>Descripcion</label>
								                                <span class="field">',
																'after'=>'</span></p>'));
echo $this->Form->input('Fecha');
echo $this->Form->input('Pedido.IdProyecto',array('type'=>'select','options'=>$proyectos,'empty'=>false,'class'=>'uniformselect','div'=>false,'label'=>false,'before'=>'<p>
                                <label>Proyecto</label>
                                <span class="field">',
								'after'=>'</span></p>'));
echo $this->Form->input('Pedido.IdEstudio',array('type'=>'select','options'=>$estudios,'empty'=>false,'class'=>'uniformselect','div'=>false,'label'=>false,'before'=>'<p>
                                <label>Estudio</label>
                                <span class="field">',
								'after'=>'</span></p>'));
?>
<?php 	
//Agregar Articulos al pedido (detalle pedido)
echo $this->Form->input('ArtArticulo',array('id'=>'ArtArticulo','type'=>'select','options'=>$articulos,'empty'=>false,'class'=>'uniformselect','div'=>false,'label'=>false,'before'=>'<p>
                                <label>Articulo</label>
                                <span class="field">',
								'after'=>'</span></p>'));
echo $this->Form->input('ArtCantidad',array('id'=>'ArtCantidad','label'=>'Cantidad','min'=>'0','value'=>'0','type'=>'number')); 
?>

<a id="agregarArticulo" class="btn btn-info" href="#">Agregar Campo</a>
<BR>
<div id="contenedor">
    <div class="added">
	</div>
</div>
<BR>
<?php 	
echo '<p class="stdformbutton"><button class="btn btn-primary save">Guardar</button><button type="reset" class="btn">Limpiar Formulario</button></p>';
?>
</div>

<?php echo $this->Form->end();?>
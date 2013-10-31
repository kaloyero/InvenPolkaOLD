<?php
echo '<h4 class="widgettitle nomargin shadowed">Inventario</h4>';
echo '<div class="widgetcontent bordered shadowed nopadding">';
echo $this->Form->create('Inventario',array('action' => 'edit','class' => 'stdform stdform2','inputDefaults' => array(
        'div' => array('class' => 'field')
    )));


echo $this->Form->input('Inventario.IdArticulo',array('type'=>'select','options'=>$articulos,'empty'=>false,'class'=>'uniformselect','div'=>false,'label'=>false,'before'=>'<p><label>Articulo</label><span class="field">','after'=>'</span></p>'));
echo $this->Form->input('Disponibilidad',array('class'=>'input-medium','min'=>'0','div'=>false,'label'=>false,'before'=>'<p>
								                                <label>Disponibilidad</label>
								                                <span class="field">',
																'after'=>'</span></p>'));
echo $this->Form->input('Inventario.IdDeposito',array('type'=>'select','options'=>$depositos,'empty'=>false,'class'=>'uniformselect','div'=>false,'label'=>false,'before'=>'<p><label>Deposito</label><span class="field">','after'=>'</span></p>'));
//echo $this->Form->input('Inventario.IdUbicacion',array('type'=>'select','options'=>$ubicaciones,'empty'=>false,'class'=>'uniformselect','div'=>false,'label'=>false,'before'=>'<p><label>Ubicacion</label><span class="field">','after'=>'</span></p>'));
echo $this->Form->input('Inventario.IdProyecto',array('type'=>'select','options'=>$proyectos,'empty'=>false,'class'=>'uniformselect','div'=>false,'label'=>false,'before'=>'<p><label>Proyecto</label><span class="field">','after'=>'</span></p>'));
echo $this->Form->input('id', array('type' => 'hidden'));

echo '<p class="stdformbutton"><button class="btn btn-primary edit">Guardar</button></p>';
?>
</div>

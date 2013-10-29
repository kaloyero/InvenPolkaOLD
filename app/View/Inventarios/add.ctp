<?php
echo '<h4 class="widgettitle nomargin shadowed">Inventarios</h4>';
echo '<div class="widgetcontent bordered shadowed nopadding">';
echo $this->Form->create('Inventario',array('class' => 'stdform stdform2','inputDefaults' => array(
        'div' => array('class' => 'field')
    )));

echo $this->Form->input('Inventario.IdArticulo',array('type'=>'select','options'=>$articulos,'empty'=>false,'class'=>'uniformselect','div'=>false,'label'=>false,'before'=>'<p><label>Articulo</label><span class="field">','after'=>'</span></p>'));
echo $this->Form->input('Disponibilidad');
echo $this->Form->input('Inventario.IdDeposito',array('type'=>'select','options'=>$depositos,'empty'=>false,'class'=>'uniformselect','div'=>false,'label'=>false,'before'=>'<p><label>Deposito</label><span class="field">','after'=>'</span></p>'));
echo $this->Form->input('Inventario.IdUbicacion',array('type'=>'select','options'=>$ubicaciones,'empty'=>false,'class'=>'uniformselect','div'=>false,'label'=>false,'before'=>'<p><label>Ubicacion</label><span class="field">','after'=>'</span></p>'));
echo $this->Form->input('Inventario.IdProyecto',array('type'=>'select','options'=>$proyectos,'empty'=>false,'class'=>'uniformselect','div'=>false,'label'=>false,'before'=>'<p><label>Proyecto</label><span class="field">','after'=>'</span></p>'));

echo '<p class="stdformbutton"><button class="btn btn-primary save">Guardar</button><button type="reset" class="btn">Limpiar Formulario</button></p>';
echo $this->Form->end();
?>
</div>


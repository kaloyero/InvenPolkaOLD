
<?php
echo '<h4 class="widgettitle nomargin shadowed">Estudios</h4>';
echo '<div class="widgetcontent bordered shadowed nopadding">';
echo $this->Form->create('Estudio',array('action' => 'edit','class' => 'stdform stdform2','inputDefaults' => array(
        'div' => array('class' => 'field')
    )));
echo $this->Form->input('Nombre',array('class'=>'input-medium','div'=>false,'label'=>false,'before'=>'<p>
                                <label>Nombre</label>
                                <span class="field">',
								'after'=>'</span></p>'));

echo $this->Form->input('Descripcion',array('type' => 'textarea','class'=>'span5','div'=>false,'label'=>false,'before'=>'<p>
									<label>Descripcion</label>
								    <span class="field">',
									'after'=>'</span></p>'));


//echo $this->Form->end('Guardar');
echo $this->Form->input('id', array('type' => 'hidden'));
echo '<p class="stdformbutton"><button class="btn btn-primary edit">Guardar</button></p>';

?>
</div>


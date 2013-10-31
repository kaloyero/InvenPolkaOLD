<?php
echo '<h4 class="widgettitle nomargin shadowed">Estudios</h4>';
echo '<div class="widgetcontent bordered shadowed nopadding">';
echo $this->Form->create('Estudio',array('class' => 'stdform stdform2','inputDefaults' => array(
        'div' => array('class' => 'field')
    )));
echo $this->Form->input('Nombre',array('class'=>'input-medium','div'=>false,'label'=>false,'before'=>'<p>
                                <label>Nombre</label>
                                <span class="field">',
								'after'=>'</span></p>'));

echo $this->Form->input('Descripcion',array('class'=>'input-medium','div'=>false,'label'=>false,'before'=>'<p>
									<label>Descripcion</label>
								    <span class="field">',
									'after'=>'</span></p>'));
<<<<<<< HEAD
echo $this->Form->input('FechaFin',array('empty'=>false,'class'=>'datepicker','div'=>false,'label'=>false,'before'=>'<p><label>Fecha Fin</label><span class="field">','after'=>'</span></p>'));
=======
echo $this->Form->input('FechaFin',array('empty'=>true,'class'=>'uniformselect','div'=>false,'label'=>false,'before'=>'<p><label>Fecha Fin</label><span class="field">','after'=>'</span></p>'));
>>>>>>> 7ad169e41625c9ccb7603704a23293e26b19a4c0
//echo $this->Form->end('Guardar');
echo '<p class="stdformbutton"><button class="btn btn-primary save">Guardar</button><button type="reset" class="btn">Limpiar Formulario</button></p>';
?>
</div>
<label>Guardar y Seguir</label>
<span class="field"><input type="checkbox"class='seguir' name="check2" style="opacity: 0;"></span>


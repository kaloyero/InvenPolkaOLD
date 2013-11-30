<table  id="configurationTable" class ="table table-bordered" width="100%"  style="width: 100%;">
        <thead>
                <tr>
                <th style="display:none;">Id</th>
 				<th>Nombre</th>
                <th>Categorias</th>
                <th>Acciones</th>

        </thead>
        <tbody>
        </tbody>
</table>

<div class="pantalla" style="width: 100px;height: 100px;" >
<?php echo $this->Form->input('edit.IdCategoria',array('type'=>'select','multiple' => 'true','required' => 'true','options'=>$categorias,'empty'=>false,'class'=>'uniformselect'															,'div'=>false,'label'=>false,'before'=>'<p>
                                <label>Categoria</label>
                                <span class="field">')); ?>
</div>
<p class="stdformbutton"></p>
<?php
echo '<h4 class="widgettitle nomargin shadowed">Materiales</h4>';
echo '<div class="widgetcontent bordered shadowed nopadding">';
echo $this->Form->create('Materiale',array('class' => 'stdform stdform2','inputDefaults' => array('div' => array('class' => 'field'))));


echo $this->Form->input('Nombre',array('class'=>'input-medium','div'=>false,'label'=>false,'before'=>'<p>
								                                <label>Nombre</label>
								                                <span class="field">',
																'after'=>'</span></p>'));
echo $this->Form->input('IdCategoria',array('type'=>'select','multiple' => 'checkbox','required' => 'true','options'=>$categorias,'empty'=>false,'class'=>'uniformselect'															,'div'=>false,'label'=>false,'before'=>'<p>
                                <label>Categoria</label>
                                <span class="field">'));
																
echo '<p class="stdformbutton"><button class="btn btn-primary save">Guardar</button><button type="reset" class="btn">Limpiar Formulario</button></p>';
echo $this->Form->end();
?>

<table  id="configurationTable" class ="table table-bordered" width="100%"  style="width: 100%;">
        <thead>
                <tr>
                <th style="display:none;">Id</th>
 				<th>Nombre</th>
				<th>Categorias</th>
                <th>Acciones</th>
                </tr>
        </thead>
        <tbody>
        </tbody>
</table>
<?php
echo '<h4 class="widgettitle nomargin shadowed">Objetos</h4>';
echo '<div class="widgetcontent bordered shadowed nopadding">';
echo $this->Form->create('Objeto',array('class' => 'stdform stdform2','inputDefaults' => array('div' => array('class' => 'field'))));


echo $this->Form->input('Nombre',array('class'=>'input-medium','div'=>false,'label'=>false,'before'=>'<p>
								                                <label>Nombre</label>
								                                <span class="field">',
																'after'=>'</span></p>'));
//echo $this->Form->input('IdCategoria',array('type'=>'select', 'multiple'=>'checkbox','options'=>$categorias,'empty'=>false,'class'=>'uniformselect multiple-chb','div'=>false,'label'=>false,'before'=>'<p><label>Categoria</label><span class="field">'));
echo $this->Form->input('IdCategoria',array('type'=>'select', 'multiple'=>'true','options'=>$categorias,'empty'=>false,'class'=>'uniformselect','div'=>false,'label'=>false,'before'=>'<p><label>Categoria</label><span class="field">'));																
																
echo '<p class="stdformbutton"><button class="btn btn-primary save">Guardar</button><button type="reset" class="btn">Limpiar Formulario</button></p>';
echo $this->Form->end();
?>

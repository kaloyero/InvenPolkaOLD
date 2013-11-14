<?php
echo '<h4 class="widgettitle nomargin shadowed">Articulos</h4>';
echo '<div class="widgetcontent bordered shadowed nopadding">';

echo $this->Form->create('Articulo',array('type' => 'file','class' => 'stdform stdform2','inputDefaults' => array(
        'div' => array('class' => 'field')
    )));
//echo $this->Form->create('Articulo', array('type' => 'file'));
//echo $this->Form->input('filename',array('type'=>'file'));

echo $this->Form->input('idFoto', array('type' => 'file', 'accept' =>'image/*','label' => false,'class'=>'uniform-file','div'=>array('class'=>'field uploader focus')));



echo $this->Form->input('dir', array('type' => 'hidden','value' => ''));
//echo $this->Form->input('CodigoArticulo',array('class'=>'input-medium'));
echo $this->Form->input('CodigoArticulo',array('class'=>'input-medium','div'=>false,'label'=>false,'before'=>'<p>
                                <label style="float: left;">Codigo Articulo</label>
                                <span class="field float">',
								'after'=>'</span>'));

echo $this->Form->input('Descripcion',array('type' => 'textarea','class'=>'span5','div'=>false,'label'=>false,'before'=>'
								                                <label style="float: left;">Descripcion</label>
								                                <span class="field float">',
																'after'=>'</span></p>'));
//echo $this->Form->input('Descripcion',array('class'=>'input-medium'));
//Acceder al wrapper del Input array('div'=>array('class'=>'selector focus') Poner antes del input 'before'=>'<span>Decorado</span>'


echo $this->Form->input('Articulo.IdCategoria',array('type'=>'select','options'=>$categorias,'empty'=>false,'class'=>'uniformselect categoria'															,'div'=>false,'label'=>false,'before'=>'<p>
                                <label>Configuraciones</label>
                                <span class="field"> Categoria : '));

echo $this->Form->input('Articulo.IdMaterial',array('type'=>'select','empty'=>false,'class'=>'uniformselect','div'=>false,'label'=>false,'before'=>' Material : '));

echo $this->Form->input('Articulo.IdEstilo',array('type'=>'select','empty'=>false,'class'=>'uniformselect','div'=>false,'label'=>false,'before'=>' Estilo : '));

//echo $this->Form->select('field', $estilos, array( 'multiple' => 'checkbox'));

echo $this->Form->input('Articulo.IdObjeto',array('type'=>'select','empty'=>false,'class'=>'uniformselect','div'=>false,'label'=>false,'before'=>' Objeto : '));

echo $this->Form->input('Articulo.IdDimension',array('type'=>'select','empty'=>false,'class'=>'uniformselect'																								,'div'=>false,'label'=>false,'before'=>' Dimension : '));


echo
$this->Form->input('Articulo.IdDecorado',array('type'=>'select','empty'=>false,'class'=>'uniformselect','div'=>false,'label'=>false,'before'=>' Decorado : ','after'=>'</span></p>'));


echo '<p class="stdformbutton"><button class="btn btn-primary save">Guardar</button><button type="reset" class="btn">Limpiar Formulario</button></p>';
?>
</div>
<label>Guardar y Seguir</label>
<span class="field"><input type="checkbox"class='seguir' name="check2" style="opacity: 0;"></span>
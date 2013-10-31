<?php
echo '<h4 class="widgettitle nomargin shadowed">Articulo</h4>';
echo '<div class="widgetcontent bordered shadowed nopadding">';

echo $this->Form->create('Articulo',array('type' => 'file','class' => 'stdform stdform2','inputDefaults' => array(
        'div' => array('class' => 'field')
    )));
//echo $this->Form->create('Articulo', array('type' => 'file'));
//echo $this->Form->input('filename',array('type'=>'file'));

echo $this->Form->input('idFoto', array('type' => 'file', 'accept' =>'image/*', 'label' => false,'class'=>'uniform-file','div'=>array('class'=>'field uploader focus')));
echo $this->Form->input('idFoto', array('type' => 'hidden','value' => ''),array('id' => 'preview'));
echo $this->Form->input('id', array('type' => 'hidden'));
echo '<span class="field"><img src="/invenPolka/app/webroot/files/articulo/IdFoto/'.$this->data['Articulo']['dir'].'/'.$this->data['Articulo']['idFoto'] .' "alt="CakePHP" width="200px"></span>';




echo $this->Form->input('dir', array('type' => 'hidden','value' => ''));
//echo $this->Form->input('CodigoArticulo',array('class'=>'input-medium'));
echo $this->Form->input('CodigoArticulo',array('class'=>'input-medium','div'=>false,'label'=>false,'before'=>'<p>
                                <label>Codigo Articulo</label>
                                <span class="field">',
								'after'=>'</span></p>'));

echo $this->Form->input('Descripcion',array('class'=>'input-medium','div'=>false,'label'=>false,'before'=>'<p>
								                                <label>Descripcion</label>
								                                <span class="field">',
																'after'=>'</span></p>'));
//echo $this->Form->input('Descripcion',array('class'=>'input-medium'));
//Acceder al wrapper del Input array('div'=>array('class'=>'selector focus') Poner antes del input 'before'=>'<span>Decorado</span>'
echo $this->Form->input('Articulo.IdMaterial',array('type'=>'select','options'=>$materiales,'empty'=>false,'class'=>'uniformselect','div'=>false,'label'=>false,'before'=>'<p>
                                <label>Material</label>
                                <span class="field">',
								'after'=>'</span></p>'));
echo $this->Form->input('Articulo.IdDecorado',array('type'=>'select','options'=>$decorados,'empty'=>false,'class'=>'uniformselect','div'=>false,'label'=>false,'before'=>'<p>
								                                <label>Decorado</label>
								                                <span class="field">',
																'after'=>'</span></p>'));
echo $this->Form->input('Articulo.IdCategoria',array('type'=>'select','options'=>$categorias,'empty'=>false,'class'=>'uniformselect'															,'div'=>false,'label'=>false,'before'=>'<p><label>Categoria</label><span class="field">','after'=>'</span></p>'));

echo $this->Form->input('Articulo.IdDimension',array('type'=>'select','options'=>$dimensiones,'empty'=>false,'class'=>'uniformselect'																								,'div'=>false,'label'=>false,'before'=>'<p><label>Dimension</label><span class="field">','after'=>'</span></p>'));
echo $this->Form->input('Articulo.IdEstilo',array('type'=>'select','options'=>$estilos,'empty'=>false,'class'=>'uniformselect','div'=>false,'label'=>false,'before'=>'<p><label>Estilo</label><span class="field">','after'=>'</span></p>'));
echo $this->Form->input('Articulo.IdObjeto',array('type'=>'select','options'=>$objetos,'empty'=>false,'class'=>'uniformselect','div'=>false,'label'=>false,'before'=>'<p><label>Objeto</label><span class="field">','after'=>'</span></p>'));
//echo '<p class="stdformbutton">button class="btn btn-primary">Guardar</button><button type="reset" class="btn">Limpiar campos</button></p>';

//echo $this->Form->submit(__('Guardar',true), array('class'=>'btn btn-primary','div'=>false,'label'=>false,'before'=>'<p class="stdformbutton"><label>Guardar </label><span class="field">','after'=>'</span></p>'));
echo '<p class="stdformbutton"><button class="btn btn-primary save">Guardar</button></p>';

?>
</div>

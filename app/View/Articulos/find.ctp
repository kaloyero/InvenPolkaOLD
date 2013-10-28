<?php
echo '<h4 class="widgettitle nomargin shadowed">Busqueda Articulo</h4>';
echo '<div class="widgetcontent bordered shadowed nopadding">';
echo $this->Form->create('ArticuloSearch',array('type' => 'file','class' => 'stdform stdform2','inputDefaults' => array(
        'div' => array('class' => 'field'))));


echo $this->Form->input('CodigoArticulo');
echo $this->Form->input('ArticuloSearch.IdMaterial',array('type'=>'select','options'=>$materiales,'empty'=>true,'class'=>'uniformselect'																								,'div'=>false,'label'=>false,'before'=>'<p><label>Material</label><span class="field">','after'=>'</span></p>'));

echo $this->Form->input('ArticuloSearch.IdDecorado',array('type'=>'select','options'=>$decorados,'empty'=>true,'class'=>'uniformselect'																								,'div'=>false,'label'=>false,'before'=>'<p><label>Decorado</label><span class="field">','after'=>'</span></p>'));

echo $this->Form->input('ArticuloSearch.IdCategoria',array('type'=>'select','options'=>$categorias,'empty'=>true,'class'=>'uniformselect'																								,'div'=>false,'label'=>false,'before'=>'<p><label>Categoria</label><span class="field">','after'=>'</span></p>'));

echo $this->Form->input('ArticuloSearch.IdDimension',array('type'=>'select','options'=>$dimensiones,'empty'=>true,'class'=>'uniformselect'																								,'div'=>false,'label'=>false,'before'=>'<p><label>Dimension</label><span class="field">','after'=>'</span></p>'));

echo $this->Form->input('ArticuloSearch.IdEstilo',array('type'=>'select','options'=>$estilos,'empty'=>true,'class'=>'uniformselect'																								,'div'=>false,'label'=>false,'before'=>'<p><label>Estilo</label><span class="field">','after'=>'</span></p>'));

echo $this->Form->input('ArticuloSearch.IdObjeto',array('type'=>'select','options'=>$objetos,'empty'=>true,'class'=>'uniformselect'																								,'div'=>false,'label'=>false,'before'=>'<p><label>Objeto</label><span class="field">','after'=>'</span></p>'));

echo '<p class="stdformbutton"><button class="btn btn-primary save">Buscar</button><button type="reset" class="btn">Limpiar Formulario</button></p>';
?>
</div>

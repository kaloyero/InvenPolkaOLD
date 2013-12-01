<?php
echo $this->Form->create('ArticuloSearch',array('type' => 'file','class' => 'stdform stdform2','inputDefaults' => array(
        'div' => array('class' => 'field'))));


echo $this->Form->input('CodigoArticulo');

echo $this->Form->input('ArticuloSearch.IdCategoria',array('type'=>'select','options'=>$categorias,'empty'=>true,'class'=>'uniformselect'																								,'div'=>false,'label'=>false,'before'=>'<p><label>Configuraciones</label><span class="field"> Categoria : '));

echo $this->Form->input('ArticuloSearch.IdObjeto',array('type'=>'select','options'=>$objetos,'empty'=>true,'class'=>'uniformselect'																								,'div'=>false,'label'=>false,'before'=>' Objeto : '));

echo $this->Form->input('ArticuloSearch.IdDecorado',array('type'=>'select','options'=>$decorados,'empty'=>true,'class'=>'uniformselect'																								,'div'=>false,'label'=>false,'before'=>' Decorado : '));

echo $this->Form->input('ArticuloSearch.IdMaterial',array('type'=>'select','options'=>$materiales,'empty'=>true,'class'=>'uniformselect'																								,'div'=>false,'label'=>false,'before'=>' Material : '));

echo $this->Form->input('ArticuloSearch.IdDimension',array('type'=>'select','options'=>$dimensiones,'empty'=>true,'class'=>'uniformselect'																								,'div'=>false,'label'=>false,'before'=>' Dimension : '));

echo $this->Form->input('ArticuloSearch.IdEstilo',array('type'=>'select','options'=>$estilos,'empty'=>true,'class'=>'uniformselect'																								,'div'=>false,'label'=>false,'before'=>' Estilo : ','after'=>'</span></p>'));

echo '<p class="stdformbutton"><button class="btn btn-primary save">Buscar</button><button type="reset" class="btn">Limpiar Formulario</button></p>';
?>
<?php
echo $this->Form->end();
?>
<h1>Busqueda Articulos</h1>
<?php
echo $this->Form->create('ArticuloSearch');


echo $this->Form->input('CodigoArticulo');
echo $this->Form->input('ArticuloSearch.IdMaterial',array('type'=>'select','options'=>$materiales,'empty'=>true,'label'=>'Material','style'=>array('width:200px')));
echo $this->Form->input('ArticuloSearch.IdDecorado',array('type'=>'select','options'=>$decorados,'empty'=>true,'label'=>'Decorado','style'=>array('width:200px')));
echo $this->Form->input('ArticuloSearch.IdCategoria',array('type'=>'select','options'=>$categorias,'empty'=>true,'label'=>'Categoria','style'=>array('width:200px')));
echo $this->Form->input('ArticuloSearch.IdDimension',array('type'=>'select','options'=>$dimensiones,'empty'=>true,'label'=>'Dimension','style'=>array('width:200px')));
echo $this->Form->input('ArticuloSearch.IdEstilo',array('type'=>'select','options'=>$estilos,'empty'=>true,'label'=>'Estilo','style'=>array('width:200px')));
echo $this->Form->input('ArticuloSearch.IdObjeto',array('type'=>'select','options'=>$objetos,'empty'=>true,'label'=>'Tipo Objeto','style'=>array('width:200px')));
echo $this->Form->end('Buscar');
?>
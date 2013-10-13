<h1>Agregar</h1>
<?php
echo $this->Form->create('Articulo',array('type' => 'file'));
//echo $this->Form->create('Articulo', array('type' => 'file'));
//echo $this->Form->input('filename',array('type'=>'file'));

echo $this->Form->input('IdFoto', array('type' => 'file', 'label' => 'Foto'));
echo $this->Form->input('dir', array('type' => 'hidden','value' => ''));


echo $this->Form->input('CodigoArticulo');
echo $this->Form->input('Articulo.IdMaterial',array('type'=>'select','options'=>$materiales,'empty'=>false,'label'=>'Material'));
echo $this->Form->input('Articulo.IdDecorado',array('type'=>'select','options'=>$decorados,'empty'=>false,'label'=>'Decorado'));
echo $this->Form->input('Articulo.IdCategoria',array('type'=>'select','options'=>$categorias,'empty'=>false,'label'=>'Categoria'));
echo $this->Form->input('Articulo.IdDimension',array('type'=>'select','options'=>$dimensiones,'empty'=>false,'label'=>'Dimension'));
echo $this->Form->input('Articulo.IdEstilo',array('type'=>'select','options'=>$estilos,'empty'=>false,'label'=>'Estilo'));
echo $this->Form->input('Articulo.IdObjeto',array('type'=>'select','options'=>$objetos,'empty'=>false,'label'=>'Tipo Objeto'));
echo $this->Form->end('Guardar');
?>
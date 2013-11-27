<?php
echo '<h4 class="widgettitle nomargin shadowed">Articulo</h4>';
echo '<div class="widgetcontent bordered shadowed nopadding">';

echo $this->Form->create('Articulo',array('type' => 'file','class' => 'stdform stdform2','inputDefaults' => array(
        'div' => array('class' => 'field')
    )));
//echo $this->Form->create('Articulo', array('type' => 'file'));
//echo $this->Form->input('filename',array('type'=>'file'));


//echo $this->Form->input('CodigoArticulo',array('class'=>'input-medium'));
echo $this->Form->input('CodigoArticulo',array('class'=>'input-medium','div'=>false,'label'=>false,'before'=>'<p>
                                <label style="float: left;">Codigo Articulo</label>
                                <span class="field float">',
								'after'=>'</span>','pattern' => '.*\S+.*'));

echo $this->Form->input('Descripcion',array('type' => 'textarea','class'=>'span5','div'=>false,'label'=>false,'before'=>'
								                                <label style="float: left;">Comentarios</label>
								                                <span class="field float">',
																'after'=>'</span></p>','pattern' => '.*\S+.*'));


echo $this->Form->input('Articulo.IdCategoria',array('type'=>'select','options'=>$categorias,'empty'=>false,'class'=>'uniformselect categoria'															,'div'=>false,'label'=>false,'before'=>'<p><label>Configuraciones : </label><span class="field"> Categoria :'));

echo $this->Form->input('Articulo.IdObjeto',array('type'=>'select','empty'=>false,'options'=>$objetos,'class'=>'uniformselect','div'=>false,'label'=>false,'before'=>' Objeto : '));

echo $this->Form->input('Articulo.IdDecorado',array('type'=>'select','options'=>$decorados,'empty'=>false,'class'=>'uniformselect','div'=>false,'label'=>false,'before'=>' Decorado : '));


echo $this->Form->input('Articulo.IdMaterial',array('type'=>'select','empty'=>false,'options'=>$materiales,'class'=>'uniformselect','div'=>false,'label'=>false,'before'=>' Material : '));

echo $this->Form->input('Articulo.IdDimension',array('type'=>'select','options'=>$dimensiones,'empty'=>false,'class'=>'uniformselect'																								,'div'=>false,'label'=>false,'before'=>' Dimension : '));

echo $this->Form->input('Articulo.IdEstilo',array('type'=>'select','empty'=>false,'options'=>$estilos,'class'=>'uniformselect','div'=>false,'label'=>false,'before'=>' Estilo : ','after'=>'</span><label class ="errorConfiguration" style="display: block;color:red"></label></p>'));

//Selector de imagen
echo $this->Form->input('idFoto', array('type' => 'file', 'accept' =>'image/*', 'label' => false,'class'=>'uniform-file','div'=>array('class'=>'field uploader focus')));
echo $this->Form->input('idFoto', array('type' => 'hidden','value' => ''),array('id' => 'preview'));
echo $this->Form->input('id', array('type' => 'hidden'));
echo '<span class="field"><img src="/invenPolka/app/webroot/files/articulo/IdFoto/'.$this->data['Articulo']['dir'].'/'.$this->data['Articulo']['idFoto'] .' "alt="CakePHP" height="500px" width="500px"></span>';
echo $this->Form->input('dir', array('type' => 'hidden','value' => ''));
echo "<label class='errorFoto' style='display: block;color:red'></label>";


//echo '<p class="stdformbutton">button class="btn btn-primary">Guardar</button><button type="reset" class="btn">Limpiar campos</button></p>';

//echo $this->Form->submit(__('Guardar',true), array('class'=>'btn btn-primary','div'=>false,'label'=>false,'before'=>'<p class="stdformbutton"><label>Guardar </label><span class="field">','after'=>'</span></p>'));
echo '<p class="stdformbutton"><button class="btn btn-primary save">Guardar</button></p>';

?>
</div>

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
echo "<label class='errorFoto' style='display: block;color:red'></label>";

echo $this->Form->input('Descripcion',array('type' => 'textarea','class'=>'span5','div'=>false,'label'=>false,'before'=>'<p>
								                                <label style="float: left;">Comentarios</label>
								                                <span class="field float">',
																'after'=>'</span></p>','pattern' => '.*\S+.*'));
//echo $this->Form->input('Descripcion',array('class'=>'input-medium'));
//Acceder al wrapper del Input array('div'=>array('class'=>'selector focus') Poner antes del input 'before'=>'<span>Decorado</span>'


echo $this->Form->input('Articulo.IdCategoria',array('type'=>'select','options'=>$categorias,'empty'=>false,'class'=>'uniformselect categoria'															,'div'=>false,'label'=>false,'before'=>'<p>
                                <label>Configuraciones</label>
                                <span class="field categorias"> Categoria : '));

echo $this->Form->input('Articulo.IdObjeto',array('type'=>'select','empty'=>false,'options'=>$objetos,'class'=>'uniformselect','div'=>false,'label'=>false,'before'=>' Objeto : '));

echo $this->Form->input('Articulo.IdDecorado',array('type'=>'select','empty'=>false,'options'=>$decorados,'class'=>'uniformselect','div'=>false,'label'=>false,'before'=>' Decorado : '));



echo $this->Form->input('Articulo.IdMaterial',array('type'=>'select','empty'=>false,'options'=>$materiales,'class'=>'uniformselect','div'=>false,'label'=>false,'before'=>' Material : '));

echo $this->Form->input('Articulo.IdDimension',array('type'=>'select','empty'=>false,'options'=>$dimensiones,'class'=>'uniformselect'																								,'div'=>false,'label'=>false,'before'=>' Dimension : '));

echo $this->Form->input('Articulo.IdEstilo',array('type'=>'select','empty'=>false,'options'=>$estilos,'class'=>'uniformselect','div'=>false,'label'=>false,'before'=>' Estilo : ','after'=>'</span><label class ="errorConfiguration" style="display: block;color:red"></label></p>'));
//echo $this->Form->select('field', $estilos, array( 'multiple' => 'checkbox'));

echo "<p><label style='float: left;'>Inventario :</label></p>";

echo $this->Form->input('Inventario.Disponibilidad',array('class'=>'input-medium','type' => 'number','required','value'=>'0','min'=>'0','div'=>false,'label'=>false,'before'=>'<p>
								                                <label  style="float: left;">Stock Inicial</label>
								                                <span class="field float">',
																'after'=>'</span>'));


echo $this->Form->input('Inventario.IdDeposito',array('type'=>'select','options'=>$depositos,'empty'=>false,'class'=>'uniformselect','div'=>false,'label'=>false,'before'=>'<label  style="float: left;">Deposito</label><span class="field float">','after'=>'</span>'));
//echo $this->Form->input('Inventario.IdUbicacion',array('type'=>'select','options'=>$ubicaciones,'empty'=>false,'class'=>'uniformselect','div'=>false,'label'=>false,'before'=>'<p><label>Ubicacion</label><span class="field">','after'=>'</span></p>'));
echo $this->Form->input('Inventario.IdProyecto',array('type'=>'select','options'=>$proyectos,'empty'=>true,'class'=>'uniformselect','div'=>false,'label'=>false,'before'=>'<label style="float: left;" >Proyecto</label><span class="field float">','after'=>'</span></p>'));



echo '<p class="stdformbutton"><button class="btn btn-primary save">Guardar</button><button type="reset" class="btn">Limpiar Formulario</button></p>';
?>
</div>
<label>Guardar y Seguir</label>
<span class="field"><input type="checkbox"class='seguir' name="check2" style="opacity: 0;"></span>
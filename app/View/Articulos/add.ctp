

<h4 class="widgettitle nomargin shadowed">Articulos</h4>
<div class="widgetcontent bordered shadowed nopadding">


    <div style="float:left; width: 400px; height: 420px; background-color:#585858; padding: 15px 0">

        <div style="margin:10px 20px">
            <?php

            echo $this->Form->create('Articulo',array('type' => 'file','class' => '','inputDefaults' => array(
            'div' => array('class' => 'field')
            )));
            //echo $this->Form->create('Articulo', array('type' => 'file'));
            //echo $this->Form->input('filename',array('type'=>'file'));

            echo $this->Form->input('idFoto', array('type' => 'file', 'accept' =>'image/*','label' => false,'class'=>'uniform-file','div'=>array('class'=>'field uploader focus')));

            ?>
        </div>

        <p class="preview"><span id ="preview" class="field float" style="margin: 0 auto"><img /></span></p>



    </div>

     

    <?php
    echo $this->Form->input('dir', array('type' => 'hidden','value' => ''));
    echo "<label class='errorFoto' style='display: block;color:red'></label>";
    ?>

    <div style="float:left; width: 520px; height: 420px; background-color:#333; padding: 15px 30px; color:#fff;">


 <?php
    echo $this->Form->input('Descripcion',array('type' => 'textarea','class'=>'span5','div'=>false,'label'=>false,'before'=>'<p>
        <label class="items-header">Comentarios</label>
        <span class="field float">',
        'after'=>'</span></p>','pattern' => '.*\S+.*'));
//echo $this->Form->input('Descripcion',array('class'=>'input-medium'));
//Acceder al wrapper del Input array('div'=>array('class'=>'selector focus') Poner antes del input 'before'=>'<span>Decorado</span>'

    echo $this->Form->input('Articulo.IdCategoria',array('type'=>'select','options'=>$categorias,'empty'=>false,'class'=>'uniformselect categoria items-select','div'=>false,'label'=>false,'before'=>'<p>
        <label class="items-header">Descripciones</label>
        <span class="items"> Categoria: </span>'));

    echo $this->Form->input('Articulo.IdObjeto',array('type'=>'select','empty'=>false,'options'=>$objetos,'class'=>'uniformselect items-select','div'=>false,'label'=>false,'before'=>'<span class="field categorias items"> Objeto: </span>'));

    echo $this->Form->input('Articulo.IdDecorado',array('type'=>'select','empty'=>false,'options'=>$decorados,'class'=>'uniformselect items-select','div'=>false,'label'=>false,'before'=>'<span class="field categorias items"> Decorado: </span> '));



    echo $this->Form->input('Articulo.IdMaterial',array('type'=>'select','empty'=>false,'options'=>$materiales,'class'=>'uniformselect items-select','div'=>false,'label'=>false,'before'=>'<span class="field categorias items"> Material: </span>'));

    echo $this->Form->input('Articulo.IdDimension',array('type'=>'select','empty'=>false,'options'=>$dimensiones,'class'=>'uniformselect items-select','div'=>false,'label'=>false,'before'=>'<span class="field categorias items"> Dimension: </span>'));

    echo $this->Form->input('Articulo.IdEstilo',array('type'=>'select','empty'=>false,'options'=>$estilos,'class'=>'uniformselect items-select','div'=>false,'label'=>false,'before'=>'<span class="field categorias items"> Estilo: </span>','after'=>'</span><label class ="errorConfiguration" style="display: block;color:red"></label></p>'));
//echo $this->Form->select('field', $estilos, array( 'multiple' => 'checkbox'));

    echo "<label class='items-header'>Inventario: </label>";

    echo $this->Form->input('Inventario.Disponibilidad',array('class'=>'input-medium items-input','type' => 'number','required','value'=>'1','min'=>'0','div'=>false,'label'=>false,'before'=>'<p>
       
        <span class="items">Stock Inicial: </span>
        <span class="field float">',
        'after'=>'</span></p>'));
		


    echo $this->Form->input('Inventario.IdDeposito',array('type'=>'select','options'=>$depositos,'empty'=>false,'class'=>'uniformselect items-select','div'=>false,'label'=>false,'before'=>'<span class="field categorias items">Deposito</span><span class="field float">','after'=>'</span>'));
//echo $this->Form->input('Inventario.IdUbicacion',array('type'=>'select','options'=>$ubicaciones,'empty'=>false,'class'=>'uniformselect','div'=>false,'label'=>false,'before'=>'<p><label>Ubicacion</label><span class="field">','after'=>'</span></p>'));
    echo $this->Form->input('Inventario.IdProyecto',array('type'=>'select','options'=>$proyectos,'empty'=>true,'class'=>'uniformselect items-select','div'=>false,'label'=>false,'before'=>'<span class="field categorias items">Proyecto</span><span class="field float">','after'=>'</span></p>'));


    ?>

</div>

</div>
<p class="stdformbutton items-btn">
    <button class="btn btn-primary save">Guardar</button>
    <button type="reset" class="btn">Limpiar Formulario</button>
    <button class="btn btn-primary volver" type="button">Volver</button>
    <input type="checkbox" class="seguir" name="check2" > Guardar y Seguir
</p>


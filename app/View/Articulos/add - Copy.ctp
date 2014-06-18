
<style type="text/css">

.items-header{
    border-bottom: 1px dotted #7CE1FF;
    color: #7CE1FF;
    margin-bottom: 10px;
}

.items-title {
    width: 75px !important;
    float: left;
    padding-top: 5px;
}

.items-select{
    width: 148px !important;
    float: left;
    margin: 0 15px 5px 0;
}

.items-input{
    width: 133px !important;
    float: left;
    margin: 0 15px 5px 0;
}

div.uploader span.action {
    background: none;
}

img.preview {
    margin-left: 25px;
    width: 350px;
    height: 350px;      
    background-color: #999;
    border: 1px solid #333;
} 

.items-btn{
    float:left;

}

</style>




<h4 class="widgettitle nomargin shadowed">Articulos</h4>
<div class="widgetcontent bordered shadowed nopadding">


    <div style="float:left; width: 400px; height: 480px; background-color:#8B8B8B; padding: 15px 0">

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

        <p class="preview"><span id ="preview" class="field float" style="margin: 0 auto"><img class="preview"/></span></p>



    </div>

     

    <?php
    echo $this->Form->input('dir', array('type' => 'hidden','value' => ''));
    echo "<label class='errorFoto' style='display: block;color:red'></label>";
    ?>

    <div style="float:left; width: 520px; height: 480px; background-color:#535353; padding: 15px 30px; color:#fff;">


 <?php
    echo $this->Form->input('Descripcion',array('type' => 'textarea','class'=>'span5','div'=>false,'label'=>false,'before'=>'<p>
        <label class="items-header">Comentarios</label>
        <span class="field float">',
        'after'=>'</span></p>','pattern' => '.*\S+.*'));
//echo $this->Form->input('Descripcion',array('class'=>'input-medium'));
//Acceder al wrapper del Input array('div'=>array('class'=>'selector focus') Poner antes del input 'before'=>'<span>Decorado</span>'

    echo $this->Form->input('Articulo.IdCategoria',array('type'=>'select','options'=>$categorias,'empty'=>false,'class'=>'uniformselect categoria items-select','div'=>false,'label'=>false,'before'=>'<p>
        <label class="items-header">Descripciones</label>
        <div class="items-title"> Categoria: </div>'));

    echo $this->Form->input('Articulo.IdObjeto',array('type'=>'select','empty'=>false,'options'=>$objetos,'class'=>'uniformselect items-select','div'=>false,'label'=>false,'before'=>'<div class="field categorias items-title"> Objeto: </div>'));

    echo $this->Form->input('Articulo.IdDecorado',array('type'=>'select','empty'=>false,'options'=>$decorados,'class'=>'uniformselect items-select','div'=>false,'label'=>false,'before'=>'<div class="field categorias items-title"> Decorado: </div> '));



    echo $this->Form->input('Articulo.IdMaterial',array('type'=>'select','empty'=>false,'options'=>$materiales,'class'=>'uniformselect items-select','div'=>false,'label'=>false,'before'=>'<div class="field categorias items-title"> Material: </div>'));

    echo $this->Form->input('Articulo.IdDimension',array('type'=>'select','empty'=>false,'options'=>$dimensiones,'class'=>'uniformselect items-select','div'=>false,'label'=>false,'before'=>'<div class="field categorias items-title"> Dimension: </div>'));

    echo $this->Form->input('Articulo.IdEstilo',array('type'=>'select','empty'=>false,'options'=>$estilos,'class'=>'uniformselect items-select','div'=>false,'label'=>false,'before'=>'<div class="field categorias items-title"> Estilo: </div>','after'=>'</span><label class ="errorConfiguration" style="display: block;color:red"></label></p>'));
//echo $this->Form->select('field', $estilos, array( 'multiple' => 'checkbox'));

    echo "<label class='items-header'>Inventario: </label>";

    echo $this->Form->input('Inventario.Disponibilidad',array('class'=>'input-medium items-input','type' => 'number','required','value'=>'1','min'=>'0','div'=>false,'label'=>false,'before'=>'<p>
       
        <div class="items-title">Stock Inicial: </div>
        <span class="field float">',
        'after'=>'</span></p>'));
		


    echo $this->Form->input('Inventario.IdDeposito',array('type'=>'select','options'=>$depositos,'empty'=>false,'class'=>'uniformselect items-select','div'=>false,'label'=>false,'before'=>'<span class="field categorias items-title">Deposito</span><span class="field float">','after'=>'</span>'));
//echo $this->Form->input('Inventario.IdUbicacion',array('type'=>'select','options'=>$ubicaciones,'empty'=>false,'class'=>'uniformselect','div'=>false,'label'=>false,'before'=>'<p><label>Ubicacion</label><span class="field">','after'=>'</span></p>'));
    echo $this->Form->input('Inventario.IdProyecto',array('type'=>'select','options'=>$proyectos,'empty'=>true,'class'=>'uniformselect items-select','div'=>false,'label'=>false,'before'=>'<span class="field categorias items-title">Proyecto</span><span class="field float">','after'=>'</span></p>'));


    ?>
 <p class="stdformbutton items-btn">
    <button class="btn btn-primary save">Guardar</button>
    <button type="reset" class="btn">Limpiar Formulario</button>
    <button class="btn btn-primary volver" type="button">Volver</button>
    <input type="checkbox" class="seguir" name="check2" > Guardar y Seguir
</p>


</div>

</div>
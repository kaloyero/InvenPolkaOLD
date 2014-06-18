
<style type="text/css">
.shadowed, .listfile li:hover, .widgeticons li a {
-webkit-box-shadow: none !important;
box-shadow: none !important;
border-bottom: 1px solid #9C9C9C;
}

.stdform span.field, .stdform div.field {
padding: 0px !important;}

.stdform label {
padding: 7px 0 0 3%;}

div.uploader span.action{
  background-image: url(../img/uniform/sprite.png) !important;}

.stdform div.uploader span.action {
color: #000 !important;}

.stdform label.error {
margin-left: 0;
padding: 0;
color: #F00;
width: 80px !important;}


</style>


<h4 class="widgettitle nomargin shadowed">Articulos<button class="volver glyphicon" style="float:right;" type="button" title="Volver atras"><img src="app/webroot/img/icon-back.png" alt="Volver atras" /></button></h4>
<div class="widgetcontent bordered shadowed nopadding">
    <?php
echo $this->Form->create('Articulo',array('type' => 'file','class' => 'stdform stdform2','inputDefaults' => array(
        'div' => array('class' => 'field')
    )));

?>
<div class="conteinerPrinc-1" style="height: 550px;">
<BR>
<?php
echo $this->Form->input('CodigoArticulo',array('class'=>'input-medium','div'=>false,'label'=>false,'before'=>'<p>
                                <label style="float: left;">Codigo Articulo</label>
                                <span class="field float">',
								'after'=>'</span>','pattern' => '.*\S+.*'));
?>
<BR>
<h2 class=" nomargin shadowed">Comentarios</h2>
<?php
echo $this->Form->input('Descripcion',array('type' => 'textarea','class'=>'span5','div'=>false,'label'=>false,'before'=>'
								                                <label style="float: left;">Comentarios</label>
								                                <span class="field float">',
																'after'=>'</span></p>','pattern' => '.*\S+.*'));

?>
<br>
<h2 class=" nomargin shadowed">Configuraciones</h2>
<?php
           echo $this->Form->input('Articulo.IdCategoria',array('type'=>'select','options'=>$categorias,'empty'=>false,'class'=>'uniformselect categoria','div'=>false,'label'=>false,'before'=>'<p><label> Categoria : </label><span class="field float"> ','after'=>'</span></p>'));

           echo $this->Form->input('Articulo.IdObjeto',array('type'=>'select','empty'=>false,'options'=>$objetos,'class'=>'uniformselect items-select','div'=>false,'label'=>false,'before'=>'<p><label> Objeto : </label><span class="field float"> ','after'=>'</span></p>'));

           echo $this->Form->input('Articulo.IdDecorado',array('type'=>'select','empty'=>false,'options'=>$decorados,'class'=>'uniformselect items-select','div'=>false,'label'=>false,'before'=>'<p>  <label class="field categorias items-title"> Decorado : </label><span class="field float">','after'=>'</span></p>'));
        
         echo $this->Form->input('Articulo.IdMaterial',array('type'=>'select','empty'=>false,'options'=>$materiales,'class'=>'uniformselect items-select','div'=>false,'label'=>false,'before'=>' <p> <label class="field categorias items-title"> Material : </label><span class="field float"> ','after'=>'</span></p>'));

         echo $this->Form->input('Articulo.IdDimension',array('type'=>'select','empty'=>false,'options'=>$dimensiones,'class'=>'uniformselect items-select','div'=>false,'label'=>false,'before'=>'<p> <label class="field categorias items-title">Dimension : </label><span class="field float">','after'=>'</span></p>'));

        echo $this->Form->input('Articulo.IdEstilo',array('type'=>'select','empty'=>false,'options'=>$estilos,'class'=>'uniformselect items-select','div'=>false,'label'=>false,'before'=>' <p><label class="field categorias items-title"> Estilo : </label><span class="field float">','after'=>'</span><p><p><label class ="errorConfiguration" style="display: block;color:red"></label></p><br/>'));
//echo $this->Form->select('field', $estilos, array( 'multiple' => 'checkbox'));

?>


</div>
<div class="conteinerPrinc-2">

          <h2 class=" nomargin shadowed">Subir foto</h2>
<?php
//Selector de imagen
echo $this->Form->input('idFoto', array('type' => 'file', 'accept' =>'image/*', 'label' => false,'class'=>'uniform-file','div'=>array('class'=>'field uploader focus')));
echo $this->Form->input('idFoto', array('type' => 'hidden','value' => ''),array('id' => 'preview'));
echo $this->Form->input('id', array('type' => 'hidden'));
?>
<p class="preview"><label></label><span id ="preview" class="field float" style="margin: 0 auto"><img class="preview" style="margin-left: 0px;width: 450px;height: 450px;background-color: #999;border: 1px solid #333;"/></span></p>
<?php
echo $this->Form->input('dir', array('type' => 'hidden','value' => ''));
echo "<label class='errorFoto' style='display: block;color:red'></label>";
?>

</div>



</div>

<div class="botonera widgettitle">
    <button class="btn btn-primary save" style="margin-left: 10px;">Guardar</button>
</div>



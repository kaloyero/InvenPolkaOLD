
<style type="text/css">
label {padding: 0px 0 0 0 !important;}
div.input {
        height: 180px !important; 
        width: 60% !important; 
        overflow-y:scroll; 
        margin: 0px 0 0px 25% !important;
        border: 1px solid #ccc; 
    	color:#333;
    	font-weight: bold;}

 .stdform input[type=checkbox], .stdform input[type=radio] {
    margin: 5px;
 }       

</style>


<h4 class="widgettitle nomargin shadowed">Materiales</h4>
<div class="widgetcontent bordered shadowed nopadding">

<?php
echo $this->Form->create('Materiale',array('class' => 'stdform stdform2','inputDefaults' => array('div' => array('class' => 'field'))));
?>

<div class="conteinerPrinc-1">
<?php
echo $this->Form->input('id',array('type'=>'hidden'));
echo $this->Form->input('Nombre',array('class'=>'input-medium','div'=>false,'label'=>false,'before'=>'<p><label>Nombre</label><span>','after'=>'</span></p>'));
?>
<br><br><br><br><br><br><br><br>
</div>


<div class="conteinerPrinc-2">

<p>
<label>Categorias</label>
 <div class="input">

<?php
foreach ($categorias as $categoria){ 
		$check = false;
		foreach ($categoriasSelected as $selected){ 
			if ($selected['material_categorias']['IdCategoria'] == $categoria['categorias']['id']){
				$check = true;
			}
		}
		if ($check){
?>
<input id="checkCat[<?php echo $categoria['categorias']['id']?>]" name="checkCat[<?php echo $categoria['categorias']['id']?>]"  checked type="checkbox" class='' style="opacity: 0;"><?php echo $categoria['categorias']['Nombre']?><br>
<?php 	} else { ?>
<input id="checkCat[<?php echo $categoria['categorias']['id']?>]" name="checkCat[<?php echo $categoria['categorias']['id']?>]"  type="checkbox" class='' style="opacity: 0;"><?php echo $categoria['categorias']['Nombre']?><br>
<?php 	}
} 
echo "</div>";
?>

</p>

</div>



</div>

<div class="botonera widgettitle">
   <p class="stdformbutton"><button class="btn btn-primary saveConfig" style="float:right;margin-right: 10px;">Guardar</button></p>
</div>
<?php
echo $this->Form->end();
?>




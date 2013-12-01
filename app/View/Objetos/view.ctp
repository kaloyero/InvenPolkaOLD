<?php
echo '<h4 class="widgettitle nomargin shadowed">Materiales</h4>';
echo '<div class="widgetcontent bordered shadowed nopadding">';
echo $this->Form->create('Objeto',array('class' => 'stdform stdform2','inputDefaults' => array('div' => array('class' => 'field'))));

echo $this->Form->input('Nombre',array('class'=>'input-medium','div'=>false,'label'=>false,'before'=>'<p>
								                                <label>Nombre</label>
								                                <span class="field">',
																'after'=>'</span></p>'));
echo "<label>Categorias</label>";
echo "<span class='field'>";


foreach ($categorias as $categoria){ 
		$check = false;
		foreach ($categoriasSelected as $selected){ 
			if ($selected['objeto_categorias']['IdCategoria'] == $categoria['categorias']['id']){
				$check = true;
			}
		}
		if ($check){
?>
<input id="checkCat[<?php echo $categoria['categorias']['id']?>]" checked type="checkbox" class='seguir' name="checkCat" style="opacity: 0;"><?php echo $categoria['categorias']['Nombre']?><br>
<?php 	} else { ?>
<input id="checkCat[<?php echo $categoria['categorias']['id']?>]" type="checkbox" class='seguir' name="checkCat" style="opacity: 0;"><?php echo $categoria['categorias']['Nombre']?><br>
<?php 	}
} 
echo "</span>";

echo '<p class="stdformbutton"><button class="btn btn-primary save">Guardar</button></p>';
echo $this->Form->end();
?>


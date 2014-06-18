<style type="text/css">
label {padding: 0px 0 0 0 !important;}
div.input {
        height: 180px !important; 
        width: 60% !important; 
        overflow-y:scroll; 
        margin: 0px 0 0px 25% !important;
        border: 1px solid #ccc; }

 .stdform input[type=checkbox], .stdform input[type=radio] {
    margin: 5px;
 }                      

</style>
<h4 class="widgettitle nomargin shadowed">Nuevo Material</h4>
<div class="">
<?php
echo $this->Form->create('Materiale',array('class' => 'stdform stdform2','inputDefaults' => array('div' => array('class' => 'field'))));
?>

<div class="conteinerPrinc-1">

<?php
echo $this->Form->input('Nombre',array('class'=>'input-medium','div'=>false,'label'=>false,'before'=>'<p><label style="display: inline-block; padding: 20px 0 0 45px; vertical-align: middle; text-align: left; font-weight: bold;">Nombre</label><span>','after'=>'</span></p>'));
?>
<br><br><br><br><br><br><br><br>
</div>
<div class="conteinerPrinc-2">

    <p>
        <label>Categorias</label>
        <span>
    <?php
    echo $this->Form->input('IdCategoria',array('type'=>'select','multiple' => 'checkbox','required' => 'true','options'=>$categorias,'empty'=>false,'class'=>'uniformselect','div'=>true,'label'=>false,'class'=>'select','before'=>' ','after'=>''));
    
    ?>
        </span>
    </p>
</div>
.
<div class="botonera widgettitle">
    <p style="margin-right: 10px;">
        <button class="btn btn-primary save" style="float:right;margin-left: 10px;">Guardar</button>
    </p>
</div>


</div>


.
<h4 class="widgettitle nomargin shadowed">Listado de Materiales</h4>

<table  id="configurationTable" class ="table table-bordered" width="100%"  style="width: 100%;">
        <thead>
                <tr>
                <th style="display:none;">Id</th>
                <th>Nombre</th>
                <th>Categorias</th>
                <th>Acciones</th>
            </tr>
         </thead>
        <tbody>
        </tbody>
</table>

<div class="botonera widgettitle">

</div>


<?php
echo $this->Form->end();
?>





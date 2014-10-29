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

.items{
    width: 90px;
}

.items2{
    width: 110px;
}

.tags{
    width: 250px;
}


</style>



<?php

echo $this->Form->create('Articulo',array('type' => 'file','class' => 'stdform stdform2','inputDefaults' => array(
        'div' => array('class' => 'field')
    )));
//echo $this->Form->create('Articulo', array('type' => 'file'));
//echo $this->Form->input('filename',array('type'=>'file'));

?>
<h4 class="widgettitle nomargin shadowed">Codigo Articulo: <?php echo $articulo['articulos_vista']['CodigoArticulo'] ?><button class="volver glyphicon" style="float:right;" type="button" title="Volver atras"><img src="app/webroot/img/icon-back.png" alt="Volver atras" /></button></h4>

<h2 class=" nomargin shadowed" style="margin:20px 10px;">Imagen</h2>
<label style="float: left;"></label>
<span class="field">

<img src="/InvenPolka/app/webroot/files/articulo/idFoto/<?php echo $articulo['articulos_vista']['dir'] ?>/<?php echo $articulo['articulos_vista']['idFoto'] ?>" alt="CakePHP" height="800px" width="800px">
</span>

<h2 class=" nomargin shadowed" style="margin:20px 10px;">Descripciones</h2>
<p>
    <label style="float: left;"></label>
            <table class="field float">
                <tr>
                    <td class="items"><b>• Categoria:</b></td>
                    <td class="tags"><?php echo $articulo['articulos_vista']['categoria'] ?></td>
                    <td class="items"><b>• Objeto:</b></td>
                    <td class="tags"><?php echo $articulo['articulos_vista']['objeto'] ?></td>
                </tr>
                <tr>
                    <td class="items"><b>• Decorado:</b></td>
                    <td class="tags"><?php echo $articulo['articulos_vista']['decorado'] ?></td>
                    <td class="items"><b>• Material:</b></td>
                    <td class="tags"><?php echo $articulo['articulos_vista']['material'] ?></td>
                </tr>
                <tr>
                    <td class="items"><b>• Tamaño:</b></td>
                    <td class="tags"><?php echo $articulo['articulos_vista']['dimension'] ?></td>
                    <td class="items"><b>• Estilo:</b></td>
                    <td class="tags"><?php echo $articulo['articulos_vista']['estilo'] ?></td>
                </tr>
            </table>


</p>

<h2 class=" nomargin shadowed" style="margin:20px 10px;">Comentarios</h2>
<p>
    <label style="float: left;"></label>
            <table class="field float">
                <tr>
                    <td class="items"><b>• Descripcion:</b></td>
                    <td width="650px"><?php echo $articulo['articulos_vista']['Descripcion'] ?></td>
                </tr>
            </table>    
</p>

<h2 class=" nomargin shadowed" style="margin:20px 10px;">Inventario</h2>
<p>
    <label style="float: left;"></label>
            <table class="field float">
                <tr>
                    <td class="items2"><b>• Stock Total:</b></td>
                    <td class="tags"><?php echo $articulo['articulos_vista']['stock_total'] ?></td>
                    <td class="items2"><b>• Stock Disponible:</b></td>
                    <td class="tags"><?php echo $articulo['articulos_vista']['stock_dispo'] ?></td>
                </tr>
            </table> 
</p>

<h2 class=" nomargin shadowed" style="margin:20px 10px;">Ubicacion del inventario</h2>

<p> 
    <label style="float: left;"></label>
         <table class="field float" style="margin-top:10px">
            <tr style="border-bottom: 1px solid #ccc;">
                <th align="left"><b>Ubicacion</b></th>
                <th><b>Cantidad</b></th>
                <th><b>Devolución Aproximada</b></th>
            </tr>
            <?php 
			               foreach ($inventario as $inv){
				 ?>
            <tr>
                <td align="left" width="150px"><?php echo $inv['pd']['proyecto'] ?></td>
                <td align="center"width="80px"><?php echo $inv['pdt']['cantidad'] ?></td>
                <td align="center"width="80px"><?php echo $inv['pd']['FechaDev'] ?></td>
            </tr>
            <?php } ?>

        </table>
</p>


</div>
<div class="botonera widgettitle">
</div>
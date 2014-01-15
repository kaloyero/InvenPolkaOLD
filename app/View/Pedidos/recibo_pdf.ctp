<?php
App::import('Vendor','xtcpdf');
$tcpdf = new XTCPDF();
$textfont = 'freesans'; // looks better, finer, and more condensed than 'dejavusans'

$tcpdf->SetAuthor("KBS Homes & Properties at http://kbs-properties.com");
$tcpdf->SetAutoPageBreak( false );
$tcpdf->setHeaderFont(array($textfont,'',40));
$tcpdf->xheadercolor = array(150,0,0);
$tcpdf->xheadertext = 'KBS Homes & Properties';
$tcpdf->xfootertext = 'Copyright Â© %d KBS Homes & Properties. All rights reserved.';

// add a page (required with recent versions of tcpdf)
$tcpdf->AddPage();

// Now you position and print your page content
// example:
$tcpdf->SetTextColor(0, 0, 0);
$tcpdf->SetFont($textfont,'B',20);
//$tcpdf->Cell(0,14, "Hello WorldAle", 0,1,'L');

//$lefthtml = '<b>Date: </b>HOY <img style="width:150px; height:150px;border-style:solid;border-width:3px;" src="http://localhost/InvenPolka/app/webroot/files/articulo/idFoto/94/small_Screen-shot-2011-11-11-at-7.55.07-PM.png" alt="CakePHP">';

//$tcpdf->Image('http://localhost/InvenPolka/app/webroot/files/articulo/idFoto/94/small_Screen-shot-2011-11-11-at-7.55.07-PM.png', '', '', 40, 40, '', '', 'T', false, 300, '', false, false, 1, false, false, false);

$lefthtml='<table ><tr>';
$articulos="";
$i=0;
	foreach ($detalles as $De){


$articulos.='<tr><td>'.$De['det']['Cantidad'].'</td><td>'.$De['art']['codigo'].'</td><td>'.$De['art']['codigo'].'</td><td>???</td></tr>';


}







$lefthtml.='</tr>';
$lefthtml.='</table>';
$testHtml='
				<table  cellpadding="1" cellspacing="1" style="width: 550px;">
					<tbody>
						<tr>
							<td>
								<span style="font-size:26px;"><strong>Pol-ka &nbsp; &nbsp;</strong></span></td>
							<td>
								<span style="font-size:26px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Traslado de Materiales</span></td>
						</tr>
						<tr>
							<td>
								<strong>Producciones</strong></td>
							<td>
								&nbsp; &nbsp; &nbsp; &nbsp;  O.S.N LOG /N 333333333</td>
						</tr>
						<tr>
							<td>
								Depto de Logistica</td>
							<td>
								&nbsp; &nbsp; &nbsp; &nbsp; Fecha :</td>
						</tr>
						<tr>
							<td>
								<strong>de Polka Producciones S.A</strong></td>
							<td>
								&nbsp; &nbsp; &nbsp; &nbsp; Cuit : &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Ing Brutos Conv Mult:11111111111</td>
						</tr>
						<tr>
							<td>
								Jorge Newbery 3039</td>
							<td>
								&nbsp; &nbsp; &nbsp; &nbsp; Inicio de Act : 01/01/1981 Inscrip Confer N0</td>
						</tr>
						<tr>
							<td>
								(C1426CYE) Capital Federal</td>
							<td>
								&nbsp;</td>
						</tr>
						<tr>
							<td>
								Tel/Fax 4566766676</td>
							<td>
								&nbsp;</td>
						</tr>
						<tr>
							<td>
								Iva Responsable Inscripto</td>
							<td>
								&nbsp;</td>
						</tr>
					</tbody>
				</table>
				<br><table  cellpadding="1" cellspacing="1" style="line-height: 10px;width: 550px;">
					<tbody><tr >
						<td>
						</td>

					</tr></tbody>
				</table>


				<table  class="prueba" border ="1" cellpadding="1" cellspacing="1" style="line-height: 10px;width: 550px;">
					<tbody>
						<tr >
							<td>
								Solcitia : &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
							<td>
								&nbsp;Responsable: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</td>
							<td>
								Sector: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</td>
						</tr>
						<tr>
							<td>
								Traslado Desde : &nbsp;(Lugar) &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
							<td>
								&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</td>
							<td>
								Hora Citado: &nbsp; &nbsp; &nbsp;</td>
						</tr>
						<tr>
							<td>
								&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; (Direccion) &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</td>
							<td>
								&nbsp;</td>
							<td>
								Hora Salida:</td>
						</tr>
						<tr>
							<td >
								&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Contacto Sr/Sra</td>
							<td>
								&nbsp;</td>
							<td>
								Hora Llegada:</td>
						</tr>
						<tr>
							<td>
								&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Hasta : &nbsp; (Lugar)</td>
							<td>
								&nbsp;</td>
							<td>
								Hora Finalizacion:&nbsp;<br />
								&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
						</tr>
						<tr>
							<td>
								&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; (Direccion)</td>
							<td>
								&nbsp;</td>
							<td>
								&nbsp;</td>
						</tr>
						<tr>
							<td>
								&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Contacto Sr/Sra</td>
							<td>
								&nbsp;</td>
							<td>
								&nbsp;</td>
						</tr>
					</tbody>
				</table>
				<table  cellpadding="1" cellspacing="1" style="line-height: 10px;width: 550px;">
					<tbody><tr >
						<td>
						</td>

					</tr></tbody>
				</table>
						<table  class="listado" border ="1" cellpadding="1" cellspacing="1" style="line-height: 10px;width: 550px;">
							<tbody>
								<tr >
									<th>
									Cantidad
									</th>
									<th>
									Descripcion
									</th>
									<th>
									Codigo
									</th>
									<th>
									Estado
								  </th>
								</tr>
								</tbody>
							</table>
								<table  class="listado" border ="0.5" cellpadding="1" cellspacing="1" style="line-height: 10px;width: 550px;">'.$articulos.'

							</tbody>
						</table>
						<table  cellpadding="1" cellspacing="1" style="line-height: 10px;width: 550px;">
							<tbody><tr >
								<td>
								</td>

							</tr></tbody>
</table>

							<table  class ="prueba" cellpadding="1" cellspacing="1" style="line-height: 10px;width: 500px;">
								<tbody><tr >
									<td>
									Firma Solicitante:
									</td>
										<td>
									____________
									</td>
											<td>
									Aclaracion:
											</td>
												<td>
									____________
												</td>
								</tr></tbody>
</table>
				<table  cellpadding="1" cellspacing="1" style="line-height: 10px;width: 550px;">
					<tbody><tr >
						<td>
						</td>

					</tr></tbody>
</table>
	<table  cellpadding="1" cellspacing="1" style="line-height: 10px;width: 250px;">

</table>
<table border ="1">
     <tr>
       <td>
         <table id="table1">
           			<tbody>


					<tr>
						<td>
						&nbsp;
						</td>
							<td>
							&nbsp;
						</td>
					</tr>

<tr>
						<td>
						Firma Autorizante:
						</td>
							<td>
							____________
						</td>
					</tr>
					<tr >
						<td>
						Aclaracion:
						</td>
							<td>
						____________
						</td>
					</tr>
					<tr>
						<td>
						&nbsp;
						</td>
							<td>
							&nbsp;
						</td>
					</tr>
					<tr >
						<td>
						Entrego(En Origen):
						</td>
							<td>
						____________
						</td>
					</tr>
					<tr>
						<td>
						&nbsp;
						</td>
							<td>
							&nbsp;
						</td>
					</tr>
					<tr >
						<td>
						Recibio(En Destino):
						</td>
							<td>
						____________
						</td>
					</tr></tbody>
         </table>
       </td>
       <td>
         <table id="table2">
           <tr>
             <td><strong>Depto de Logista :</strong></td><td></td>
           </tr>
		<tr>
             <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Transporte</td> <td></td>
           </tr>
		<tr>
             <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Propio</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; De Terceros</td>
           </tr>
			<tr>
             <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td><td></td>
           </tr>
		<tr>
             <td>Vechiculo ________</td><td>Vechiculo ________</td>
           </tr>
		<tr>
             <td>Patente &nbsp;&nbsp;&nbsp; ________</td><td>Patente  &nbsp;&nbsp;&nbsp;________</td>
           </tr>
		<tr>
             <td>Chofer &nbsp;&nbsp;&nbsp;  ________</td><td>Chofer  &nbsp;&nbsp;&nbsp;________</td>
           </tr>
		<tr>
             <td>Firma &nbsp; &nbsp;&nbsp;&nbsp; ________</td><td>Firma &nbsp; &nbsp;&nbsp;&nbsp;________</td>
           </tr>
			<tr>
             <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td><td></td>
           </tr>
			<tr>
	             <td>Encargado:  __________________</td><td></td>
	           </tr>
			<tr>
             <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td><td></td>
           </tr>
			<tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td><td></td>
          </tr>
         </table>

       </td>

     </tr>
   </table>		   <table id="table3">
	           <tr>
	             <td> Devolucion por O.de S N Log / Blanco = Logistica chofer / Rosa Usuario / Amarillo Seguridad / Verde Archivo</td>
	           </tr>
				</table>
								';


$html = <<<EOF
	<style>



table.prueba td {
	border: 0px solid white;
}
</style>
<!-- EXAMPLE OF CSS STYLE -->

<body>
<br>
$testHtml
</body>
EOF;

$tcpdf->SetY(0);
$tcpdf->SetTextColor(0, 0, 0);
$tcpdf->SetFont('times', '', 12);
$tcpdf->writeHTML($html, true, false, true, false, '');


//$tcpdf->writeHTMLCell(0, '', '', '', $lefthtml, 0, 0, false, true, 'L');



// ...
// etc.
// see the TCPDF examples
echo $tcpdf->Output('ReciboTest.pdf', 'FD');

?>
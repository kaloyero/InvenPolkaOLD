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



// Now you position and print your page content
// example:
$tcpdf->SetTextColor(0, 0, 0);
$tcpdf->SetFont($textfont,'B',20);
//$tcpdf->Cell(0,14, "Hello WorldAle", 0,1,'L');

//$lefthtml = '<b>Date: </b>HOY <img style="width:150px; height:150px;border-style:solid;border-width:3px;" src="http://localhost/InvenPolka/app/webroot/files/articulo/idFoto/94/small_Screen-shot-2011-11-11-at-7.55.07-PM.png" alt="CakePHP">';

//$tcpdf->Image('http://localhost/InvenPolka/app/webroot/files/articulo/idFoto/94/small_Screen-shot-2011-11-11-at-7.55.07-PM.png', '', '', 40, 40, '', '', 'T', false, 300, '', false, false, 1, false, false, false);


$articulos="";
$i=0;
$cantidadRecibos=0;
$totalElementos=count($detalles);


$lastElement = end($detalles);
	foreach ($detalles as $De){

   if ($De['det']['Cantidad']!=0){
	$articulos.='<tr><td>'.$De['det']['Cantidad'].'</td><td>'.$De['art']['Descripcion'].'</td><td>'.$De['art']['codigo'].'</td><td></td></tr>';
	 $i=$i+1;
}


	if ($i==15 || $De==$lastElement){

      if ($i!=15){
		$faltantes=15-$i;
		for ($i = 1; $i <= $faltantes; $i++) {
		    $articulos.='<tr><td></td><td></td><td></td><td></td></tr>';
		}

	}
		// add a page (required with recent versions of tcpdf)
		$tcpdf->AddPage();


		$cantidadRecibos=$cantidadRecibos+1;
		$i=0;

$testHtml='
				<table  cellpadding="1" cellspacing="1" style="width: 550px;">
					<tbody>
						<tr>
							<td>
								<span style="font-size:26px;"><strong>Pol-ka &nbsp; &nbsp;</strong></span>
							</td>
							<td>
								<span style="font-size:26px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Traslado de Materiales</span>
							</td>
						</tr>
						<tr>
							<td>
								<strong>Depto de Arte</strong>
							</td>
							<td>
								&nbsp;
							</td>
						</tr>
						<tr>
							<td>
								<strong>de Polka Producciones S.A</strong>
							</td>
							<td>
								&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; O.S.N LOG /N° &nbsp;'.$pedidoId.'
							</td>
						</tr>
						<tr>
							<td>
								<span style="font-size:9px;">Jorge Newbery 3039</span>
							</td>
							<td>
								&nbsp;
							</td>
						</tr>
						<tr>
							<td>
								<span style="font-size:9px;">(C1426CYE) Capital Federal</span></td>
							<td>
								&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; Fecha : ..../..../........
							</td>
						</tr>
						<tr>
							<td>
								<span style="font-size:9px;">Tel/Fax 4555-9137</span></td>
							<td>
								&nbsp;
							</td>
						</tr>
						<tr>
							<td>
								<span style="font-size:9px;">IVA RESPONSABLE INSCRIPTO</span></td>
							<td>
								<span style="font-size:7px;">
									C.U.I.T. : 30-67822531-9 &nbsp;&nbsp; ING BRUTOS CONV MULT: 901-905077-6
								<br>
									&nbsp;INICIO DE ACT : 01/12/1994 &nbsp;&nbsp; INSCRIP CONFER N° 011729
								</span>
							</td>
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
								Solcita : .............................................</td>
							<td>
								&nbsp;Responsable: ....................................</td>
							<td>
								Sector: ...........................................</td>
						</tr>
						<tr>
							<td>
								Traslado Desde : (Lugar) ..................
							</td>
							<td>
								...........................................................
							</td>
							<td>
								Hora Citado: .................................</td>
						</tr>
						<tr>
							<td>
								&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; (Direccion) ............</td>
							<td>
								...........................................................</td>
							<td>
								Hora Salida:...................................</td>
						</tr>
						<tr>
							<td >
								&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Contacto Sr/Sra .....</td>
							<td>
								...........................................................</td>
							<td>
								Hora Llegada:................................</td>
						</tr>
						<tr>
							<td>
								&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Hasta : &nbsp; (Lugar) ..................</td>
							<td>
								...........................................................</td>
							<td>
								Hora Finalizacion:.........................
							</td>
						</tr>
						<tr>
							<td>
								&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; (Direccion) ............</td>
							<td>
								...........................................................</td>
							<td>
								&nbsp;</td>
						</tr>
						<tr>
							<td>
								&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Contacto Sr/Sra ....</td>
							<td>
								...........................................................</td>
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
									Estado / Obs.
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
	             <td> <span style="font-size:9px;">Devolucion por O.de S N Log / Blanco = Logistica chofer / Rosa = Usuario / Amarillo = Seguridad / Verde = Archivo</span></td>
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

$tcpdf->SetY(10);
$tcpdf->SetTextColor(0, 0, 0);
$tcpdf->SetFont('times', '', 12);
$tcpdf->writeHTML($html, true, false, true, false, '');


//$tcpdf->writeHTMLCell(0, '', '', '', $lefthtml, 0, 0, false, true, 'L');



// ...
// etc.
// see the TCPDF examples
 $nombreRecibo='Remito_'.$pedidoId.'.pdf';
//$nombreRecibo2='ReciboA'.$pedidoId.'.pdf';
//$tcpdf->Output($nombreRecibo2, 'F');
$articulos="";


	}
}

$tcpdf->Output("/files/remitos/".$nombreRecibo, 'F');






?>
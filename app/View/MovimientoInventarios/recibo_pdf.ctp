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

$lefthtml='<table  cellpadding="1" cellspacing="1" style="line-height: 10px;width: 550px;"><tbody><tr>';
$fila=0;
$col=0;
$page=1;
//Cuantas columnas de articulos por pagina
$tope=6;
$listaArtis= array();

foreach ($detalles as $De){

	$fila=$fila+1;

	if ($fila==6 ) {
			$col= $col + 1;
			
			$fila=1;
			if ($col == $tope){
				$lefthtml.="</tr></tbody></table>";
				$listaArtis[$page]= $lefthtml;
				$lefthtml='<table  cellpadding="1" cellspacing="1" style="line-height: 10px;width: 550px;"><tbody><tr>';
				$col = 0;
				$page = $page + 1;
				//En las proximas paginas vana entrar 7 columnas
				$tope=7;
			} else {
				$lefthtml.="</tr><tr>";
				$fila=1;
			
			}
	}

	$lefthtml.='<td width="100" align="center"><img style="width:80px; height:80px;border-style:solid;border-width:0px;" src="/InvenPolka/app/webroot/files/articulo/idFoto/'.$De["det"]["IdArticulo"].'/small_'.$De["art"]["idFoto"].'"><br>'.$De['art']['codigo'].'<br>Cantidad: '.$De['det']['Cantidad'].'</td>';

}

$lefthtml.='</tr>';
$lefthtml.='</tbody></table>';
$listaArtis[$page]= $lefthtml;

$tcpdf->AddPage();


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
								&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; PEDIDO N° &nbsp;'.$pedidoId.'
							</td>
						</tr>
						<tr>
							<td>
								<span style="font-size:9px;"><b>Fecha Despacho: </b>'.$pedido['Fecha'].'</span>
							</td>
							<td>
								<span style="font-size:9px;"><b>Fecha Solicitud: </b>'.$movi['Fecha'].'</span>
							</td>
						</tr>
						<tr>
							<td>
								<span style="font-size:9px;"><b>Deposito: </b>'.$movi['DepoOrig'].'</span>
							</td>
							<td>
								<span style="font-size:9px;"><b>Proyecto: </b>'.$movi['proyecto'].'</span>
							</td>
						</tr>
						<tr>
							<td>
								<span style="font-size:9px;"><b>Entrega: </b>'.$pedido['username'].' ('.$pedido['Nombre'].' '.$pedido['Apellido'].')</span>
							</td>
							<td>
								<span style="font-size:9px;"><b>Solicita: </b>'.$movi['username'].' ('.$movi['Nombre'].' '.$movi['Apellido'].')</span>
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

				<br>
				'.$listaArtis[1].'
				
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

//Separo en paginas
for ($i = 2; $i < $page+1; $i++){
	// add a page (required with recent versions of tcpdf)
	$tcpdf->AddPage();
$html = <<<EOF
<body>
$listaArtis[$i]
</body>
EOF;
	$tcpdf->writeHTML($html, true, false, true, false, '');
}


$nombreRecibo='Remito_'.$pedidoId.'.pdf';

$tcpdf->Output("files/remitos/".$nombreRecibo, 'F');

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

$articulos="";

/*
$fila = '<td></td><td></td><td></td><td></td><td></td>';
$listaArt = '<tr>';
	$c = 0;
	foreach ($detalles as $De){
		
		if ($c == 5){
			$listaArt.= '</tr><tr>';
			$fila = '<td></td><td></td><td></td><td></td>';
			$art = '<td>'.$De['art']['codigo'].'</td>';
			$listaArt.= $art;
			$c = 1;			
		} else {
			$art = '<td>'.$De['art']['codigo'].'</td>';
			//descuento uno para la fila final
	        $fila = substr_replace( $fila, "", -9 );
			$listaArt.= $art;
		}
		$c++;	
	}	
	
	$listaArt.=$fila.'<tr>';
*/

$testHtml='
				<table  cellpadding="1" cellspacing="1" style="width: 550px;">
					<tbody>
						<tr>
							<td>
								<span style="font-size:26px;"><strong>Pol-ka &nbsp; &nbsp;</strong></span>
							</td>
							<td>
								<span style="font-size:26px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  PEDIDO N° &nbsp;'.$pedidoId.'</span>
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
								&nbsp;
							</td>
						</tr>
						<tr>
							<td>
								<span style="font-size:9px;"><b>Fecha de Pedido:</b> '.$pedido['Fecha'].'</span>
							</td>
							<td>
								<span style="font-size:9px;"><b>Fecha Despacho:</b> '.$movi['Fecha'].'</span>
							</td>
						</tr>
						<tr>
							<td>
								<span style="font-size:9px;"><b>Proyecto:</b> '.$pedido['proyecto'].'</span>
							</td>
							<td>
								<span style="font-size:9px;"><b>Deposito:</b> '.$movi['DepoOrig'].'</span>
							</td>
						</tr>
						<tr>
							<td>
								<span style="font-size:9px;"><b>Solicita:</b> '.$pedido['Nombre'].' '.$pedido['Apellido'].' ('.$pedido['username'].')</span>
							</td>
							<td>
								<span style="font-size:9px;"><b>Despachante:</b> '.$movi['Nombre'].' '.$movi['Apellido'].' ('.$movi['username'].')</span>
							</td>
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
					
					<tr>
				
				
					<tr>


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


$nombreRecibo='Remito_'.$pedidoId.'.pdf';

$tcpdf->Output("files\\remitos\\".$nombreRecibo, 'F');






?>
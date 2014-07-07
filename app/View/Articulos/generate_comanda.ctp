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
$tcpdf->SetFont($textfont,'B',10);
//$tcpdf->Cell(0,14, "Hello WorldAle", 0,1,'L');

//$lefthtml = '<b>Date: </b>HOY <img style="width:150px; height:150px;border-style:solid;border-width:3px;" src="http://localhost/InvenPolka/app/webroot/files/articulo/idFoto/94/small_Screen-shot-2011-11-11-at-7.55.07-PM.png" alt="CakePHP">';

//$tcpdf->Image('http://localhost/InvenPolka/app/webroot/files/articulo/idFoto/94/small_Screen-shot-2011-11-11-at-7.55.07-PM.png', '', '', 40, 40, '', '', 'T', false, 300, '', false, false, 1, false, false, false);


$encabezado = "	<table><tr><td><u>Proyecto:</u> ".$pedido['proyecto']." </td><td><u>Fecha de Emisión:</u> ".$pedido['Fecha']." </td><td><u>Estado:</u> ".$pedido['estado']."  </td></tr><tr><td colspan ='3'><u>Descripción:</u> ".$pedido['Descripcion']."</td></tr><table> <br>";

$lefthtml='<table ><tr>';
$fila=0;
$col=0;
$page=1;
$listaArtis= array();
$tope=6;

foreach ($detalles as $De){

	$fila=$fila+1;

	if ($fila==6 ) {
			$col= $col + 1;
			
			$fila=1;
			if ($col == $tope){
				$lefthtml.="</tr></table>";
				$listaArtis[$page]= $lefthtml;
				$lefthtml='<table ><tr>';
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
$lefthtml.='</table>';
$listaArtis[$page]= $lefthtml;
$html = <<<EOF

<!-- EXAMPLE OF CSS STYLE -->
<style>
  h1 {
    color: navy;
    font-family: times;
    font-size: 14pt;
    text-decoration: underline;
  }
  h2 {
    color: navy;
    font-family: times;
    font-size: 10pt;
  }
  p {
    color: blue;
        margin-top: 0px;
        margin-bottom: 0px;
    font-family: helvetica;
    font-size: 10pt;
  }
  c {
    color: black;
    margin-top: 0px;
    margin-bottom: 0px;
    font-family: helvetica;
    font-size: 10pt;
  }
  
</style>
<body>
<h1>Listado de Articulos del pedido $pedidoId</h1>
<h2>$encabezado</h2>

$listaArtis[1]
</body>
EOF;

$tcpdf->SetY(0);
$tcpdf->SetTextColor(0, 0, 0);
$tcpdf->SetFont('times', '', 10);
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
	
// ...
// etc.
// see the TCPDF examples

//echo $tcpdf->Output('C:\\invoices\filename.pdf', 'I');
$nombreComanda='Comanda_'.$pedidoId.'.pdf';
echo $tcpdf->Output($nombreComanda, 'D');

?>
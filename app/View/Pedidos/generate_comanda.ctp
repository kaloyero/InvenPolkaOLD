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


$encabezado = "	Proyeco: <c>".$pedido['proyecto']."</c>
			   	Fecha de Emisión: <c>".$pedido['Fecha']."</c>
			   	Estado: <c>".$pedido['estado']."</c>
				Descripción: <c>".$pedido['Descripcion']."</c>";

$lefthtml='<table ><tr>';
$i=0;
        foreach ($detalles as $De){

$i=$i+1;

if ($i==6 ) {
        $lefthtml.="</tr><tr>";
        $i=1;
}

$lefthtml.='<td width="100"><img style="width:80px; height:80px;border-style:solid;border-width:0px;" src="/InvenPolka/app/webroot/files/articulo/idFoto/'.$De["det"]["IdArticulo"].'/small_'.$De["art"]["idFoto"].'"><p align="center">'.$De['art']['codigo'].'</p><span align="center">Cantidad: '.$De['det']['Cantidad'].'</p></td>';


}

$lefthtml.='</tr>';
$lefthtml.='</table>';
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
<h1>Listado de Articulos del pedido $pedidoId</i></h1>
<h2>$encabezado</h2>

<p>      </p>
<br>
$lefthtml
</body>
EOF;

$tcpdf->SetY(0);
$tcpdf->SetTextColor(0, 0, 0);
$tcpdf->SetFont('times', '', 10);
$tcpdf->writeHTML($html, true, false, true, false, '');


//$tcpdf->writeHTMLCell(0, '', '', '', $lefthtml, 0, 0, false, true, 'L');



// ...
// etc.
// see the TCPDF examples

//echo $tcpdf->Output('C:\\invoices\filename.pdf', 'I');
$nombreComanda='Comanda_'.$pedidoId.'.pdf';
echo $tcpdf->Output($nombreComanda, 'D');

?>
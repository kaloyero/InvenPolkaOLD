<?php
App::import('Vendor','xtcpdf');
$tcpdf = new XTCPDF();
$textfont = 'freesans'; // looks better, finer, and more condensed than 'dejavusans'

$tcpdf->SetAuthor("KBS Homes & Properties at http://kbs-properties.com");
$tcpdf->SetAutoPageBreak( false );
$tcpdf->setHeaderFont(array($textfont,'',40));
$tcpdf->xheadercolor = array(150,0,0);
$tcpdf->xheadertext = 'KBS Homes & Properties';
$tcpdf->xfootertext = 'Copyright å© %d KBS Homes & Properties. All rights reserved.';

// add a page (required with recent versions of tcpdf)
$tcpdf->AddPage();

// Now you position and print your page content
// example:
$tcpdf->SetTextColor(0, 0, 0);
$tcpdf->SetFont($textfont,'B',20);
$lefthtml='<table ><tr>';
$i=0;
        foreach ($detalles as $De){

$i=$i+1;

if ($i==6 ) {
        $lefthtml.="</tr><tr>";
        $i=1;
}

$lefthtml.='<td width="100"><img style="width:80px; height:80px;border-style:solid;border-width:3px;" src="/InvenPolka/app/webroot/files/articulo/idFoto/'.$De["det"]["IdArticulo"].'/small_'.$De["art"]["idFoto"].'"><p align="center">'.$De['art']['codigo'].'</p><span align="center">'.$De['det']['Cantidad'].'    .....</p></td>';


}

$lefthtml.='</tr>';
$lefthtml.='</table>';

$html = <<<EOF

<!-- EXAMPLE OF CSS STYLE -->
<style>
  h1 {
    color: navy;
    font-family: times;
    font-size: 24pt;
    text-decoration: underline;
  }
  p {
    color: blue;
        margin-top: 0px;
        margin-bottom: 0px;
    font-family: helvetica;
    font-size: 10pt;
  }
</style>
<body>
<h1>Listado de pedido</i></h1>
<p>      </p>
<br>
$lefthtml
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

//echo $tcpdf->Output('C:\\invoices\filename.pdf', 'I');
echo $tcpdf->Output('Comanda.pdf', 'D');

?>
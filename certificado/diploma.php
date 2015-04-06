<?php
require_once('./tcpdf/tcpdf.php');
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->setFontSubsetting(false);
$pdf->SetFont('helvetica', '', 10, '', false);
$pdf->AddPage();
// set certificate file
$certificate = 'file://tcpdf.crt';
// set additional information
$info = array(
    'Name' => 'TCPDF',
    'Location' => 'UPO',
    'Reason' => 'Test TCPDF',
    'ContactInfo' => 'http://www.tcpdf.org',
    );
$pdf->setSignature($certificate, $certificate, 'tcpdfdemo', '', 2, $info);
$text = 'Este es un <b color="#FF0000">documento firmado</b> mediante el certificado<b>tcpdf.crt</b>';
$pdf->writeHTML($text, true, 0, true, 0);
$pdf->Output('nombre.pdf', 'D');
?>
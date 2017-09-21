<?php
require 'vendor/autoload.php';	

//use Spipu\Html2Pdf\Html2Pdf;
try {
    ob_start();
    include_once 'report/alat_rusak.php';
    $content = ob_get_clean();
	$html2pdf = new HTML2PDF('P','A4','en');
	$html2pdf->writeHTML($content);
	$html2pdf->output('report_alat_rusak.pdf');
} catch (Html2PdfException $e) {
    $formatter = new ExceptionFormatter($e);
    echo $formatter->getHtmlMessage();
}

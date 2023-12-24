<?php 

require 'vendor/autoload.php';

// reference the Dompdf namespace

use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf(['enable_remote'=>true]);
$dados ="<img src='http://localhost/soft/imagens/insignia.jpg' alt='foto'>";
$dompdf->loadHtml($dados);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
  $dompdf->stream();     
 
 ?>

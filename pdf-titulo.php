<?php
session_start();
if (!isset($_SESSION['id_admin']) && !isset($_SESSION['id_comum'])) {
    header('location: login.php');
}

 include 'Classes/Gabinete.php';
 $p=new Gabinete();

if(isset($_GET['id_empresa'])){
   $id=addslashes($_GET['id_empresa']);
   $empresa=$p->buscar_Uma_empresa($id);
   $nome=$empresa['nome'];
   $data=$empresa['ano'];
   $titulo=$empresa['numero_cadastro'];
   $categoria=$empresa['categoria'];
}

require './vendor/autoload.php';


$dados ="<!DOCTYPE html>";
$dados .="<html lang='en'>";
$dados .="<head>";
$dados .="<meta charset='UTF-8'>";
$dados .="<meta http-equiv='X-UA-Compatible' content='IE=edge'>";
$dados .=" <meta name='viewport' content='width=device-width, initial-scale=1.0'>";
$dados .="<title>titulo de cadastro</title>";
$dados .="<link rel='stylesheet' href='http://localhost/soft/Css/titulo.css'>";
$dados .="<link rel='stylesheet' href='http://localhost/soft/Css/assets/fontawesome/css/all.min.css'>";
$dados .="</head>";
$dados .="<body>";
$dados .="<div class='titulo-cadastro'>";
$dados .="<div class='insignia'>";
$dados .="<img src='http://localhost/soft/imagens/insignia.jpg' alt='insignia'>";
$dados .="</div>";
$dados .="<h2>REPÚBLICA DE ANGOLA</h2>";
$dados .="<h2>GOVERNO DA PROVÍNCIA DO BIÉ</h2>";
$dados .="<h5>Gabinete Provincial de Infraestruturas e Serviços Técnicos</h5>";
$dados .="<div class='carimbo'>";
$dados .="<h3>VISTO</h3>";
$dados .="<span>A DIRETORA</span>";
$dados .="</div>";
$dados .="<h1>TÍTULO DE CADASTRAMENTO</h1>";
$dados .="<div class='paragrafo'>";
$dados .="<p>
O Gabinete Provincial de Infraestruturas e Serviços Técnicos vem por intermédio deste informar
que a empresa <span>".$nome."</span> está registada sob o nº <span>".$titulo."</span>
e que a mesma poderrá concorrer a qualquer conurso de adjucação de empreitada de obras públicas na província
do Bié no domínio da <span>".$categoria."</span> correspondente a <strong>7ª classe</strong> da tabela 
de valores previsto no Decreto nº 9/17 de 11 de janeiro.
</p>";
$dados .="<h3>Cuito, aos <strong>".$data."</strong></h3>";
$dados .="</div>";
$dados .="<h3><strong>O chefe de departamento de Obras Públicas</strong></h3>";
$dados .="<h3>-Engº Rufino Sambingo Sunguhanga-</h3>";
$dados .="<h3><strong>OBS:</strong> O Título é válido mediamte a validade do alvará.</h3>";
$dados .="</div>";
$dados .="</body>";
$dados .="</html>";

// reference the Dompdf namespace

use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf(['enable_remote'=>true]);

$dompdf->loadHtml($dados);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream();   

?>    
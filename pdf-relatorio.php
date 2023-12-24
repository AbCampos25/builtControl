<?php
session_start();
if (!isset($_SESSION['id_admin']) && !isset($_SESSION['id_comum'])) {
    header('location: login.php');
}

 include 'Classes/Gabinete.php';
 $p=new Gabinete();

 if(isset($_GET['id_relatorio']) && isset($_GET['id_obra'])){
    $id_obra=addslashes($_GET['id_obra']);
    $id_relatorio= addslashes($_GET['id_relatorio']);
    $obra=$p->buscar_Uma_obra($id_obra);
    $relatorio=$p->buscar_Um_relatorio($id_relatorio);
        $id_fiscal= $obra['fk_fiscalizacao_id'];
        $id_const= $obra['fk_costrucao_id'];
        $fiscal=$p->buscar_Uma_empresa($id_fiscal);
        $construtor=$p->buscar_Uma_empresa($id_const);
 }


require './vendor/autoload.php';


$dados ="<!DOCTYPE html>";
$dados .="<html lang='en'>";
$dados .="<head>";
$dados .="<meta charset='UTF-8'>";
$dados .="<meta http-equiv='X-UA-Compatible' content='IE=edge'>";
$dados .=" <meta name='viewport' content='width=device-width, initial-scale=1.0'>";
$dados .="<title>".$relatorio['nome']."</title>";
$dados .="<link rel='stylesheet' href='http://localhost/soft/Css/relatorio.css'>";
$dados .="<link rel='stylesheet' href='http://localhost/soft/Css/assets/fontawesome/css/all.min.css'>";
$dados .="</head>";
$dados .="<body>";
$dados .="<h4 style='width: 800px; margin: 0 auto; font-size:14pt;'>".$relatorio['nome']."</h4>";
$dados .="<h1>".$obra['nome']."</h1>";
$dados .=" <div class='detalhes-obra'>";
$dados .="<h2>EMPREITEIRO: <span>".$construtor['nome']."</span></h2>";
$dados .="<h2>FISCAL: <span>".$fiscal['nome']."</span></h2>";
$dados .="<h2>ORÇAMENTO: <span>".$obra['orcamento']." AO </span></h2>";
$dados .="</div> ";
$dados .="<div class='imagens-obra'>";

$foto_obra=$p->buscar_Relatorio_imagens($id_relatorio);
foreach ($foto_obra as $foto) {
    $dados .="<div class='imagem'>";
    $dados .="<img src='http://localhost/soft/imagens/";
    $dados.=$foto['nome']."'";
    $dados.=" alt='foto'>";
    $dados .="</div>"; 

}
$dados .="</div> ";
$dados .="<div class='detalhes-obra'>";
$dados .="<h2>Execução Financeira: <span>".$relatorio['exec_financeira']."%</span></h2>";
$dados .="<h2>Execução Física: <span>".$relatorio['exec_fisica']."%</span></h2>";
$dados .="</div>";

$pontos_de_situacao=explode(';', $relatorio['ponto_situacao']);
$recomendacoes=explode(';', $relatorio['recomendacoes']);
$irregularidades=explode(';', $relatorio['irregularidades']);

$dados .="<div class='pontos'>";
$dados .="<h2>Pontos de Situação</h2>";

foreach ($pontos_de_situacao as $ponto) {
    
    $dados .="<h4>-".$ponto.";</h4>";
      
}
$dados .="</div>";
$dados .="<div class='pontos'>";
$dados .="<h2>Irregularidades</h2>";

foreach ($irregularidades as $irregularidade) {
    
    $dados .="<h4>-".$irregularidade.";</h4>";
      
}
$dados .="</div>";
$dados .="<div class='pontos'>";
$dados .="<h2>Recomendações</h2>";

foreach ($recomendacoes as $recomend) {
    
    $dados .="<h4>-".$recomend.";</h4>";
      
}
$dados .="</div>";
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
    
    


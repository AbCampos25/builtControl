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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>titulo de cadastro</title>
    <link rel="stylesheet" href="Css/titulo.css">
    <link rel="stylesheet" href="Css/assets/fontawesome/css/all.min.css">
</head>
<body>
    <a href="pdf-titulo.php?id_empresa=<?=  $id ?>">Gerar pdf  <i class="fa fa-download"></i></a>
    <div class="titulo-cadastro">
        <div class="insignia">
            <img src="imagens/insignia.jpg" alt="">
        </div>
        <h2>REPÚBLICA DE ANGOLA</h2>
        <h2>GOVERNO DA PROVÍNCIA DO BIÉ</h2>
        <h5>Gabinete Provincial de Infraestruturas e Serviços Técnicos</h5>
        <div class="carimbo">
            <h3>
                VISTO
            </h3>
            <span>
                A DIRETORA
            </span>
        </div>
        <h1>
            TÍTULO DE CADASTRAMENTO
        </h1>

        <div class="paragrafo">
            <p>
                O Gabinete Provincial de Infraestruturas e Serviços Técnicos vem por intermédio deste informar
                que a empresa <span><?=  $nome ?></span> está registada sob o nº <span><?=  $titulo ?></span>
                e que a mesma poderrá concorrer a qualquer conurso de adjucação de empreitada de obras públicas na província
                do Bié no domínio da <span><?=  $categoria ?></span> correspondente a <strong>7ª classe</strong> da tabela 
                de valores previsto no Decreto nº 9/17 de 11 de janeiro.
            </p>
            <h3>Cuito, aos <strong><?=  $data ?></strong></h3>
        </div>
        <h3><strong>O chefe de departamento de Obras Públicas</strong></h3>
        <h3>-Engº Rufino Sambingo Sunguhanga-</h3>
        <h3><strong>OBS:</strong> O Título é válido mediamte a validade do alvará.</h3>
    </div>
</body>
</html>
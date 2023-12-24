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
    $foto_obra=$p->buscar_Relatorio_imagens($id_relatorio);
 }

?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $relatorio['nome'] ?></title>
    <link rel="stylesheet" href="Css/relatorio.css">
    <link rel="stylesheet" href="Css/assets/fontawesome/css/all.min.css">
</head>
<body>
    <a href="pdf-relatorio.php?id_relatorio=<?= $id_relatorio ?>&id_obra=<?= $id_obra ?>">Gerar pdf  <i class="fa fa-download"></i></a>
    <h4 style="width: 800px; margin: 0 auto; font-size:14pt;"><?= $relatorio['nome'] ?></h4>
    <h1><?= $obra['nome'] ?></h1>
    <div class="detalhes-obra">
        <h2>EMPREITEIRO: <span><?= $construtor['nome']; ?></span></h2>
        <h2>FISCAL: <span><?=  $fiscal['nome'] ?></span></h2>
        <h2>ORÇAMENTO: <span><?=  $obra['orcamento'].' AO' ?></span></h2>
    </div>  
    <div class="imagens-obra">
    <?php  
        $foto_obra=$p->buscar_Relatorio_imagens($id_relatorio);
        foreach ($foto_obra as $foto) {
            ?>
            <div class="imagem">
                <img src="imagens/<?=$foto['nome']?>" alt="">
            </div>
            <?php
        }
        ?>
    </div> 
    <div class="detalhes-obra">
        <h2>Execução Financeira: <span><?= $relatorio['exec_financeira'].'%' ?></span></h2>
        <h2>Execução Física: <span><?= $relatorio['exec_fisica'].'%' ?></span></h2>
    </div> 
    <?php 
      $pontos_de_situacao=explode(';', $relatorio['ponto_situacao']);
      $recomendacoes=explode(';', $relatorio['recomendacoes']);
      $irregularidades=explode(';', $relatorio['irregularidades']);

    ?>
    <div class="pontos">
        <h2>Pontos de Situação</h2>
        <?php  
        foreach ($pontos_de_situacao as $ponto) {
            ?>
            <h4><i class="fa fa-minus-circle"></i> <?= $ponto ?>;</h4>
            <?php
        }
        ?>
    </div>
    <div class="pontos">
        <h2>Irregularidades</h2>
        <?php  
        foreach ($irregularidades as $irregularidade) {
            ?>
            <h4><i class="fa fa-minus-circle"></i> <?= $irregularidade ?>;</h4>
            <?php
        }
        ?>
    </div>
    <div class="pontos">
        <h2>Recomendações</h2>
        <?php  
        foreach ($recomendacoes as $recomend) {
            ?>
            <h4><i class="fa fa-minus-circle"></i> <?= $recomend ?>;</h4>
            <?php
        }
        ?>
    </div>
</body>
</html>
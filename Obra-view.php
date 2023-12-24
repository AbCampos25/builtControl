<?php
session_start();
if (!isset($_SESSION['id_admin']) && !isset($_SESSION['id_comum'])) {
    header('location: login.php');
}

 include 'Classes/Gabinete.php';
 $p=new Gabinete();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link rel="stylesheet" href="./Css/obras.css">
    <link href="Css/bootstrap-5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="Css/assets/fontawesome/css/all.min.css">
    <title>Obra-view</title>
</head>

<body>
    <section>
        <div class="esquerda">
            <div class="superior">
                <a href="Obras.php" style="font-size: 24px;">Voltar</i></a>
                <div class="menu-lateral">
                    <a href="Obras.php" class="">Obras</a>
                    <a href="Empresas.php" class="">Empresas</a>
                    <a href="Usuarios.php" class="">Usuários</a>
                </div>
            </div>
            <div class="inferior">
                <a href=""><i class="fa fa-question-circle"></i></a>
                <a href="Classes/Logout.php">Logout</a>
                <a href="#">copyright &copy; 2023</a>
            </div>
        </div>
        <div class="direita">

<?php

if(isset($_GET['id_view'])){
   $id=addslashes($_GET['id_view']);
   $res=$p->buscar_Uma_obra($id);
}

$foto_obra=$p->buscar_imagem_perfil_obra($res['id']);

$id_fiscal= $res['fk_fiscalizacao_id'];
$id_const= $res['fk_costrucao_id'];
$fiscal=$p->buscar_Uma_empresa($id_fiscal);
$construtor=$p->buscar_Uma_empresa($id_const);
?>
            <header>
            <?php echo $res['nome']; ?>
            </header>
            <div class="nav-view">
                <a href="form-obra.php?id_edit=<?php echo $id;?>"><i class="fa fa-edit"></i>Editar</a>
                <a href="relatorios.php?id_obra=<?php echo $res['id']; ?>"> <i class="fa fa-pen"></i> Relatórios</a>
            </div>
            <div class="fluxo-direito">
                <div class="foto-obra">
                <img src="imagens/<?php echo $foto_obra['nome']; ?>" alt="foto-obra">
                </div>
                <div class="detalhes-obra">
                    <h4>ESTADO: <span> <?php echo $res['estado']; ?></span></h4>
                    <h4>PRAZO: <span> <?php echo $res['duracao'].' meses'; ?></span></h4>
                    <h4>ORÇAMENTO: <span> <?php echo $res['orcamento'].' KZ'; ?> </span></h4>
                    <h4>EMPR. CONST: <span> <?php echo $construtor['nome']; ?></span></h4>
                    <h4>EMPR. FISC: <span> <?php echo $fiscal['nome']; ?></span></h4>
                </div>
            </div>
        </div>
    </section>
    <script src="Css/bootstrap-5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
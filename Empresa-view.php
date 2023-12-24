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
                <a href="Empresas.php" style="font-size: 24px;">Voltar</i></a>
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
   $res=$p->buscar_Uma_empresa($id);
}

$nome= $res['nome'];
$numero= $res['numero_cadastro'];
$categoria= $res['categoria'];
$data= $res['ano'];
?>
            <header>
            <?php echo $nome; ?>
            </header>
                <div class="nav-view">
                    <a href="form-empresa.php?id_edit=<?php echo $id;?>"><i class="fa fa-edit"></i>Editar</a>
                    <a href="titulo-cadastro.php?id_empresa=<?php echo $id; ?>" target="_blank">Emitir título de cadastro</a>
                </div>
                <div class="detalhes-empresa">
                    <h2>NÚMERO: <span><?php echo $numero; ?></span></h2>
                    <h2>CATEGORIA: <span><?php echo $categoria; ?></span></h2>
                    <h2>DATA DE CADASTRO: <span><?php echo $data; ?></span></h2>
                </div>
        </div>
    </section>

    <script src="Css/bootstrap-5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
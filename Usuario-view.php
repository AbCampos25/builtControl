<?php
session_start();
if (!isset($_SESSION['id_admin']) && !isset($_SESSION['id_comum'])) {
    header('location: Index.php');
}

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
    <title>Perfil</title>
</head>

<body>
    <section>
        <div class="esquerda">
            <div class="superior">
                <a href="index.php" style="font-size: 35px;"><i class="fa fa-home"></i></a>
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
            <header>
                Usuário
            </header>
                <div class="usuario-card">
                    <i class="fa fa-user"></i>
                    <button>Editar foto</button>
                    <div class="nome-email">
                        <div class="nome">
                        <h2><?php echo $_SESSION['nome']; ?></h2>
                        </div>
                        <div class="email">
                        <h5><?php echo $_SESSION['email']; ?></h5>
                        <a href="">editar <i class="fa fa-edit"></i></a>
                        </div>                        
                    </div>
                </div>
        </div>
    </section>

    <script src="Css/bootstrap-5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
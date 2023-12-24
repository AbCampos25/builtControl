<?php
session_start();
if (!isset($_SESSION['id_admin']) && !isset($_SESSION['id_comum'])) {
    header('location: Index.php');
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
    <title>Usuarios</title>
</head>

<body>
    <section>
        <div class="esquerda">
            <div class="superior">
                <a href="index.php" style="font-size: 35px;"><i class="fa fa-home"></i></a>
                <div class="menu-lateral">
                    <a href="Obras.php" class="">Obras</a>
                    <a href="Empresas.php" class="">Empresas</a>
                    <a href="Usuarios.php" class="activo">Usuários</a>
                </div>
            </div>
            <div class="inferior">
                <a href=""><i class="fa fa-question-circle"></i></a>
                <a href="Classes/logout.php">Logout</a>
                <a href="#">copyright &copy; 2023</a>
            </div>
        </div>
        <div class="direita">
            <header>
                Usuários
            </header>
            <div class="lista-user">
                <a href="form-usuario.php"><i class="fa fa-user-plus"></i> Adicionar</a>
<?php
    //EXIBIÇÃ......
     
    $res=$p->buscar_usuarios();
    
     if(count($res)>0){

        foreach($res as $value){
            ?> 
                <div class="usuario">
                <i class="fa fa-user"></i>
                    <div class="nome-email">
                        <h2><?php echo  $value['nome']; ?></h2>
                        <h5><?php echo  $value['email']; ?></h5>
                    </div>
                </div>
            <?php 
             
           }
             
     }

?>
               
            </div>
        </div>
    </section>

    <script src="Css/bootstrap-5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php
session_start();
if (!isset($_SESSION['id_admin'])) {
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
    <title>form-usuario</title>
</head>

<body>
    <section>
        <div class="esquerda">
            <div class="superior">
                <a href="Usuarios.php" style="font-size: 24px;">Voltar</i></a>
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
                Cadastrar Usuário
            </header>
            <form method="POST">
                <div classe="form-direita">
                    <label for="nome">Nome</label>
                    <input type="text" required name="nome" maxlength="32">
                    <label for="email"> Eamil</label>
                    <input type="email" required name="email" maxlength="32">
                    <?php

//CADASTRAR.........

 if(isset($_POST['nome'])){  
    
    //CADASTAR
   
        $nome=trim(htmlentities(addslashes($_POST['nome'])));
        $email=trim(htmlentities(addslashes($_POST['email'])));
        $senha=trim(htmlentities(addslashes($_POST['senha'])));
        $senha2=trim(htmlentities(addslashes($_POST['senha2'])));
        if(!empty($nome) && !empty($email) && !empty($senha) && !empty($senha2)){

            
            include 'Classes/Gabinete.php';
             $p=new Gabinete();
        

            if ($senha2==$senha) {
                if(!$p->cadastrar_Usuario($nome,$senha,$email)){
                   
                   ?>
                    <p class='message-erro'> Email já cadastrado, tente outro!</p>
                  <?php              
                }
                else {
                    ?>
                    <p class='message-sucesso'>Cadastrado com sucesso!</p>
                  <?php
                }
                
            }
            else {
                ?>
                <p class='message-erro'>Senhas não correspondentes! </p>
              <?php
                
            }
        }

        else{
            ?>
            <p class='message-erro'>Por favor, Preencha todos os campos!</p>
          <?php
          
        } 
 }

  
?>
        
                </div>
                <div>
                <label for="nome">Senha</label>
                    <input type="password" required name="senha" minlength="6">
                    <label for=""> Confirmar senha</label>
                    <input type="password" required name="senha2" minlength="6">
                    <button type="submit">ADICIONAR</button>
                 </div>
                 
            </form>
        </div>
    </section>

    <script src="Css/bootstrap-5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
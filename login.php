<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="Css/login.css">
</head>
<body>
    <header>GABINETE PROVINCIAL DE INFRAESTRUTURA</header>
     <form method="post">
        <h1> LOGIN </h1>
        <input type="email" name="email" required placeholder="email" id="" autocomplete="off">
        <input type="password" required placeholder="palavra passe" name="senha" id="">
        <button type="submit">ENTRAR</button>
        <?php

//................LOGAR.....................


        if(isset($_POST['email'])){  
   
            $email=htmlentities(addslashes($_POST['email']));
            $senha=htmlentities(addslashes(md5($_POST['senha'])));
    
            if(!empty($email) && !empty($senha)){
    
                include 'Classes/Gabinete.php';
                $p=new Gabinete('localhost','3308','gabinete','root','');
    
                    if(!$p->login($email,$senha)){
                       
                        ?>
                        <p class="message-erro"> Email ou senha está incorrecto</p>
                      <?php              
                    }
     
                    else header('location:Index.php');
                }
    
            else{
                ?>
                <p class="message-erro">Preencha todos os campos</p>
              <?php
              
            } 
         }
    
      
    ?>
     
     </form>    
</body>
</html>
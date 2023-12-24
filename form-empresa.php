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
    <title>form-empresa</title>
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
                <a href="classes/Logout.php">Logout</a>
                <a href="#">copyright &copy; 2023</a>
            </div>
        </div>
        
        <?php
//CADASTRAR OU ATUALIZAR.........

 if(isset($_POST['nome'])){  
     //ATUALIZAR
    if(isset($_GET['id_edit']) && !empty($_GET['id_edit'])){
        $id=addslashes($_GET['id_edit']);
        $nome=trim(addslashes($_POST['nome']));
        $numero=trim(addslashes($_POST['numero']));
        $categoria=trim(addslashes($_POST['categoria']));
        $ano=trim(addslashes($_POST['ano']));
        
        if(!empty($nome) && !empty($numero) && !empty($categoria) && !empty($ano) ){
            
            $p->editar_empresa($id,$categoria,$numero,$ano,$nome);
            
            header("location: Empresas.php");  
         
       } 
        else   ?>
              <script>alert('preencha todos os campos por favor!')</script>
               <?php  
     }
    
    //CADASTAR
    else{   
        $nome=trim(addslashes($_POST['nome']));
        $numero=trim(addslashes($_POST['numero']));
        $categoria=trim(addslashes($_POST['categoria']));
        $ano=trim(addslashes($_POST['ano']));
        if(!empty($nome) && !empty($numero) && !empty($categoria) && !empty($ano) ){
            if(!$p->cadastrar_empresa($categoria,$numero,$ano,$nome)){
               
                ?>
                 
                <script>alert('Esta empresa já existe!')</script>
            
             <?php
               
              
              
        }
              header('location:Empresas.php');
        
       }
       else{
        ?>
        <script>alert('preencha todos os campos por favor!')</script>
      <?php
       } 
   }
 }
  
?>
<?php
if(isset($_GET['id_edit'])){
    $id=addslashes($_GET['id_edit']);
   $res=$p-> buscar_Uma_empresa($id);
}

?>
        <div class="direita">
            <header>
                 <?php if(isset($res)){echo "Actualizar dados da Empresa";} else {echo "Cadastrar Empresa";}?>
            </header>

            <form action="" method="POST">
                <div>
                    <label for="nome">Nome</label>
                    <input type="text" autocomplete="off" required name="nome" value="<?php if(isset($res)){echo $res['nome'];}  ?>">
                    <label for="duracao"> Número de Cadastro</label>
                    <input type="txt" autocomplete="off" required name="numero" value="<?php if(isset($res)){echo $res['numero_cadastro'];}  ?>">
                </div>
                <div>
                    <label for="estado">Ramo de Actuação</label>
                    <div class="cat">
                        <input type="radio"  required name="categoria" id="construcao" value="Construção">
                        <label for="categoria">Construção</label>
                        <input type="radio" required name="categoria" id="fiscal" value="Fiscalização">
                        <label for="categoria">Fiscalização</label>
                    </div>
                    <label for="data">Data de cadastro</label>
                    <input type="date" required name="ano">

                    <button type="submit">
                        <?php if(isset($res)){echo "Actualizar";} else {echo "Adicionar";}?>
                    </button>
                </div>

            </form>
        </div>
    </section>

    <script src="Css/bootstrap-5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
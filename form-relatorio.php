
<?php
session_start();
if (!isset($_SESSION['id_admin']) && !isset($_SESSION['id_comum'])) {
    header('location: login.php');
}

 include 'Classes/Gabinete.php';
 $p=new Gabinete();

 if(isset($_GET['id_obra'])){
    $id_obra=addslashes($_GET['id_obra']);
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
    <title>Obras</title>
</head>

<body>
    <section>
        <div class="esquerda">
            <div class="superior">
                <a href="relatorios.php?id_obra=<?php echo $id_obra; ?>" style="font-size: 24px;">Voltar</i></a>  
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
//CADASTRAR OU ATUALIZAR.........

 if(isset($_POST['nome'])){  
     //ATUALIZAR
    if(isset($_GET['id_edit']) && !empty($_GET['id_edit'])){
        $id=addcslashes($_GET['id_edit']);
        $nome=trim(addslashes($_POST['nome']));
        $ponto_situacao=trim(addslashes($_POST['ponto_situacao']));
        $irregularidades=trim(addslashes($_POST['irregularidades']));
        $recomendacoes=trim(addslashes($_POST['recomendacoes']));
        $exec_financeira=trim(addslashes($_POST['exec_financeira']));
        $exec_fisica=trim(addslashes($_POST['exec_fisica']));
        
        if(!empty($nome) && !empty($ponto_situacao) && !empty($irregularidades) && !empty($recomendacoes) && !empty($exec_financeira) && !empty($exec_fisica) && !empty($exec_fisica) ){
            
            $p->editar_relatorio($id,$nome,$ponto_situacao,$irregularidades,$recomendacoes,$exec_financeira,$exec_fisica);
            
            header("location: relatorios.php");  
         
       } 
        else   ?>
              <script>alert('preencha todos os campos por favor!')</script>
               <?php  
     }
    
    //CADASTRAR $nome,$ponto_situacao,$irregularidades,$recomendacoes,$exec_financeira,$exec_fisica,$id_obra
    else{   
        $nome=trim(addslashes($_POST['nome']));
        $ponto_situacao=trim(addslashes($_POST['ponto_situacao']));
        $irregularidades=trim(addslashes($_POST['irregularidades']));
        $recomendacoes=trim(addslashes($_POST['recomendacoes']));
        $exec_financeira=trim(addslashes($_POST['exec_financeira']));
        $exec_fisica=trim(addslashes($_POST['exec_fisica']));
        $id_obra=addslashes($_GET['id_obra']);
        $foto=array();
       if(isset($_FILES["foto"])){
           for($i=0;$i<count($_FILES["foto"]["name"]);$i++){

        //SALVAR DENTRO DE UMA PASTA

         $nome_arq=md5($_FILES["foto"]["name"][$i].rand(1,999)).'.jpg';
         move_uploaded_file($_FILES["foto"]["tmp_name"][$i],'imagens/'.$nome_arq );
        
         //SALVAR NOMES PARA O BANCO DE DADOS

          array_push($foto,$nome_arq );
           }
       }

          //VERIFICAR SE TODOS OS CAMPOS FORAM PREENCHIDOS
        if(!empty($nome) && !empty($ponto_situacao) && !empty($irregularidades) && !empty($recomendacoes) && !empty($exec_financeira) && !empty($exec_fisica) && !empty($exec_fisica) ){
            $p->cadastrar_relatorio($nome,$ponto_situacao,$irregularidades,$recomendacoes,$exec_financeira,$exec_fisica,$id_obra,$foto);
                ?> 
                 
                <script>alert('Relatório cadastrado com sucesso')</script>
            
             <?php
                             header('location:relatorios.php?id_obra='.$id_obra);

            }
        
       else{
        ?>
        <script>alert('preencha todos os campos, por favor!')</script>
      <?php
       } 
   }
 }
  
?>
            <header>
                Formulário de relatório
            </header>
<?php
if(isset($_GET['id_edit'])){
    $id_rel=addslashes($_GET['id_edit']);
   $relatorio=$p->buscar_Um_relatorio($id_rel);
}

?> 
            <form method="POST" enctype="multipart/form-data">
                <div>
                    <label for="nome" >Nome</label>
                    <input type="text" value="<?php if(isset($_GET['id_edit'])){ echo $relatorio['nome'];}?>" required name="nome">
                    <label for="exec_financeira">Execução financeira</label>
                    <input type="number" value="<?php if(isset($_GET['id_edit'])){echo $relatorio['exec_financeira'];}?>" required name="exec_financeira">
                    <label for="exec_fisica">Execução física</label>
                    <input type="number" value="<?php if(isset($_GET['id_edit'])){echo $relatorio['exec_fisica'];}?>" required name="exec_fisica">
                    <label for="recomendacoes">Recomendações</label>
                    <span style="color: black; font-size: 10pt;">Use ";" para separar os pontos.</span>
                    <textarea name="recomendacoes" value="" placeholder="" id="" cols="10" rows="5" ><?php if(isset($_GET['id_edit'])){echo $relatorio['recomendacoes'];}?></textarea>                    
                </div>
                <div>
                    <label for="ponto_situacao">Pontos de Situação</label>
                    <span style="color: black; font-size: 10pt;">Use ";" para separar os pontos.</span>
                    <textarea name="ponto_situacao" value="" id="" cols="10" rows="5"><?php if(isset($_GET['id_edit'])){echo $relatorio['ponto_situacao'];}?></textarea>
                    <label for="irregularidades">Irregularidades</label>
                    <span style="color: black; font-size: 10pt;">Use ";" para separar os pontos.</span>
                    <textarea name="irregularidades" value="" id="" cols="10" rows="5"><?php if(isset($_GET['id_edit'])){echo $relatorio['irregularidades'];}?></textarea>
                    <label for="foto">Selecione no máximo 4 fotos</label>
                    <input type="file" name="foto[]" multiple id="foto">
                    <button type="submit">
                        Submeter
                    </button>
                </div>
            </form>
        </div>
    </section>

    <script src="Css/bootstrap-5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

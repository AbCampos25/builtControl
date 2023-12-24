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
    <title>Obras</title>
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
//CADASTRAR OU ATUALIZAR.........

 if(isset($_POST['nome'])){  
     //ATUALIZAR
    if(isset($_GET['id_edit']) && !empty($_GET['id_edit'])){
        $id=addslashes($_GET['id_edit']);
        $nome=trim(addslashes($_POST['nome']));
        $duracao=trim(addslashes($_POST['duracao']));
        $orcamento=trim(addslashes($_POST['orcamento']));
        $estado=trim(addslashes($_POST['estado']));
        $fiscal=trim(addslashes($_POST['fiscal']));
        $construtor=trim(addslashes($_POST['construcao']));
        
        if(!empty($nome) && !empty($duracao) && !empty($orcamento) && !empty($fiscal) && !empty($construtor) && !empty($estado) ){
            
            $p->editar_obra($id,$duracao,$nome,$orcamento,$estado,$fiscal,$construtor);
            
            header("location: Obras.php");  
         
       } 
        else   ?>
              <script>alert('preencha todos os campos por favor!')</script>
               <?php  
     }
    
    //CADASTRAR
    else{   
        $nome=trim(addslashes($_POST['nome']));
        $duracao=trim(addslashes($_POST['duracao']));
        $orcamento=trim(addslashes($_POST['orcamento']));
        $estado=trim(addslashes($_POST['estado']));
        $fiscal=trim(addslashes($_POST['fiscal']));
        $construtor=trim(addslashes($_POST['construcao']));
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
        if(!empty($nome) && !empty($duracao) && !empty($orcamento) && !empty($fiscal) && !empty($construtor) && !empty($estado) ){
            if(!$p->cadastrar_Obra($duracao,$nome,$orcamento,$estado,$fiscal,$construtor,$foto)){
                ?> 
                 
                <script>alert('Esta obra já existente!')</script>
            
             <?php

            }
            else {
                header('location:Obras.php');
            }

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
   $res=$p-> buscar_Uma_obra($id);
}

?>
            <header>
            <?php 
            if (isset($_GET['id_edit'])) {
                echo 'Actualizar dados da obra';
            }
            else {
                echo 'Cadastrar Obras';
            }            
            ?>
            </header>
            <form method="POST" enctype="multipart/form-data">
                <div>
                    <label for="nome" >Nome</label>
                    <input type="text" value="<?php if (isset($_GET['id_edit'])) { echo $res['nome'];} ?>" required name="nome">
                    <label for="duracao">Duaração da obra em meses</label>
                    <input type="number" value="<?php if (isset($_GET['id_edit'])) { echo $res['duracao'];} ?>" required name="duracao">
                    <label for="numero">Orçamento</label>
                    <input type="text" value="<?php if (isset($_GET['id_edit'])) { echo $res['orcamento'];} ?>" required name="orcamento">

                </div>
                <div>
                    <label for="estado">Estado da obra</label>
                    <select name="estado" required id="">
                        <option value="Em construção" >Em construção</option>                              
                        <option value="Parada"> Parada</option>
                        <option value="Quase Finalizada">Quase Finalizada</option>
                        <option value="Finalizada">Finalizada</option>
                    </select>
                    <label for="construcao">Empresa Construtora</label>
                    <select name="construcao" required id="">
                    <?php
                        $empresas=$p-> buscar_empresas();
                        foreach ($empresas as $value) {
                            if ($value['categoria']=='Construção') {
                                ?>
                                <option value="<?php echo $value['id']; ?>"><?php echo $value['nome']; ?></option>
                                <?php
                            }
                        }
                    ?>
                    </select>
                    <label for="fiscal">Empresa Fiscal</label>
                    <select name="fiscal" required id="">
                    <?php
                        $empresas=$p-> buscar_empresas();
                        foreach ($empresas as $value) {
                            if ($value['categoria']=='Fiscalização') {
                                ?>
                                <option value="<?php echo $value['id']; ?>"><?php echo $value['nome']; ?></option>
                                <?php
                            }
                        }
                    ?>
                    </select>
                    <label for="foto">Adicione a foto do projecto</label>
                    <input type="file" <?php if(!isset($_GET['id_edit'])) { echo 'required';} ?> name="foto[]" multiple id="foto">
                    <button type="submit">
                        <?php 
                        if (isset($_GET['id_edit'])) {
                            echo 'Actualizar';
                        }
                        else {
                            echo 'Adicionar';
                        }            
                        ?>    
                    </button>
                </div>
            </form>
        </div>
    </section>

    <script src="Css/bootstrap-5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
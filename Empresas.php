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
    <title>Empresas</title>
</head>

<body>
    <section>
        <div class="esquerda">
            <div class="superior">
                <a href="index.php" style="font-size: 35px; font-weight: bold;"><i class="fa fa-home"></i></a>
                <div class="menu-lateral">
                    <a href="Obras.php" class="">Obras</a>
                    <a href="Empresas.php" class="activo">Empresas</a>
                    <a href="Usuarios.php" class="">Usuários</a>
                </div>
            </div>
            <div class="inferior">
                <a href=""><i class="fa fa-question-circle"></i></a>
                <a href="classes/Logout.php">Logout</a>
                <a href="#">copyright &copy; 2023</a>
            </div>
        </div>
        <div class="direita">
            <header>
                Empresas
            </header>
            <div class="fluxo-direito">
                <table class="empresa">
                    <tr id="pr">
                        <td>Nome da Empresa</td>
                        <td>Categoria</td>
                        <td>Nº de Resgisto</td>
                        <td>Data de registo</td>
                        <td> <a href="form-empresa.php">Adicionar <i class="fa fa-plus"></i></a></td>
                    </tr>


    <?php
    //EXIBIÇÃ......
     
    $res=$p->buscar_empresas();
    
     if(count($res)>0){

        foreach($res as $value){

            echo " <tr>";
            echo"<td>".$value['nome']."</td>";
            echo"<td>".$value['categoria']."</td>";
            echo"<td>".$value['numero_cadastro']."</td>";   
            echo"<td>".$value['ano']."</td>";
            ?> 
                    <!-- Modal -->
                <div class="modal fade" id="exampleModal<?php echo $value['id'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar Empresa</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Tem certeza? Esta empresa pode estar associada a uma obra, Verifique. 
                            Se estiver, por favor, edite os dados da obra mudando a empresa antes de eliminar.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <a href=" Empresas.php?id_delete=<?php echo $value['id'];?>" class="btn btn-primary">Eliminar</a>
                        </div>
                        </div>
                    </div>
                </div>

                        <td>
                            <a href="form-empresa.php?id_edit=<?php echo $value['id'];?>"><i class="fa fa-edit"></i> </a>
                            <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $value['id'];?>"><i class="fa fa-trash"></i></a>
                            <a href="Empresa-view.php?id_view=<?php echo $value['id'];?>"><i class="fa fa-eye"></i></a>
                        </td>

            <?php
            echo " </tr>";
             
           }
             
         
        
     }
     else{
        ?>
        <div class="message-sucesso"> <h2>Ainda não há empresas cadastradas!</h2> </div>
        
        <?php
     }
    ?>
                </table>
            </div>
        </div>
    </section>

    <script src="Css/bootstrap-5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
if(isset($_GET['id_delete'])){
    $idp=addslashes($_GET['id_delete']);
    $p->eliminar_empresa($idp);   

}
?>
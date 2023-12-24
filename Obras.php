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
    <title>Obras</title>
</head>

<body>
    <section>
        <div class="esquerda">
            <div class="superior">
                <a href="index.php" style="font-size: 35px; font-weight: bold;"><i class="fa fa-home"></i></a>
                <div class="menu-lateral">

                    <a href="Obras.php" class="activo">Obras</a>
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
                Obras
            </header>
            <div class="fluxo-direito">
                <table>
                    <tr id="pr">
                        <td>Nome da obra</td>
                        <td>Duração da obra</td>
                        <td>Emp. construção</td>
                        <td>Emp. Fiscalização</td>
                        <td>Orçamento</td>
                        <td>Estado da obra</td>
                        <td> <a href="form-obra.php">Adicionar <i class="fa fa-plus"></i></a></td>
                    </tr>
                    <?php
    //EXIBIÇÃ......
     
    $res=$p->buscar_obras();
    
     if(count($res)>0){

        foreach($res as $value){
            $id_fiscal= $value['fk_fiscalizacao_id'];
            $id_const= $value['fk_costrucao_id'];
            $fiscal=$p->buscar_Uma_empresa($id_fiscal);
            $construtor=$p->buscar_Uma_empresa($id_const);
            echo " <tr>";
            echo"<td>".$value['nome']."</td>";
            echo"<td>".$value['duracao']." meses </td>";           
            echo"<td>".$construtor['nome']."</td>";
            echo"<td>".$fiscal['nome']."</td>";
            echo"<td>".$value['orcamento']." AO </td>";
            echo"<td>".$value['estado']."</td>";
            ?> 

                                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal<?php echo $value['id'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar Obra</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Esta obra será eliminda. Tem certeza?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <a href=" Obras.php?id_delete=<?php echo $value['id'];?>" class="btn btn-primary">Eliminar</a>
                                </div>
                                </div>
                            </div>
                        </div>

                        <td>
                            <a href="form-obra.php?id_edit=<?php echo $value['id'];?>"><i class="fa fa-edit"></i> </a>
                            <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $value['id'];?>"><i class="fa fa-trash"></i></a>
                            <a href="obra-view.php?id_view=<?php echo $value['id'];?>"><i class="fa fa-eye"></i></a>
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
                    </tr>
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
    $p->eliminar_obra($idp); 
    $p->eliminar_imagens_Obra($idp);
    $p->eliminar_relatorios_obra($idp);
}
?>
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
<?php

if(isset($_GET['id_obra'])){
   $id=addslashes($_GET['id_obra']);
   $res=$p->buscar_Uma_obra($id);
}
$id_obra=$res['id'];
$nome_obra=$res['nome'];

$foto_obra=$p->buscar_imagem_perfil_obra($id_obra);
$relatorios=$p->buscar_relatorios();

?>
            <div class="superior">
                <a href="obra-view.php?id_view=<?php echo $id_obra; ?>" style="font-size: 24px;">Voltar</i></a>
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
                Relatórios
            </header>
            <div class="fluxo-direito">
                <div class="painel-exibicao">
                    <div class="imagem largura-capa cover" style="background-image: url(./imagens/<?php echo $foto_obra['nome']; ?>);">
                        <div class="cover2 bg-trans-dark">
                            <h2><?php echo $nome_obra; ?></h2>
                        </div>
                    </div>
                    <div class="detalhes">
                        <a href="form-relatorio.php?id_obra=<?php echo $id_obra; ?>"><h2>Ir para formulário de relatório</h2></a>
<?php
 foreach ($relatorios as $relatorio) {
    if ($relatorio['fk_obra_id']==$id_obra) {
        ?>
                    <!-- Modal -->
                <div class="modal fade" id="exampleModal<?php echo $relatorio['id'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar Relatório</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Deseja eliminar este relatório?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <a href="relatorios.php?id_delete=<?php echo $relatorio['id'];?>&id_obra=<?php echo $id_obra;?>" class="btn btn-primary">Eliminar</a>
                    </div>
                    </div>
                </div>
            </div>


                    <div class="relatorio-list">
                        <div class="relatorio"><a href="relato.php?id_relatorio=<?php echo $relatorio['id'];?>&id_obra=<?php echo $id_obra; ?>" target="_blank"><?php echo $relatorio['nome'];?></a></div>
                        <div class="config">
                            <a href="form-relatorio.php?id_edit=<?php echo $relatorio['id'];?>&id_obra=<?php echo $id_obra;?>"><i class="fa fa-edit"></i> </a>
                            <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $relatorio['id'];?>"><i class="fa fa-trash"></i></a>
                            <a href="relato.php?id_relatorio=<?php echo $relatorio['id'];?>&id_obra=<?php echo $id_obra;?>" target="_blank"><i class="fa fa-eye"></i></a>
                        </div>
                    </div>
<?php
    }
 }


?>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="Css/bootstrap-5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
if(isset($_GET['id_delete'])){
    $idp=addslashes($_GET['id_delete']);
    $p->eliminar_relatorio($idp);   
    $p->eliminar_imagens_Relatorio($idp);   

}
?>
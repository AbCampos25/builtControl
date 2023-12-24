<?php
session_start();
if (!isset($_SESSION['id_admin']) && !isset($_SESSION['id_comum'])) {
    header('location: Login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link rel="stylesheet" href="./Css/index.css">
    <link href="Css/bootstrap-5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="Css/assets/fontawesome/css/all.min.css">
    <title>Home</title>
</head>

<body>
    <section>
        <div class="esquerda">
            <div class="superior">
                <i class="fa fa-user"></i>
                <a href="usuario-view.php"> ver perfil</a>
            </div>
            <div class="inferior">
                <a href=""><i class="fa fa-question-circle"></i></a>
                <a href="classes/Logout.php">Logout</a>
                <a href="#">copyright &copy; 2023</a>
            </div>
        </div>
        <div class="direita">
            <header>
                GABINETE PROVINCIAL DE INFRAESTRUTURAS
            </header>
            <nav>
                <a href="obras.php">Obras</a>
                <a href="Empresas.php">Empresas</a>
                <a href="Usuarios.php">Usuários</a>
            </nav>
            <div class="carross">
                <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="painel-exibicao">
                                <div class="imagem largura-capa cover" style="background-image: url(./imagens/1.jpg);">
                                    <div class="cover2 bg-trans-dark">
                                        <h2>PONTE SOBRE O RIO CUANGO</h2>
                                    </div>
                                </div>
                                <div class="detalhes ">
                                    <h4>ESTADO: <span> EM CONSTRUÇÃO</span></h4>
                                    <h4>PRAZO: <span> 12 MESES</span></h4>
                                    <h4>ORÇAMENTO: <span> 245.320.123,00 KZ</span></h4>
                                    <h4>EMPR. CONST: <span> SET-CONSTRUÇÃO</span></h4>
                                    <h4>EMPR. FISC: <span> MBAPOLO-LDA</span></h4>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="painel-exibicao">
                                <div class="imagem largura-capa cover" style="background-image: url(./imagens/3.jpg);">
                                    <div class="cover2 bg-trans-dark">
                                        <h2>INSTITUTO MÉDIO DE SAÚDE</h2>
                                    </div>
                                </div>
                                <div class="detalhes">
                                    <h4>ESTADO: <span> EM CONSTRUÇÃO</span></h4>
                                    <h4>PRAZO: <span> 12 MESES</span></h4>
                                    <h4>ORÇAMENTO: <span> 245.320.123,00 KZ</span></h4>
                                    <h4>EMPR. CONST: <span> SET-CONSTRUÇÃO</span></h4>
                                    <h4>EMPR. FISC: <span> MBAPOLO-LDA</span></h4>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="painel-exibicao">
                                <div class="imagem largura-capa cover" style="background-image: url(./imagens/2.jpg);">
                                    <div class="cover2 bg-trans-dark">
                                        <h2>MONUMENTO MÁRTIRES</h2>
                                    </div>
                                </div>
                                <div class="detalhes ">
                                    <h4>ESTADO: <span> EM CONSTRUÇÃO</span></h4>
                                    <h4>PRAZO: <span> 12 MESES</span></h4>
                                    <h4>ORÇAMENTO: <span> 245.320.123,00 KZ</span></h4>
                                    <h4>EMPR. CONST: <span> SET-CONSTRUÇÃO</span></h4>
                                    <h4>EMPR. FISC: <span> MBAPOLO-LDA</span></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="rodape">
                <a href="about.php">SAIBA MAIS SOBRE NÓS...</a>
                <a href="#ajuda"></a>
            </div>
        </div>
    </section>

    <script src="Css/bootstrap-5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php
    include_once("process/conn.php");

    $msg = "";
    $status = "";

    if(isset($_SESSION["msg"])) {

        $msg = $_SESSION["msg"];
        $status = $_SESSION["status"];
        //Limpar a mensagem ao da F5
        $_SESSION["msg"] = "";
        $_SESSION["status"] = "";

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faça seu Pedido!</title>
    <!-- Bootstrap -->  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- App CSS --> 
    <link rel="stylesheet" href="css\styles.css">
</head>
<body>
    <header>
        <!--<p>Cabeçalho</p> --->
        <!--Utilizar componente da BLIB Bootstrap---> 
        <nav class="navbar navbar-expand-lg">
            <a href="index.php" class="navbar-brand">
            <img src="img\pizza.svg" alt="Pizzaria do Lúcio" id="bland-logo">
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <li class="nav-item active">
                    <a href="index.php" class="nav-link">Peça sua pizza</a>
                </li>
            </div>
        </nav>
        </nav>
    </header>
    <!-- Alert no cabeçalho Baseado no Status do PHP e sua mensagem não ser vaziu!! --->
    <?php if($msg != ""): ?>
        <div class="alert alert-<?= $status ?>">
            <p><?= $msg ?></p>
        </div>
    <?php endif; ?>
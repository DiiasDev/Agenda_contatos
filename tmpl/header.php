<?php
include_once('config/url.php');
include_once('config/process.php');

//limpa a mensagem 
if(isset($_SESSION['msg'])){ //verifica se há alguma mensagem
    $printMsg = $_SESSION['msg']; // imprime a mensagem
    $_SESSION['msg'] = ''; //Limpa a mensagem com o f5 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda de Contatos</title>
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css">
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- css -->
    <link rel="stylesheet" href="<?= $BASE_URL ?>/css/style.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <a class="navbar-brand" href="<?= $BASE_URL ?>/index.php">
                <img src="<?= $BASE_URL ?>/img/logo.png" alt="agenda">
            </a>
            <div>
                <div class="navbar-nav">
                    <a href="<?= $BASE_URL ?>/index.php"  id="home-link" class="nav-link active">Agenda</a>
                    <a href="<?= $BASE_URL ?>/create.php" class="nav-link active" >Adicionar contato</a>
                </div>
            </div>
        </nav>
    </header>
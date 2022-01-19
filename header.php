<?php session_start(); require 'conn.php';
?>

<!doctype html>
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema de Pedidos">
    <meta name="author" content="Wanderson Santos">
    <meta name="generator" content="">
    <title>Painel - Sistema de Pedidos</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/sticky-footer-navbar.css" rel="stylesheet">
    <!-- Icons fontawesome -->    
    <link href="icons/css/fontawesome.css" rel="stylesheet">
    <link href="icons/css/brands.css" rel="stylesheet">
    <link href="icons/css/solid.css" rel="stylesheet">


  </head>
  <body class="d-flex flex-column h-100">
  
  <?php
    if (!isset($_SESSION['UserIDLogin'])){
      $_SESSION['msgErros'] = "Autenticação não realizada.<br/> Impossível Acessar Painel Administrativo.<br/> Faça Login Novamente <a href='login.php'>Clicando Aqui</a>";
        echo "<div class='alert alert-danger text-center'>".$_SESSION['msgErros']."</div>";   
        $_SESSION['msgErros'] = "";
        unset($_SESSION['msgErros']);  
        exit;
    }
  ?>


  <header>
  <!-- Fixed navbar -->
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-primary">    
    <a class="navbar-brand" href="dashboard.php"><img src="img/logo.png" height="30px" /> Sistema de Pedidos</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
        
        <li class="nav-item">
          <a class="nav-link" href="admin-categoria-lista.php">Cadastro Categorias</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="admin-produto-lista.php">Cadastro Produtos</a>
        </li>
      
        <li class="nav-item">
          <a class="nav-link" href="admin-pedido-lista.php">Pedidos</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link" href="admin-user-meus-dados.php">Meus Dados</a>
        </li>

      </ul>
      
      
      <a class="btn btn-danger" href="logout.php">Sair</a>

    </div>
    
  </nav>
</header>
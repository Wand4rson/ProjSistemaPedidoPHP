<?php  
  require 'header.php';  
  require 'class/usuarios.class.php';

  $user = new Usuario();
  $lstUsuario = $user-> getUsuarioID($_SESSION['UserIDLogin']);
?>


<!-- Begin page content -->
<main role="main" class="flex-shrink-0">
  
  <div class="container">
  
    <h1>Sistema de Pedidos</h1>
   
      <?php foreach($lstUsuario as $usuario) : ?>            
            <br/><small class="text-muted">E-mail : <?php echo $usuario['user_email'] ;?></small>
            <br/><small class="text-muted">Ultimo Acesso : <?php echo date('d/m/Y', strtotime($usuario['user_ultimoacesso'])) ;?></small>
            <br/>
            <br/>
      <?php endforeach; ?>

  </div>
</main>


<?php
  require 'footer.php';
?>
<?php  
  require 'header.php';
  require 'class/pedidos.class.php';

  $ped = new Pedidos(); 
  $lstpedido = $ped->getPedidos();
  
  if (isset($_POST['btnNovoPedido']))
  {                 
      if($ped->AddPedido()!=false)
      {	
          $_SESSION['msgInfo']  = "Registro Inserido com sucesso. <br/>";        	    
          header("Location:admin-pedido-lista.php");
          die();
      }
  }

 
?>

<!-- Begin page content -->
<main role="main" class="flex-shrink-0">
  
  <div class="container">  
   <h1>Lista de Pedidos</h1>
   <br/><br/>

   <form method="POST">    
    <button name="btnNovoPedido" class="btn btn-primary btn-block" type="submit">Novo Pedido <i class="fas fa-plus"></i></button>
   </form>
   
   <br/><br/>

    <?php
      if (isset($_SESSION['msgInfo'])){      
          echo "<div class='alert alert-info text-center'>".$_SESSION['msgInfo']."</div>";   
          $_SESSION['msgInfo'] = "";
          unset($_SESSION['msgInfo']);         
      }
    ?>

    <?php
      if (isset($_SESSION['msgErros'])){
          echo "<div class='alert alert-danger'>".$_SESSION['msgErros']."</div>";
          unset($_SESSION['msgErros']);               
      }    
    ?>

  <table class="table table-hover table-sm">
  <thead>
    <tr>
      <th scope="col">#</th>      
      <th scope="col">Data Lçto</th>      
      <th scope="col">Hora Lçto</th>      
      <th scope="col">R$ ICMS</th>      
      <th scope="col">R$ IPI</th>      
      <th scope="col">R$ Pedido</th>   
      <th scope="col">Cancelado ?</th>
      <th scope="col"></th>      
      <th scope="col"></th>
    </tr>
  </thead>

    <?php    
      foreach($lstpedido as $pedido):
    ?>
        <tbody>

          <tr>
            <th scope="row"><?php echo $pedido['ped_id'];?></th>
            <td><?php echo date('d/m/Y', strtotime($pedido['ped_datacadastro']));?></td>            
            <td><?php echo $pedido['ped_horacadastro'];?></td>            
            <td><?php echo number_format($pedido['total_icms'],2,',','.');?></td>
            <td><?php echo number_format($pedido['total_ipi'],2,',','.');?></td>
            <td><?php echo number_format($pedido['total_pedido'],2,',','.') ;?></td>
            <td><?php echo $pedido['ped_cancelado'];?></td>

            
            <?php if ($pedido['ped_cancelado'] == 'nao') :;?>                
              <td>
                <form action="admin-pedido-itens.php" method="post">            
                  <input type="hidden" name="ped_id" value="<?=$pedido['ped_id']?>"> 
                  <button type="submit" name="editar" class="btn btn-outline-primary btn-sm">Itens <i class="fas fa-cart-plus"></i></button>              
                </form>
              </td>
            <?php endif; ?> 
          
            <?php if ($pedido['ped_cancelado'] == 'nao') :;?> 
                <td>
                  <form action="admin-pedido-cancelar.php" method="post">              
                    <input type="hidden" name="ped_id" value="<?=$pedido['ped_id']?>">							              
                    <button type="submit" name="remover" class="btn btn-outline-danger btn-sm">Cancelar <i class="fas fa-times"></i></button>
                  </form>						
                </td>
            <?php endif; ?> 

          </tr>

        </tbody>

    <?php
      endforeach
    ?>

  </table>

  <div class="container-fluid">

		<?php if(!empty($lstpedido)){ ?>
			<div class="text-muted">Qtde Registros encontrados : <?php echo count($lstpedido) ?></div>
		<?php } ?>
		
	</div>


  </div>
</main>

<?php
  require 'footer.php';
?>
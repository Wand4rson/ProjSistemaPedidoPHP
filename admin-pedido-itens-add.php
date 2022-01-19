<?php  
  require_once 'header.php';
  require_once 'class/produtos.class.php';
  

  $pro = new Produtos();
  $lstproduto = $pro->getProdutos();
  
  
  if (isset($_POST['additem']))
  {       
      if (isset($_POST['ped_id']) || !empty($_POST['ped_id']))
      {            
          require_once 'class/pedidos.class.php';
          $ped = new Pedidos();     
          

          if (isset($_POST['pro_qtde']) || !empty($_POST['pro_qtde']))
          {
            $qtdevendido = $_POST['pro_qtde'];
          }
          else
          {
            $qtdevendido = 1;
          }
          

          $ped->AddPedidoItens($_POST['ped_id'], $_POST['pro_id'], $qtdevendido);
          header("Location: admin-pedido-lista.php"); 

      }
  }

?>


<!-- Begin page content -->
<main role="main" class="flex-shrink-0">
  
  <div class="container">  
   <h1>Selecione o item para adicionar ao Pedido</h1>

   <?php
    if (isset($_SESSION['msgInfo'])){      
        echo "<div class='alert alert-info text-center'>".$_SESSION['msgInfo']."</div>";   
        $_SESSION['msgInfo'] = "";
        unset($_SESSION['msgInfo']);         
    }
  ?>

  <table class="table table-hover table-sm">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Descrição</th>
      <th scope="col">Categoria</th>      
      <th scope="col">Preço Venda</th>      
      <th scope="col">Ativo ?</th>
      <th scope="col"></th>      
      <th scope="col"></th>
    </tr>
  </thead>

    <?php    
      foreach($lstproduto as $produto):
    ?>
        <tbody>
          <tr>
            <th scope="row"><?php echo $produto['pro_id'];?></th>
            <td><?php echo $produto['pro_descricao'];?></td>
            <td><?php echo $produto['categoria_nome'];?></td>   
            <td><?php echo $produto['pro_precovenda'];?></td>
            <td><?php echo $produto['pro_ativo'];?></td>
                
            
            <td>
              <form method="post">              
                <input type="hidden" name="ped_id" value="<?=$_POST['ped_id']?>">
                <input type="hidden" name="pro_id" value="<?=$produto['pro_id']?>">
                <input type="number" name="pro_qtde" min="1" max="999" value="1">
                <button type="submit" name="additem" class="btn btn-outline-primary btn-sm">Comprar <i class="fa fa-cart-plus"></i></button>
              </form>						
            </td>

					

          </tr>
        </tbody>

    <?php
      endforeach
    ?>

  </table>

  <div class="container-fluid">

		<?php if(!empty($lstproduto)){ ?>
			<div class="text-muted">Qtde Registros encontrados : <?php echo count($lstproduto) ?></div>
		<?php } ?>
		
	</div>


  </div>
</main>

<?php
  require 'footer.php';
?>


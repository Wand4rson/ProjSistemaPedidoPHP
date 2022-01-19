<?php  
  require 'header.php';
  require 'class/pedidos.class.php';

    
    if (isset($_POST['ped_id']) || !empty($_POST['ped_id']))
    {            
        $ped = new Pedidos();         
        $lstItens = $ped->getPedidoItensPorPedido($_POST['ped_id']);      

        $numeroPedido = $_POST['ped_id'];
    }

?>

<!-- Begin page content -->
<main role="main" class="flex-shrink-0">
  
  <div class="container">   

    <div class="text-center mb-4">
          <img class="mb-4" src="img/categories-list.png" alt="Icone Principal">    
        <h3>Produtos Já Lançados no Pedido <?php echo $numeroPedido ;?> </h3>
    </div>
    
    <br/><br/>      
    <form action="admin-pedido-itens-add.php" method="post">              
      <input type="hidden" name="ped_id" value="<?= $numeroPedido ?>">      
      <button type="submit" name="btncomprarmais" class="btn btn-outline-primary btn-sm">Continuar Comprando  <i class="fas fa-cart-plus"></i></button>
    </form>						
    <br/><br/>    

  <table class="table table-hover table-sm">
  <thead>
    <tr>
      <th scope="col">#</th>      
      <th scope="col">Produto ID</th>      
      <th scope="col">Descrição</th>      
      <th scope="col">Qtde</th>      
      <th scope="col">R$ Unitário</th>      
      <th scope="col">R$ Total</th>   
      <th scope="col">R$ ICMS</th>
      <th scope="col">R$ IPI</th>            
      <th scope="col"></th>
    </tr>
  </thead>

    <?php    
      foreach($lstItens as $item):
    ?>
        <tbody>

          <tr>
            <th scope="row"><?php echo $item['peditem_id'];?></th>
            <td><?php echo $item['produto_id'];?></td>
            <td><?php echo $item['descricao'];?></td>                    
            <td><?php echo number_format($item['peditem_qtdevendida'],2,',','.');?></td>
            <td><?php echo number_format($item['peditem_precounitario'],2,',','.');?></td>
            <td><?php echo number_format($item['peditem_precototal'],2,',','.') ;?></td>
            <td><?php echo number_format($item['peditem_precoicms'],2,',','.') ;?></td>
            <td><?php echo number_format($item['peditem_precoipi'],2,',','.') ;?></td>

            <td>
              <form action="admin-pedido-itens-deletar.php" method="post">              
                <input type="hidden" name="ped_id" value="<?=$item['pedido_id']?>">
                <input type="hidden" name="peditem_id" value="<?=$item['peditem_id']?>">
                <button type="submit" name="remover" class="btn btn-outline-danger btn-sm">Excluir <i class="fas fa-trash"></i></button>
              </form>						
            </td>

          </tr>

        </tbody>

    <?php
      endforeach
    ?>

  </table>

  <div class="container-fluid">

		<?php if(!empty($lstItens)){ ?>
			<div class="text-muted">Qtde Registros encontrados : <?php echo count($lstItens) ?></div>
		<?php } ?>
		
	</div>

    

  </div>
</main>

<?php
  require 'footer.php';
?>
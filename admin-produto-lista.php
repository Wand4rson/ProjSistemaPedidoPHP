<?php  
  require 'header.php';
  require 'class/produtos.class.php';

  $pro = new Produtos();
  $lstproduto = $pro->getProdutos();
?>

<!-- Begin page content -->
<main role="main" class="flex-shrink-0">
  
  <div class="container">  
   <h1>Lista de Produtos</h1>

   <a class="btn btn-outline-primary btn-sm" href="admin-produto-add.php">Nova <i class="fas fa-plus"></i></a>
   <br/><br/>

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
						<form action="admin-produto-alterar.php" method="post">            
              <input type="hidden" name="pro_id" value="<?=$produto['pro_id']?>"> 
							<button type="submit" name="editar" class="btn btn-outline-primary btn-sm"><i class="fas fa-pen"></i></button>              
						</form>
					</td>
					
					<td>
						<form action="admin-produto-deletar.php" method="post">              
              <input type="hidden" name="pro_id" value="<?=$produto['pro_id']?>">							              
              <button type="submit" name="remover" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></button>
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
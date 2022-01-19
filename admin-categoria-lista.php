<?php  
  require 'header.php';
  require 'class/categorias.class.php';

  $cat = new Categorias();
  $lstcategoria = $cat->getCategorias();
?>

<!-- Begin page content -->
<main role="main" class="flex-shrink-0">
  
  <div class="container">  
   <h1>Lista de Categorias de Produtos</h1>

   <a class="btn btn-outline-primary btn-sm" href="admin-categoria-add.php">Nova <i class="fas fa-plus"></i></a>
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
      <th scope="col">Aliquota ICMS</th>      
      <th scope="col">Aliquota IPI</th>      
      <th scope="col">Ativo ?</th>
      <th scope="col"></th>      
      <th scope="col"></th>
    </tr>
  </thead>

    <?php    
      foreach($lstcategoria as $categoria):
    ?>
        <tbody>
          <tr>
            <th scope="row"><?php echo $categoria['cat_id'];?></th>
            <td><?php echo $categoria['cat_descricao'];?></td>
            <td><?php echo $categoria['cat_aliquotaicms'];?></td>   
            <td><?php echo $categoria['cat_aliquotaipi'];?></td>
            <td><?php echo $categoria['cat_ativo'];?></td>
                        
					<td>
						<form action="admin-categoria-alterar.php" method="post">            
              <input type="hidden" name="cat_id" value="<?=$categoria['cat_id']?>"> 
							<button type="submit" name="editar" class="btn btn-outline-primary btn-sm"><i class="fas fa-pen"></i></button>              
						</form>
					</td>
					
					<td>
						<form action="admin-categoria-deletar.php" method="post">              
              <input type="hidden" name="cat_id" value="<?=$categoria['cat_id']?>">							              
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

		<?php if(!empty($lstcategoria)){ ?>
			<div class="text-muted">Qtde Registros encontrados : <?php echo count($lstcategoria) ?></div>
		<?php } ?>
		
	</div>


  </div>
</main>

<?php
  require 'footer.php';
?>
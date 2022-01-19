<?php  
  require 'header.php';
  require 'class/produtos.class.php';

    if (isset($_POST['inputdescricao']) && (!empty($_POST['inputdescricao']))){
        $pro_descricao = htmlspecialchars(addslashes($_POST['inputdescricao']));
    }

    if (isset($_POST['categoria_codigo']) && (!empty($_POST['categoria_codigo']))){
        $categoria_codigo = htmlspecialchars(addslashes($_POST['categoria_codigo']));
    }


    if (isset($_POST['inputstatus']) && (!empty($_POST['inputstatus']))){
        $pro_ativo = htmlspecialchars(addslashes($_POST['inputstatus']));
    }


    if (isset($_POST['pro_precovenda']) && (!empty($_POST['pro_precovenda']))){
        $pro_precovenda = htmlspecialchars(addslashes($_POST['pro_precovenda']));
        $pro_precovenda = str_replace(',','.', str_replace('.','', $pro_precovenda));
    }

    //Se Todos os valores obrigatorios foram preenchidos grava//    
    if (isset($_POST['inputdescricao']) && (!empty($_POST['inputdescricao'])))
    {       

        $pro = new Produtos();
        
        if($pro->AddProduto($pro_descricao, $pro_ativo, $pro_precovenda, $categoria_codigo)!=false)
        {	            
            $_SESSION['msgInfo']  = "Registro Inserido com sucesso. <br/>";        	    
            header("Location:admin-produto-lista.php");
            die();
        }
        else
        {
            //
        }
    }



?>

<!-- Begin page content -->
<main role="main" class="flex-shrink-0">
  
  <div class="container">     

            <form class="form-signin" action="" method="POST">
            
                    <?php
                        if (isset($_SESSION['msgErros'])){
                            echo "<div class='alert alert-danger'>".$_SESSION['msgErros']."</div>";
                            unset($_SESSION['msgErros']);               
                        }    
                    ?>

                        <div class="text-center mb-4">
                            <img class="mb-4" src="img/categories-list.png" alt="Icone Principal">    
                            <h3>Cadastro de Produtos</h3>
                        </div>
                        
                        <div class="form-group">
                            <label for="inputdescricao">Descrição *</label>
                            <input type="text" class="form-control" id="inputdescricao" name="inputdescricao" placeholder="Descrição" required>                    
                        </div>

                        <div class="form-group">
                            <label for="pro_precovenda">Preço de Venda </label>
                            <input type="text" class="form-control money" id="pro_precovenda" name="pro_precovenda" placeholder="Preço de Venda">                    
                        </div>

                                                

                        <div class="row">  
                                          
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="categoria_codigo">Categoria de Produto *</label>
                                        
                                        <select name="categoria_codigo" id="categoria_codigo" class="form-control" required>
                                        <?php                  

                                        require 'class/categorias.class.php';
                                        $cat = new Categorias();
                                        $listacat = $cat->getCategorias();

                                        foreach($listacat as $categoria):
                                        ?>
                                            <option value="<?php echo $categoria['cat_id']; ?>"><?php echo $categoria['cat_descricao']; ?></option>
                                        <?php
                                        endforeach;
                                        ?>
                                        </select>
                                    </div>
                                </div> 
                                
                                <div class="col-sm-4">
                                    <div class="form-group">
                                    <label for="inputstatus">Ativo *</label>
                                        <select name="inputstatus" class="form-control" required>
                                            <option value="" selected>Escolha...</option>
                                            <option value="sim">Sim</option>
                                            <option value="nao">Não</option>
                                        </select>
                                    </div>
                                </div>
                                
                        </div>
                        
                        <br/>
                        <button class="btn btn-primary btn-block" type="submit">Confirmar</button>
            </form>
            <br/>
            <a class="btn btn-link btn-sm" href="admin-produto-lista.php">Voltar -> Lista de Produtos</a>                
    


    </div>
</main>

<?php
  require 'footer.php';
?>


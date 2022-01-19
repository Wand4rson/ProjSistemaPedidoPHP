<?php  
  require 'header.php';
  require 'class/produtos.class.php';
   
   if (isset($_POST['pro_id']) || !empty($_POST['pro_id'])){
    $pro = new Produtos();
    $pro_id = addslashes($_POST['pro_id']);

    //Busca dados a Alterar
    $result = $pro->getProdutosPorID($pro_id);		
    }


   //Clicou no Botão Alterar no form executa Ações //
   if (isset($_POST['btnalterar']))
   {      
                
            if (isset($_POST['inputcodigo']) && (!empty($_POST['inputcodigo']))) {
                $cat_codigo_alterar = htmlspecialchars(addslashes($_POST['inputcodigo']));
            }

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
            if ((isset($_POST['inputcodigo']) && (!empty($_POST['inputcodigo'])))             
            &&  (isset($_POST['inputdescricao']) && (!empty(trim($_POST['inputdescricao']))))) 
            {   
            
                $pro = new Produtos();
                if($pro->EditProduto($cat_codigo_alterar, $pro_descricao, $pro_ativo, $pro_precovenda, $categoria_codigo)!=false){                
                    $_SESSION['msgInfo']  = "Registro Alterado com sucesso. <br/>";	    
                    header("Location:admin-produto-lista.php");
                    die();
                }
                else
                {
                //
                }
            }
            else
            {
                //Não Preencheu Campos Obrigatórios
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
                        <h3>Alterar Produto</h3>
                    </div>
                    
                        <?php foreach($result as $produto): ?>
                        
                        <input class="form-control" type="hidden" name="inputcodigo" value="<?php echo $produto['pro_id']; ?>">


                        <div class="form-group">
                            <label for="inputdescricao">Descrição *</label>
                            <input type="text" class="form-control" id="inputdescricao" name="inputdescricao" placeholder="Descrição" value="<?php echo $produto['pro_descricao']; ?>" required>                    
                        </div>

                        <div class="form-group">
                            <label for="pro_precovenda">Preço de Venda </label>
                            <input type="text" class="form-control money" id="pro_precovenda" name="pro_precovenda" value="<?php echo $produto['pro_precovenda']; ?>" placeholder="Preço de Venda">                    
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
                                            <option value="<?php echo $categoria['cat_id']; ?>"<?php echo ($categoria['cat_id']==$produto['categoria_codigo'])?'selected="selected"':''; ?>> <?php echo $categoria['cat_descricao']; ?></option>
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
                                            <option value="">Escolha...</option>
                                                <option value="sim" <?php echo($produto['pro_ativo'] == 'sim')? 'selected="selected"':'';?>>Sim</option>
                                                <option value="nao" <?php echo($produto['pro_ativo'] == 'nao')? 'selected="selected"':'';?>>Não</option>
                                        </select>
                                     </div>
                                </div>
                    
                        </div>
                        
                        <?php 
                            endforeach;
                        ?>

                        <br/>
                        <button class="btn btn-primary btn-block" name="btnalterar" type="submit">Alterar</button>
                        
            </form>
            <br/>
            <a class="btn btn-link btn-sm" href="admin-produto-lista.php">Voltar -> Lista de Produtos</a>                
    
    </div>
</main>

<?php
  require 'footer.php';
?>


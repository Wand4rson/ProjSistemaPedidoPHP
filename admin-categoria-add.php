<?php  
  require 'header.php';
  require 'class/categorias.class.php';

    if (isset($_POST['inputdescricao']) && (!empty($_POST['inputdescricao']))){
        $cat_descricao = htmlspecialchars(addslashes($_POST['inputdescricao']));
    }


    if (isset($_POST['inputstatus']) && (!empty($_POST['inputstatus']))){
        $cat_status = htmlspecialchars(addslashes($_POST['inputstatus']));
    }


    if (isset($_POST['cat_aliquotaicms']) && (!empty($_POST['cat_aliquotaicms']))){
        $cat_aliquotaicms = htmlspecialchars(addslashes($_POST['cat_aliquotaicms']));
        $cat_aliquotaicms = str_replace(',','.', str_replace('.','', $cat_aliquotaicms));
    }

    if (isset($_POST['cat_aliquotaipi']) && (!empty($_POST['cat_aliquotaipi']))){
        $cat_aliquotaipi = htmlspecialchars(addslashes($_POST['cat_aliquotaipi']));
        $cat_aliquotaipi = str_replace(',','.', str_replace('.','', $cat_aliquotaipi));
    }


    //Se Todos os valores obrigatorios foram preenchidos grava//    
    if (isset($_POST['inputdescricao']) && (!empty($_POST['inputdescricao'])))
    {       

        $cat = new Categorias();
        
        if($cat -> AddCategoria($cat_descricao, $cat_status, $cat_aliquotaicms, $cat_aliquotaipi)!=false)
        {	
            $_SESSION['msgInfo']  = "Registro Inserido com sucesso. <br/>";        	    
            header("Location:admin-categoria-lista.php");
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
    <!-- <h1>Cadastro de Categorias</h1> -->

            <form class="form-signin" action="" method="POST">
            
                    <?php
                        if (isset($_SESSION['msgErros'])){
                            echo "<div class='alert alert-danger'>".$_SESSION['msgErros']."</div>";
                            unset($_SESSION['msgErros']);               
                        }    
                    ?>

                        <div class="text-center mb-4">
                            <img class="mb-4" src="img/categories-list.png" alt="Icone Principal">    
                            <h3>Cadastro de Categorias</h3>
                        </div>
                        
                        <div class="form-group">
                            <label for="inputdescricao">Descrição *</label>
                            <input type="text" class="form-control" id="inputdescricao" name="inputdescricao" placeholder="Descrição" required>                    
                        </div>

                        <div class="form-group">
                            <label for="cat_aliquotaicms">Aliquota ICMS </label>
                            <input type="text" class="form-control money" id="cat_aliquotaicms" name="cat_aliquotaicms" placeholder="Aliquota ICMS">                    
                        </div>

                        <div class="form-group">
                            <label for="cat_aliquotaipi">Aliquota IPI </label>
                            <input type="text" class="form-control money" id="cat_aliquotaipi" name="cat_aliquotaipi" placeholder="Aliquota IPI">                    
                        </div>
                        

                        <div class="row">  
                                                       
                                <div class="col-sm-12">
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
            <a class="btn btn-link btn-sm" href="admin-categoria-lista.php">Voltar -> Lista de Categorias</a>                
    


    </div>
</main>

<?php
  require 'footer.php';
?>


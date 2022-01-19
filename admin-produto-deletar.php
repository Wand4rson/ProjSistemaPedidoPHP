<?php  
  require 'header.php';
  require 'class/produtos.class.php';

    
    if (isset($_POST['pro_id']) || !empty($_POST['pro_id']))
    {      
        
        $pro = new Produtos();        
        $pro_id = addslashes($_POST['pro_id']);

        if($pro->RemoveProdutoID($pro_id)!=false){	
            $_SESSION['msgInfo']  = "Registro removido com sucesso. <br/>";	    
            header("Location: admin-produto-lista.php");            
            die();
        }else
        {
        //
        }
    }

?>

<?php
  require 'footer.php';
?>
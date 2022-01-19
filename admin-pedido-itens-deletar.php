<?php  
  require 'header.php';
  require 'class/pedidos.class.php';

    
    if (isset($_POST['ped_id']) || !empty($_POST['ped_id']))
    { 
        
        $ped = new Pedidos();;        
        

        if($ped->RemoveItensPedidoPorItem($_POST['ped_id'], $_POST['peditem_id'])!=false){	
            $_SESSION['msgInfo']  = "Item " . $_POST['peditem_id'] . " removido com sucesso do pedido ".$_POST['ped_id'].". <br/>";	    
            header("Location: admin-pedido-lista.php");            
            die();
        }
    }

?>

<?php
  require 'footer.php';
?>
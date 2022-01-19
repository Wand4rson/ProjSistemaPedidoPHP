<?php  
  require 'header.php';
  require 'class/pedidos.class.php';

    
    if (isset($_POST['ped_id']) || !empty($_POST['ped_id']))
    {      
        
        $ped = new Pedidos();        
        $ped_id = addslashes($_POST['ped_id']);

        if($ped->CancelarPedidoID($ped_id)!=false){	
            $_SESSION['msgInfo']  = "Registro Cancelado com sucesso. <br/>";	    
            header("Location: admin-pedido-lista.php");            
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
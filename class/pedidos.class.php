<?php

class Pedidos{

    public function getPedidos(){

        global $conn;
        

        $result = array();
        //$sql = "SELECT * FROM tab_pedido WHERE user_codigo=:user_codigo ORDER BY ped_id DESC";

        $sql = "SELECT tab_pedido.*,
            (select sum(peditem_precototal) FROM tab_pedido_item where pedido_id = tab_pedido.ped_id) as total_pedido,
            (select sum(peditem_precoicms) FROM tab_pedido_item where pedido_id = tab_pedido.ped_id) as total_icms,
            (select sum(peditem_precoipi) FROM tab_pedido_item where pedido_id = tab_pedido.ped_id) as total_ipi
        FROM tab_pedido 
        WHERE tab_pedido.user_codigo=:user_codigo ORDER BY tab_pedido.ped_id DESC";

        $sql = $conn->prepare($sql);
        $sql->bindValue("user_codigo", $_SESSION['UserIDLogin']);
        $sql->execute();

        if ($sql->rowCount() > 0){
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $result;
    }

    public function getPedidosPorID($ped_id){

        global $conn;
        
        $result = array();
        $sql = "SELECT * FROM tab_pedido WHERE user_codigo=:user_codigo AND ped_id=:ped_id";
        $sql = $conn->prepare($sql);
        $sql->bindValue("user_codigo", $_SESSION['UserIDLogin']);
        $sql->bindValue("ped_id", $ped_id);
        $sql->execute();

        if ($sql->rowCount() > 0){
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $result;
    }

    public function CancelarPedidoID($ped_id){
        global $conn;
        
        $sql = "UPDATE tab_pedido SET ped_cancelado='sim' WHERE user_codigo=:user_codigo AND ped_id=:ped_id";
        $sql = $conn->prepare($sql);
        $sql->bindValue("user_codigo", $_SESSION['UserIDLogin']);
        $sql->bindValue("ped_id", $ped_id);
        
        try
        {            
            return $sql->execute();
        }catch(PDOException $e){
            $_SESSION['msgErros']  = $e->getMessage() ."<br/>";
            return false;
        }

    }


    //Somente Insere Pedido
    public function AddPedido(){
        global $conn;
       

        $sql= " INSERT INTO tab_pedido(
            user_codigo,                       
            ped_datacadastro,
            ped_horacadastro,
            ped_cancelado,            
            ip_lancamento)
        VALUES (
            :user_codigo,                       
            :ped_datacadastro,
            :ped_horacadastro,
            :ped_cancelado,            
            :ip_lancamento)";
     

            try{
                
                $sql = $conn->prepare($sql);
                $sql->bindValue("user_codigo", $_SESSION['UserIDLogin']);                                
                $sql->bindValue("ped_cancelado", 'nao');
                $sql->bindValue("ped_datacadastro", date('Y-m-d'));
                $sql->bindValue("ped_horacadastro", date('H:i:s', time()));                
                $sql->bindValue("ip_lancamento",$_SERVER['REMOTE_ADDR']);                


                return $sql->execute();
            }catch(PDOException $e){
                $_SESSION['msgErros']  = $e->getMessage() ."<br/>";
                return false;
            }
    }    

    


    public function getPedidoItensPorPedido($pedido_id){

        global $conn;
        
        $result = array();
                
        $sql = "SELECT tab_pedido_item.*, tab_produtos.pro_descricao as descricao 
        FROM tab_pedido_item, tab_produtos
        WHERE 
            (tab_pedido_item.produto_id = tab_produtos.pro_id) and 
        tab_pedido_item.user_codigo=:user_codigo AND tab_pedido_item.pedido_id=:pedido_id ORDER BY tab_pedido_item.peditem_id DESC";
        
        $sql = $conn->prepare($sql);
        $sql->bindValue("user_codigo", $_SESSION['UserIDLogin']);
        $sql->bindValue("pedido_id", $pedido_id);
        $sql->execute();

        if ($sql->rowCount() > 0){
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $result;
    }

    public function RemoveItensPedidoPorItem($pedido_id, $peditem_id){
        global $conn;
        
        $sql = "DELETE FROM tab_pedido_item WHERE user_codigo=:user_codigo AND pedido_id=:pedido_id AND peditem_id=:peditem_id";
        $sql = $conn->prepare($sql);
        $sql->bindValue("user_codigo", $_SESSION['UserIDLogin']);
        $sql->bindValue("pedido_id", $pedido_id);
        $sql->bindValue("peditem_id", $peditem_id);
        
        try
        {            
            return $sql->execute();
        }catch(PDOException $e){
            $_SESSION['msgErros']  = $e->getMessage() ."<br/>";
            return false;
        }

    }


    public function AddPedidoItens($pedido_id, $produto_id, $produto_qtde){
        global $conn;
       

        //Busca Aliqutos do Produto Selecionado//
        if (!empty($produto_id)){
            
            require_once 'class/produtos.class.php';
            $pro = new Produtos();

            //Só fiz o foreach pois retornei como fetchAll para não quebrar outros locais
            ///do codigo
            foreach($pro->getProdutosPorID($produto_id) as $produto)
            {
                $aliquota_icms = $produto['cat_aliquotaicms'];
                $aliquota_ipi = $produto['cat_aliquotaipi'];
                $precovenda = $produto['pro_precovenda'];


                $precototal = $precovenda * $produto_qtde;
                $precoicms = ($precototal * $aliquota_icms) / 100;
                $precoipi = ($precototal * $aliquota_ipi) / 100;
            }
        }
        else
        {
            $_SESSION['msgErros']  ="Não foi possível adicionar item. <br/>";
            return false;  
        }
        
        
        

        $sql= " INSERT INTO tab_pedido_item(
            pedido_id,
            produto_id,
            peditem_qtdevendida,
            peditem_precounitario,
            peditem_aliquotaicms,
            peditem_aliquotaipi,            
            peditem_datacadastro,
            peditem_horacadastro,            
            ip_lancamento,
            user_codigo,
            peditem_precototal,
            peditem_precoicms,
            peditem_precoipi)
        VALUES (
            :pedido_id,
            :produto_id,
            :peditem_qtdevendida,
            :peditem_precounitario,
            :peditem_aliquotaicms,
            :peditem_aliquotaipi,            
            :peditem_datacadastro,
            :peditem_horacadastro,            
            :ip_lancamento,
            :user_codigo,
            :peditem_precototal,
            :peditem_precoicms,
            :peditem_precoipi)";
     

            try{
                
                $sql = $conn->prepare($sql);
                
                $sql->bindValue("pedido_id", $pedido_id);
                $sql->bindValue("produto_id", $produto_id);
                $sql->bindValue("peditem_qtdevendida", $produto_qtde);
                $sql->bindValue("peditem_precounitario", $precovenda);
                $sql->bindValue("peditem_aliquotaicms", $aliquota_icms);
                $sql->bindValue("peditem_aliquotaipi", $aliquota_ipi);

                $sql->bindValue("peditem_datacadastro", date('Y-m-d'));
                $sql->bindValue("peditem_horacadastro", date('H:i:s', time()));                
                $sql->bindValue("ip_lancamento",$_SERVER['REMOTE_ADDR']);                
                $sql->bindValue("user_codigo", $_SESSION['UserIDLogin']); 
                
                $sql->bindValue("peditem_precototal", $precototal);
                $sql->bindValue("peditem_precoicms", $precoicms);
                $sql->bindValue("peditem_precoipi", $precoipi);



                return $sql->execute();
            }catch(PDOException $e){
                $_SESSION['msgErros']  = $e->getMessage() ."<br/>";
                return false;
            }
    }  
    
    
    
}


?>
<?php

class Produtos{

    public function getProdutos(){

        global $conn;
        

        $result = array();
        $sql = "SELECT *, 
        (SELECT cat_descricao FROM tab_produtos_tipo WHERE user_codigo=tab_produtos.user_codigo AND cat_id=tab_produtos.categoria_codigo) as categoria_nome         
        FROM tab_produtos WHERE user_codigo=:user_codigo";
        $sql = $conn->prepare($sql);
        $sql->bindValue("user_codigo", $_SESSION['UserIDLogin']);
        $sql->execute();

        if ($sql->rowCount() > 0){
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $result;
    }

    public function getProdutosPorID($pro_id){

        global $conn;
        
        $result = array();        
        $sql = "SELECT tab_produtos.*, tab_produtos_tipo.cat_aliquotaicms, tab_produtos_tipo.cat_aliquotaipi
        FROM tab_produtos, tab_produtos_tipo 
        WHERE 
          tab_produtos.categoria_codigo=tab_produtos_tipo.cat_id and 
          tab_produtos.user_codigo=:user_codigo AND tab_produtos.pro_id=:pro_id";


        $sql = $conn->prepare($sql);
        $sql->bindValue("user_codigo", $_SESSION['UserIDLogin']);
        $sql->bindValue("pro_id", $pro_id);
        $sql->execute();

        if ($sql->rowCount() > 0){
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $result;
    }

    public function RemoveProdutoID($pro_id){
        global $conn;
        
        $sql = "DELETE FROM tab_produtos WHERE user_codigo=:user_codigo AND pro_id=:pro_id";
        $sql = $conn->prepare($sql);
        $sql->bindValue("user_codigo", $_SESSION['UserIDLogin']);
        $sql->bindValue("pro_id", $pro_id);
        
        try
        {            
            return $sql->execute();
        }catch(PDOException $e){
            $_SESSION['msgErros']  = $e->getMessage() ."<br/>";
            return false;
        }

    }

    public function AddProduto($pro_descricao, $pro_ativo, $pro_precovenda, $categoria_codigo){
        global $conn;

        if(empty($pro_descricao)){
            $_SESSION['msgErros']  = "Descrição Obrigatória não informado.<br/>";
            return false;
            exit;
        }

        if(empty($pro_ativo)){
            $_SESSION['msgErros']  = "Status Obrigatória não informado.<br/>";
            return false;
            exit;
        }
        

        $sql= " INSERT INTO tab_produtos(
            user_codigo,            
            pro_descricao,
            pro_ativo,
            pro_datacadastro,
            pro_horacadastro,
            pro_precovenda,
            categoria_codigo,
            ip_lancamento)
        VALUES (
            :user_codigo,            
            :pro_descricao,
            :pro_ativo,
            :pro_datacadastro,
            :pro_horacadastro,
            :pro_precovenda,
            :categoria_codigo,
            :ip_lancamento)";
     

            try{
                
                $sql = $conn->prepare($sql);
                $sql->bindValue("user_codigo", $_SESSION['UserIDLogin']);                
                $sql->bindValue("pro_descricao", $pro_descricao);
                $sql->bindValue("pro_ativo", $pro_ativo);
                $sql->bindValue("pro_datacadastro", date('Y-m-d'));
                $sql->bindValue("pro_horacadastro", date('H:i:s', time()));
                $sql->bindValue("pro_precovenda", $pro_precovenda);
                $sql->bindValue("categoria_codigo", $categoria_codigo);
                $sql->bindValue("ip_lancamento",$_SERVER['REMOTE_ADDR']);                


                return $sql->execute();
            }catch(PDOException $e){
                $_SESSION['msgErros']  = $e->getMessage() ."<br/>";
                return false;
            }
    }    
    
    
    public function EditProduto($pro_id, $pro_descricao, $pro_ativo, $pro_precovenda, $categoria_codigo){
        global $conn;

        if(empty($pro_descricao)){
            $_SESSION['msgErros']  = "Descrição Obrigatória não informado.<br/>";
            return false;
            exit;
        }

        if(empty($pro_ativo)){
            $_SESSION['msgErros']  = "Status Obrigatória não informado.<br/>";
            return false;
            exit;
        }




        $sql= " 
        UPDATE tab_produtos SET                        
            pro_descricao=:pro_descricao,
            pro_ativo=:pro_ativo,            
            pro_precovenda=:pro_precovenda,
            categoria_codigo=:categoria_codigo            

        WHERE
            user_codigo=:user_codigo AND pro_id=:pro_id";
     
            try{
                
                $sql = $conn->prepare($sql);
                $sql->bindValue("user_codigo", $_SESSION['UserIDLogin']);
                $sql->bindValue("pro_id", $pro_id);                
                $sql->bindValue("pro_descricao", $pro_descricao);
                $sql->bindValue("pro_ativo", $pro_ativo);    
                $sql->bindValue("pro_precovenda", $pro_precovenda);
                $sql->bindValue("categoria_codigo", $categoria_codigo);                
                
                return $sql->execute();
            }catch(PDOException $e){
                $_SESSION['msgErros']  = $e->getMessage() ."<br/>";
                return false;
            }
    }

}


?>
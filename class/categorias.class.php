<?php

class Categorias{

    public function getCategorias(){

        global $conn;
        

        $result = array();
        $sql = "SELECT * FROM tab_produtos_tipo WHERE user_codigo=:user_codigo";
        $sql = $conn->prepare($sql);
        $sql->bindValue("user_codigo", $_SESSION['UserIDLogin']);
        $sql->execute();

        if ($sql->rowCount() > 0){
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $result;
    }

    public function getCategoriasPorID($cat_id){

        global $conn;
        
        $result = array();
        $sql = "SELECT * FROM tab_produtos_tipo WHERE user_codigo=:user_codigo AND cat_id=:cat_id";
        $sql = $conn->prepare($sql);
        $sql->bindValue("user_codigo", $_SESSION['UserIDLogin']);
        $sql->bindValue("cat_id", $cat_id);
        $sql->execute();

        if ($sql->rowCount() > 0){
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $result;
    }

    public function RemoveCategoriaID($cat_id){
        global $conn;
        
        $sql = "DELETE FROM tab_produtos_tipo WHERE user_codigo=:user_codigo AND cat_id=:cat_id";
        $sql = $conn->prepare($sql);
        $sql->bindValue("user_codigo", $_SESSION['UserIDLogin']);
        $sql->bindValue("cat_id", $cat_id);
        
        try
        {            
            return $sql->execute();
        }catch(PDOException $e){
            $_SESSION['msgErros']  = $e->getMessage() ."<br/>";
            return false;
        }

    }

    public function AddCategoria($cat_descricao, $cat_ativo, $cat_aliquotaicms, $cat_aliquotaipi){
        global $conn;

        if(empty($cat_descricao)){
            $_SESSION['msgErros']  = "Descrição Obrigatória não informado.<br/>";
            return false;
            exit;
        }

        if(empty($cat_ativo)){
            $_SESSION['msgErros']  = "Status Obrigatória não informado.<br/>";
            return false;
            exit;
        }
        

        $sql= " INSERT INTO tab_produtos_tipo(
            user_codigo,            
            cat_descricao,
            cat_ativo,
            cat_datacadastro,
            cat_horacadastro,
            ip_lancamento, 
            cat_aliquotaicms, 
            cat_aliquotaipi)
        VALUES (
            :user_codigo,            
            :cat_descricao,
            :cat_ativo,
            :cat_datacadastro,
            :cat_horacadastro,
            :ip_lancamento,
            :cat_aliquotaicms, 
            :cat_aliquotaipi)";
     

            try{
                
                $sql = $conn->prepare($sql);
                $sql->bindValue("user_codigo", $_SESSION['UserIDLogin']);                
                $sql->bindValue("cat_descricao", $cat_descricao);
                $sql->bindValue("cat_ativo", $cat_ativo);
                $sql->bindValue("cat_datacadastro", date('Y-m-d'));
                $sql->bindValue("cat_horacadastro", date('H:i:s', time()));
                $sql->bindValue("ip_lancamento",$_SERVER['REMOTE_ADDR']);
                $sql->bindValue("cat_aliquotaicms", $cat_aliquotaicms);
                $sql->bindValue("cat_aliquotaipi", $cat_aliquotaipi);


                return $sql->execute();
            }catch(PDOException $e){
                $_SESSION['msgErros']  = $e->getMessage() ."<br/>";
                return false;
            }
    }    
    
    
    public function EditCategoria($cat_id, $cat_descricao, $cat_ativo, $cat_aliquotaicms, $cat_aliquotaipi){
        global $conn;

        if(empty($cat_descricao)){
            $_SESSION['msgErros']  = "Descrição Obrigatória não informado.<br/>";
            return false;
            exit;
        }

        if(empty($cat_ativo)){
            $_SESSION['msgErros']  = "Status Obrigatória não informado.<br/>";
            return false;
            exit;
        }




        $sql= " 
        UPDATE tab_produtos_tipo SET            
            cat_descricao=:cat_descricao,
            cat_ativo=:cat_ativo,
            cat_aliquotaicms=:cat_aliquotaicms, 
            cat_aliquotaipi=:cat_aliquotaipi
        WHERE
            user_codigo=:user_codigo AND cat_id=:cat_id";
     
            try{
                
                $sql = $conn->prepare($sql);
                $sql->bindValue("user_codigo", $_SESSION['UserIDLogin']);
                $sql->bindValue("cat_id", $cat_id);                
                $sql->bindValue("cat_descricao", $cat_descricao);
                $sql->bindValue("cat_ativo", $cat_ativo);
                $sql->bindValue("cat_aliquotaicms", $cat_aliquotaicms);
                $sql->bindValue("cat_aliquotaipi", $cat_aliquotaipi);
                
                return $sql->execute();
            }catch(PDOException $e){
                $_SESSION['msgErros']  = $e->getMessage() ."<br/>";
                return false;
            }
    }

}


?>
<?php
        
    $user ='postgres';
    $password ='1234';
    $dbname='appvendas';
    $servidor='localhost';
    $port = "5432";
    

    try{
        $conn = new PDO("pgsql:host=$servidor;port=$port;dbname=$dbname;user=$user;password=$password");
        //echo "Conectado com PostgreSQL";
    }catch(PDOException $e){
        echo "Erro ao conectar no banco de dados .:".$e->getMessage();
        die();
    }


?>
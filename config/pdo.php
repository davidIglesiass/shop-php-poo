<?php

Class MyPDO{
    public static function connect(){
        try{
            $pdo = new PDO('mysql:host=localhost;dbname=shop;charset=utf8', 'root', '0000');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}
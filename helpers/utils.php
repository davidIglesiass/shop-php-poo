<?php

class Utils{

    public static function deleteSession($name){
        if(isset($_SESSION[$name])){
            $_SESSION[$name] = null;
        }

        return $name;
    }

    public static function isAdmin(){
        if(!isset($_SESSION['admin'])) return header('Location: /');
        return true;
    }

    public static function showCategories(){
        require_once 'models/CategoryModel.php';
        $category = new CategoryModel();
        $categories = $category->getAll();
        return $categories;
    }
}
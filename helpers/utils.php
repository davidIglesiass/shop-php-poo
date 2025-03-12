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

    public static function isIdentity(){
        if(!isset($_SESSION['identity'])) return header('Location: /');
        return true;
    }

    public static function showCategories(){
        require_once 'models/CategoryModel.php';
        $category = new CategoryModel();
        $categories = $category->getAll();
        return $categories;
    }

    public static function statsCarShop(){
        $stats = array('count' => 0, 'total' => 0);
        if(isset($_SESSION['carshop'])){
            foreach($_SESSION['carshop'] as $product){
                $stats['count'] += $product['units'];
                $stats['total'] += $product['price'] * $product['units'];
            }
        }
        return $stats;   
    }

    public static function showStatus($status){
        $value = 'Requested';
        switch ($status) {
            case 'requested':
                $value = 'Requested';
                break;
            case 'paid':
                $value = 'Paid';
                break;
            case 'shipped':
                $value = 'Shipped';
                break;
            case 'delivered':
                $value = 'Delivered';
                break;
            case 'cancelled':
                $value = 'Cancelled';
                break;
        }
        return $value;
    }
}
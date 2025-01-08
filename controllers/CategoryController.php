<?php

require_once 'models/CategoryModel.php';
require_once 'models/ProductModel.php';

class CategoryController{
    public function index(){
        Utils::isAdmin();
        $categories = new CategoryModel();
        $categories = $categories->getAll();

        require_once 'views/category/index.php';
    }

    public function show(){
        if(isset($_GET['id'])){
            $category = new CategoryModel;
            $category->setId($_GET['id']);
            $categorie = $category->getOne();
 
            $product = new ProductModel;
            $product->setCategoryId($_GET['id']);
            $productByCategory = $product->getAllCategories();
        }
        require_once 'views/category/show.php';
    }
    
    public function save(){
        Utils::isAdmin();
        $category = new CategoryModel();
        $category->setName($_POST['name']);
        $category->save();
        header('Location: /category/index');
    }
}
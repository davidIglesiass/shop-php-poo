<?php

require_once 'models/ProductModel.php';

class ProductController
{
    public function index()
    {
        $product = new ProductModel();
        $products = $product->getRandom(6);
        require_once 'views/product/index.php';
    }

    public function manage(){
        Utils::isAdmin();

        $product = new ProductModel();
        $products = $product->getAll();
        require_once 'views/product/manage.php';
    }

    public function create(){
        Utils::isAdmin();
        require_once 'views/product/create.php';
    }

    public function save(){
        Utils::isAdmin();

        if(!$_POST) return header('Location: /product/create');

        if(!empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['price']) && !empty($_POST['stock'])){
            $product = new ProductModel();
            $product->setCategoryId($_POST['category_id']);
            $product->setName($_POST['name']);
            $product->setDescription($_POST['description']);
            $product->setPrice($_POST['price']);
            $product->setStock($_POST['stock']);

            if(!empty($_FILES['image']['name'])){
                $file = $_FILES['image']['tmp_name'];
                $filename = $_FILES['image']['name'];
                $filetype = $_FILES['image']['type'];

                if($filetype == 'image/jpeg' || $filetype == 'image/png' || $filetype == 'image/webp' || $filetype == 'image/jpg'){
                    if(!is_dir('public/uploads/products/')) mkdir('public/uploads/products/', 0777, true);
                    move_uploaded_file($file, 'public/uploads/products/'.$filename);
                    $product->setImage($filename);
                }
            }

            if(isset($_GET['id'])){
                $product->setId($_GET['id']);
                $product->update();
                $_SESSION['productupdated'] = 'Product updated successfully';

            }else{
                $product->save();
                $_SESSION['productsaved'] = 'Product saved successfully';
            }
            


        }else{
            $_SESSION['productunsaved'] = 'Product not saved'; 
        }

        header('Location: /product/manage');

    }

    public function delete(){
        Utils::isAdmin();
        $product = new ProductModel();
        if(isset($_GET['id'])){
            $product->setId($_GET['id']);
            $delete = $product->delete();

            if($delete){
                $_SESSION['productdeleted'] = 'Product deleted successfully';
            }else{
                $_SESSION['productundeleted'] = 'Product not deleted';
            }
        }else{
            $_SESSION['productundeleted'] = 'Product not deleted';
        }

        header('Location: /product/manage');
    }

    public function update(){
        Utils::isAdmin();
        $product = new ProductModel();
        $edit = true;
        
        if(isset($_GET['id'])){
            $product->setId($_GET['id']);
            $getOneProduct = $product->getOne();
        }else{
            $_SESSION['productnotfound'] = 'Product not found';
            header('Location: /product/manage');
        }
        require_once 'views/product/create.php';
    }

    public function show(){
        $product = new ProductModel();
        $product->setId($_GET['id']);
        $product = $product->getOne();
        require_once 'views/product/show.php';
    }
}

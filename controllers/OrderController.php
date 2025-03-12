<?php

require_once 'models/OrderModel.php';

class OrderController
{
    public function index()
    {
        require_once 'views/order/index.php';
    }

    public function add()
    {

        if(!isset($_SESSION['identity'])) return header('Location: /');

        $statsCarshop = Utils::statsCarShop();

        try {
            $order = new OrderModel();
            $order->setState($_POST['state']);
            $order->setCity($_POST['city']);
            $order->setAddress($_POST['address']);
            $order->setUserId($_SESSION['identity']['id']);
            $order->setPrice($statsCarshop['total']);
            $order->save();
            $order->save_foreign_key();
            
            $_SESSION['ordercreated'] = 'Order created successfully';

            header('Location: /order/done');
        } catch (Exception $e) {
            $_SESSION['orderfailed'] = 'Unable to create order';
        }
    }

    public function done()
    {
        if (!isset($_SESSION['identity'])) return header('Location: /views/order/index.php');
        $identity = $_SESSION['identity'];
        $order = new OrderModel();   
        $order = $order->setUserId($identity['id']);

        $order = $order->getOneByUser();

        $orderProducts = new OrderModel();
        $products = $orderProducts->getProductsByOrder($order->id);

        require_once 'views/order/done.php';
    }

    public function myOrders(){
        Utils::isIdentity();
        $order = new OrderModel();
        $order = $order->setUserId($_SESSION['identity']['id']);
        $orders = $order->getAllByUser();
        require_once 'views/order/myorders.php';
    }

    public function show(){
        Utils::isIdentity();

        if(!isset($_GET['id'])) return header('Location: /order/myorders');

        $order = new OrderModel();
        $order = $order->setId($_GET['id']);
        $order = $order->getOne();
        $orderProducts = new OrderModel();
        $products = $orderProducts->getProductsByOrder($_GET['id']);
        require_once 'views/order/show.php';
    }

    public function manage(){
        Utils::isAdmin();
        $order = new OrderModel();
        $manage = true;
        $orders = $order->getAll();
        require_once 'views/order/myorders.php';
    }

    public function status(){
        Utils::isAdmin();
        if(!isset($_POST['id']) || !isset($_POST['status'])) return header('Location: /order/manage');
        $order = new OrderModel();
        $order->setId($_POST['id']);
        $order->setStatus($_POST['status']);
        $order->updateStatus();
        header('Location: /order/show&id='.$_POST['id']);
    }


}

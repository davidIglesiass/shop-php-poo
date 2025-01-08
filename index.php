<?php

session_start();
require_once 'autoload.php';
require_once 'helpers/utils.php';
require_once 'config/pdo.php';
require_once 'config/constants.php';
require_once 'views/layout/header.php';
require_once 'views/layout/sidebar.php';

function showError(){
    $error = new ErrorController();
    $error->index();
}

if(isset($_GET['controller'])){
    $controller = ucfirst($_GET['controller']).'Controller';
}elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {
    $controller = controller_default;
}else{
    showError();
    exit();
}

if(class_exists($controller)){
    $controller = new $controller();
    if(isset($_GET['action']) && method_exists($controller, $_GET['action'])){
        $action = $_GET['action'];
        $controller->$action();
    } elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {
        $action = action_default;
        $controller->$action();
    }else{
        showError();
    }
}else{
    showError();
}

require_once 'views/layout/footer.php';
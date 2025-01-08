<?php

require_once 'models/UserModel.php';

class UserController
{
    public function index()
    {
        echo 'User controller, action index';
    }

    public function create()
    {
        require_once 'views/user/create.php';
    }

    public function save(){
        if(!isset($_POST)) return $_SESSION['registerfailed'] = 'unable to save' && header('Location: /user/create');

        if(!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['email']) && !empty($_POST['password'])) {

            if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                $_SESSION['registerfailed'] = 'unable to save';
                return header('Location: /user/create');
            }

            $user = new UserModel();
            $user->setName($_POST['firstname'].' '.$_POST['lastname']);
            $user->setEmail($_POST['email']);
            $user->setPassword($_POST['password']);
            $user->save();

            $_SESSION['registersaved'] = 'completed successfully';
        }else{
            $_SESSION['registerfailed'] = 'Please fill all the fields';
        }

        header('Location: /user/create');
    }

    public function login(){

        if (!isset($_POST)){
            $_SESSION['loginfailed'] = 'unable to login';
            return header('Location: /');
        }    

        $user = new UserModel();
        $user->setEmail($_POST['email']);
        $user->setPassword($_POST['password']);

        $indentity = $user->login();

        if(!$indentity){
            $_SESSION['loginfailed'] = 'unable to login';
            return header('Location: /');
        }

        $_SESSION['identity'] = $indentity;
        
        if($indentity['rol'] == 'admin') $_SESSION['admin'] = true;
        
        return header('Location: /');
    }

    public function logout(){
        if(isset($_SESSION['identity']) || isset($_SESSION['admin'])) unset($_SESSION['identity'], $_SESSION['admin']);

        header('Location: /');
    }
}
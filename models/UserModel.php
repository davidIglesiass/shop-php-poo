<?php

class UserModel{
    private $id;
    private $name;
    private $email;
    private $password;
    private $rol;
    private $image;
    private $created_at;
    private $db;

    public function __construct(){
        $this->db = MyPDO::connect();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword()
    {
        return password_hash($this->password, PASSWORD_BCRYPT, ['cost' => 4]);
    }

    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    public function getRol()
    {
        return $this->rol;
    }

    public function setRol($rol)
    {
        $this->rol = $rol;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function save()
    {
        $stmt = $this->db->prepare("INSERT INTO users VALUES(null, :name, :email, :password, 'user', null, CURRENT_TIMESTAMP)");
        $name = $this->getName();
        $email = $this->getEmail();
        $password = $this->getPassword();

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);

        try {
            $stmt->execute();
        } catch (PDOException $e) {
            $error = $e->getMessage();
            echo "Error al guardar el usuario: $error";
            return false;
        }

        return true;
    }

    public function login(){
        
        $email = $this->email;
        $password = $this->password;

        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user && password_verify($password, $user["password"])) {
            return $user;
        }

        return false;
    }
}
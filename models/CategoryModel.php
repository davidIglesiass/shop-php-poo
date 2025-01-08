<?php

class CategoryModel{
    private $id;
    private $name;
    private $created_at;
    private $db;

    public function __construct()
    {
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

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getAll(){
        $stmt = $this->db->prepare("SELECT * FROM categories ORDER BY id DESC");
        $stmt->execute();
        $categories = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $categories;
    }

    public function getOne(){
        $stmt = $this->db->prepare("SELECT * FROM categories WHERE id = {$this->getId()}");
        $stmt->execute();
        $categories = $stmt->fetchObject();
        return $categories;
    }

    public function save(){
        $stmt = $this->db->prepare("INSERT INTO categories VALUES(null, :name, CURRENT_TIMESTAMP)");
        $name = $this->getName();
    
        $stmt->bindParam(':name', $name);
    
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            $error = $e->getMessage();
            echo "Error al guardar la categoria: $error";
            return false;
        }
    
        return true;
    }
    
}